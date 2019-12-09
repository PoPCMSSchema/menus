<?php
namespace PoP\Menus\TypeResolvers;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\Menus\TypeDataResolvers\MenuTypeDataResolver;

class MenuTypeResolver extends AbstractTypeResolver
{
    public const TYPE_COLLECTION_NAME = 'menus';
    
    public function getTypeCollectionName(): string
    {
        return self::TYPE_COLLECTION_NAME;
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

