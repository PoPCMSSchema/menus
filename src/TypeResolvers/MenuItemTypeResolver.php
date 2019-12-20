<?php
namespace PoP\Menus\TypeResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Menus\TypeDataLoaders\MenuItemTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;

class MenuItemTypeResolver extends AbstractTypeResolver
{
    public const NAME = 'MenuItem';

    public function getTypeName(): string
    {
        return self::NAME;
    }

    public function getSchemaTypeDescription(): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        return $translationAPI->__('Items (links, pages, etc) added to a menu', 'menus');
    }

    public function getID($resultItem)
    {
        $cmsmenusresolver = \PoP\Menus\ObjectPropertyResolverFactory::getInstance();
        $menuItem = $resultItem;
        return $cmsmenusresolver->getMenuItemId($menuItem);
    }

    public function getTypeDataLoaderClass(): string
    {
        return MenuItemTypeDataLoader::class;
    }
}

