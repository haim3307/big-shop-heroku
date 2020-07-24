<?php

namespace App\Http\Controllers;

use App\Product;
use App\Tag;

class HomeController extends MainController
{
    public function byTag($tagName)
    {
        if (Tag::where('url', $tagName)) {
            Product::getTagged($tagName, self::$data['tagged']);
            return self::$data['tagged'];
        } else abort(404);
    }
}
