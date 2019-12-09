<?php
namespace PoP\Menus\FieldResolvers;

use PoP\ComponentModel\Facades\Instances\InstanceManagerFacade;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\Schema\TypeCastingHelpers;
use PoP\Menus\TypeResolvers\MenuTypeResolver;
use PoP\Menus\TypeResolvers\MenuItemTypeResolver;

class MenuFieldResolver extends AbstractDBDataFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(MenuTypeResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
			'items',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
			'items' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_ID),
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'items' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $cmsmenusresolver = \PoP\Menus\ObjectPropertyResolverFactory::getInstance();
        $cmsmenusapi = \PoP\Menus\FunctionAPIFactory::getInstance();
        $menu = $resultItem;
        switch ($fieldName) {
            case 'items':
                // Load needed values for the menu-items
                $instanceManager = InstanceManagerFacade::getInstance();
                $gd_dataload_fieldresolver_menu_items = $instanceManager->getInstance(MenuItemTypeResolver::class);
                $items = $cmsmenusapi->getNavigationMenuItems($cmsmenusresolver->getMenuTermId($menu));

                // Load these item data-fields. If other set needed, create another $field
                $item_data_fields = array('id', 'title', 'alt', 'classes', 'url', 'target', 'menu-item-parent', 'object-id', 'additional-attrs');
                $value = array();
                if ($items) {
                    foreach ($items as $item) {
                        $item_value = array();
                        foreach ($item_data_fields as $item_data_field) {
                            $item_value[$item_data_field] = $gd_dataload_fieldresolver_menu_items->resolveValue($item, $item_data_field);
                        }

                        // $id = $gd_dataload_fieldresolver_menu_items->getId($item);
                        $value[] = $item_value;
                    }
                }
                return $value;
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}
