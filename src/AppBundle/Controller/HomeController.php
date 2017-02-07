<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/")
 */
class HomeController extends Controller
{
	/**
	 * @Route("", name="homepage_index")
	 */
	public function indexAction()
	{
		return $this->render('index.html.twig');
	}

}