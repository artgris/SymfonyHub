<?php


namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class Builder implements ContainerAwareInterface
{
	use ContainerAwareTrait;

	/**
	 * Main menu
	 * @param FactoryInterface $factory
	 * @param array $options
	 * @return ItemInterface
	 */
	public function mainMenu(FactoryInterface $factory, array $options)
	{
		/**
		 * need this structure for translations generator ...
		 * @link http://symfony.com/doc/current/bundles/KnpMenuBundle/i18n.html
		 */
		$menu = $factory->createItem('main');
		$menu->setChildrenAttribute('class', 'navbar-nav');
		$menu->addChild('menu_home', ['route' => 'homepage_index', 'label' => 'menu_home']);
		$menu->addChild('menu_bundles', ['route' => 'bundle', 'label' => 'menu_bundles']);
		$menu->addChild('menu_components', ['route' => 'component', 'label' => 'menu_components']);
		$menu->addChild('menu_twig', ['route' => 'twig_twig', 'label' => 'menu_twig']);
		$menu->addChild('menu_services', ['route' => 'service', 'label' => 'menu_services']);

		return $this->addChildrensAttributs($menu);
	}

	/**
	 * SideBar in Bundle menu
	 * @param FactoryInterface $factory
	 * @param array $options
	 * @return ItemInterface
	 */
	public function sidebarBundleMenu(FactoryInterface $factory, array $options)
	{
		$menu = $factory->createItem('bundle');
		$menu->setChildrenAttribute('class', 'navbar-nav');
		$menu->addChild('menu_arkounay_image', ['route' => 'bundle_arkounay_image', 'label' => 'menu_arkounay_image']);
		$menu->addChild('menu_arkounay_block', ['route' => 'bundle_arkounay_block', 'label' => 'menu_arkounay_block']);
		$menu->addChild('menu_knp_paginator', ['route' => 'bundle_knp_paginator', 'label' => 'menu_knp_paginator']);
		$menu->addChild('menu_knp_snappy', ['route' => 'bundle_knp_snappy', 'label' => 'menu_knp_snappy']);
		$menu->addChild('menu_phone_number', ['route' => 'bundle_phone_number', 'label' => 'menu_phone_number']);
		$menu->addChild('menu_artgris_version_checker', ['route' => 'bundle_artgris_version_checker', 'label' => 'menu_artgris_version_checker']);
		$menu->addChild('menu_interactive_svg', ['route' => 'bundle_interactive_svg', 'label' => 'menu_interactive_svg']);
		$menu->addChild('menu_gregwar_image', ['route' => 'bundle_gregwar_image', 'label' => 'menu_gregwar_image']);
		$menu->addChild('menu_translation', ['route' => 'jms_translation_index', 'label' => 'menu_jms_translation']);
		return $this->addChildrensAttributs($menu);
	}

	/**
	 * SideBar in twig menu
	 * @param FactoryInterface $factory
	 * @param array $options
	 * @return ItemInterface
	 */
	public function sidebarTwigMenu(FactoryInterface $factory, array $options)
	{
		$menu = $factory->createItem('twig');
		$menu->setChildrenAttribute('class', 'navbar-nav');
		$menu->addChild('menu_twig_exemples', ['route' => 'twig_twig_exemples', 'label' => 'menu_twig_exemples']);
		$menu->addChild('menu_twig_extensions', ['route' => 'twig_twig_extensions', 'label' => 'menu_twig_extensions']);
		$menu->addChild('menu_twig_grab_sentenses', ['route' => 'twig_twig_grab_sentenses', 'label' => 'menu_twig_grab_sentenses']);
		$menu->addChild('menu_twig_highlight', ['route' => 'twig_twig_highlight', 'label' => 'menu_twig_highlight']);
		return $this->addChildrensAttributs($menu);
	}

	/**
	 * SideBar in component menu
	 * @param FactoryInterface $factory
	 * @param array $options
	 * @return ItemInterface
	 */
	public function sidebarComponentMenu(FactoryInterface $factory, array $options)
	{
		$menu = $factory->createItem('component');
		$menu->setChildrenAttribute('class', 'navbar-nav');
		$menu->addChild('menu_component_console', ['route' => 'component_console', 'label' => 'menu_component_console']);
		$menu->addChild('menu_component_translation', ['route' => 'component_translation', 'label' => 'menu_component_translation']);
		$menu->addChild('menu_component_form', ['route' => 'component_form', 'label' => 'menu_component_form']);
		$menu->addChild('menu_component_validator', ['route' => 'component_validator', 'label' => 'menu_component_validator']);
		return $this->addChildrensAttributs($menu);
	}

    /**
     * SideBar in component menu
     * @param FactoryInterface $factory
     * @param array $options
     * @return ItemInterface
     */
    public function sidebarServiceMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('service');
        $menu->setChildrenAttribute('class', 'navbar-nav');
        $menu->addChild('menu_service_export', ['route' => 'service_export', 'label' => 'menu_service_export']);
        $menu->addChild('menu_service_mail', ['route' => 'service_mail', 'label' => 'menu_service_mail']);
        return $this->addChildrensAttributs($menu);
    }



	/**
	 * @param ItemInterface $menu
	 * @return ItemInterface
	 */
	private function addChildrensAttributs(ItemInterface $menu)
	{
		foreach ($menu->getChildren() as $child) {
			$child->setAttribute('class', 'nav-item')->setLinkAttribute('class', 'nav-link');
		}
		return $menu;
	}

}