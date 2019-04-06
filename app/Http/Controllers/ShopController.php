<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    Category,
    Brand,
    Http\Requests\CategoryRequest,
    Http\Requests\ProductReviewRequest,
    Product,
    ProductReview,
    WishListItem
};

class ShopController extends MainController
{
    public function index()
    {
        self::$data['title'] .= 'Shop';
        self::$data['categories'] = Category::orderBy('order')->unTrash()->get();
        return view('main-pages.shop', self::$data);
    }

    public function show($main_category, $subCategory = 'all', $page = 1,Request $request)
    {
        $main_category = Category::getByNameOrUrl($main_category);
        if ($main_category) {
            $selectedBrandIds= Brand::getSelected($request);
            //items source
            Category::getCategoryProducts($main_category,$selectedBrandIds,$request,self::$data);

            $request->flash();
            self::setTitle('Shop | ' . ucwords($main_category->name));
            self::$data += [
                'category' => $main_category,
                'page' => $page,
                'selected_category' => $main_category,
                'categories' => Category::orderBy('order')->get(),
            ];
            return view('main-pages.categories-page', self::$data);
        } else abort(404);
    }
    public function storeReview($categoryUrl,$productUrl , ProductReviewRequest $request){
        if($product = Product::getByUrl($productUrl) and $product->id){
            if(!ProductReview::where([['user_id',auth()->user()->id],['product_id',$product->id]])->exists())
                ProductReview::createNew($product,$request);
            else return redirect()->back()->withErrors(['exist'=> 'You have already written a review for this product!']);
        }

        return redirect()->back();

    }
    public function productPage($mainCategory, $itemTitle)
    {
        $item = Product::getItemPage($itemTitle, $mainCategory);
        if (!$item) self::notFound();
        $item->setRelatedProducts();

        self::setTitle($item->title);
        self::$data += [
            'inWishList' => WishListItem::inWishList($item->id),
            'selected_sub_category' => (object)['name' => $mainCategory],
            'category' => (object)['name' => $mainCategory],
            'item' => $item,
            'reviews' => [
                (object)[
                    "user" => (object)["name" => 'Daniel Israel', "profile_img" => "default.png"],
                    "description" => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi
                                        blanditiis consectetur error,
                                        et, eum illo illum mollitia nisi perferendis placeat, recusandae rem sequi sint
                                        temporibus totam veniam. Amet, at dicta, dolorem doloribus ducimus eaque est et
                                        maiores maxime neque non odio quae repellat sequi sint suscipit vel.
                                        Exercitationem, libero.',
                    'rating'=>4.5
                ],
                (object)[
                    "user" => (object)["name" => 'Rina Oziel', "profile_img" => "default.png"],
                    "description" => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi
                                        blanditiis consectetur error,
                                        et, eum illo illum mollitia nisi perferendis placeat, recusandae rem sequi sint
                                        temporibus totam veniam. Amet, at dicta, dolorem doloribus ducimus eaque est et
                                        maiores maxime neque non odio quae repellat sequi sint suscipit vel.
                                        Exercitationem, libero.',
                    'rating'=>5
                ]
            ]
        ];
        return view('main-pages.product', self::$data);
    }
}
