<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/ads")
 */
class AdController extends AbstractController
{
    /**
     * @Route("/", name="ad_index")
     */
    public function index(AdRepository $adRepository)
    {
        return $this->render('ad/index.html.twig', [
            'ads' => $adRepository->findAll(),
            ]);
    }


    /**
     * @Route("/", name="ad_user_index")
     */
    public function userIndex(AdRepository $adRepository, User $user)
    {
        return $this->render('ad/_user_index.html.twig', [
            'ads' => $adRepository->findAllByUser($user),
            ]);
    }

    /**
     * Create a new Ad object
     * @Route("/new", name="ad_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     * @param  Request                $request [description]
     * @param  EntityManagerInterface $em      [description]
     * @return Response                        [description]
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $ad = new Ad();
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ad->setStatus('New');
            $ad->setUser($this->getUser());
            $em->persist($ad);
            $em->flush();

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('ad/new.html.twig', [
            'ad' => $ad,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/{id}", name="ad_show", methods={"GET"})
     */
    public function show(Ad $ad): Response
    {
        return $this->render('ad/show.html.twig', [
            'ad' => $ad,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ad_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ad $ad, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('ad/edit.html.twig', [
            'ad' => $ad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cheese_delete", methods={"POST"})
     */
    public function delete(Request $request, Ad $ad, EntityManagerInterface $em): Response
    {
        if($this->isCsrfTokenValid('delete'.$ad->getId(), $request->request->get('_token'))) {
            $em->remove($ad);
            $em->flush();
        }
        return $this->redirectToRoute('cheese_index');
    }

}
