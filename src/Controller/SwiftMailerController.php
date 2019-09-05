<?php

namespace App\Controller;

use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SwiftMailerController extends AbstractController
{
    /**
     * @Route("/swift/mailer", name="swift_mailer")
     */
    public function index($mailer, $name)
    {

        $message = (new Swift_Message('Hello Email'))
            ->setFrom('hugo.christin@gmail.com')
            ->setTo('recipient@example.com')
            ->setBody('Test de mail'
                //$this->renderView(
//                 //templates/emails/swift_mailer.html.twig
//                    'emails/registration.html.twig',
//                    ['name' => $name]
                )
                //'text/html'
            //)
        ;

        $mailer->send($message);

        return $this->render($message);
//        return $this->render('swift_mailer/index.html.twig', [
//            'controller_name' => 'SwiftMailerController',
//        ]);

    }

}
