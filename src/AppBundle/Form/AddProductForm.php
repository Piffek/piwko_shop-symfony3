<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Item;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
<<<<<<< HEAD
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
=======
>>>>>>> f9a5da703f1eaa852002f7c713260ecd6d6375e6

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
<<<<<<< HEAD
		 ->add('percentPromotion')
		 ->add('photo', FileType::class, array('label' => 'Zdjecie produktu'));
=======
		 ->add('photo', FileType::class, array('label' => 'Zdjecie Produktu'))
		 ->add('percentPromotion');
>>>>>>> f9a5da703f1eaa852002f7c713260ecd6d6375e6
	 }
	 
	 public function configureOptions(OptionsResolver $resolver){
		 $resolver->setDefaults([
				'data_class' => Item::class
		]);
		 
	 }
}