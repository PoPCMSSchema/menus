<?php
namespace PoP\Menus\TypeResolvers;

use PoP\Menus\TypeDataResolvers\MenuItemTypeDataResolver;
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
        $menuItem = $resultItem;
        return $cmsmenusresolver->getMenuItemId($menuItem);
    }

    public function getTypeDataResolverClass(): string
    {
        return MenuItemTypeDataResolver::class;
    }
}

