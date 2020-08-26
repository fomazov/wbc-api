<?php


namespace WBC\Helpers;

use Jasny\ValidationResult;
use Jasny\SSO;

class SingleSignOnHelper extends SSO\Server
{
    /**
     * Registered brokers
     * @var array
     */
    private static $brokers;

    private $_di;
    private $authClient;

    /**
     * @param $brokers
     */
    public function __construct($brokers, \Phalcon\DI\FactoryDefault $di)
    {
        $this->_di = $di;

        parent::__construct();
        self::$brokers = $brokers;

    }

    public function getDi()
    {
        return $this->_di;
    }

    /**
     * Authenticate
     */
    public function login($checkPassword = true)
    {
        $this->startSession();

        if (empty($_POST['username'])) $this->fail(_('msg_username_not_set'), 400);
        if ($checkPassword) {
            if (empty($_POST['password'])) $this->fail(_('msg_password_not_set'), 400);
        } else {
            $_POST['password'] = null;
        }

        $validation = $this->authenticate($_POST['username'], $_POST['password'], $checkPassword);

        if ($validation->failed() || !$this->authClient) {
            return $this->fail($validation->getError(), 400);
        }

        $this->setSessionData('sso_user', $this->authClient->id);
        return $this->userInfo();
    }

    /**
     * Ouput user information as json.
     */
    public function userInfo()
    {
        $this->startSession();

        return $this->checkUser();
    }

    public function checkUser()
    {
        $user = null;

        $userId = $this->getSessionData('sso_user');
        if ($userId) {
            $user = $this->getUserInfoById($userId);
            if (!$user) return $this->fail("User not found", 500); // Shouldn't happen
        }

        return $user;
    }

    public function checkSession($sessionID)
    {
        $matches = null;
        if (preg_match('/^SSO-(\w*+)-(\w*+)-([a-z0-9]*+)$/', $sessionID, $matches)) {
            try {
                $this->startBrokerSession($sessionID, $matches[1], $matches[2]);
            } catch (\Exception $e) {
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * Set session data
     *
     * @param string $key
     * @param string $value
     */
    protected function setSessionData($key, $value)
    {
        if (!isset($value)) {
            unset($_SESSION[$key]);
            return;
        }

        $_SESSION[$key] = $value;
    }

    /**
     * Start the session for broker requests to the SSO server
     */
    protected function startBrokerSession($sid, $brokerId, $token)
    {
        $linkedId = $this->cache->get($sid);
        if (!$linkedId) {
            return $this->fail("The broker session id isn't attached to a user session", 403);
        }

        if (session_status() === PHP_SESSION_ACTIVE) {
            if ($linkedId !== session_id()) {
                return;
            }
        }

        session_id($linkedId);
        if (!isset($_SESSION)) session_start();

        $clientAddr = $this->getSessionData('client_addr');

        if (!$clientAddr) {
            session_destroy();
            return $this->fail("Unknown client IP address for the attached session", 500);
        }

        if ($this->generateSessionId($brokerId, $token, $clientAddr) != $sid) {
            session_destroy();
            return $this->fail("Checksum failed: Client IP address may have changed", 403);
        }

        $this->broker = $brokerId;
        return;
    }

    /**
     * Authenticate using user credentials
     *
     * @param string $username
     * @param string $password
     * @return \Jasny\ValidationResult
     */
    protected function authenticate($username, $password, $checkPassword = true)
    {
        if (!isset($username)) {
            return ValidationResult::error(_('msg_username_not_set'));
        }

        if ($checkPassword && !isset($password)) {
            return ValidationResult::error(_('msg_password_not_set'));
        }

        if ($client = $this->getUserInfo($username)) {
            $deletedAt = intval($client->getDeletedAt());

            if ($deletedAt != 0) {
                return ValidationResult::error(_('msg_user_was_deleted'));
            }

            if ($checkPassword) {
                if ($password !== $client->getPassword()) {
                    $security = $this->getDi()->getSecurity();
                    if (!$security->checkHash($password, $client->getPassword())) {
                        return ValidationResult::error(_('msg_invalid_credentials'));
                    }
                }
            }
        } else {
            return ValidationResult::error(_('msg_invalid_credentials'));
        }

        $this->authClient = $client;
        return ValidationResult::success();
    }

    /**
     * Get the secret key and other info of a broker
     *
     * @param string $brokerId
     * @return array
     */
    protected function getBrokerInfo($brokerId)
    {
        return isset(self::$brokers[$brokerId]) ? self::$brokers[$brokerId] : null;
    }

    /**
     * Get the information about a user
     *
     * @param string $username
     * @return array|object
     */
    protected function getUserInfo($username)
    {
        $clientEmail = $this->getDi()->getClientEmail($username);

        if ($clientEmail) {
            if ($clientEmail->Client) {
                return $clientEmail->Client;
            }
        }

        return null;
    }

    /**
     * Get the information about a user by id
     *
     * @param int $userId
     * @return array|object
     */
    protected function getUserInfoById($userId)
    {
        $clientModel = $this->getDi()->getClientById($userId);
        return $clientModel ? $clientModel : null;
    }

}

