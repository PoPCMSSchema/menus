<?php
namespace PoP\Menus\TypeResolvers;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;

class MenuItemTypeResolver extends AbstractTypeResolver
{
    public const NAME = 'MenuItem';

    public function getTypeName(): string
    {
        return self::NAME;
    }

    public function getId($resultItem)
    {
        $cmsmenusresolver = \PoP\Menus\ObjectPropertyResolverFactory::getInstance();
        $menu_item = $resultItem;
        return $cmsmenusresolver->getMenuItemId($menu_item);
    }
}

