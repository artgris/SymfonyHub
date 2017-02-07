<?php

namespace AppBundle\Service;

use Html2Text\Html2Text;
use Symfony\Component\Templating\EngineInterface;

class MailingService
{
    const SENDER = 'sender@sender.com';
    const PREFIX = '[Sender Site] ';
    const DESTINATION = 'a.gribet@gmail.com';

    private $mailer;
    private $templating;

    /**
     * MailingToAdminService constructor.
     * @param $mailer
     * @param $templating
     */
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendMail()
    {
        $template = $this->templating->render('service/mail/mail.twig');
        $message = \Swift_Message::newInstance()
            ->setSubject(self::PREFIX . 'subject')
            ->setFrom(self::SENDER, 'Sender')
            ->setTo(self::DESTINATION)
            ->setBody($text = Html2Text::convert($template), 'text/plan')
            ->addPart($template, 'text/html');
        $this->mailer->send($message);
    }

}