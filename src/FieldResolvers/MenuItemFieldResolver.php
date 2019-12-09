<?php
namespace PoP\Menus\FieldResolvers;

use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\Menus\TypeResolvers\MenuItemTypeResolver;

class MenuItemFieldResolver extends AbstractDBDataFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(MenuItemTypeResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'title',
            'alt',
            'url',
            'classes',
            'target',
            'additional-attrs',
            'object-id',
            'menu-item-parent',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
			'title' => SchemaDefinition::TYPE_STRING,
            'alt' => SchemaDefinition::TYPE_STRING,
            'url' => SchemaDefinition::TYPE_URL,
            'classes' => SchemaDefinition::TYPE_STRING,
            'target' => SchemaDefinition::TYPE_STRING,
            'additional-attrs' => SchemaDefinition::TYPE_STRING,
            'object-id' => SchemaDefinition::TYPE_ID,
            'menu-item-parent' => SchemaDefinition::TYPE_ID,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'title' => $translationAPI->__('', ''),
            'alt' => $translationAPI->__('', ''),
            'url' => $translationAPI->__('', ''),
            'classes' => $translationAPI->__('', ''),
            'target' => $translationAPI->__('', ''),
            'additional-attrs' => $translationAPI->__('', ''),
            'object-id' => $translationAPI->__('', ''),
            'menu-item-parent' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $cmsmenusresolver = \PoP\Menus\ObjectPropertyResolverFactory::getInstance();
        $cmsmenusapi = \PoP\Menus\FunctionAPIFactory::getInstance();
        $menu_item = $resultItem;
        switch ($fieldName) {
            case 'title':
                return $cmsmenusapi->getMenuItemTitle($menu_item);

            case 'alt':
                return $cmsmenusresolver->getMenuItemTitle($menu_item);
        
            case 'url':
                return $cmsmenusresolver->getMenuItemUrl($menu_item);
        
            case 'classes':
                // Copied from nav-menu-template.php function start_el
                $classes = $cmsmenusresolver->getMenuItemClasses($menu_item);
                $classes = empty($classes) ? array() : (array) $classes;
                $classes[] = 'menu-item';
                $classes[] = 'menu-item-' . $cmsmenusresolver->getMenuItemId($menu_item);
                if ($parent = $cmsmenusresolver->getMenuItemParent($menu_item)) {
                    $classes[] = 'menu-item-parent';
                    $classes[] = 'menu-item-parent-' . $parent;
                }
                if ($object_id = $cmsmenusresolver->getMenuItemObjectId($menu_item)) {
                    $classes[] = 'menu-item-object-id-' . $object_id;
                }
                return join(' ', HooksAPIFacade::getInstance()->applyFilters('menuitem:classes', array_filter($classes), $menu_item, array()));
            
            case 'target':
                return $cmsmenusresolver->getMenuItemTarget($menu_item);

            case 'additional-attrs':
                // Using the description, because WP does not give a field for extra attributes when creating a menu,
                // and this is needed to add target="addons" for the Add ContentPost link
                return $cmsmenusresolver->getMenuItemDescription($menu_item);

            case 'object-id':
                return $cmsmenusresolver->getMenuItemObjectId($menu_item);

            case 'menu-item-parent':
                return $cmsmenusresolver->getMenuItemParent($menu_item);
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}
