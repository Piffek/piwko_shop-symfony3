<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LoginFormType extends AbstractType
{
	 /**
     * {@inheritdoc}
     */
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
		->add('_username')
		->add('_password', PasswordType::class);
	}
}