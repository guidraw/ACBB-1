<?php


namespace AcbbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;

class MatchRepository extends EntityRepository
{
    public function findByDate()
    {
//        $serializer = new Serializer(array(new DateTimeNormalizer('Y-m-d')));
//        $dateAsString = $serializer->normalize($date);
//        $queryBuilder = $this->createQueryBuilder('m');
//        $queryBuilder
//            ->where('m.id = 1');
////            ->setParameter('date',$date);
//
//        $results = $queryBuilder->getQuery()->getResult();

        return 'fre';
    }
}