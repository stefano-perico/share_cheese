<?php

namespace App\Controller;

use App\Entity\Exchange;
use App\Form\ExchangeType;
use App\Repository\ExchangeRepository;
use App\Entity\Ad;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/exchanges")
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
     * @Route("/new/{id}", name="exchange_new", methods={"GET", "POST"})
     */
    public function new(Request $request, Ad $ad, EntityManagerInterface $em): Response
    {
        //dd($request);
        $exchange = new Exchange();
        $exchange->setAd($ad);
        $exchange->setStatus('Pending');
        $exchange->setCreator($ad->getUser());
        $exchange->setDateProposed(new \DateTime('NOW'));

        $form = $this->createForm(ExchangeType::class, $exchange);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($exchange);
            $em->flush();

            return $this->redirectToRoute('exchange_index');
        }

        return $this->render('exchange/new.html.twig', [
            'exchange' => $exchange,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="exchange_show", methods={"GET"})
     */
    public function show(Exchange $exchange): Response
    {
        return $this->render('exchange/show.html.twig', [
            'exchange' => $exchange,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="exchange_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Exchange $exchange, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ExchangeType::class, $exchange);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('exchange/edit.html.twig', [
            'exchange' => $exchange,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ad_delete", methods={"POST"})
     */
    public function delete(Request $request, Ad $ad, EntityManagerInterface $em): Response
    {
        if($this->isCsrfTokenValid('delete'.$ad->getId(), $request->request->get('_token'))) {
            $em->remove($ad);
            $em->flush();
        }
        return $this->redirectToRoute('ad_index');
    }

}
