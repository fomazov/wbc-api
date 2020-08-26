<?php

namespace WBC\Controllers;

use WBC\Models\PasswordReset;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;
use WBC\Helpers\ValidationErrors\Uniqueness as HubUnique;

use WBC\Models\Client;
use WBC\Models\ClientEmail;
use WBC\Models\ClientLibrary;
use WBC\Models\ChangeEmailRequest;
use WBC\Models\RegisterRequest;
use WBC\Models\Companies;
use WBC\Models\ManagerRequest;
use WBC\Models\ManagerCompanyRequest;
use WBC\Models\XmppUsers;

class AuthController extends ApiController
{

    const ROUTE_EMAIL_NOTIFICATION = 'notification_global_email';

    const RESULT_MESSAGE_KEY = 'message';
    const RESULT_CLIENT_COMPANY = 'status';
    const RESULT_TYPE_KEY = 'type';

    public function login()
    {
        $user = $this->getDI()->getSso()->login();
        if ($user instanceof Client) {
            $user->resetToken();
            $user->save();

            $this->doOnLogin($user);

            return $this->setJsonResponse($user->toArray(), 'success');
        } else {
            return $this->setJsonResponse($user, 'errorUnauthorized');
        }

    }

    protected function doOnLogin(Client $user)
    {
        $user->setLastVisit(date('Y-m-d H:i:s'));
        $user->save();

        $di     = $this->getDI();
        $config = $di->getConfig();

        $stopFunction = function () use($user, $di) {
            $user->resetToken();
            $user->save();

            $di->getSso()->logout();
        };

        return true;
    }

    public function registerUser()
    {
        /**
         * Checking whether user is already exists
         */
        foreach (['WBC\Models\RegisterRequest', 'WBC\Models\ClientEmail'] as $class) {
            if ($class::findFirstByEmail($this->request->getPost('email'))) {

                $messages = array();
                $unique = new HubUnique($messages);
                $unique->email();

                return $this->setJsonResponse($messages, 'errorUnauthorized');

            }
        }

        $company = $this->request->getPost('company', 'striptags');
        $companyField = null;

        if (mb_strlen($company) > 0) {
            $companyModel = Companies::findFirstById($company);

            if ($companyModel) {
                $companyField = $companyModel->getId();
            } else {
                $companyField = $company;
            }
        }

        $assign = array(
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'first_name' => $this->request->getPost('first_name', 'striptags'),
            'last_name' => $this->request->getPost('last_name', 'striptags'),
            'company_field' => $companyField
        );

        $registerRequest = new RegisterRequest();
        $registerRequest->request_url = $this->request->getPost('request_url');
        $registerRequest->assign($assign);

        if ($registerRequest->save()) {
            return $this->setJsonResponse($registerRequest->toArray(), 'success');
        } else {
            return $this->setJsonResponse($registerRequest->getMessages(), 'errorUnauthorized');
        }
    }

    public function activateEmailUser($code, $email)
    {
        $clientEmail = ClientEmail::findFirstByEmail($email);
        if (!$clientEmail) {
            return $this->getSendErrorTextMessage(_('errmsg_invalid_activation_email') . ': ' . $email);
        }

        if ($clientEmail->getIsVerified()) {
            return $this->getSendErrorTextMessage(_('errmsg_invalid_activation_email_is_verified') . ': ' . $email);
        }

        if ($clientEmail->getCode() != $code) {
            return $this->getSendErrorTextMessage(_('errmsg_invalid_activation_code') . ': ' . $code);
        }
        $clientEmail->setIsVerified(1);

        if ($clientEmail->save()) {
            $client = $clientEmail->getClient();
            $res = $client->toArray();
            $res['email'] = $clientEmail->getEmail();

            return $this->setJsonResponse($res, 'success');
        }

        return $this->setJsonResponse($clientEmail->getMessages(), 'errorUnauthorized');
    }

