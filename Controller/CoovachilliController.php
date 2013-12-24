<?php

namespace Spomky\CoovachilliBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Spomky\CoovachilliBundle\Form\Handler\LoginFormHandler;
use Spomky\CoovachilliBundle\Form\Type\LoginFormType;

class CoovachilliController extends Controller
{
    /**
     * Login page
     * @template()
     */
    public function loginAction()
    {
        $form = new LoginFormType;
        $handler = new LoginFormHandler(
            $form,
            $this->get('request'),
            $this->getParameter('spomky_coovachilli.uam.secret'),
            $this->getParameter('spomky_coovachilli.uam.method')
        );

        $result = $handler->process();
        if ($result !== false) {
            return $this->redirect($result);
        }

        return array(
            "form" => $form->createView(),
        );
    }

    /**
     * Status page
     * @template()
     */
    public function statusAction()
    {
        return array();
    }

    /**
     * Success page
     * @template()
     */
    public function successAction()
    {
        return array();
    }

    /**
     * Logoff process
     */
    public function logoffAction()
    {
        return array();
    }
}
