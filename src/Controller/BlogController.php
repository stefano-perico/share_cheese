<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog_index")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

	/**
	 * @Route("/{slug}", name="blog_show")
	 */
    public function show(Article $article): Response
    {
    	return $this->render('blog/show.html.twig', [
		    'article' => $article
	    ]);
    }

	/**
	 * @Route("/create", name="blog_new")
	 */
    public function new(): Response
    {
	    // TODO make create
    }

	/**
	 * @Route("/{slug}/edit", name="blog_edit")
	 */
    public function edit(): Response
    {
	    // TODO make update
    }

	/**
	 * @Route("/{slug}", name="blog_delete")
	 */
    public function delete(Article $article): Response
    {
	    // TODO make delete
    }

}
