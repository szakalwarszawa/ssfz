<?php

namespace Parp\SsfzBundle\Service;

use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Parp\SsfzBundle\Entity\Uzytkownik;

/**
 * Serwis obsługujący eysyłkę wiadomości email
 */
class MailerService
{
    /**
     * @var string
     */
    private $sender;

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var TwigEngine
     */
    private $templating;

    /**
     * @param string $sender
     * @param Swift_Mailer $mailer
     * @param TwigEngine $templating
     */
    public function __construct($sender, Swift_Mailer $mailer, TwigEngine $templating)
    {
        $this->sender = $sender;
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * Metoda wysyłająca wiadomość email do pojedynczego użytkownika
     *
     * @param Uzytkownik $receiver
     * @param string $topic
     * @param string $templateName
     * @param array $templateParams
     */
    public function sendMail($receiver, $topic, $templateName, array $templateParams = [])
    {
        $message = (new Swift_Message($topic))
            ->setFrom($this->sender)
            ->setTo($receiver->getEmail())
            ->setBody($this->templating->render($templateName, $templateParams), 'text/html');
        $this->mailer->send($message);
    }

    /**
     * Metoda wysyłająca wiadomość email do grupy odbiorców
     *
     * @param array  $receivers
     * @param string $topic
     * @param string $templateName
     * @param array  $templateParams
     */
    public function sendMailToGroup(array $receivers, $topic, $templateName, array $templateParams = [])
    {
        $message = (new Swift_Message($topic))
            ->setFrom($this->sender)
            ->setTo($receivers)
            ->setBody($this->templating->render($templateName, $templateParams), 'text/html')
        ;
        $this->mailer->send($message);
    }
}
