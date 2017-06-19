<?php 
namespace AppBundle\Controller\Admin\Customer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



/**
 * @Route("/admin")
 */
class CustomerController extends Controller
{
	/**
	 * @Route("/pokazKlientow", name="showCustomer")
	 */
	 public function showCustomer(){
		 
		$allUsers = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
		
		return $this->render('admin/customer/showCustomer.html.twig', [
			'allUsers' => $allUsers,
		]);
		
		
		 
	 }
}