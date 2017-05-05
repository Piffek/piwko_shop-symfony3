<?php 
namespace AppBundle\Security;

use AppBundle\Form\LoginFormType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use AppBundle\Entity\User;


class LoginFormAuth extends AbstractFormLoginAuthenticator
{
	private $formFactory;
	public function __construct(FormFactoryInterface $formFactory, EntityManager $ent, RouterInterface $router, UserPasswordEncoder $passwordEncoder){
		$this->formFactory = $formFactory;
		$this->ent = $ent;
		$this->router = $router;
		$this->passwordEncoder = $passwordEncoder;
	}
	
	public function getCredentials(Request $request)
	{
		$isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');
		if(!$isLoginSubmit){
			return;
		}
		$form = $this->formFactory->create(LoginFormType::class);
		$form->handleRequest($request);
		$data = $form->getData();
		
		$data = $form->getData();
		$request->getSession()->set(
				Security::LAST_USERNAME,
				$data['_username']
				);
		
		return $data;
	
	}
	
	public function getUser($credentials, UserProviderInterface $userProvider)
	{
		$username = $credentials['_username'];
		return $this->ent->getRepository('AppBundle:User')->findOneBy(['email' => $username]);
	}
	
	public function checkCredentials($credentials, UserInterface $user)
	{
		$password = $credentials['_password'];
		
		if ($this->passwordEncoder->isPasswordValid($user, $password)) {
			return true;
		}
	}
	
	protected function getLoginUrl()
	{
		return $this->router->generate('login');
	}
	
	protected function getDefaultSuccessRedirectUrl()
	{
		return $this->router->generate('homepage');
	}
}

?>