<?php

namespace App\Http\Controllers;

class MainController extends SuperController
{
    public function __construct()
    {
        self::$data['title'] = 'Big Shop | ';
    }

    static public function setTitle($title)
    {
        self::$data['title'] .= ucwords($title);
    }

    static public function setMetaDesc($metaDesc)
    {
        self::$data['metaDesc'] = $metaDesc;
    }

    static public function notFound()
    {
        self::setTitle('Page Not Found');
        abort(404);
    }
}
