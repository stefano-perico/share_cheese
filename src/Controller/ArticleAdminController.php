<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/article")
 */
class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/", name="article_admin_list")
     */
    public function index(Request $request, ArticleRepository $articleRepository, PaginatorInterface $paginator)
    {
    	$term = $request->query->get('term');
    	$queryBuilder = $articleRepository->getWithSearchQueryBuilder($term);

    	$articlePagination = $paginator->paginate(
    	    $queryBuilder, /* query NOT result */
		    $request->query->getInt('page', 1), /*page number*/
		    10 /* limit per page */
	    );

        return $this->render('article_admin/index.html.twig', [
            'articlesPagination' => $articlePagination,
        ]);
    }

	/**
	 * @Route("/new", name="admin_article_new")
	 */
	public function new(EntityManagerInterface $em, Request $request, UploaderHelper $uploaderHelper): Response
	{
		$form = $this->createForm(ArticleType::class);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid())
		{
			/** @var Article $article */
			$article = $form->getData();
			$article->setAuthor($this->getUser());

			/** @var UploadedFile $uploadedFile */
			$uploadedFile = $form['imageFile']->getData();
			if ($uploadedFile) {
				$newFilename = $uploaderHelper->uploadArticleImage($uploadedFile);
				$article->setImageFilename($newFilename);
			}

			$em->persist($article);
			$em->flush();

			$this->addFlash('success', 'Article Created');

			return $this->redirectToRoute('article_admin_list');
		}

		return $this->render('article_admin/new.html.twig', [
			'articleForm' => $form->createView()
		]);
	}

	/**
	 * @Route("/{id}/edit", name="admin_article_edit")
	 */
	public function edit(Article $article, Request $request, EntityManagerInterface $em, UploaderHelper $uploaderHelper): Response
	{
		$form = $this->createForm(ArticleType::class, $article);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid())
		{
			/** @var UploadedFile $uploadedFile */
			$uploadedFile = $form['imageFile']->getData();
			if ($uploadedFile) {
				$newFilename = $uploaderHelper->uploadArticleImage($uploadedFile);
				$article->setImageFilename($newFilename);
			}

			$em->persist($article);
			$em->flush();

			$this->addFlash('success', 'Article Updated!');

			return $this->redirectToRoute('admin_article_edit', [
				'id' => $article->getId(),
			]);
		}

		return $this->render('article_admin/edit.html.twig', [
			'articleForm' => $form->createView()
		]);
	}

	/**
	 * @Route("/{slug}", name="blog_delete")
	 */
	public function delete(Article $article): Response
	{
		// TODO make delete
	}

}
