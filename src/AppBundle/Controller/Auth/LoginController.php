<?php

namespace AppBundle\Controller\Auth;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\LoginFormType;

class LoginController extends Controller
{
    /**
     * @Route("/login/", name="login")
     */
    public function loginAction(Request $request)
    {
    	$authenticationUtils = $this->get('security.authentication_utils');
    	$error = $authenticationUtils->getLastAuthenticationError();
    	$lastUsername = $authenticationUtils->getLastUsername();
    	$form = $this->createForm(LoginFormType::class,
    			[
    					'_username' => $lastUsername,
    			
    			]);
    	
    	return $this->render('auth/loginForm.html.twig',
    			array(
    					'form' => $form->createView(),
    					'error' => $error,
    			)
    			);
    }
    
    /**
     * @Route("/wyloguj", name="logout")
     */
    public function logoutAction()
    {
    	
    }
   
    

}
