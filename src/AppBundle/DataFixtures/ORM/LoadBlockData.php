<?php


namespace AppBundle\DataFixtures\ORM;


use Arkounay\BlockBundle\Entity\PageBlock;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class LoadBlockData implements FixtureInterface
{

	/**
	 * Load data fixtures with the passed EntityManager
	 *
	 * @param ObjectManager $manager
	 */
	public function load(ObjectManager $manager)
	{
		$blocks = [
			'h1' => 'Arkounay Block Bundle',
			'h2' => 'WYSIWIG HTML editable blocks and entities bundle',
			'p' => 'Lightweight and opinionated bundle allowing you to quickly render HTML blocks editable with a WYSIWYG editor, either via the provided PageBlock entity, or directly already existing entities through custom twig functions.',
			'block_id' => "I'm a block",
			'block_id_span' => "I'm a block with span Tinymce",
			'block_id_not_editable' => "I'm not editable !!!",
		];
		foreach ($blocks as $id => $block) {
			$blockEntityTmp = new PageBlock();
			$blockEntityTmp->setId($id);
			$blockEntityTmp->setContent($block);
			$manager->persist($blockEntityTmp);
		}
		$manager->flush();
	}
}