<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\User;

class UserRepository extends EntityRepository
{

    public function searchByEmail($email)
    {
        $entityManager = require (dirname(__DIR__,2).'/config/bootstrap.php');
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('u')
                    ->from(User::class, 'u')
                    ->where('u.email = :email')
                    ->setParameter('email', $email);
        
        // $query = $queryBuilder->getQuery();
        // $result = $query->getSingleResult();

        $result = $queryBuilder ->getQuery()
                                ->getResult();

        return $result;
    }
}