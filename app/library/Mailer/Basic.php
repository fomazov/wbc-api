<?php

namespace WBC\Lib\Mailer;

use Phalcon\Mvc\User\Component,
    Http\Adapter\Guzzle6\Client as Guzzle6Client,
    Mailgun\Mailgun;

class Basic extends Component
{
    protected $config = array();

    public function __construct($config)
    {
        $this->setConfig($config);
    }


    public function getConfig($key = null, $default = null)
    {
        if ($key !== null) {
            return isset($this->config[$key])? $this->config[$key] : $default;
        }

        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    protected function getMailGun()
    {
        $client = new Guzzle6Client();
        return new Mailgun($this->getConfig('key'), $client);
    }
}