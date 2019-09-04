<?php

namespace App\Controller;

use App\Entity\Exchange;
use App\Entity\Ad;
use App\Form\ExchangeType;
use App\Repository\ExchangeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/exchange", name="exchange")
 */
class ExchangeController extends AbstractController
{
    /**
     * @Route("/", name="exchange_index")
     */
    public function index(Exchangerepository $exchangeRepository): Response
    {
        return $this->render('exchange/index.html.twig', [
            'exchanges' => $exchangeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="exchange_new")
     * @param  Request                $request [description]
     * @param  EntityManagerInterface $em      [description]
     * @return Response                        [description]
     */
    public function create(Ad $ad, EntityManagerInterface $em): Response
    {
        $exchange = new Exchange();
        $exchange->setAd($ad);
        $exchange->setStatus('Pending');
        $em->persist($exchange);
        $em->flush();

        return $this->redirectToRoute('exchange_show', ['id' => $exchange->getId()]);
    }
}
