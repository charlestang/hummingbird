<?php

namespace app\components;

/**
 * Description of MenuHelper
 *
 * @author charles
 */
class MenuHelper
{

    public static function getMenuItemParser()
    {
        return [__CLASS__, 'menuItemParser'];
    }

    public static function menuItemParser($menu)
    {
        $data = json_decode($menu['data'], true);
        return [
            'label' => $menu['name'],
            'url'   => [$menu['route']],
            'icon'  => $data['icon'],
            'items' => $menu['children'],
        ];
    }
}
