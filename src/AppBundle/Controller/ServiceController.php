<?php

namespace AppBundle\Controller;

use PHPExcel_Settings;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * @Route("/service")
 */
class ServiceController extends Controller
{

    /**
     * @Route("/", name="service")
     */
    public function indexAction()
    {
        $this->generateBreadcrumbs();

        return $this->render('service/service.html.twig', [
            'title' => "menu_services",
            'url' => "http://symfony.com/doc/current/service_container.html"
        ]);

    }

    /**
     * @Route("/export", name="service_export")
     */
    public function serviceExportAction()
    {
        $this->generateBreadcrumbs()->addItem($title = 'menu_service_export');
        return $this->render('service/export/csv.html.twig',
            ['title' => $title]);

    }

    /**
     * @Route("/export/csv", name="service_export_csv")
     */
    public function serviceExportCsvAction()
    {

        return $this->get('export_service')->arrayToCSVResponse($this->getHeader(), $this->getContent(), 'export');
    }

    /**
     * @Route("/export/excel", name="service_export_excel")
     */
    public function serviceExportExcelAction()
    {
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

        return $this->get('export_service')->arrayToExcelResponse($this->getHeader(), $this->getContent(), 'export');

    }

    /**
     * @Route("/mail", name="service_mail")
     */
    public function mailAction()
    {
        $this->generateBreadcrumbs()->addItem($title = 'menu_service_mail');
        return $this->render('service/mail/action.html.twig', [
            'title' => $title,
            'url' => 'http://symfony.com/doc/current/email.html'
        ]);
    }

    /**
     * @Route("/mail/send", name="service_mail_send")
     */
    public function sendMailAction()
    {
        try {
            $this->get('mailing_service')->sendMail();
            $this->addFlash("success", "mail_send");

        } catch (\Exception $e) {
            $this->addFlash("danger", $e->getMessage());
        }
        return $this->redirectToRoute('service_mail');
    }

    private function getHeader()
    {
        return ['Date', 'Uuid'];
    }

    private function getContent()
    {
        $content = [];
        $date = '2009-12-06';
        $end_date = '2020-12-31';

        while (strtotime($date) <= strtotime($end_date)) {
            $content[] = [$date, uniqid('lolcat-', true)];
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }
        return $content;

    }

    /**
     * @return object|\WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs
     */
    private
    function generateBreadcrumbs()
    {
        return $this->get("breadcrumbs")->generate('menu_services', 'service');
    }
}