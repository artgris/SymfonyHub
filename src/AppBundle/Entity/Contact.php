<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

/**
 * @ORM\Entity()
 * @ORM\Table(name="contact")
 */
class Contact
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="phone_number")
	 * @AssertPhoneNumber(type="mobile")
	 */
	private $phoneNumber;


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
	 * Set phoneNumber
	 *
	 * @param phone_number $phoneNumber
	 *
	 * @return Contact
	 */
	public function setPhoneNumber($phoneNumber)
	{
		$this->phoneNumber = $phoneNumber;

		return $this;
	}

	/**
	 * Get phoneNumber
	 *
	 * @return phone_number
	 */
	public function getPhoneNumber()
	{
		return $this->phoneNumber;
	}
}
