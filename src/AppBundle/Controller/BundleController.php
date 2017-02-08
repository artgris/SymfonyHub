<?php


namespace AppBundle\Controller;


use AppBundle\Entity\ArkounayImage;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Fixture;
use AppBundle\Form\ArkounayImageType;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Arthur Gribet <a.gribet@gmail.com>
 * @Route("/bundle")
 */
class BundleController extends Controller
{


    /**
     * @Route("/", name="bundle")
     */
    public function bundleAction()
    {

        $this->generateBreadcrumbs();

        $bundles = [
            ['arkounay/imageBundle', 'https://github.com/Arkounay/imageBundle', 'composer require arkounay/image-bundle'],
            ['arkounay/block-bundle', 'https://github.com/Arkounay/BlockBundle', 'c require arkounay/block-bundle'],
            ['KnpLabs/KnpPaginatorBundle', 'https://github.com/KnpLabs/KnpPaginatorBundle', 'composer require knplabs/knp-paginator-bundle'],
            ['KnpLabs/KnpSnappyBundle', ' https://github.com/KnpLabs/KnpSnappyBundle', '"knplabs/knp-snappy-bundle": "~1.4"'],
            ['misd/phone-number-bundle', 'https://github.com/misd-service-development/phone-number-bundle', 'composer require misd/phone-number-bundle', "This bundle integrates Google's libphonenumber into your Symfony2 application through the giggsey/libphonenumber-for-php port."],
            ['artgris/version-checker-bundle', 'https://github.com/artgris/VersionCheckerBundle', 'composer require artgris/version-checker-bundle'],
            ['artgris/InteractiveSVGBundle', 'https://github.com/artgris/InteractiveSVGBundle', 'composer require artgris/interactive-svg-bundle'],
            ['Gregwar/ImageBundle', 'https://github.com/Gregwar/ImageBundle', '"gregwar/image-bundle": "dev-master"'],
            ['FOSUserBundle', 'https://github.com/FriendsOfSymfony/FOSUserBundle', 'c require friendsofsymfony/user-bundle "~2.0@dev'],
            ['Asset Management', 'https://symfony.com/doc/current/assetic/asset_management.html', 'c require symfony/assetic-bundle'],
            ['whiteoctober/BreadcrumbsBundle', 'https://github.com/whiteoctober/BreadcrumbsBundle', 'c require whiteoctober/breadcrumbs-bundle'],
            ['StofDoctrineExtensionsBundle', 'https://symfony.com/doc/current/bundles/StofDoctrineExtensionsBundle/index.html', 'c require stof/doctrine-extensions-bundle'],
            ['artgris/MaintenanceBundle', 'https://github.com/artgris/MaintenanceBundle', 'c require artgris/maintenance-bundle'],
            ['liuggio/ExcelBundle', 'https://github.com/liuggio/ExcelBundle', '"liuggio/excelbundle": "^2.1"', "This bundle permits you to create, modify and read excel objects"],
            ['knplabs/knp-menu-bundle', "https://github.com/KnpLabs/KnpMenuBundle", 'composer require knplabs/knp-menu-bundle "^2.0"'],

        ];
        $multilinguals = [
            ['knplabs/doctrine-behaviors', '  https://github.com/KnpLabs/DoctrineBehaviors#translatable', '"knplabs/doctrine-behaviors": "~1.1"', 'add behaviors to Doctrine2 entites and repositories.'],
            ['jms/translation-bundle', 'http://jmsyst.com/bundles/JMSTranslationBundle', '"jms/translation-bundle": "dev-master",', 'en : s translation:extract en --config=app'],
            ['jms/di-extra-bundle', 'http://jmsyst.com/bundles/JMSDiExtraBundle', '"jms/di-extra-bundle": "dev-master"'],
            ['jms/i18n-routing-bundle', ' http://jmsyst.com/bundles/JMSI18nRoutingBundle', '"jms/i18n-routing-bundle": "dev-master"', "This bundle allows you to create i18n routes"],
            ['a2lix/translation-form-bundle', 'http://a2lix.fr/bundles/translation-form/3.x.html', '"a2lix/translation-form-bundle": "2.*"'],
        ];
        $useFull = [
            ['soundasleep/html2text', '', ' "soundasleep/html2text": "~0.3"'],
            ['twig/extensions', 'http://twig.sensiolabs.org/doc/extensions/index.html', ' "twig/extensions": "^1.4"'],
            ['doctrine/doctrine-fixtures-bundle', 'https://github.com/doctrine/DoctrineFixturesBundle', 'composer require --dev doctrine/doctrine-fixtures-bundle']
        ];
        return $this->render('bundle/bundle.html.twig', [
            'title' => 'menu_bundles',
            'bundles' => $bundles,
            'useFull' => $useFull,
            'multilinguals' => $multilinguals
        ]);
    }

    /**
     * @Route("/artgris_version_checker_bundle", name="bundle_artgris_version_checker")
     */
    public function artgrisVersionCheckerAction()
    {
        $versions = $this->get('version_checker_service')->versionChecker();
        $this->generateBreadcrumbs()->addItem('menu_artgris_version_checker');

        return $this->render('bundle/artgris/version_checker_bundle.html.twig', [
            'versions' => $versions,
            'bundle' => 'artgris/VersionCheckerBundle'
        ]);
    }

