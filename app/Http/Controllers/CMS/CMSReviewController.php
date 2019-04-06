<?php

namespace App\Http\Controllers\CMS;

use App\ProductReview;
use Illuminate\Http\Request;

class CMSReviewController extends CMSControlller
{
    public function __construct()
    {
        self::$data['entity'] = 'review';
    }

    public function index()
    {
        self::$data['reviews'] = ProductReview::has('product')->with('product')->orderBy('created_at','desc')->paginate(5);
        return view('cms.review.index',self::$data);
    }
}
