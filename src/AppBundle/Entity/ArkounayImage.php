<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity()
 * @ORM\Table(name="arkounay")
 */
class ArkounayImage
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var Image
	 * @ORM\Column(type="json_image", nullable=true)
	 */
	protected $image;

	/**
	 * @var ArrayCollection|Image[]
	 * @ORM\Column(type="json_images")
	 */
	protected $imageCollection;

	/**
	 * @var Image
	 * @ORM\Column(type="json_image", nullable=true)
	 */
	protected $imageNoAlt;


	public function __construct()
	{
		$this->imageCollection = new ArrayCollection();
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
	 * Set image
	 *
	 * @param json_image $image
	 *
	 * @return ArkounayImage
	 */
	public function setImage($image)
	{
		$this->image = $image;

		return $this;
	}

	/**
	 * Get image
	 *
	 * @return json_image
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Set imageCollection
	 *
	 * @param json_images $imageCollection
	 *
	 * @return ArkounayImage
	 */
	public function setImageCollection($imageCollection)
	{
		$this->imageCollection = $imageCollection;

		return $this;
	}

	/**
	 * Get imageCollection
	 *
	 * @return json_images
	 */
	public function getImageCollection()
	{
		return $this->imageCollection;
	}





    /**
     * Set imageNoAlt
     *
     * @param json_image $imageNoAlt
     *
     * @return ArkounayImage
     */
    public function setImageNoAlt($imageNoAlt)
    {
        $this->imageNoAlt = $imageNoAlt;

        return $this;
    }

    /**
     * Get imageNoAlt
     *
     * @return json_image
     */
    public function getImageNoAlt()
    {
        return $this->imageNoAlt;
    }
}
