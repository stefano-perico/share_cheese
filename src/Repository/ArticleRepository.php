<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findFiveLastArticle()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;
    }

    public function getWithSearchQueryBuilder(?string $term): QueryBuilder
    {
    	$qb = $this->createQueryBuilder('article')
		    ->innerJoin('article.author', 'author')
		    ->addSelect('author')
	    ;

		    if ($term) {
		    	$qb->andWhere('author.firstName LIKE :term OR author.lastName LIKe :term OR article.content LIKE :term OR article.title LIKE :term')
				   ->setParameter('term', '%'.$term.'%')
			    ;
		    }

		    return $qb
			    ->orderBy('article.createdAt', 'DESC');
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */

//    public function findByExampleField($value)
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField LIKE :val')
//            ->setParameter('val', '%'.$value.'%')
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }


    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
