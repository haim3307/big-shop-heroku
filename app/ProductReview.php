<?php

namespace App;

class ProductReview extends MainModel
{
    protected $table = 'product_reviews';
    protected $fillable = ['title','description','rating'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    static public function createNew($product,$request){
        $review = new self();
        $review->description  = $request->description;
        $review->rating  = $request->rating;
        $review->product()->associate($product);
        $review->user()->associate(auth()->user());
        return $review->save();
    }
}
