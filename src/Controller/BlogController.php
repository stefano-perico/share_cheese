<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request, ArticleRepository $articleRepository, PaginatorInterface $paginator): Response
    {
    	$term = $request->query->get('term');
		$queryBuilder = $articleRepository->getWithSearchQueryBuilder($term);

    	$articlesPagination = $paginator->paginate(
    		$queryBuilder,
		    $request->query->getInt('page', 1),
		    10
	    );

        return $this->render('blog/index.html.twig', [
            'articlesPagination' => $articlesPagination,
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
}
