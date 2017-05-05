<?php 
namespace AppBunde\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Role;

class LoadRole implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$roleName = ['ROLE_ADMIN', 'ROLE_USER', 'ROLE_GUEST'];
		foreach($roleName as $name)
		{
			$role = new Role;
			$role->setName($name);	
			$manager->persist($role);
			$manager->flush();
		}
	}
}