    public function activateUser($code)
    {

        if (!$registerRequest = RegisterRequest::findFirstByCode($code)) {
            return $this->getSendErrorTextMessage(_('errmsg_invalid_activation_code') . ': ' . $code);
        }

        $client = new Client();
        $client->assign(array(
            'password' => $registerRequest->getPassword(),
            'first_name' => $registerRequest->getFirstName(),
            'last_name' => $registerRequest->getLastName(),
            'linkedin_profile_url' => $registerRequest->getLinkedinProfileUrl(),
            'user_type' => Client::UT_USER
        ));

        if (!$client->save()) {
            return $this->setJsonResponse($client->getMessages(), 'errorUnauthorized');
        }

        $clientEmail = new ClientEmail();
        $clientEmail->assign(array(
            'client_id' => $client->getId(),
            'is_main' => 1,
            'is_verified' => 1,
            'email' => $registerRequest->getEmail()
        ));

        $res = $client->toArray();

        if ($clientEmail->save()) {
            $res['email'] = $clientEmail->getEmail();
        } else {
            return $this->setJsonResponse($clientEmail->getMessages(), 'errorUnauthorized');
        }

        $this->setDefaultNotifications($client);

        if ($registerRequest->getCompanyField()) {
            $companyModel = Companies::findFirstById($registerRequest->getCompanyField());

            $resCompany = true;
            if ($companyModel) {
                $resCompany = $this->addExistCompanyToUser($client, $companyModel->getId(), false, true);
                if ($resCompany !== true && $resCompany !== false) {
                    return $resCompany;
                }
            }

            if (!$companyModel || ($companyModel && !$resCompany)) {
                $managerRequestModel = new ManagerRequest();
                $managerRequestModel->setClientId($client->getId());
                $managerRequestModel->setStatus(ManagerRequest::STATUS_REGISTERED);
                $managerRequestModel->setIsDeleted(ManagerRequest::IS_NOT_DELETED);
                $managerRequestModel->setType(ManagerRequest::TYPE_COMPANY_REQUEST);
                $managerRequestModel->setToken(preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24))));
                if ($companyModel && !$resCompany) {
                    $managerRequestModel->setCompanyVerified(1);
                    $managerRequestModel->setCompanyId($companyModel->getId());
                }

                if (!$managerRequestModel->save()) {
                    return $this->setJsonResponse($managerRequestModel->getMessages(), 'errorUnauthorized');
                }

                $managerCompRequestModel = new ManagerCompanyRequest();
                $managerCompRequestModel->setName($registerRequest->getCompanyField());
                if ($companyModel && !$resCompany) {
                    $managerCompRequestModel->setName($companyModel->getName());
                }
                $managerCompRequestModel->setRequestId($managerRequestModel->getId());
                $managerCompRequestModel->setIsOut(0);
                $managerCompRequestModel->setClientId($client->getId());

                if (!$managerCompRequestModel->save()) {
                    return $this->setJsonResponse($managerCompRequestModel->getMessages(), 'errorUnauthorized');
                }

                $managerRequestModel->setLastId($managerCompRequestModel->getId());

                if (!$managerRequestModel->save()) {
                    return $this->setJsonResponse($managerRequestModel->getMessages(), 'errorUnauthorized');
                }

                $activateUrl = $this->getDi()->getEnvUrl('profileUrl', sprintf('/company/request/%s/%s', $managerRequestModel->getId(), $managerRequestModel->getToken()));
                $mailer = $this->getDi()->getMailer();

                $vars = [
                    'firstName' => $client->getFirstName(),
                    'lastName' => $client->getLastName(),
                    'requestUrl' => $activateUrl
                ];
                $message = $mailer->createMessageFromView('company_verify', $vars)
                    ->to($clientEmail->getEmail(), $client->getFirstName() . ' ' . $client->getLastName())
                    ->subject(_('approve_company_on_register'));

