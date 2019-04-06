<?php

namespace App\Http\Controllers;

use App\WishListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishListController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::setTitle('wish list');
        self::$data['wishList'] = auth()->user()->wishList()->with('product','product.mainCategory')->get();
        return view('users.wish-list',self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function store(Request $request)
    {
        $wishItem = WishListItem::inWishList($request->wish_id,false)->first();

        if(isset($wishItem) && isset($wishItem->id)){
            return WishListItem::destroy($wishItem->id)?1:0;
        }else{
            $item = new WishListItem();
            $item->product_id = $request->wish_id;
            $item->user_id = auth()->user()->id;
            $saved = $item->save()?1:0;
            if($saved) Session::flash('addedToWishList',$item->product_id);
            return $saved;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return auth()->user()->wishList()->where('id',$id)->delete();
    }
}
