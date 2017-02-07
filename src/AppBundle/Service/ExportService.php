<?php

namespace AppBundle\Service;

use Liuggio\ExcelBundle\Factory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class ExportService
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * ExportService constructor.
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {

        $this->factory = $factory;
    }


    /**
     * @param array $header
     * @param array $content
     * @param string $filename
     * @return Response
     */
    public function arrayToCSVResponse(array $header, array $content, $filename = 'export')
    {
        header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');

        $handle = fopen('php://output', 'w');

        fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // encodage UTF8
        fputcsv($handle, $header, ';');

        foreach ($content as $row) {
            fputcsv($handle, $row, ';');
        }

        fclose($handle);

        return new Response();
    }


    /**
     * @param array $header
     * @param array $content
     * @param string $filename
     * @return mixed
     */
    public function arrayToExcelResponse(array $header, array $content, $filename = 'export')
    {
        $content = array_merge([$header], $content);
        $phpExcelObject = $this->factory->createPHPExcelObject();

        $phpExcelObject->getProperties()->setTitle($filename);
        $phpExcelObject->setActiveSheetIndex(0)->fromArray($content);
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->factory->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->factory->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename . '.xlsx'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }


}