<?php
namespace PoP\Menus\TypeResolvers;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;

class MenuItemTypeResolver extends AbstractTypeResolver
{
    public const TYPE_COLLECTION_NAME = 'menu-items';

    public function getTypeCollectionName(): string
    {
        return self::TYPE_COLLECTION_NAME;
    }

    public function getId($resultItem)
    {
        $cmsmenusresolver = \PoP\Menus\ObjectPropertyResolverFactory::getInstance();
        $menu_item = $resultItem;
        return $cmsmenusresolver->getMenuItemId($menu_item);
    }

    public function getIdFieldTypeDataResolverClass(): string
    {
        // Not implemented yet, since no need...
        return null;
    }
}
    
