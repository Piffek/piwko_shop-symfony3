<?php 
namespace AppBunde\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Post;
use AppBundle\Entity\User;

class LoadFakerPosts implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$faker=\Faker\Factory::create();
		for($i=1 ; $i<10 ; $i++)
		{
			$posts = new Post;
			$user = new User;
			$posts->setBody($faker->text('50'));
			$posts->setUser($user->getId());
			$posts->setCreatedAt($faker->dateTimeThisMonth);
			$manager->persist($posts);
		}
		$manager->flush();
	}
}
