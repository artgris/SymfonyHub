<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
	public function registerBundles()
	{
		$bundles = [
			new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
			new Symfony\Bundle\SecurityBundle\SecurityBundle(),
			new Symfony\Bundle\TwigBundle\TwigBundle(),
			new Symfony\Bundle\MonologBundle\MonologBundle(),
			new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
			new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
			new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
			new AppBundle\AppBundle(),

			new FOS\UserBundle\FOSUserBundle(),
			new Symfony\Bundle\AsseticBundle\AsseticBundle(),
			new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

			new Arkounay\ImageBundle\ArkounayImageBundle(),
			new Arkounay\BlockBundle\ArkounayBlockBundle(),
			new Gregwar\ImageBundle\GregwarImageBundle(),
			new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
			new Knp\Bundle\MenuBundle\KnpMenuBundle(),
			new Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle(),
			new Misd\PhoneNumberBundle\MisdPhoneNumberBundle(),

			new Artgris\MaintenanceBundle\ArtgrisMaintenanceBundle(),
			new WhiteOctober\BreadcrumbsBundle\WhiteOctoberBreadcrumbsBundle(),

			new JMS\TranslationBundle\JMSTranslationBundle(),
			new JMS\DiExtraBundle\JMSDiExtraBundle($this),
			new JMS\AopBundle\JMSAopBundle(),
			new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
			new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),

			new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
			new Liuggio\ExcelBundle\LiuggioExcelBundle(),

			new Artgris\VersionCheckerBundle\ArtgrisVersionCheckerBundle(),
			new CodeExplorerBundle\CodeExplorerBundle(),
            new Artgris\Bundle\InteractiveSVGBundle\ArtgrisInteractiveSVGBundle()
		];

		if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
			$bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
			$bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
			$bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
			$bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
			$bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
		}

		return $bundles;
	}

	public function getRootDir()
	{
		return __DIR__;
	}

	public function getCacheDir()
	{
		return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
	}

	public function getLogDir()
	{
		return dirname(__DIR__) . '/var/logs';
	}

	public function registerContainerConfiguration(LoaderInterface $loader)
	{
		$loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
	}
}
