<?php

namespace App;

use Toastr;
use Illuminate\Database\Eloquent\SoftDeletes;



class Post extends CMSModel
{
    protected $fillable = ['title', 'url', 'description', 'main_img','article'];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'post_categories');
    }
    public function tags(){
        return $this->belongsToMany (Tag::class);
    }
    public function comments(){
        return $this->hasMany(PostComment::class);
    }
    public function scopeItems($query){
        return $query->with('author','comments:id,post_id');
    }
    public function setRelatedPosts()
    {
        $this->relatedPosts = self::items()->where('posts.id','!=',$this->id)->get();
    }

    static public function createNew($request)
    {
        $post = new self($request->all());
        $post->author()->associate(auth()->user());
        if ($post->save()) {
            $post->attachTags($request->tags);
            Toastr::success('New Post has been added!');
            if($post->uploadImg($request,'_img/posts',['width'=>600],'main_img')){
                return Toastr::success('New Post Image has been added!');
            }
            return Toastr::error('New Post Image has not been added!');
        }
        Toastr::error('Post has not been created');

    }
    static public function updateItem($id, $request)
    {
        $post = self::findOrFail($id);
        if ($post->update($request->all()))
        {
            $post->attachTags($request->tags);
            if($request->hasFile('main_img')){
                $post->uploadImg($request,'_img/posts');
            }
            return Toastr::success('The post has been updated!');
        }
        Toastr::error('Post was not updated successfully!');


    }

}
