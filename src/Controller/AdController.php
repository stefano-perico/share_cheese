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

    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $ad = new Ad();
        $form = $this->createForm(Ad::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ad);
            $em->flush();

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('ad/new.html.twig', [
            'ad' => $ad,
            'form' => $form->createView()
        ]);
    }

}
