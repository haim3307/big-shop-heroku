<?php

namespace App\Http\Controllers;

use App\Product;
use App\Tag;

class HomeController extends MainController
{
    //
/*    public function index()
    {
        self::setTitle('Home');
        Product::headItems(self::$data);
        Product::frameItems(self::$data);
        Product::getTagged('featured',self::$data['cubeItems']);
        Product::getTagged('man',self::$data['cateItems']);
        return view('main-pages.home', self::$data);
    }*/

    public function byTag($tagName)
    {
        if(Tag::where('url',$tagName)) {
            Product::getTagged($tagName,self::$data['tagged']);
            return self::$data['tagged'];
        }else abort(404);
    }
}
