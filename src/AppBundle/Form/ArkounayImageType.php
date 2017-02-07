<?php

namespace AppBundle\Form;

use Arkounay\ImageBundle\Form\JsonImagesType;
use Arkounay\ImageBundle\Form\JsonImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArkounayImageType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('image', JsonImageType::class)
			->add('imageNoAlt', JsonImageType::class, [
				'allow_alt' => false,
				'path_readonly' => true
			])
			->add('imageCollection', JsonImagesType::class);
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\ArkounayImage'
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return 'appbundle_arkounayimage';
	}


}
