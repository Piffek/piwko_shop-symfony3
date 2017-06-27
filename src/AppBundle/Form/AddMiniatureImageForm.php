<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Item;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AddMiniatureImageForm extends AbstractType
{
	 /**
     * {@inheritdoc}
     */
	 public function buildForm(FormBuilderInterface $builder, array $options){
		 $builder
		 ->add('imageFile', VichImageType::class, array(
		 		'label' => 'Zdjecie Miniaturki',
		 		'required' => false,
		 		'allow_delete' => true,		
		 ));
	 }
	 
	 public function configureOptions(OptionsResolver $resolver){
		 $resolver->setDefaults([
				'data_class' => Item::class
		]);
		 
	 }
}