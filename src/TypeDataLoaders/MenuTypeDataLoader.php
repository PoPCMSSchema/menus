<?php
namespace PoP\Menus\TypeDataLoaders;

use PoP\ComponentModel\TypeDataLoaders\AbstractTypeDataLoader;

class MenuTypeDataLoader extends AbstractTypeDataLoader
{
    public function resolveObjectsFromIDs(array $ids): array
    {
        $cmsmenusapi = \PoP\Menus\FunctionAPIFactory::getInstance();
        $ret = array_map(array($cmsmenusapi, 'getNavigationMenuObjectById'), $ids);
        return $ret;
    }
}
