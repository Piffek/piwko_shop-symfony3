<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Item;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\FileToRental;

class AddProductForm extends AbstractType
{
	 /**
     * {@inheritdoc}
     */
	 public function buildForm(FormBuilderInterface $builder, array $options){
		 $builder
		 ->add('name', TextType::class, array(
		 		'attr' => array('minlength' => 4),
		 ))
		 ->add('kind', TextType::class)
		 ->add('price')
		 ->add('amount')
		 ->add('promotion')
		 ->add('textPromotion', TextType::class, array('attr' => array('minlength' => 4)))
		 ->add('percentPromotion')
		 ->add('imageFile', VichFileType::class, array(
		 		'label' => 'Zdjecie Produktu',
		 		'required' => false,
		 		'allow_delete' => true,		
		 ))->add('fileToRental', CollectionType::class, array(
                'entry_type' => FileToRental::class, 
		 ));
	 }
	 
	 public function configureOptions(OptionsResolver $resolver){
		 $resolver->setDefaults([
				'data_class' => Item::class
		]);
		 
	 }
}