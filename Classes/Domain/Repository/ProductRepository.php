<?php

namespace Mopolo\Products\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class ProductRepository extends Repository
{
    /**
     * @param int $minimumQuantity
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAvailables($minimumQuantity = 0)
    {
        $query = $this->createQuery();

        $query->matching($query->greaterThanOrEqual('quantity', $minimumQuantity));

        return $query->execute();
    }
}
