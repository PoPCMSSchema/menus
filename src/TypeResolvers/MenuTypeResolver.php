<?php
namespace PoP\Menus\TypeResolvers;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\Menus\TypeDataResolvers\MenuTypeDataResolver;

class MenuTypeResolver extends AbstractTypeResolver
{
    public const NAME = 'menus';

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

    public function getIdFieldTypeDataResolverClass(): string
    {
        return MenuTypeDataResolver::class;
    }
}

