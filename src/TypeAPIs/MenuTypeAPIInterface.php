<?php
namespace PoP\Menus\TypeAPIs;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
interface MenuTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type Menu
     *
     * @param [type] $object
     * @return boolean
     */
    public function isInstanceOfMenuType($object): bool;
}