<?php


namespace AppBundle\Services;


class UtilsService
{
    private $mailer;
    private  $fromEmail;

    public  function  __construct( \Swift_Mailer $mailer, $fromEmail)
    {
        $this->mailer = $mailer;
        $this->fromEmail = $fromEmail;
    }

    public function  getRandomString($taille) {
        $char = "azertyuiopQSDFGJKL34567UIO";
        $chaineAleatoire = str_shuffle($char);

        return substr($chaineAleatoire,0,$taille);
    }

    public function sendMail($body, $to, $subject) {
        $message = (new \Swift_Message($subject))
            ->setFrom($this->fromEmail)
            ->setTo($to)
            ->setBody(
                $body,
                'text/html'
            ) ;

        $this->mailer->send($message);

        // or, you can also fetch the mailer service this way
        // $this->get('mailer')->send($message);

       // return $this->render(...);
    }

}