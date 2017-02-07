<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/twig/")
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class TwigController extends Controller
{

    const TEXT = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris	nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

    /**
     * @Route("", name="twig_twig")
     */
    public function twigAction()
    {
        $this->generateBreadcrumbs();
        return $this->render('twig/twig.html.twig', [
            'title' => 'menu_twig',
            'url' => "http://twig.sensiolabs.org/"
        ]);
    }

    /**
     * @Route("highlight/", name="twig_twig_highlight")
     */
    public function highlightAction()
    {
        $this->generateBreadcrumbs()->addItem($title = 'menu_twig_highlight');
        return $this->render('twig/highlight.html.twig', [
            'text' => self::TEXT,
            'title' => $title,
        ]);
    }

    /**
     * @Route("grabs-sentenses/", name="twig_twig_grab_sentenses")
     */
    public function grabSentensesAction()
    {
        $this->generateBreadcrumbs()->addItem($title = 'menu_twig_grab_sentenses');
        return $this->render('twig/grab_sentences.html.twig', [
            'text' => self::TEXT,
            'title' => $title
        ]);
    }

    /**
     * @Route("twig-extensions/", name="twig_twig_extensions")
     */
    public function twigExtensionAction()
    {
        $this->generateBreadcrumbs()->addItem($title = 'menu_twig_extensions');
        return $this->render('twig/twig_extensions.html.twig', [
            'title' => $title
        ]);
    }

    /**
     * @Route("twig-exemples/", name="twig_twig_exemples")
     */
    public function twigExempleAction()
    {
        $this->generateBreadcrumbs()->addItem($title = 'menu_twig_exemples');
        return $this->render('twig/twig_exemples.html.twig', [
            'title' => $title
        ]);
    }

    /**
     * @return object|\WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs
     */
    private function generateBreadcrumbs()
    {
        return $this->get("breadcrumbs")->generate('menu_twig', 'twig_twig');
    }
}