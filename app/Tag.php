<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Tag extends MainModel
{
    //
    protected $fillable = ['name','url'];
    public static function boot()
    {
        static::deleting(function ($tag) {
            $tag->products()->detach();
        });

        parent::boot();
    }
    public function products(){
        return $this->belongsToMany(Product::class,'products_tags');
    }
    static public function createNew($request){
        self::Create($request->all());
    }
    static public function updateItem($id, $request)
    {
        $msg = 'Tag was not updated successfully!';
        $status = 1;
        if (self::findOrFail($id)->update($request->all())) {
            $msg = 'Tag updated successfully!';
            $status = 1;
        }
        Session::flash('cms_m', $msg);
        Session::flash('cms_status', $status);
    }
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
