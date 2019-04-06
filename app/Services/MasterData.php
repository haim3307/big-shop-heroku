<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/27/2018
 * Time: 11:08 AM
 */

namespace App\Services;


class MasterData
{
    public $menus , $brands , $allCategories;
    public function __construct()
    {
        $this->menus = \App\Menu::with('items')->get()->keyBy('url');
        $this->menus->transform(function ($menu){
            $menu->items->transform(function ($item,$key) use ($menu){
                $item->calc_url = $item->customUrl();
                if($item->calc_url) return $item;
            });
            return $menu;
        });
        $this->brands = \App\Brand::all()->reverse();
        $this->allCategories = \App\Category::take(15)->get();
    }
}