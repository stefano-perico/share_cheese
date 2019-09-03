<?php

namespace App\Controller;

use App\Entity\Cheese;
use App\Form\CheeseType;
use App\Repository\CheeseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @Route("/cheese")
 */
class CheeseController extends AbstractController
{

    /**
     * @Route("/", name="cheese_index", methods={"GET"})
     */
    public function index(CheeseRepository $cheeseRepository): Response
    {
        return $this->render('cheese/index.html.twig', [
            'cheeses' => $cheeseRepository->findAll(),
            ]);
    }

    /**
     * @Route("/new", name="cheese_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $cheese = new Cheese();
        $form = $this->createForm(CheeseType::class, $cheese);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cheese);
            $em->flush();

            return $this->redirectToRoute('cheese_index');
        }

        return $this->render('cheese/new.html.twig', [
            'cheese' => $cheese,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="cheese_show", methods={"GET"})
     */
    public function show(Cheese $cheese): Response
    {

        $geoPoint = $cheese->getGeoPoint();

        return $this->render('cheese/show.html.twig', [
            'cheese' => $cheese,
            'geoPoint' => explode(',', $geoPoint),
            'geoShape' => $cheese->getGeoShape()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cheese_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cheese $cheese, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CheeseType::class, $cheese);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('cheese_index');
        }

        return $this->render('cheese/edit.html.twig', [
            'cheese' => $cheese,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cheese_delete", methods={"POST"})
     */
    public function delete(Request $request, Cheese $cheese, EntityManagerInterface $em): Response
    {
        if($this->isCsrfTokenValid('delete'.$cheese->getId(), $request->request->get('_token'))) {
            $em->remove($cheese);
            $em->flush();
        }
        return $this->redirectToRoute('cheese_index');
    }
}