                $message->send();
            }
        }

        $this->doOnLogin($client);
        return $this->setJsonResponse($res, 'success');
    }

    public function setDefaultNotifications($clientModel)
    {
        $allowField = $this->notification->getUserNotificationTypes($clientModel);
        $convert = $this->notification->getNotificationTypes();

        $typeList = array();
        foreach ($allowField as $fieldName) {
            foreach ($convert as $postFix) {
                $typeList[$fieldName . '_' . $postFix] = 1;
            }
        }

        if (count($typeList)) {
            foreach ($typeList as $keyName => $keyValue) {
                $libraryItem = new ClientLibrary();
                $libraryItem->setLibKey($keyName);
                $libraryItem->setLibValue($keyValue);
                $libraryItem->setClientId($clientModel->getId());

                $libraryItem->clientLibraryNotificationValidation();

                if (!$libraryItem->validation() || !$libraryItem->save()) {
                    continue;
                }
            }
        }

        $typeRequest = self::ROUTE_EMAIL_NOTIFICATION;

        $resList = $clientModel->getRelated('ClientLibrary', array(
            'conditions' => 'key = :key:',
            'bind' => array(
                'key' => $typeRequest
            ),
            'limit' => 1
        ));

        $item = $resList->getFirst();

        if (!$item) {
            $item = new ClientLibrary();
            $item->setLibKey($typeRequest);
            $item->setLibValue(1);
            $item->setClientId($clientModel->getId());

            $item->save();
        }
    }

    public function activateLoginUser($code)
    {
        $transactionManager = new TransactionManager();
        $transaction = $transactionManager->get();

        $changeEmailRequest = ChangeEmailRequest::findFirstByCode($code);
        if (!$changeEmailRequest) {
            return $this->getSendErrorTextMessage(_('errmsg_invalid_activation_code') . ': ' . $code);
        }

        $changeEmailRequest->setTransaction($transaction);
        $client = $changeEmailRequest->getClient();
        if (!$client) {
            return $this->getSendErrorTextMessage(_('errmsg_client_not_exist') . ': ' . $code);
        }

        $email = ClientEmail::findFirst(array(
            'conditions' => 'client_id = :client_id: AND is_main = :is_main:',
            'bind' => array(
                'client_id' => $client->getId(),
                'is_main' => 1,
            )
        ));
        if (!$client) {
            return $this->getSendErrorTextMessage(_('errmsg_email_not_exist') . ': ' . $code);
        }

        $changeEmailRequest->delete();

        $email->setTransaction($transaction);
        $email->setEmail($changeEmailRequest->getEmail());
        if (!$email->save()) {
            return $this->setJsonResponse($email->getMessages(), 'errorUnauthorized');
        }
        $transaction->commit();


        $res = $client->toArray();
        $res['email'] = $email->getEmail();
        $this->doOnLogin($client);

        return $this->setJsonResponse($res, 'success');
    }

    public function attach()
    {
        $this->getDI()->getSso()->attach();
    }

    public function logout()
    {
        $user = $this->getDI()->getSso()->userInfo();
        if ($user instanceof Client) {
            $user->resetToken();
            $user->setLastVisit(date('Y-m-d H:i:s'));
            $user->save();
        }

        $this->getDI()->getSso()->logout();
    }

    public function userInfo()
    {
        $user = $this->getDI()->getSso()->userInfo();
        if ($user instanceof Client) {
            $result = $user->toArray();
            return $this->setJsonResponse($result, 'success');
        } else {
            return $this->setJsonResponse($user, 'errorUnauthorized');
        }
    }

    public function checkOk()
    {
        $result = array(self::RESULT_MESSAGE_KEY => 'ok');
        return $this->setJsonResponse($result);
    }

    // linkedIn & Facebook
    public function socialRegLogin()
    {
        /**
         * Checking whether user is already exists
         */
        foreach (['WBC\Models\RegisterRequest', 'WBC\Models\ClientEmail'] as $class) {
            if ($class::findFirstByEmail($this->request->getPost('emailAddress'))) {
                return $this->socialLogin();
            }
        }

        $positions = $this->request->getPost('positions');

        $company = "";
        if ($positions && count($positions['values'])) {
            foreach ($positions['values'] as $position) {
                if (isset($position['isCurrent']) && $position['isCurrent'] == 1 &&
                    isset($position['company']) && isset($position['company']['name'])
                ) {
                    $company = $position['company']['name'];
                }
            }
        }
        $companyField = null;

        if (mb_strlen($company) > 0) {
            $companyModel = Companies::findFirstById($company);

            if ($companyModel) {
                $companyField = $companyModel->getId();
            } else {
                $companyField = $company;
            }
        }

        $assign = array(
            'email' => $this->request->getPost('emailAddress'),
            'password' => $this->request->getPost('password'),
            'first_name' => $this->request->getPost('firstName', 'striptags'),
            'last_name' => $this->request->getPost('lastName', 'striptags'),
            'company_field' => $companyField
        );

        $linkedinProfileUrl = $this->request->getPost('publicProfileUrl', 'striptags');
        if ($linkedinProfileUrl) {
            $assign['linkedin_profile_url'] = $linkedinProfileUrl;
        }

        $registerRequest = new RegisterRequest();
        $registerRequest->assign($assign);
        $registerRequest->sendEmail = false;

        if ($registerRequest->save()) {
            $res = $this->activateUser($registerRequest->getCode());
            if ($res->getStatusCode() == "200 Ok") {
                return $this->socialLogin();
            }
        } else {
            return $this->setJsonResponse($registerRequest->getMessages(), 'errorUnauthorized');
        }
    }

    private function socialLogin()
    {
        $_POST['username'] = $this->request->getPost('emailAddress');
        $user = $this->getDI()->getSso()->login(false);
        if ($user instanceof Client) {
            $user->resetToken();
            $user->save();
            $this->doOnLogin($user);
            return $this->setJsonResponse($user->toArray(), 'success');
        } else {
            return $this->setJsonResponse($user, 'errorUnauthorized');
        }
    }

    public function pwdResetSend()
    {
        $email = $this->request->getPost('email');
        $requestUrl = $this->request->getPost('request_url');

        $clientEmail = ClientEmail::findFirstByEmail($email);
        if (!$clientEmail) {
            return $this->setJsonResponse([self::RESULT_MESSAGE_KEY => [_('errmsg_email_not_exist')]], 'error');
        }

        $client = Client::findFirst($clientEmail->getClientId());
        if (!$client) {
            return $this->setJsonResponse([self::RESULT_MESSAGE_KEY => [_('errmsg_client_not_exist')]], 'error');
        }

        $passwordReset = PasswordReset::findFirst([
            "conditions" => "email = :email:",
            "bind" => ["email" => $email]
        ]);
        if ($passwordReset) {
            $passwordReset->setCode(preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24))));
        } else {
            $passwordReset = new PasswordReset();
            $passwordReset->setClientId($client->getId());
            $passwordReset->setEmail($clientEmail->getEmail());
        }
        $passwordReset->save();
        $code = $passwordReset->getCode();

        $resetUrl = $this->getDi()->getEnvUrl('clientUrl', sprintf('/password-reset/%s', $code));
        $mailer = $this->getDi()->getMailer();

        if($requestUrl) {
            $resetUrl .= '?request_url='.$requestUrl;
        }

        $vars = [
            'firstName' => $client->getFirstName(),
            'lastName' => $client->getLastName(),
            'resetUrl' => $resetUrl
        ];
        $message = $mailer->createMessageFromView('password_reset', $vars)
            ->to($clientEmail->getEmail(), $client->getFirstName() . ' ' . $client->getLastName())
            ->subject(_('subj_password_reset'));

        if ($message->send()) {
            return $this->setJsonResponse([self::RESULT_MESSAGE_KEY => [_('msg_password_reset_code_was_sent')]]);
        } else {
            return $this->setJsonResponse([self::RESULT_MESSAGE_KEY => [_('errmsg_password_reset_code_send')]], 'error');
        }
    }

    public function pwdResetCheck()
    {
        $code = $this->request->getPost('code', 'striptags');
        $passwordReset = PasswordReset::findFirst([
            "conditions" => "code = :code:",
            "bind" => [
                "code" => $code
            ]
        ]);
        if ($passwordReset) {
            return $this->setJsonResponse([self::RESULT_MESSAGE_KEY => ['ok']]);
        } else {
            return $this->setJsonResponse([self::RESULT_MESSAGE_KEY => [_('errmsg_password_reset_code_false')]], 'error');
        }
    }

    public function pwdReset()
    {
        $code = $this->request->getPost('code', 'striptags');
        $password = $this->request->getPost('password', 'striptags');
        $passwordRepeat = $this->request->getPost('password_repeat', 'striptags');
        $passwordReset = PasswordReset::findFirst([
            "conditions" => "code = :code:",
            "bind" => ["code" => $code]
        ]);


        if (!$passwordReset) {
            return $this->setJsonResponse([self::RESULT_MESSAGE_KEY => [_('errmsg_password_reset_code_false')]], 'error');
        }
        if (!$passwordRepeat) {
            return $this->setJsonResponse([self::RESULT_MESSAGE_KEY => [_('errmsg_password_repeat_needed')]], 'error');
        }
        if ($password != $passwordRepeat) {
            return $this->setJsonResponse([self::RESULT_MESSAGE_KEY => [_('errmsg_password_and_repeat_not_equal')]], 'error');
        }

        $client = Client::findFirst($passwordReset->getClientId());
        $client->setNewPassword($password);
        $client->save();

        $clientEmail = ClientEmail::findFirst([
            "conditions" => "client_id = :client_id: AND is_main=1",
            "bind" => ["client_id" => $client->getId()]
        ]);
        $email = $clientEmail->getEmail();
        $passwordReset->delete();
        return $this->setJsonResponse(['email'=>$email], 'success');
    }
}
