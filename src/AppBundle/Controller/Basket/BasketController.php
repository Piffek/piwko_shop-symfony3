<?php 
namespace AppBundle\Controller\Basket;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Basket;

class BasketController extends Controller
{
	/**
	 * @Route("/koszyk", name="basket")
	 */
	public function indexAction(){
		return $this->render('basket/index.html.twig');
	}
}