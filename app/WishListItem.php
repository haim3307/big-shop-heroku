<?php

namespace App;

class WishListItem extends MainModel
{
    protected $table = 'wish_list';
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    static public function inWishList($productId,$onlyCheck = true){
        if(isset(auth()->user()->id)){
            $item = self::where([['product_id',$productId],['user_id',auth()->user()->id]]);
            if($onlyCheck) $item = $item->exists();
            return $item;
        }else return false;

    }
}
