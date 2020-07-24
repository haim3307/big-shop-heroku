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

    public function info()
    {
        return $this->hasOne();
    }

    static public function getAllOrdersPaginate(&$page, $userId = null, $limit = 3)
    {
        $qb = self::orderBy('created_at', 'desc');
        if ($userId) $qb->where('user_id', $userId);
        $page = $qb->paginate($limit);
        $page->getCollection()->transform(function ($order) {
            $order->list = collect(json_decode($order['list']));
            $order->subTotal = $order->list->sum(fn($listItem) => $listItem->item->price * $listItem->quantity);
            $order->total = $order->subTotal + ($order->subTotal * 0.18);
            $order->totalQuantity = $order->list->sum(fn($listItem) => $listItem->quantity);
            if (!empty($order->user)) return $order;
        });

    }
}
