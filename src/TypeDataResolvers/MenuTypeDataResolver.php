<?php
namespace PoP\Menus\TypeDataResolvers;

use PoP\ComponentModel\TypeDataResolvers\AbstractTypeDataResolver;

class MenuTypeDataResolver extends AbstractTypeDataResolver
{
    public function resolveObjectsFromIDs(array $ids): array
    {
        $cmsmenusapi = \PoP\Menus\FunctionAPIFactory::getInstance();
        $ret = array_map(array($cmsmenusapi, 'getNavigationMenuObjectById'), $ids);
        return $ret;
    }
}
