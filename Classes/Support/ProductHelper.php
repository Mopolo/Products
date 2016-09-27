<?php

namespace Mopolo\Products\Support;

use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;

class ProductHelper
{
    /**
     * @return BackendUserAuthentication
     */
    public static function getBackendUser()
    {
        return $GLOBALS['BE_USER'];
    }
}
