<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	$authChecker = $this->container->get('security.authorization_checker');
    	$router = $this->container->get('router');
    	
    	if($authChecker->isGranted('ROLE_USER')){
    		return new RedirectResponse($router->generate('add_person_in_need'), 307);
    	} else {
    		return new RedirectResponse($router->generate('fos_user_security_login'), 307);
    	}
    }
}
