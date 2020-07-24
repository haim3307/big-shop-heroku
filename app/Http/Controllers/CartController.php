<?php

namespace App\Http\Controllers;

use App\OrderList;
use App\Product;
use Cartalyst\Stripe\Exception\CardErrorException;
use Illuminate\Http\Request;
use Session;
use Stripe;
use Toastr;

class CartController extends MainController
{

    public function index()
    {
        self::setTitle('Cart');
        return view('main-pages.cart', self::$data + ['shopCartPage' => true]);
    }

    public function storeOrderList(Request $request)
    {
        $order = json_decode($request->order);

        if (count($order)) {
            $order = collect($order)->map(function ($item) {
                $product = Product::from('products as p')->withoutDeleted('p')->where('p.id', $item->id)->join('categories as c', 'p.category_id', '=', 'c.id')->select('p.title', 'p.price', 'p.main_img', 'p.url', 'c.url as c_url')->first();
                if (isset($product->id)) {
                    $product->quantity -= $item->quantity;
                    $product->save();
                }
                return ['item' => $product, 'quantity' => $item->quantity];
            })->filter(fn($order) => $order['item'])->toJson();
            /** @var OrderList $orderList */
            $orderList = auth()->user()->orders()->save(new OrderList(['list' => $order, 'step' => 1]));

            if ($orderList) {
                $orderData = ['order_id', $orderList->id, 'step' => 1];
                if (!session()->has('userOrders')) session()->put('userOrders', [$orderData]);
                else session()->push('userOrders', $orderData);
                //Session::flash('ms','Thank you ! Order has been registered');
                return redirect('checkout?order_id=' . $orderList->id)->with('clear_cart', 1);
            }
        }
        return redirect('cart');
    }

    public function checkout(Request $request)
    {
        self::setTitle('checkout');
        $args = ['view' => 'errors.any', 'data' => []];
        if ($request->order_id) {
            $order = OrderList::find($request->order_id);
            if (auth()->user()->id == $order->user_id) {
                if (empty($order->step) || Session::has('orderPayed')) {
                    $args['view'] = 'main-pages.checkout-vue';
                } else $args['data']['msg'] = 'This order was already paid';
            } else $args['data']['msg'] = 'This order is Unauthorized';
        } else $args['data']['msg'] = 'Sorry ,No order was found';
        return view($args['view'], self::$data + $args['data']);

    }

    public function checkoutPost(Request $request)
    {
        try {
            $charge = Stripe::charges()->create([
                'amount' => 20,
                'currency' => 'CAD',
                'source' => $request->stripeToken,
                'description' => 'Description goes here',
                'receipt_email' => $request->email,
                'metadata' => [
                    'data1' => 'metadata 1',
                    'data2' => 'metadata 2',
                    'data3' => 'metadata 3',
                ],
            ]);

            // save this info to your database
            auth()->user()->orders()->where('id', $request->order_id)->update(['step' => 1]);
            session()->flash('orderPayed', 1);
            session()->flash('clear_cart', 1);
            // SUCCESSFUL
            return back()->with('success_message', 'Thank you! Your payment has been accepted.');
        } catch (CardErrorException $e) {
            // save info to database for failed
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

}
