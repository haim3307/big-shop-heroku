<?php

namespace App;

use DB;

class PageList extends MainModel
{
    protected $table = 'page_lists';
    public function entity(){
        return $this->belongsTo(Entity::class);
    }
    public function items()
    {
        return $this->hasMany(PageListItem::class)->orderBy('order');
    }

}
