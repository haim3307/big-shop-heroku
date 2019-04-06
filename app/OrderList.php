<?php

namespace App;

class OrderList extends MainModel
{
    protected $table = 'order_lists';
    protected $fillable = ['list'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function info(){
        return $this->hasOne();
    }
    static public function getAllOrdersPaginate(&$page,$userId = null,$limit = 3)
    {

        if($userId) $page = self::where('user_id',$userId);
        $page = self::orderBy('created_at','desc')->paginate($limit);
        $page->getCollection()->transform(function ($order) {
            $order->list = collect(json_decode($order['list']));
            $order->subTotal = $order->list->sum(function ($listItem){
                return $listItem->item->price * $listItem->quantity;
            });
            $order->total = $order->subTotal + ($order->subTotal * 0.18) ;
            $order->totalQuantity = $order->list->sum(function ($listItem){
                return $listItem->quantity;
            });
            if(isset($order->user)) return $order;
        });

    }
}
