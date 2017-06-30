<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class LoginFormType extends AbstractType
{
	 /**
     * {@inheritdoc}
     */
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
		->add('_username', EmailType::class)
		->add('_password', PasswordType::class);
	}
}