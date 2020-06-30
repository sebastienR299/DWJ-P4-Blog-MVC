<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Entity\Article;

class ArticleRepository extends EntityRepository
{

    public function findAllByDesc($firstResult, $maxResults)
    {
        $entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('a')
                    ->from(Article::class, 'a')
                    ->orderBy('a.createdAt', 'DESC')
                    ->setFirstResult($firstResult) //offset
                    ->setMaxResults($maxResults); // limit
        
        $results = new Paginator($queryBuilder);
        return $results;
    }
}