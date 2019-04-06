<?php

namespace App;

use DB, Session, File, Toastr, Image;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends CMSModel
{
    //
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = ['title', 'url', 'description', 'price', 'category_id', 'main_img', 'stock'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'products_tags');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function mainCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function longDescription()
    {
        return $this->hasOne(ProductDescription::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /*    public function filters(){
            return $this->hasManyThrough(Filter::class,Category::class,);
            return $this->hasManyThrough('Contact', 'Account', 'owner_id')->join('orders','contact.id','=','orders.contact_ID')->select('orders.*');

        }*/
    public function allOfCategory($category_id)
    {
        return $this->where('category_id', '=', $category_id)->get();
    }
    public function scopeWithMainCategory($query,$more=''){
        return $query->with('mainCategory:id,url'.$more);
    }
    public function setRelatedProducts()
    {
        $this->relatedProducts = self::inRandomOrder()->withMainCategory()->where('id', '!=', $this->id)->limit(4)->get();
    }
    public function setExtraProps(){
        $this->inWishList =  WishListItem::inWishList($this->id);
        $this->main_category =  $this->mainCategory()->first(['id','url']);
    }
    static function setExtraPropsAll($data){
        foreach ($data as $item){
            $item->setExtraProps();
        }
    }

    static public function getTagged($tag_name, &$data)
    {
        $data = self::with(['tags','mainCategory:id,url'])->whereHas('tags',function ($query) use ($tag_name){
            $query->where('name', '=', $tag_name);
        })->limit(4)->get();
        self::setExtraPropsAll($data);
    }

    static public function searchProductWithRoute($id)
    {
        return self::from('products as p')->where('p.id', '=', $id)->join('categories as c', 'p.category_id', '=', 'c.id')->select('p.*', 'c.url as c_url');
    }

    static public function getItemPage($itemTitle, $mainCategory)
    {
        return self::where('url', '=', $itemTitle)->withMainCategory(',name')->whereHas('mainCategory',function ($query) use($mainCategory){$query->where('url',$mainCategory);})->first();
    }

    static public function joinCategory($query)
    {
        return $query->join('categories as c', 'c.id', '=', 'products.category_id');
    }

    public function scopeAddCategory($query, $categoryId = null)
    {
        $query->join('categories as c', 'c.id', '=', 'products.category_id');
        if ($categoryId) $query->where('c.id', $categoryId);
        return $query;
    }

    public function scopeWithoutDeleted($query,$alias){
        return $query->withTrashed()->whereRaw($alias.'.deleted_at IS NULL');
    }

    static public function productsWithCategory()
    {
        return self::from('products')->join('categories as c', 'c.id', '=', 'products.category_id')->select('products.*', 'c.url as c_url');
        //$product = Product::with('tags')->where('id',22)->tags->paginate(2);
        //$produc;

    }

    static public function frameItems(&$data)
    {
        $data['frameItems'] = self::with('mainCategory:id,url')->limit(10)->get();
    }
    static public function createNew($request)
    {
        $product = new self($request->all() + ['main_img' => 'default.png']);
        if ($category = Category::findOrFail($request->category_id)) {
            if ($product->save()) {
                $product->attachTags($request->tags);
                if($request->long_description){
                    $product->longDescription()->updateOrCreate(['long_description'=>$request->long_description]);
                }
                $product->uploadImg($request,"_img/products/$category->url/",['width'=>400],'main_img');
            }
            return Toastr::success('New Product Created!');
        }
        Toastr::error('Product has not been created');
    }

    static public function updateItem($id, $request)
    {
        $product = self::findOrFail($id);
        if (isset($product)) {
            if ($product->update($request->all())) {
                $product->attachTags($request->tags);
                if($request->long_description){
                    $product->longDescription()->updateOrCreate(['long_description'=>$request->long_description]);
                }
                $oldCategory = Category::find($product->category_id);
                $pFolder = '_img/products/';
                $oldPFolder = $pFolder . $oldCategory->url;
                $checkIfToUpload = $product->uploadImg($request,"$pFolder{$oldCategory->url}/",['width'=>600],'main_img');
                if (!$checkIfToUpload && isset($product->main_img) && $product->category_id != $request->category_id) {
                    $newCategory = Category::find($request->category_id);
                    File::move(public_path($oldPFolder . $product->main_img), public_path($pFolder . $newCategory->url));
                }
                return Toastr::success('Product updated successfully!');
            }
        }
        Toastr::error('Product was not updated successfully!');

    }
}
