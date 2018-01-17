<?php
namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Entity\Uzytkownik;

/**
 * Serwis obsługujący eysyłkę wiadomości email
 *
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class MailerService
{

    /**
     *
     * @var string
     */
    private $sender;

    /**
     *
     * @var Uzytkownik
     */
    private $receiver;

    /**
     *
     * @var string 
     */
    private $topic;

    /**
     *
     * @var string
     */
    private $templateName;

    /**
     *
     * @var array
     */
    private $templateParams;

    /**
     *
     * @var Swift_Mailer 
     */
    private $mailer;

    /**
     *
     * @var TwigEngine 
     */
    private $templating;

    /**
     * 
     * @param string       $sender
     * @param Swift_Mailer $mailer
     * @param TwigEngine   $templating
     */
    public function __construct($sender, $mailer, $templating)
    {
        $this->sender = $sender;
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * Metoda wysyłająca wiadomość email
     * do pojedynczego użytkownika
     * 
     * @param Uzytkownik $receiver
     * @param string     $topic
     * @param string     $templateName
     * @param array      $templateParams
     */
    public function sendMail($receiver, $topic, $templateName, array $templateParams = array())
    {
        $message = (new \Swift_Message($topic))
            ->setFrom($this->sender)
            ->setTo($receiver->getEmail())
            ->setBody($this->templating->render($templateName, $templateParams), 'text/html');
        $this->mailer->send($message);
    }

    /**
     * Metoda wysyłająca wiadomość email
     * do grupy odbiorców
     * 
     * @param array  $receivers
     * @param string $topic
     * @param string $templateName
     * @param array  $templateParams
     */
    public function sendMailToGroup(array $receivers, $topic, $templateName, array $templateParams = array())
    {
        $message = (new \Swift_Message($topic))
            ->setFrom($this->sender)
            ->setTo($receivers)
            ->setBody($this->templating->render($templateName, $templateParams), 'text/html');
        $this->mailer->send($message);
    }
}
