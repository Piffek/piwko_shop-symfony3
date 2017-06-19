<?php 
namespace AppBundle\Controller\Admin\Customer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\EditCustomerDataForm;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin")
 */
class CustomerController extends Controller
{
	/**
	 * @Route("/pokazKlientow", name="showCustomer")
	 */
	 public function showCustomerAction(){
		$allUsers = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
		
		return $this->render('admin/customer/showCustomer.html.twig', [
			'allUsers' => $allUsers,
		]);
	 }
	 
	 
	 /**
	  * @Route("/edytujDaneKlienta/{id}", name="editCustomerData")
	  */
	 public function editCustomerAction(Request $request, $id){
	 	$em = $this->getDoctrine()->getManager();
	 	$userData = $em->getRepository('AppBundle:User')->find($id);
	 	
	 	$form = $this->createForm(EditCustomerDataForm::class, $userData);
	 	$form->handleRequest($request);
	 	
	 	if($form->isValid() && $form->isSubmitted()){
	 		$em->persist($userData);
	 		$em->flush();
	 	}
	 	
	 	return $this->render('admin/customer/editCustomer.html.twig', [
	 			'form' => $form->createView()
	 	]);
	 }
}