<?php

namespace Scribe\SharedBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * NavMenuItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IconTemplateRepository extends EntityRepository
{
    /**
     * @param  IconFamily    $family
     * @return IconTemplate 
     */
    public function loadHighestPriorityByFamily(IconFamily $family)
    {
        $q = $this
          ->createQueryBuilder('t')
          ->where('t.family = :family')
          ->setParameter('family', $family)
          ->orderBy('t.priority', 'DESC')
          ->setMaxResults(1)
          ->getQuery()
        ;

        try {
            return $q->getSingleResult();
        }
        catch(NonUniqueResultException $e) {
            return null;
        }
    }
}
