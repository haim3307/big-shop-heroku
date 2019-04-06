<?php

namespace App;

use App\Http\Requests\CategoryRequest;
use Session, URL, File, Image, Toastr,Storage;

class Category extends MainModel
{
    //
    protected $fillable = ['name', 'url', 'img'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function filters()
    {
        return $this->belongsToMany(Filter::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }
    public function scopeUnTrash($query){
        return $query;//->where('url','!=','uncategorized');
    }
    static public function createNew($request)
    {
        $category = new self($request->all());
        if ($category->save()) {
            Toastr::success('New category has been added!');
            if ($category->uploadImg($request, '_img/categories')) {
                return Toastr::success('New category Image has been added!');
            }
            return Toastr::error('New category Image has not been added!');
        }
        Toastr::error('Category has not been created');

    }

    static public function updateItem($id, $request)
    {
        $category = self::findOrFail($id);
        $req = $request;
        if($category->url === 'uncategorized') $req->request->remove('url');
        if($category->update($request->all())){
            if ($request->hasFile('img')) {
                $category->uploadImg($request, '_img/categories');
            }
            return Toastr::success('The category has been updated!');
        }
        Toastr::error('Category was not updated successfully!');
    }

    static public function orderShop($request)
    {
        $request->order = explode(',', $request->order);
        for ($i = 1; $i <= count($request->order); $i++) {
            $item = self::where('id', '=', $request->order[$i - 1]) and $item->update(['order' => $i]);
        }
    }

    static public function deleteItem($categoryId)
    {
        if($category = self::find($categoryId) and $category->url !== 'uncategorized'){
            $uncategorized = Category::getByUrl('uncategorized');
            $pFolder = '_img/products/';
            $oldPFolder = $pFolder.$category->url;
            $newFolder = $pFolder . 'uncategorized';
            self::checkOrCreateFolder($newFolder);
            $productOfOldCategory = $category->products();
            $postsOfOldCategory = $category->posts();
            $productOfOldCategory->withTrashed()->get()->each(function($product) use ($oldPFolder,$pFolder,$newFolder){
                if(File::exists(public_path($oldPFolder .'/'. $product->main_img)))
                File::move(public_path($oldPFolder .'/'. $product->main_img), public_path($newFolder.'/'. $product->main_img));
            });
            $productOfOldCategory->update(['category_id'=>$uncategorized->id]);
            $postsOfOldCategory->update(['category_id'=>$uncategorized->id]);
            return $category->delete()?1:0;
        }
        return 0;
    }

    static public function getCategoryProducts($main_category, $selectedBrandIds, $request, &$data)
    {
        $main_items_collection = $main_category->products();
        $min_price = $main_items_collection->min('price');
        $max_price = $main_items_collection->max('price');
        $title = trim($request->{'product-search'});
        $main_items_collection->where(function ($query) use ($request, $selectedBrandIds, $title) {
            if (!empty($title)) $query->where('title', 'like', '%' . $title . '%');
            if (!empty($selectedBrandIds)) $query->whereIn('brand_id', $selectedBrandIds);
        });
        $main_items_collection->where(function ($query) use ($request) {
            if (isset($request['max-price']) && isset($request['min-price'])) {
                if (is_numeric($request['max-price']) && is_numeric($request['max-price'])) {
                    $query->whereBetween('price', [$request['min-price'], $request['max-price']]);
                }
            } else if (isset($request['max-price']) && is_numeric($request['max-price'])) $query->whereBetween('price', [0, $request['max-price']]);
            else if (isset($request['min-price']) && is_numeric($request['min-price'])) $query->where('price', '>=', $request['min-price']);

        })->select('products.*');
        if ($request->{'order-by-price'} == 'high') $orderPrice = 'desc';
        elseif ($request->{'order-by-price'} == 'low') $orderPrice = 'asc';
        if (isset($orderPrice)) $main_items_collection->orderBy('price', $orderPrice);
        $merage = [];
        if (!$main_items_collection->count()) {
            $merage += ['max-price' => $max_price, 'min-price' => $min_price, 'product-search' => ''];
        }
        if ($merage) $request->merge($merage);
        $result = $main_items_collection->paginate(4);
        Product::setExtraPropsAll($result);
        $data += [
            'main_items' => $result,
            'max_price' => $max_price,
            'min_price' => $min_price,
            'category' => $main_category,
            'selected_category' => $main_category,
        ];
    }
}
