<?php
namespace PoP\Menus\TypeDataResolvers;

use PoP\ComponentModel\TypeDataResolvers\AbstractTypeDataResolver;
use PoP\Menus\TypeResolvers\MenuTypeResolver;

class MenuTypeDataResolver extends AbstractTypeDataResolver
{
    public function getTypeResolverClass(): string
    {
        return MenuTypeResolver::class;
    }
    
    public function resolveObjectsFromIDs(array $ids): array
    {
        $cmsmenusapi = \PoP\Menus\FunctionAPIFactory::getInstance();
        $ret = array_map(array($cmsmenusapi, 'getNavigationMenuObjectById'), $ids);
        return $ret;
    }
}
