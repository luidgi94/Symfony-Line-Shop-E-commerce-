<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

  

    public function trouverJeux($keyword){
        $query = $this->createQueryBuilder('a')
            ->where('upper(a.product_name) LIKE :key')->orWhere('upper(a.description) LIKE :key')
            ->orWhere('upper(a.id_Console) LIKE :key')
            ->setParameter('key' , '%'.strtoupper($keyword).'%')->getQuery();
 
        return $query->getResult();
    }

     // /**
    //  * @return Game[] Returns an array of Game objects
    // */
    
    // public function trouverJeuxMod($search): array
    // {
    //     dump(' Voici la recherche :'.'%'.strtoupper($search).'%');
    //     $entityManager = $this->getEntityManager();

    //     $query = $entityManager->createQuery(
    //         'SELECT p
    //         FROM App\Entity\Game p 
    //         WHERE upper(p.product_name) LIKE :price OR upper(p.description)
    //         ORDER BY p.price ASC'
    //     )->setParameter('price', '%'.strtoupper($search).'%'); // on interoge des objets php mais ca ressemble a une requete SQL

    //     // returns an array of Product objects
    //     return $query->getResult();
    // }
    
}
