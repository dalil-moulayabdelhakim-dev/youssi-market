<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderMail;
use App\Models\AdministrativeInformation;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\StoreWilaya;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mail;

class CartController extends Controller
{
    public function cartView()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('product')->get();

        return view('cart', compact('cart'));
    }

    public function store(Request $request)
{
    $product = Product::findOrFail($request->product_id);

     $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => [
            'required',
            'numeric',
            'min:1',
            'max:' . $product->quantity,
        ],
    ], [
        'quantity.max' => __('messages.max_quantity_exceeded'),
    ]);

    $product_price = (int) $product->price;
    $quantity = $request->quantity;
    $total = $product_price * $quantity;
    $user_id = Auth::user()->id;

    Cart::create([
        'user_id' => $user_id,
        'product_id' => $product->id,
        'delivery_place' => $request->delivery_place,
        'quantity' => $quantity,
        'total' => $total,
    ]);

    Session::flash('success', [__('messages.product_added')]);
    return back();
}

    public function checkout(Request $request)
    {
        $user = Auth::user();

        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if (empty($cartItems)) {
            return back()->with('error',  __('messages.cart_empty'));
        }

        DB::beginTransaction();

        try {
            // حساب المجموع
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->total;
            }

            // إنشاء الطلب
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'delivery_place' => $request->delivery_place,
            ]);

            // إضافة العناصر للطلب
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            Mail::to($user->email)->send(new NewOrderMail($order));
            // إفراغ السلة
            session()->forget('cart'); // أو حذف من جدول cart_items
            Cart::where('user_id', $user->id)->delete();
            DB::commit();
            Session::flash('success', [__('messages.order_success')]);

            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();

            Session::flash('error', [__('messages.order_error'), $e->getMessage()]);
            return back();
        }
    }
}
