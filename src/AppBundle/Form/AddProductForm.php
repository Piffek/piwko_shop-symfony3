<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Item;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AddProductForm extends AbstractType
{
	 /**
     * {@inheritdoc}
     */
	 public function buildForm(FormBuilderInterface $builder, array $options){
		 $builder
		 ->add('name', TextType::class)
		 ->add('price')
		 ->add('amount')
		 ->add('promotion')
		 ->add('textPromotion', TextType::class)
		 ->add('percentPromotion')
	 }
	 
	 public function configureResolve(OptionsResolver $resolver){
		 $resolver->setDefaults([
		    'data_class' => Item::class,
		 ]);
		 
	 }