<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCommentRequest;
use App\Post;
use App\PostComment;
use App\Tag;
use Illuminate\Http\Request;

class BlogController extends MainController
{
    public function index(){
        self::connectPage('blog');
        self::$data['posts'] = Post::items()->paginate(4);
        return view('main-pages.blog',self::$data);
    }
    public function indexByCategory($category){
        if($category = Category::getByUrl($category)){
            self::$data['posts'] = $category->posts()->paginate(4);
            return view('main-pages.blog',self::$data);
        }else return abort(404);
    }
    public function indexByTag($tag){
        if($tag = Tag::getByUrl($tag)){
            self::$data['posts'] = $tag->posts()->paginate(4);
            return view('main-pages.blog',self::$data);
        }else return abort(404);
    }
    public function show($post){
        self::$data['post'] = Post::getByurl($post);
        self::setTitle(self::$data['post']->title);
        self::$data['previous'] = Post::where('id', '<', self::$data['post']->id)->first();
        self::$data['post']->setRelatedPosts();
        // get next post id
        self::$data['next'] = Post::where('id', '>', self::$data['post']->id)->first();
        return view('blog.post',self::$data);
    }
    public function storeComment($post,PostCommentRequest $request){
        $post = Post::getByUrl($post);
        PostComment::createNew($post,$request);
        return redirect()->back();
    }
}
