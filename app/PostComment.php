<?php

namespace App;

class PostComment extends MainModel
{
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    static public function createNew($product,$request){
        $comment = new self();
        $comment->comment  = $request->comment;
        $comment->post()->associate($product);
        $comment->user()->associate(auth()->user());
        return $comment->save();
    }
}
