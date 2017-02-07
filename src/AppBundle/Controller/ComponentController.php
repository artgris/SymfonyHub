<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Page;
use AppBundle\Form\PageType;
use AppBundle\Validator\Constraints\ContainsCode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;

/**
 * @author Arthur Gribet <a.gribet@gmail.com>
 * @Route("/component")
 */
class ComponentController extends Controller
{

    /**
     * @Route("/", name="component")
     */
    public function bundleAction()
    {
        $this->generateBreadcrumbs();

        return $this->render('component/component.html.twig', [
            'title' => 'menu_components',
            'url' => 'http://symfony.com/components'
        ]);
    }


    /**
     * @Route("/console", name="component_console")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ConsoleAction()
    {
        $this->generateBreadcrumbs()->addItem($title = 'menu_component_console');
        return $this->render('component/console/list.html.twig', [
            'title' => $title,
            'url' => 'http://symfony.com/doc/current/components/console.html'
        ]);
    }

    /**
     * @Route("/cc", name="component_console_cc")
     */
    public function ccAction()
    {
        $commande = [
            'command' => 'c:c',
            '-e' => "prod",
        ];
        $content = $this->createCommande($commande);

        $this->addFlash('success', $content);
        return $this->redirectToRoute('component_console');
    }

    /**
     * @Route("/ad", name="component_console_ad")
     */
    public function adAction()
    {
        $commande = [
            'command' => 'a:d',
            '-e' => "prod",
        ];
        $content = $this->createCommande($commande);

        $this->addFlash('success', $content);
        return $this->redirectToRoute('component_console');
    }

    /**
     * @Route("/dsv", name="component_console_dsv")
     */
    public function dsvAction()
    {
        $commande = [
            'command' => 'd:s:v'
        ];
        $content = $this->createCommande($commande);

        $this->addFlash('success', $content);
        return $this->redirectToRoute('component_console');
    }

    /**
     * @Route("/dsu", name="component_console_dsu")
     */
    public function dusAction()
    {
        $commande = [
            'command' => 'd:s:u',
            '--force'
        ];
        $content = $this->createCommande($commande);

        $this->addFlash('success', $content);
        return $this->redirectToRoute('component_console');
    }

    /**
     * @Route("/dfl", name="component_console_dfl")
     */
    public function fixtureAction()
    {
        //s doctrine:fixtures:load

        $commande = [
            'command' => 'd:f:l',
            '-n' // no interaction
        ];
        $content = $this->createCommande($commande);

        $this->addFlash('success', $content);
        return $this->redirectToRoute('component_console');
    }

    /**
     * @param $commande
     * @return mixed
     */
    private function createCommande($commande)
    {
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput($commande);
        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        return $output->fetch();
    }


    /**
     * @Route("/translation", name="component_translation")
     */
    public function translationAction()
    {
        $this->generateBreadcrumbs()->addItem($title = 'menu_component_translation');
        return $this->render(':component/translation:exemple.html.twig', [
            'title' => $title,
            'url' => 'http://symfony.com/doc/current/components/translation.html'
        ]);
    }


    /**
     * @Route("/form", name="component_form")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function formAction(Request $request)
    {
        $pageExist = $this->getDoctrine()->getRepository("AppBundle:Page")->findOneBy([]);
        $page = $pageExist !== null ? $pageExist : new Page();
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();
            $this->addFlash("success", "success");
            return $this->redirectToRoute('component_form');
        }

        $this->generateBreadcrumbs()->addItem($title = 'menu_component_form');
        return $this->render('component/form/collection_edit.html.twig', [
            'title' => $title,
            'url' => 'http://symfony.com/doc/current/components/form.html',
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/validator", name="component_validator")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function validatorAction(Request $request)
    {
        /** @var Form $form */
        $form = $this->createFormBuilder()
            ->add('calcul', NumberType::class, [
                'constraints' => [
                    new ContainsCode()
                ],
                'label' => "form_message",
                'data' => 10
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//			$data = $form->getData();
            $this->addFlash('success', "success");
            return $this->redirectToRoute('component_validator');
        }
        $this->generateBreadcrumbs()->addItem($title = 'menu_component_validator');
        return $this->render('component/validator/exemple.html.twig', [
            'title' => $title,
            'url' => 'http://symfony.com/doc/current/components/validator.html',
            'form' => $form->createView()
        ]);

    }

    /**
     * @return object|\WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs
     */
    private function generateBreadcrumbs()
    {
        return $this->get("breadcrumbs")->generate('menu_components', 'component');
    }

}