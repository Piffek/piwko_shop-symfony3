<?php 
namespace AppBundle\Controller\Admin\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Item;
use AppBundle\Entity\Rental;
use AppBundle\Form\AddProductForm;
use AppBundle\Form\EditProductForm;


/**
 * @Route("/admin")
 */
class ProductController extends Controller
{
	/**
	 * @Route("/dodajProdukt", name="addProduct")
	 */
	public function addProductAction(Request $request){
		$thisItem = new Item;
		$form = $this->createForm(AddProductForm::class, $thisItem);
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
		    'form' => $form->createView(), 
		]);
	}
	

	/**
	 * @Route("/produkty", name="allProduct")
	 */
	public function allProduct(){
		$em = $this->getDoctrine()->getManager();
		$allProducts = $em->getRepository('AppBundle:Item')->findAll();
		
		return $this->render('admin/product/allProducts.html.twig', [
				'allProducts' => $allProducts,
		]);
	}
	
	/**
	 * @Route("/edytujProdukt/{id}", name="editProduct")
	 */
	public function editProductAction(Request $request, $id){
		$em = $this->getDoctrine()->getManager();
		$item = $em->getRepository('AppBundle:Item')->find($id);
		$form = $this->createForm(EditProductForm::class, $item);
		$form->handleRequest($request);
		

		if($form->isValid() && $form->isSubmitted()){	
		

			$em->persist($item);
			$em->flush();
			
			return $this->redirectToRoute('editProduct', array('id' => $id));
		}
		return $this->render('admin/product/editProduct.html.twig', [
				'form' => $form->createView(),
				'photo' => $item->getImageName()
		]);
	}
	
	/**
	 * @Route("/usunProdukt/{id}", name="deleteProduct")
	 */
	public function deleteProductAction($id){
		$em = $this->getDoctrine()->getManager();
		$item = $em->getRepository('AppBundle:Item')->findOneById($id);
		$this->except($item);
		$em->remove($item);
		$em->flush();
		return $this->redirectToRoute('allProduct');
	}
	
	
	public function except($object){
		if(!$object){
			throw $this->createNotFoundException('Object not found');
		}
	}
	
	
}