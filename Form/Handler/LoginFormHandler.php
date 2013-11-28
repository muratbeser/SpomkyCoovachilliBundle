<?php

namespace Spomky\CoovachilliBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Spomky\CoovachilliBundle\Form\Model\Login;

class LoginFormHandler
{
    protected $request;
    protected $form;
    protected $secret;
    protected $method;
    protected $uri;

    public function __construct(FormInterface $form, Request $request, $secret, $method)
    {
        $this->form = $form;
        $this->request = $request;
        $this->secret = $secret;
        $this->method = $method;
        $this->uri = null;
    }

    public function process()
    {
        $this->form->setData(new Login(
            $this->request->query->get("username"),
            $this->request->query->get("password")
        ));

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);
            if ($this->form->isValid()) {
                $this->onSuccess();

                return true;
            }
        }

        return false;
    }

    public function getUri()
    {
        return $this->uri;
    }

    protected function onSuccess()
    {
        //Calculate URI
    }
}
