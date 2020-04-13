<?php

declare(strict_types=1);

namespace PoP\Menus\Facades;

use PoP\Menus\TypeAPIs\MenuTypeAPIInterface;
use PoP\Root\Container\ContainerBuilderFactory;

class MenuTypeAPIFacade
{
    public static function getInstance(): MenuTypeAPIInterface
    {
        return ContainerBuilderFactory::getInstance()->get('menu_type_api');
    }
}
