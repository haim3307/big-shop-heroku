<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\SuperController;
use App\MenuItem;
use App\OrderList;
use App\PageList;
use App\Product;
use App\ProductReview;
use Illuminate\Support\Facades\Session;

class CMSControlller extends SuperController
{
    public function __construct()
    {
        self::$data['title'] = 'CMS | ';
    }
    static public function connectPageManage($url,$pageListUrl = null){
        if($pageListUrl && ($pageListUrl = PageList::where('url',$pageListUrl)->first())) self::$data['selectedList'] = $pageListUrl->url;
        self::connectPage($url,false);
    }
    static public function updateFollow($entityItem){
        MenuItem::updateLinksUrl($entityItem->getLinks());
    }
    public function index(){
        self::$data['products'] = Product::orderBy('created_at','desc')->limit(10)->get();
        self::$data['reviews'] = ProductReview::has('product')->with('product:id,title')->orderBy('created_at','desc')->limit(10)->get();
        self::$data['orders'] = [];
        OrderList::getAllOrdersPaginate(self::$data['orders'],null,10);
        return view('cms.home',self::$data);
    }
    static public function setTitle($title){
        self::$data['title'] .= $title;
    }
    static public function notFound(){
        self::setTitle('Page Not Found');
        abort(404,self::$data);
    }

}