    /**
     * @Route("/arkounay_image_bundle", name="bundle_arkounay_image")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function arkounayImageAction(Request $request)
    {
        $arkounayImageExist = $this->getDoctrine()->getRepository("AppBundle:ArkounayImage")->findOneBy([]);
        $arkounayImage = $arkounayImageExist !== null ? $arkounayImageExist : new ArkounayImage();
        $form = $this->createForm(ArkounayImageType::class, $arkounayImage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($arkounayImage);
            $em->flush();
            $this->addFlash("success", $this->get('translator')->trans('image.saved_successfully'));
            return $this->redirectToRoute('bundle_arkounay_image');
        }

        $this->generateBreadcrumbs()->addItem('menu_arkounay_image');
        return $this->render('bundle/arkounay/image_bundle.html.twig', [
            'form' => $form->createView(),
            'bundle' => 'Arkounay/ImageBundle'
        ]);
    }

    /**
     * @Route("/arkounay_block_bundle", name="bundle_arkounay_block")
     */
    public function arkounayBlockAction()
    {
        $entityExist = $this->getDoctrine()->getRepository("AppBundle:Fixture")->findOneBy([]);
        $entity = $entityExist !== null ? $entityExist : new Fixture();
        $this->generateBreadcrumbs()->addItem('menu_arkounay_block');
        return $this->render('bundle/arkounay/block_bundle.html.twig', [
            'entity' => $entity,
            'bundle' => 'Arkounay/BlockBundle'
        ]);
    }

    /**
     * @Route("/gregwar_image_bundle", name="bundle_gregwar_image")
     */
    public function gregwarImageAction()
    {
        $this->generateBreadcrumbs()->addItem('menu_gregwar_image');
        return $this->render('bundle/gregwar/image_bundle.html.twig', [
            'imageLena' => "images/lena.gif",
            'bundle' => 'Gregwar/ImageBundle'
        ]);
    }

    /**
     * @Route("/knp_paginator_bundle", name="bundle_knp_paginator")
     * @param Request $request
     * @return Response
     */
    public function knpPaginatorAction(Request $request)
    {

        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT f FROM AppBundle:Fixture f";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        $this->generateBreadcrumbs()->addItem('menu_knp_paginator');
        // parameters to template
        return $this->render('bundle/knpLabs/knp_paginator_bundle.html.twig', [
            'pagination' => $pagination,
            'bundle' => 'KnpLabs/KnpPaginatorBundle'
        ]);
    }

    /**
     * @Route("/knp_snappy_bundle", name="bundle_knp_snappy")
     */
    public function KnpSnappyAction()
    {
        $this->generateBreadcrumbs()->addItem('menu_knp_snappy');
        return $this->render('bundle/knpLabs/knp_snappy_bundle.html.twig', [
            'bundle' => 'KnpLabs/KnpSnappyBundle'
        ]);

    }

    /**
     * @Route("/knp_snappy_bundle/pdf", name="bundle_knp_snappy_pdf")
     */
    public function KnpSnappyPdfAction()
    {
        $html = $this->renderView(':bundle/knpLabs:knp_snappy_bundle_export.html.twig', [
            'bundle' => 'KnpLabs/KnpSnappyBundle'
        ]);

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="file.pdf"'
            ]
        );
    }

    /**
     * @Route("/knp_snappy_bundle/image", name="bundle_knp_snappy_image")
     */
    public function KnpSnappyImageAction()
    {
        $html = $this->renderView(':bundle/knpLabs:knp_snappy_bundle_export.html.twig', [
            'bundle' => 'KnpLabs/KnpSnappyBundle'
        ]);

        return new Response(
            $this->get('knp_snappy.image')->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'image/jpg',
                'Content-Disposition' => 'attachment; filename="file.jpg"'
            ]
        );
    }

    /**
     * @Route("/phone_number_bundle", name="bundle_phone_number")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function phoneNumberAction(Request $request)
    {
        $contactExist = $this->getDoctrine()->getRepository("AppBundle:Contact")->findOneBy([]);
        $contact = $contactExist !== null ? $contactExist : new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $this->addFlash("success", "Contact <b>{$contact->getId()}</b> créé avec succès.");

            return $this->redirectToRoute('bundle_phone_number');
        }
        $this->generateBreadcrumbs()->addItem('menu_phone_number');
        return $this->render('bundle/misd-service-development/phone_number_bundle.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact,
            'bundle' => 'misd-service-development/phone-number-bundle'
        ]);
    }


    /**
     * @Route("/interactive_svg_bundle", name="bundle_interactive_svg")
     */
    public function InteractiveSVGAction()
    {
        $this->generateBreadcrumbs()->addItem('menu_interactive_svg');
        return $this->render('bundle/artgris/interactive_svg_bundle.html.twig', [
            'bundle' => 'artgris/InteractiveSVGBundle'
        ]);

    }

    /**
     * @return object|\WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs
     */
    private function generateBreadcrumbs()
    {
        return $this->get("breadcrumbs")->generate('menu_bundles', 'bundle');
    }
}