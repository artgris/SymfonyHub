<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('titre')
			->add('blocks', CollectionType::class, [
				'label' => 'block',
				'entry_type' => BlockType::class,
				'allow_add' => true,
				'allow_delete' => true,
				'allow_extra_fields' => true,
				'required' => false,
				'prototype' => true,
				'delete_empty' => true,
				'attr' => [
					'class' => 'block-collection'
				],
				'by_reference' => false,
			]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'AppBundle\Entity\Page'
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix()
	{
		return 'appbundle_page';
	}


}
