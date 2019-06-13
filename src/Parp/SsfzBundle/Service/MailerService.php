<?php

namespace Parp\SsfzBundle\Service;

use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Twig_Environment;

/**
 * Serwis obsługujący eysyłkę wiadomości email
 */
class MailerService
{
    /**
     * @var string
     */
    protected $sender;

    /**
     * @var Swift_Mailer
     */
    protected $mailer;

    /**
     * @var TwigEngine
     */
    protected $templating;

    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @param string $sender
     * @param Swift_Mailer $mailer
     * @param TwigEngine $templating
     * @param Twig_Environment $twig
     */
    public function __construct($sender, Swift_Mailer $mailer, TwigEngine $templating, Twig_Environment $twig)
    {
        $this->sender = $sender;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->twig = $twig;
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
     * Metoda wysyłająca wiadomość email do pojedynczego użytkownika
     *
     * @param Uzytkownik $receiver
     * @param string $templateName
     * @param array $templateParams
     */
    public function sendMailTopicInTemplate($receiver, $templateName, array $templateParams = [])
    {
        $body = $this->render($templateName, $templateParams);
        $message = (new Swift_Message($body['subject']))
            ->setFrom($this->sender)
            ->setTo($receiver->getEmail())
            ->setBody($body['body_txt'], 'text/plain')
            ->addPart($body['body_html'], 'text/html')
        ;
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

    /**
     * Metoda wysyłająca wiadomość email do grupy odbiorców
     *
     * @param array  $receivers
     * @param string $templateName
     * @param array  $templateParams
     */
    public function sendMailToGroupTopicInTemplate(array $receivers, $templateName, array $templateParams = [])
    {
        $body = $this->render($templateName, $templateParams);
        $message = (new Swift_Message($body['subject']))
            ->setFrom($this->sender)
            ->setTo($receivers)
            ->setBody($body['body_txt'], 'text/plain')
            ->addPart($body['body_html'], 'text/html')
        ;
        $this->mailer->send($message);
    }

    /**
     * Renderuje szablon i zwraca jego bloki aby otrzymać składowe maila: temat,
     * treść w htmlu i treść jako czysty tekst.
     *
     * @param string  $template Nazwa szablonu w konwencji SF2 np: ParpOcenaMerytorycznaBundle:Emaile:powiadomienie.twig
     * @param mixed[] $params   Parametry, z którymi renderować szablon
     *
     * @return string[] Tablica bloków z szablonu
     */
    public function render($template, $params)
    {
        $tpl = $this
            ->twig
            ->loadTemplate($template)
        ;

        $blocks = $tpl->getBlockNames();
        $result = [];

        foreach ($blocks as $blockname) {
            $result[$blockname] = $tpl->renderBlock($blockname, $params);
        }

        return $result;
    }
}
