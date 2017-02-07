<?php


namespace AppBundle\Service;


use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;

class BreadcrumbsService
{
    /**
     * @var Breadcrumbs
     */
    private $breadcrumbs;


    /**
     * BreadcrumbsService constructor.
     * @param Breadcrumbs $breadcrumbs
     */
    public function __construct(Breadcrumbs $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }


    public function generate($text, $route)
    {

        $breadcrumbs = $this->breadcrumbs;
        $breadcrumbs->addRouteItem($text, $route);
        return $breadcrumbs;
    }

}