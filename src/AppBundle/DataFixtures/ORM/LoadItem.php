<?php 
namespace AppBunde\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Item;

class LoadItem implements FixtureInterface{
	
	public function load(ObjectManager $manager){
		$faker = \Faker\Factory::create();
		for ($i=0 ; $i<10 ; $i++){
			$item = new Item;
			$item->setName($faker->name);
			$item->setPrice($faker->randomNumber(3));
			$item->setAmount($faker->randomNumber(2));
			$item->setPromotion($faker->boolean(1));
			$item->setCreatedAt($faker->dateTimeThisMonth);
			$manager->persist($item);
		}
		$manager->flush();
	}
}