<?php

namespace AppBundle\Controller\RealizationOrder;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FormRealizationOrder extends Controller
{
	/**
	 * @Route("/realizuj", name="realizationOrder")
	 */
	public function indexAction(){
		return $this->render('realizationOrder/index.html.twig');
	}
}