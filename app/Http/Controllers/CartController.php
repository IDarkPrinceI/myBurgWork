<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cartAdd($slug)
    {
        $qty = request()->get('qty');
        $product = Cart::identityProduct($slug);
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        return $product;
    }


    public function cartClear()
    {
        Session::forget(['cart', 'cartQtySum', 'cartTotalPrice']);
    }


    public function cartDell($slug)
    {
        $product = Cart::identityProduct($slug);
        $cart = new Cart();
        $cart->dellToCart($product);
        return $product;
    }


    public function getOrder()
    {
        $userId = Auth::id();
        $user = User::query()
            ->find($userId);
        return view('front.cart.order', compact('user'));
    }


    public function cartReCalc($qty)
    {
        $slug = request()->get('slug');
        $qtyRez = request()->get('qtyRez');
        $product = Cart::identityProduct($slug);
        $cart = new Cart();
        $cart->recalculateCart($product, $qty, $qtyRez);
    }


    public function confirmOrder(Request $request)
    {
        $order = new Order();

        DB::beginTransaction();
        if ($order->saveOrder($request) && OrderItem::saveOrderItems($order->id)){
            DB::commit();
            $this->cartClear();
            return redirect()->route('index')->with('success', 'Заказ успешно оформлен!');
        } else {
            DB::rollback();
            return redirect()->back()->with('error', 'Ошибка оформления заказа!');
        }
    }
}
