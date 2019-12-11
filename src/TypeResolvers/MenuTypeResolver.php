<?php
namespace PoP\Menus\TypeResolvers;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\Menus\TypeDataLoaders\MenuTypeDataLoader;

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

    public function getTypeDataLoaderClass(): string
    {
        return MenuTypeDataLoader::class;
    }
}

