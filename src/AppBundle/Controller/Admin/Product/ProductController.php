<?php 
namespace AppBundle\Controller\Admin\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/admin")
 */
class ProductController extends Controller
{
	/**
	 * @Route("/dodajProdukt", name="addProduct")
	 */
	public function addProductAction(){
		
		return $this->render('Admin/addProduct.html.twig');
	}
}