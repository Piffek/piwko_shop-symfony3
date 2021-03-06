<?php 
namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterForm extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
		->add('username', TextType::class)
		->add('email', EmailType::class)
		->add('name', TextType::class)
		->add('city', TextType::class)
		->add('street', TextType::class)
		->add('plainPassword', RepeatedType::class,[
				'type'=>PasswordType::class
		]);
	}
	public function configureOptions(OptionsResolver $resolver){
		$resolver->setDefaults([
				'data_class' => User::class
		]);
	}
}


?>