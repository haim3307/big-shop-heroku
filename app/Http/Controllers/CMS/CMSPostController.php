<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class CMSPostController extends CMSControlller
{
    static public $route = 'cms/post';
    static public $routeName = 'cms.post';
    public function __construct(){
        parent::__construct();
        self::$data['entity'] = 'post';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(self::$routeName.'.index', self::$data + ['items'=>Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(self::$routeName . '.create', self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        Post::createNew($request);
        return redirect(self::$route . '/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*    public function show($id)
    {
        return ($product = Product::where('url', '=', $productUrl)->first()) ? view('cms.product.show')->with('product', $product) : abort(404);
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view(self::$routeName . '.create', self::$data + ['entityItem' => Post::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        Post::updateItem($id, $request);
        return redirect(self::$route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
        return Post::destroy($id);
    }
}
