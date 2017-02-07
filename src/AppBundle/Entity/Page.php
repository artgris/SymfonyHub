<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Class Page
 * @ORM\Entity()
 * @ORM\Table(name="page")
 */
class Page
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=50)
	 */
	private $titre;

	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Block", mappedBy="page", cascade={"persist", "remove"}, fetch="EAGER" ,orphanRemoval=true)
	 * @Assert\Valid()
	 */
	private $blocks;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->blocks = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Add block
	 *
	 * @param \AppBundle\Entity\Block $block
	 *
	 * @return Page
	 */
	public function addBlock(\AppBundle\Entity\Block $block)
	{
		$this->blocks[] = $block->setPage($this);
		return $this;
	}

	/**
	 * Remove block
	 *
	 * @param \AppBundle\Entity\Block $block
	 */
	public function removeBlock(\AppBundle\Entity\Block $block)
	{
		$this->blocks->removeElement($block);
	}

	/**
	 * Get block
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getBlock()
	{
		return $this->blocks;
	}

	/**
	 * Set titre
	 *
	 * @param string $titre
	 *
	 * @return Page
	 */
	public function setTitre($titre)
	{
		$this->titre = $titre;

		return $this;
	}

	/**
	 * Get titre
	 *
	 * @return string
	 */
	public function getTitre()
	{
		return $this->titre;
	}

	/**
	 * Get blocks
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getBlocks()
	{
		return $this->blocks;
	}
}
