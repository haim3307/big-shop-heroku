<?php

namespace App;

class UserInfo extends MainModel
{
    protected $guarded = ['created_at','updated_at','user_id','id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
