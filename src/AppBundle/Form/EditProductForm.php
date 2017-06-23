<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Item;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EditProductForm extends AbstractType
{
	 /**
     * {@inheritdoc}
     */
	 public function buildForm(FormBuilderInterface $builder, array $options){
		 $builder
		 ->add('name', TextType::class, array(
		 		'attr' => array('minlength' => 4),
		 ))
		 ->add('kind')
		 ->add('price')
		 ->add('amount')
		 ->add('promotion')
		 ->add('textPromotion', TextType::class, array('attr' => array('minlength' => 4)))
		 ->add('percentPromotion')
		 ->add('photo', FileType::class, array(
		 		'required'   => false,
		 		'data_class' => null,
		 		'data' => function ($photo) {
		 		return $photo->getPhoto();
		 		}
		 		//'data_class' => null,
		 ));
	 }
	 
	 
	 public function configureOptions(OptionsResolver $resolver){
		 $resolver->setDefaults([
				'data_class' => Item::class
		]);
		 
	 }
}