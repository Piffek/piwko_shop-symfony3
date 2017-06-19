<?php 
namespace AppBundle\Controller\Admin\FrontPanel;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/admin")
 */
class IndexController extends Controller
{
	/**
	 * @Route("/", name="adminHomePage")
	 */
	public function indexAction(){
		
		return $this->render('admin/index.html.twig');
	}
}