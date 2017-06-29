<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	
    	$products = $this->getDoctrine()->getManager()->createQueryBuilder()
       	       ->select('u')
        	   ->from('AppBundle:Item', 'u')
        	   ->getQuery()
        	   ->getResult();
       	
        return $this->render('default/index.html.twig',[
			'products' => $products,
		]);
    }

}
