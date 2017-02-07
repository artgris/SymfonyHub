<?php


namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class LoadFixtureData implements FixtureInterface
{

	/**
	 * Load data fixtures with the passed EntityManager
	 *
	 * @param ObjectManager $manager
	 */
	public function load(ObjectManager $manager)
	{

		for ($i = 0; $i < 1000; $i++) {
			$fixture = new Fixture();
			$fixture->setContent(bin2hex(random_bytes(10)));
			$manager->persist($fixture);
		}

		$manager->flush();

	}
}