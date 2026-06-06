<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatusUpdatedMail;
use App\Models\Category;
use App\Models\Commission;
use App\Models\DeleveryArea;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Store;
use App\Models\Wilaya;
use Auth;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OwnerController extends Controller
{
    public function addProductView()
    {
        $categories = Category::all();
        return view('owner.pages.add-product', compact('categories'));
    }

    public function viewOrders()
    {
        $storeId = Auth::user()->store_id;

        $orders = Order::whereHas('orderItems.product', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })
            ->with([
                'orderItems' => function ($query) use ($storeId) {
                    $query->whereHas('product', function ($q) use ($storeId) {
                        $q->where('store_id', $storeId);
                    })->with('product'); // نجيب المنتج المرتبط فقط للـ store الحالي
                }
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('owner.pages.view-order', compact('orders'));
    }

    public function viewProduct()
    {
        $store_id = Auth::user()->store_id;
        $products = Product::where('store_id', $store_id)->paginate(10);
        $categories = Category::all();

        return view('owner.pages.view-product', compact(['products', 'categories']));
    }

    public function addProduct(Request $request)
    {
        try {

            $disk = 'public';
            $path = '';

            if ($request->hasFile('image')) {
                $postName = time() . "." . $request->file('image')->getClientOriginalExtension();
                $destination_path = "uploads/products/" . Auth::user()->store_id . "/banner";
                $path = $request->file('image')->storeAs($destination_path, $postName, $disk);
                $path = 'storage/' . $path;
            } else {
                Session::flash('error', ['Each product contains banner!!']);
                return redirect()->back();
            }


            $data = Product::create([
                'title' => $request->title,
                'type' => $request->type,
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'store_id' => Auth::user()->store_id,
                'description' => $request->description,
                'discount_price' => $request->discount_price,
                'old_price' => $request->old_price,
                'image' => $path,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $filename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                    $destinationPath = 'uploads/products/' . Auth::user()->store_id . '/gallery' . $data->id;
                    $path = $imageFile->storeAs($destinationPath, $filename, $disk);

                    ProductImages::create([
                        'product_id' => $data->id,
                        'path' => 'storage/' . $path,
                    ]);
                }
            }


            $data->save();

            Session::flash('success', ['Product added successfully']);
            return redirect()->back();

        } catch (\Exception $e) {

            Session::flash('error', [$e->getMessage()]);
            return redirect()->back();

        }
    }

    public function updateProduct(Request $request)
    {
        $product = Product::findOrFail($request->id);


        // ✅ تحديث البيانات الأساسية
        $product->title = $request->input('title');
        $product->category_id = $request->input('category_id');
        $product->old_price = $request->input('old_price');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');

        $disk = 'public';

        //✅ إذا حذف البانر وما رفعش جديد → خطأ
        if ($request->has('removed_banner') && !$request->hasFile('image')) {
            Session::flash('error', ['Each product must have a banner image!']);
            return redirect()->back();
        }

        // ✅ حذف البانر إذا طلب المستخدم
        if ($request->has('removed_banner')) {
            if ($product->image && \Storage::exists(str_replace('storage/', '', $product->image))) {
                \Storage::delete(str_replace('storage/', '', $product->image));
            }
            $product->image = null;
        }

        // ✅ رفع بانر جديد إذا موجود
        if ($request->hasFile('image')) {
            // حذف القديم إذا موجود
            if ($product->image && \Storage::exists(str_replace('storage/', '', $product->image))) {
                \Storage::delete(str_replace('storage/', '', $product->image));
            }

            $postName = time() . "." . $request->file('image')->getClientOriginalExtension();
            $destination_path = "uploads/products/" . Auth::user()->store_id . "/banner";
            $path = $request->file('image')->storeAs($destination_path, $postName, $disk);
            $product->image = 'storage/' . $path;
        }

        // ✅ حذف صور المعرض إذا طلب المستخدم
        if ($request->has('removed_images')) {
            foreach ($request->removed_images as $imgPath) {
                if (\Storage::exists(str_replace('storage/', '', $imgPath))) {
                    \Storage::delete(str_replace('storage/', '', $imgPath));
                }

                ProductImages::where('product_id', $product->id)
                    ->where('path', $imgPath)
                    ->delete();
            }
        }

        // ✅ رفع صور جديدة للمعرض
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $filename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $destinationPath = 'uploads/products/' . Auth::user()->store_id . '/gallery' . $product->id;
                $path = $imageFile->storeAs($destinationPath, $filename, $disk);

                ProductImages::create([
                    'product_id' => $product->id,
                    'path' => 'storage/' . $path,
                ]);
            }
        }

        $product->save();

        Session::flash('success', ['Product updated successfully']);
        return redirect()->back();
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $paths = ProductImages::where('product_id', $id)->pluck('path')->toArray();


        return response()->json([
            'title' => $product->title,
            'old_price' => $product->old_price,
            'price' => $product->price,
            'discount' => $product->discount_price,
            'quantity' => $product->quantity,
            'description' => $product->description,
            'category_id' => $product->category_id,
            'image' => $product->image,
            'images' => $paths,
        ]);
    }

    public function addWilayaView()
    {
        $user = Auth::user();
        $store = $user->store;
        $wilayas = Wilaya::all();
        return view('owner.pages.delevery', compact(['store', 'wilayas']));

    }

    public function getDeliveryCost(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $wilaya = DeleveryArea::findOrFail($request->id);
            return response()->json($wilaya);
        }
        Session::flash('error', [__('messages.you_must_login')]);
        return redirect()->back();
    }

    public function updateDelivery(Request $request, $store_id)
{
    $store = Store::findOrFail($store_id);

    $request->validate([
        'wilayas' => 'required|array',
        'wilayas.*.H_cost' => 'nullable|numeric|min:0',
        'wilayas.*.SD_cost' => 'nullable|numeric|min:0',
    ]);

    $data = [];
    foreach ($request->wilayas as $wilaya_id => $values) {
        // نتحقق أن الوالية صحيحة (موجودة في جدول الولايات)
        if (!\App\Models\Wilaya::where('id', $wilaya_id)->exists()) {
            return back()->withErrors(['wilayas' => "Wilaya $wilaya_id غير موجودة"]);
        }

        $data[$wilaya_id] = [
            'price_to_home' => $values['H_cost'] ?? null,
            'price_to_office' => $values['SD_cost'] ?? null,
        ];
    }

    $store->wilayas()->sync($data);
    Session::flash('success', [__('messages.delivery_prices_updated')]);

    return redirect()->back();
}


    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected,shipped,delivered,received',
        ]);

        $store = Auth::user()->store;
        $storeId = $store->id;


        // نجيب الـ Order
        $order = Order::findOrFail($id);

        // نتحقق هل كاين items تخص المتجر الحالي
        $items = OrderItem::where('order_id', $order->id)
            ->whereHas('product', function ($query) use ($storeId) {
                $query->where('store_id', $storeId);
            })
            ->get();

        if ($items->isEmpty()) {
            abort(403, __('messages.not_authorized'));
        }
        
        if ($request->status === 'accepted') {
        foreach ($items as $item) {
            
            $product = $item->product;

            if ($product && $product->quantity >= $item->quantity) {
                $product->quantity -= $item->quantity;
                $product->save();
            } else {
                // لو الكمية ما تكفيش
                return back()->withErrors(__('messages.not_enough_stock', ['product' => $product->name]));
            }
        }
    }

        // نحدّث الحالة فقط للـ items اللي تخص المتجر الحالي
        OrderItem::whereIn('id', $items->pluck('id'))
            ->update(['status' => $request->status]);

        if ($request->status === 'received') {
            $commissionRate = $store->commission_rate / 100;

            $commissionAmount = $items->sum(function ($item) use ($commissionRate) {
                $itemTotal = $item->price * $item->quantity;
                return round($itemTotal * $commissionRate, 2); // 3% لكل item
            });

            Commission::create([
                'store_id' => $storeId,
                'order_id' => $order->id,
                'amount' => $commissionAmount,
            ]);
        }

        Mail::to($order->user->email)
            ->send(new OrderStatusUpdatedMail($order, $request->status, $items));

        Session::flash('success', [__('messages.order_status_updated')]);

        return back();
    }

    public function categoryView()
    {
        $categories = Category::all();
        return view('owner.pages.categories', compact('categories'));
    }

    // إضافة تصنيف جديد
    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //  تجهيز الاسم بشكل يدعم الحروف العربية والـ UTF-8
        $name = mb_strtolower($request->name, 'UTF-8');
        $name = str_replace(' ', '_', $name);
        $name = preg_replace('/[^\p{L}\p{N}_-]+/u', '', $name);

        // حفظ الصورة
        $disk = 'public';
        $path = '';

        if ($request->hasFile('image')) {
            $postName = time() . "." . $request->file('image')->getClientOriginalExtension();
            $destination_path = "uploads/categories";
            $path = $request->file('image')->storeAs($destination_path, $postName, $disk);
            $path = 'storage/' . $path;
        } else {
            Session::flash('error', [__('messages.category_banner_exists')]);
            return redirect()->back();
        }

        // إنشاء التصنيف
        Category::create([
            'name' => $name,
            'path' => $path,
        ]);

        Session::flash('success', [__('messages.operation_success')]);
        return redirect()->back();
    }

    public function payoutsView()
    {
        $user = Auth::user();
        $store = $user->store;

        if (!$store) {
            return redirect()->back()->with('error', [__('messages.no_store')]);
        }

        // Owed Commission calculation (Option B)
        $storeId = $store->id;
        $totalCommissions = \App\Models\Commission::where('store_id', $storeId)->sum('amount');

        $paidCommissions = \App\Models\PayoutRequest::where('store_id', $storeId)
            ->where('status', 'approved')
            ->sum('amount');

        $dueCommission = max(0, $totalCommissions - $paidCommissions);

        // Fetch past payout requests
        $payoutRequests = \App\Models\PayoutRequest::where('store_id', $storeId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.pages.payouts', compact('store', 'dueCommission', 'payoutRequests'));
    }

    public function storePayoutRequest(Request $request)
    {
        $user = Auth::user();
        $store = $user->store;

        if (!$store) {
            return redirect()->back()->with('error', [__('messages.no_store')]);
        }

        // Recalculate Owed Commission to validate amount
        $storeId = $store->id;
        $totalCommissions = \App\Models\Commission::where('store_id', $storeId)->sum('amount');

        $paidCommissions = \App\Models\PayoutRequest::where('store_id', $storeId)
            ->where('status', 'approved')
            ->sum('amount');

        $dueCommission = max(0, $totalCommissions - $paidCommissions);

        if ($dueCommission <= 0) {
            return redirect()->back()->with('error', [__('messages.insufficient_balance')]);
        }

        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . $dueCommission,
            'bank_details' => 'required|string',
        ], [
            'amount.max' => __('messages.insufficient_balance'),
        ]);

        \App\Models\PayoutRequest::create([
            'store_id' => $storeId,
            'amount' => $request->amount,
            'status' => 'pending',
            'bank_details' => $request->bank_details,
        ]);

        Session::flash('success', [__('messages.payout_requested')]);
        return redirect()->back();
    }
}
