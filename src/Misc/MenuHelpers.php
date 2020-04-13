<?php
namespace PoP\Menus\Misc;

class MenuHelpers
{
    public static function getMenuIDFromMenuName($menu)
    {
        $cmsmenusresolver = \PoP\Menus\ObjectPropertyResolverFactory::getInstance();
        $cmsmenusapi = \PoP\Menus\FunctionAPIFactory::getInstance();
        $menu_object = $cmsmenusapi->getNavigationMenuObject($menu);
        return $cmsmenusresolver->getMenuObjectTermId($menu_object);
    }
}
