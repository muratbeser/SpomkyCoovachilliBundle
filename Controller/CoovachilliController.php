<?php

namespace Spomky\CoovachilliBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Component\HttpKernel\Exception\HttpException;

use Spomky\CoovachilliBundle\Form\Handler\LoginFormHandler;
use Spomky\CoovachilliBundle\Form\Type\LoginFormType;


class CoovachilliController extends ContainerAware {
    /**
     * Login page
     * @template()
     */
    public function loginAction() {

        $form = new LoginFormType;
        $handler = new LoginFormHandler(
            $form,
            $this->get('request'),
            $this->getParameter('spomky_coovachilli.uam.secret'),
            $this->getParameter('spomky_coovachilli.uam.method')
        );

        $result = $handler->process();
        if( $result !== false ) {

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
    public function statusAction() {
        
        return array();
    }
    
    /**
     * Success page
     * @template()
     */
    public function successAction() {
        
        return array();
    }
    
    /**
     * Logoff process
     */
    public function logoffAction() {

        return array();
    }
}
