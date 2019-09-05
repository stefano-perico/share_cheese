<?php

namespace App\Controller;

use App\Entity\Exchange;
use App\Form\ExchangeType;
use App\Repository\ExchangeRepository;
use App\Entity\Ad;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/exchange")
 */
class ExchangeController extends AbstractController
{
    /**
     * @Route("/", name="exchange_index")
     * @IsGranted("ROLE_USER")
     */
    public function index(Exchangerepository $exchangeRepository): Response
    {
        return $this->render('exchange/index.html.twig', [
            'exchanges' => $exchangeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="exchange_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, Ad $ad, EntityManagerInterface $em): Response
    {
        $exchange = new Exchange();
        $form = $this->createForm(ExchangeType::class, $exchange);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $exchange->setAd($ad);
            $ad->setStatus('Attente');
            $exchange->setStatus('Attente');
            $exchange->setCreator($ad->getUser());
            $exchange->setApplicant($this->getUser());
            $exchange->setDateProposed(new \DateTime('NOW'));
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
     * @IsGranted("ROLE_USER")
     */
    public function show(Exchange $exchange): Response
    {
        return $this->render('exchange/show.html.twig', [
            'exchange' => $exchange,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="exchange_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Exchange $exchange, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ExchangeType::class, $exchange);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('exchange_index');
        }

        return $this->render('exchange/edit.html.twig', [
            'exchange' => $exchange,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exchange_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Exchange $exchange, EntityManagerInterface $em): Response
    {
        if($this->isCsrfTokenValid('delete'.$exchange->getId(), $request->request->get('_token'))) {
            $em->remove($exchange);
            $em->flush();
        }
        return $this->redirectToRoute('exchange_index');
    }

}
