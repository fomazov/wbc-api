<?php

namespace WBC\Lib\Mailer;

class Message extends Basic
{
    protected $viewObj;

    protected $template;
    protected $templateDir;
    protected $templateParams;
    protected $templateContent;

    protected $to;
    protected $subject;

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateDir()
    {
        if(!$this->templateDir) {
            $configDir = $this->getConfig('viewsDir');
            return $configDir;
        }
        return $this->templateDir;
    }

    /**
     * @param mixed $templateDir
     */
    public function setTemplateDir($templateDir)
    {
        $this->templateDir = $templateDir;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateParams()
    {
        return $this->templateParams;
    }

    /**
     * @param mixed $templateParams
     */
    public function setTemplateParams($templateParams)
    {
        $this->templateParams = $templateParams;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateContent()
    {
        return $this->templateContent;
    }

    /**
     * @param mixed $templateContent
     */
    public function setTemplateContent($templateContent)
    {
        $this->templateContent = $templateContent;
        return $this;
    }

    public function setContent()
    {
        $content  = '';
        $viewFile = $this->getTemplate();
        $params   = $this->getTemplateParams();
        $viewsDir = $this->getTemplateDir();
        $view     = $this->getObjView();

        if ($viewsDir !== null) {
            $viewsDirOld = $view->getViewsDir();
            $view->setViewsDir($viewsDir);

            $content = $view->render($viewFile, $params);
            $view->setViewsDir($viewsDirOld);
        } else {
            $content = $view->render($viewFile, $params);
        }

        $this->setTemplateContent($content);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function to($to, $name = '')
    {
        return $this->setTo(trim($name.' <'.$to.'>'));
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function subject($subject)
    {
        return $this->setSubject($subject);
    }

    public function send()
    {
        $mg = $this->getMailGun();
        $fromArray = $this->getConfig('from');

        try {
            $mg->sendMessage($this->getConfig('domain'), array(
                    'from' => $fromArray['name'] . ' <' . $fromArray['email'] . '>',
                    'to' => $this->getTo(),
                    'subject' => $this->getSubject(),
                    'html' => $this->getTemplateContent(),
                )
            );

            return true;
        } catch (\Exception $e) {
            $this->onErrorSend($e);
        }

        return false;
    }

    protected function onErrorSend($e)
    {

    }

    protected function getObjView()
    {
        if ($this->viewObj) {
            return $this->viewObj;
        } else {

            /** @var $viewApp \Phalcon\Mvc\View */
            $viewApp = $this->getDI()->get('view');

            if (!($viewsDir = $this->getConfig('viewsDir'))) {
                $viewsDir = $viewApp->getViewsDir();
            }

            /** @var $view \Phalcon\Mvc\View\Simple */
            $view = $this->getDI()->get('\Phalcon\Mvc\View\Simple');
            $view->setViewsDir($viewsDir);

            if ($engines = $viewApp->getRegisteredEngines()) {
                $view->registerEngines($engines);
            }

            return $this->viewObj = $view;
        }
    }
}