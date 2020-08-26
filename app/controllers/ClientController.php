<?php

namespace WBC\Controllers;

use WBC\Models\Client;

class ClientController extends ApiController
{

    const RESULT_MESSAGE_KEY = 'message';

    public function getByCurrentToken()
    {
        $token = $this->request->getHeader('token');
        $entity = Client::findFirstByToken($token);
        if (!$entity) {
            return $this->setJsonNotFound();
        }

        $result = $this->normalize($entity);
        return $this->setJsonResponse($result);
    }

    public function getByIds($ids)
    {
        $currentClient = $this->getCurrentUser();

        if (!$currentClient->getCompanyId()) {
            return $this->getSendErrorTextMessage(_('client_company_is_empty'));
        }

        $ids = explode(",", $ids);
        $clients = Client::query()
            ->inWhere('id', $ids)
            ->execute();

        if (count($clients)) {
            foreach ($clients as $entity){
                $result[] = $this->normalize($entity);
            }
            return $this->setJsonResponse($result);
        } else {
            return $this->setJsonNotFound();
        }
    }

    public function getByNameInIds()
    {
        $currentClient = $this->getCurrentUser();

        if (!$currentClient->getCompanyId()) {
            return $this->getSendErrorTextMessage(_('client_company_is_empty'));
        }

        $name = $this->filter->sanitize($this->request->getPost("name"), "string");
        $clientIds = $this->filter->sanitize($this->request->getPost("ids"), "int");

        $params = [
            'companyId' => $currentClient->getCompanyId()
        ];

        if ($name){
            $params = array_merge($params,
                [
                    'findLike' => [
                        'locale' => CURRENT_LOCALE_ISO == 'en'?'': '_'.CURRENT_LOCALE_ISO,
                        'name'  => str_replace('%', '', htmlentities($name))
                    ]
                ]
            );
        }

        $params = array_merge($params,
            [
                'inClientIds' => $clientIds
            ]
        );

        $clients = Client::getListByParams($params);

        if (count($clients)) {
            foreach ($clients as $entity){
                $result[] = $this->normalize($entity);
            }
            return $this->setJsonResponse($result);
        } else {
            return $this->setJsonNotFound();
        }
    }

    protected function normalize($entity)
    {
        $mainEmail = null;
        foreach ($entity->getClientEmail() as $emailModel) {
            if ($emailModel->getIsMain()){
                $mainEmail = $emailModel->getEmail();
            }
        }
        $company = null;
        if ($companyModel = $entity->getClientCompany()){
            $company = $companyModel->getName();
        }
        $return = array(
            'id' => $entity->getId(),
            'firstName'   => $entity->getFirstName(),
            'lastName'    => $entity->getLastName(),
            'firstNameRu' => $entity->getFirstNameRu(),
            'lastNameRu'  => $entity->getLastNameRu(),
            'userType'    => $entity->getUserType(),
            'companyId'   => $entity->getCompanyId(),
            'lastVisit'   => $entity->getLastVisit(),
            'online'      => $entity->getIsOnline(),
            'isCompanyAdmin' => $entity->getIsCompanyAdmin(),
            'mainEmail'      => $mainEmail,
            'companyName'    => $company
        );

        return $this->getUserAvatar($return, $entity);
    }

    protected function denormalize($entity, $data)
    {
        $map = array('firstName', 'lastName', 'email');
        foreach ($map as $value) {
            $method = 'set' . ucfirst($value);
            if (!empty($data->$value)) {
                $entity->$method($data->$value);
            }
        }

        if (false === empty($data->password)) {
            $entity->setPassword($this->security->hash($data->password));
        }
    }

    /**
     * @return Client
     */
    protected function getCurrentUser()
    {
        return $this->getDI()->getCurrentUser();
    }
}
