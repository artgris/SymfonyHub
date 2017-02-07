<?php


namespace AppBundle\Validator\Constraints;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ContainsCodeValidator
 * @package AppBundle\Validator\Constraints
 */
class ContainsCodeValidator extends ConstraintValidator
{

	private $em;


	/**
	 * ContainsCodeValidator constructor.
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}


	/**
	 * Checks if the passed value is valid.
	 *
	 * @param mixed $value The value that should be validated
	 * @param Constraint $constraint The constraint for the validation
	 */
	public function validate($value, Constraint $constraint)
	{
		if (10.0 !== $value) {
			/** @var ContainsCode $constraint */
			$this->context->buildViolation($constraint->messageNoValid)->addViolation();
		}
	}
}