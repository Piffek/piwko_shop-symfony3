<?php 
namespace AppBundle\Controller\Admin\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Item;
use AppBundle\Form\AddProductForm;


/**
 * @Route("/admin")
 */
class ProductController extends Controller
{
	/**
	 * @Route("/dodajProdukt", name="addProduct")
	 */
	public function addProductAction(Request $request){
		
		$form = $this->createForm(AddProductForm::class);
		$form->handleRequest($request);
		
		if($form->isValid() && $form->isSubmitted()){
			
    		/**
    		 * 
    		 * @var Item $item
    		 */
			$item = $form->getData();
			$em = $this->getDoctrine()->getManager();
			$em->persist($item);
			$em->flush();
			return $this->redirectToRoute('addProduct');
		}
		
		return $this->render('admin/product/addProduct.html.twig', [
		    'form' => $form->createView()]);
	}
}