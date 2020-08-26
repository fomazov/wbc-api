<?php

namespace WBC\Lib\Mailer;

class Main extends Basic
{
    public function createMessageFromView($view, $params = [], $viewsDir = null)
    {
        $message = new Message($this->getConfig());
        $message->setTemplate($view)
                ->setTemplateParams($params)
                ->setTemplateDir($viewsDir)
                ->setContent();

        return $message;
    }
}