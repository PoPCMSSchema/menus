<?php
namespace PoP\Menus\TypeResolvers;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\Menus\TypeDataResolvers\MenuTypeDataResolver;

class MenuTypeResolver extends AbstractTypeResolver
{
    public const NAME = 'Menu';

    public function getTypeName(): string
    {
        return self::NAME;
    }

    public function getId($resultItem)
    {
        $cmsmenusresolver = \PoP\Menus\ObjectPropertyResolverFactory::getInstance();
        $menu = $resultItem;
        return $cmsmenusresolver->getMenuTermId($menu);
    }

    public function getTypeDataResolverClass(): string
    {
        return MenuTypeDataResolver::class;
    }
}

