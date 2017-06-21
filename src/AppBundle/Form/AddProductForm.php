<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Item;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AddProductForm extends AbstractType
{
	 /**
     * {@inheritdoc}
     */
	 public function buildForm(FormBuilderInterface $builder, array $options){
		 $builder
		 ->add('name', TextType::class, array('attr' => array('minlength' => 4)))
		 ->add('kind', TextType::class)
		 ->add('price')
		 ->add('amount')
		 ->add('promotion')
		 ->add('textPromotion', TextType::class, array('attr' => array('minlength' => 4)))
		 ->add('percentPromotion')
		 ->add('photo', FileType::class, array('label' => 'Zdjecie Produktu'));
	 }
	 
	 public function configureOptions(OptionsResolver $resolver){
		 $resolver->setDefaults([
				'data_class' => Item::class
		]);
		 
	 }
}