<?php

namespace App\Http\Controllers;

use App\Mail\TicketReplyMail;
use App\Models\Commission;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentRequest;
use App\Models\Product;
use App\Models\Store;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Models\Wilaya;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function redirect()
    {
        $user = Auth::user();
        if ($user) {
            $user_type = $user->user_type_id;
            $storeId = $user->store_id;
            $cartCount = 0;

            $cartCount = $user->cart()->count(); // يحسب العدد الإجمالي

            return match ($user_type) {
                1 => (function () use ($user) {
                        $all_users_number = User::query()->where('id', '!=', $user->id)->count();
                        $payment_requests_number = PaymentRequest::query()->where('status', 'pending')->count();
                        $owners_number = User::where('user_type_id', 2)->count();
                        $total_commissions = Commission::sum('amount');

                        // 1) Trend line chart (last 30 days)
                        $commissions_trend = Commission::select(
                            DB::raw('DATE(created_at) as date'),
                            DB::raw('SUM(amount) as total')
                        )
                            ->where('created_at', '>=', now()->subDays(30))
                            ->groupBy('date')
                            ->orderBy('date', 'asc')
                            ->get();

                        // 2) Top 5 stores by commission
                        $top_stores = Commission::select('store_id', DB::raw('SUM(amount) as total_commission'))
                            ->with('store:id,name')
                            ->groupBy('store_id')
                            ->orderBy('total_commission', 'desc')
                            ->take(5)
                            ->get()
                            ->map(function ($item) {
                                return [
                                    'name' => optional($item->store)->name ?? __('messages.no_name'),
                                    'total_commission' => (float)$item->total_commission
                                ];
                            });

                        // 3) Category sales distribution
                        $category_sales = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
                            ->join('categories', 'products.category_id', '=', 'categories.id')
                            ->select('categories.name', DB::raw('SUM(order_items.price * order_items.quantity) as total_sales'))
                            ->groupBy('categories.id', 'categories.name')
                            ->orderBy('total_sales', 'desc')
                            ->get()
                            ->map(function ($item) {
                                return [
                                    'name' => __('messages.' . $item->name) == 'messages.' . $item->name ? str_replace('_', ' ', $item->name) : __('messages.' . $item->name),
                                    'total_sales' => (float)$item->total_sales
                                ];
                            });

                        // 4) Expiring subscriptions in next 5 days
                        $expiring_stores = Store::where(function($query) {
                            $query->where('subscription_status', 'active')
                                  ->whereBetween('subscription_ends_at', [now(), now()->addDays(5)]);
                        })->orWhere(function($query) {
                            $query->where('subscription_status', 'trial')
                                  ->whereBetween('trial_ends_at', [now(), now()->addDays(5)]);
                        })->with('users')->get();

                        return view('admin.index', compact(
                            'all_users_number',
                            'payment_requests_number',
                            'owners_number',
                            'total_commissions',
                            'commissions_trend',
                            'top_stores',
                            'category_sales',
                            'expiring_stores'
                        ));
                    })(),

                2 => (function () use ($storeId, $cartCount) {
                        // 1) عدد الطلبات (Orders)
                        $orders_number = Order::whereHas('orderItems.product', function ($query) use ($storeId) {
                            $query->where('store_id', $storeId);
                        })->count();

                        // 2) عدد المنتجات (Products)
                        $products_number = Product::where('store_id', $storeId)->count();

                        // 3) عدد الزبائن (Customers)
                        $customers_number = Order::whereHas('orderItems.product', function ($query) use ($storeId) {
                            $query->where('store_id', $storeId);
                        })->distinct('user_id')->count('user_id');

                        // 4) مجموع الأرباح (Revenue)
                        $revenue = OrderItem::whereHas('product', function ($query) use ($storeId) {
                            $query->where('store_id', $storeId);
                        })->sum(DB::raw('price * quantity'));




                        return view('owner.index', [
                        'orders_number' => $orders_number,
                        'products_number' => $products_number,
                        'customers_number' => $customers_number,
                        'revenue' => $revenue,
                        'cartCount' => $cartCount,
                        ]);
                    })(),

                default => view('index'),
            };

        }
    }

    public function subscriptionRequestView()
    {
        $requests = PaymentRequest::paginate(10);

        return view('admin.pages.subscription-requests-view', compact('requests'));
    }

    public function subscriptionDetails($id)
    {
        $payment = PaymentRequest::findOrFail($id);
        return response()->json([
            'id' => $payment->id,
            'name' => $payment->subscription_method->name,
            'price' => $payment->subscription_method->price,
            'status' => $payment->status,
            'proof_path' => asset($payment->proof_path),
            'store' => [
                'name' => $payment->store->name,
                'category' => $payment->store->category,
                'address' => $payment->store->address,
                'contact' => $payment->store->contact,
                'subscription_status' => $payment->store->subscription_status,
            ]
        ]);
    }
    public function usersView()
    {
        $user = Auth::user();
        $wilayas = Wilaya::all();
        if ($user) {
            $users = User::whereNot('id', $user->id)
                ->paginate(20);
            return view('admin.pages.users', compact('users', 'wilayas'));
        }

        Session::flash('success', [__('messages.auth_required')]);
        return back();
    }
    public function userStore($id)
    {
        $store = Store::findOrFail($id);

        if (!$store) {
            return response()->json(['error' => 'No store found'], 404);
        }

        return response()->json([
            'store' => [
                'id' => $store->id,
                'name' => $store->name,
                'category' => $store->category,
                'address' => $store->address,
                'contact' => $store->contact,
                'subscription_status' => $store->subscription_status,
            ]
        ]);
    }

    public function approve(Request $request)
    {
        $paymentRequest = PaymentRequest::findOrFail($request->request_id);
        $store = $paymentRequest->store;

        // تحديث حالة الطلب
        $paymentRequest->status = 'approved';
        $paymentRequest->save();

        // تحديث المتجر
        $duration = $store->subscription_method_id == 1 ? '1 mounth' : '1 year'; // حسب الخطة
        $store->subscription_status = 'active';
        $store->subscription_ends_at = now()->add($duration);
        $store->save();

        Session::flash('success', [__('messages.approved_success')]);
        return back();
    }

    public function reject(Request $request)
    {
        $paymentRequest = PaymentRequest::findOrFail($request->request_id);
        $paymentRequest->status = 'rejected';
        $paymentRequest->save();

        return back()->with('error', __('messages.rejected_success'));
    }


    public function addUser(Request $request)
    {
        $user = Auth::user();
        $user_type_admin = $user->user_type_id;

        if ($user_type_admin == 1) { // 1 = admin
            $input = $request->all();

            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'min:10'],
                'user_type' => ['required'],
                'wilaya_id' => ['required', 'exists:wilayas,id'],
                'commune_id' => ['required', 'exists:communes,id'],
                'password' => ['required', 'min:8'],
            ])->validate();

            $user_type = $input['user_type'];
            $store_id = null;

            if ($user_type == '2') {
                Validator::make($input, [
                    'store_name' => ['required_if:user_type,2', 'string', 'max:255'],
                    'store_category' => ['required_if:user_type,2', 'string', 'max:255'],
                    'store_address' => ['required_if:user_type,2', 'string', 'max:255'],
                    'store_contact' => ['required_if:user_type,2', 'string', 'max:255'],
                ])->validate();

                $store = Store::create([
                    'name' => $input['store_name'],
                    'category' => $input['store_category'],
                    'address' => $input['store_address'],
                    'contact' => $input['store_contact'],
                    'commission_rate' => $input['commission_rate'],
                    'trial_ends_at' => Carbon::now()->addMonth(),
                ]);

                if (!$store) {
                    return redirect()->back()->with('error', [__('messages.store_creation_failed')]);
                }

                $store_id = $store->id;
            }

            $new_user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'user_type_id' => $user_type,
                'store_id' => $store_id,
                'address' => $input['address'] ?? null,
                'wilaya_id' => $input['wilaya_id'],
                'commune_id' => $input['commune_id'],
                'password' => Hash::make($input['password']),
            ]);

            if ($new_user) {
                return redirect()->back()->with('success', [__('messages.user_created_successfully')]);
            } else {
                return redirect()->back()->with('error', [__('messages.user_creation_failed')]);
            }

        } else {
            return redirect()->back()->with('error', [__('messages.only_admin_allowed')]);
        }
    }

    public function profitsPage()
    {
        $stores = Store::with([
            'commissions',
            'products.orderItems' => function ($query) {
                $query->where('status', 'received');
            }
        ])->get();

        $storesData = $stores->map(function ($store) {
            $totalCommission = $store->commissions->sum('amount');
            $receivedItemsCount = $store->products
                ->flatMap->orderItems
                ->where('status', 'received')
                ->count();

            $paidCommission = \App\Models\PayoutRequest::where('store_id', $store->id)
                ->where('status', 'approved')
                ->sum('amount');

            $dueCommission = max(0, $totalCommission - $paidCommission);

            return [
                'store' => $store,
                'total_commission' => $totalCommission,
                'received_items_count' => $receivedItemsCount,
                'paid_commission' => $paidCommission,
                'due_commission' => $dueCommission,
            ];
        });

        // 2) Subscription payments history
        $subscriptionPayments = \App\Models\PaymentRequest::with(['store', 'subscription_method'])->orderByDesc('created_at')->get();

        // 3) Commission transaction logs
        $commissionLogs = \App\Models\Commission::with(['store', 'order'])->orderByDesc('created_at')->get();

        return view('admin.pages.revenue', compact('storesData', 'subscriptionPayments', 'commissionLogs'));
    }

    public function ticketsView()
    {
        // نجيبو جميع التذاكر مع الرسائل و صاحب التذكرة
        $tickets = Ticket::with(['user', 'admin', 'messages'])
            ->orderBy('updated_at', 'desc')
            ->get();

//dd(view('admin.pages.contacts', compact('tickets'))->render());
        return view('admin.pages.contacts', compact('tickets'));
    }

    public function updateTicketStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,closed',
            'priority' => 'required|in:low,medium,high',
            'agent_notes' => 'nullable|string',
        ]);

        $ticket->update([
            'status' => $request->status,
            'priority' => $request->priority,
            'agent_notes' => $request->agent_notes,
        ]);

        return back()->with('success', [__('messages.ticket_status_updated')]);
    }

    public function updateUserStatus($id)
    {
        $user = User::findOrFail($id);

        $status = $user->status === 'active' ? 'suspended' : 'active';

        $user->status = $status;
        $user->save();

        return back()->with('success', [__('messages.user_status_updated')]);
    }

    public function settingsView()
    {
        $admin_info = \App\Models\AdministrativeInformation::first();
        $plans = \App\Models\SubscriptionMethod::whereIn('name', ['monthly', 'yearly'])->get();

        return view('admin.pages.settings', compact('admin_info', 'plans'));
    }

    public function updateCommission(Request $request)
    {
        $request->validate([
            'default_commission_rate' => 'required|numeric|min:0|max:100',
        ]);

        $admin_info = \App\Models\AdministrativeInformation::first();
        if (!$admin_info) {
            $admin_info = \App\Models\AdministrativeInformation::create([
                'email' => 'admin@gmail.com',
                'phone' => '0000000000',
                'baridimob' => '0000',
                'ccp' => '0000',
                'default_commission_rate' => $request->default_commission_rate,
            ]);
        } else {
            $admin_info->update([
                'default_commission_rate' => $request->default_commission_rate
            ]);
        }

        return back()->with('success', [__('messages.settings_updated')]);
    }

    public function updatePlans(Request $request)
    {
        $request->validate([
            'plans' => 'required|array',
            'plans.*.id' => 'required|exists:subscription_methods,id',
            'plans.*.display_name_en' => 'required|string|max:255',
            'plans.*.display_name_ar' => 'required|string|max:255',
            'plans.*.price' => 'required|numeric|min:0',
            'plans.*.features_en' => 'nullable|string',
            'plans.*.features_ar' => 'nullable|string',
        ]);

        foreach ($request->plans as $planData) {
            $plan = \App\Models\SubscriptionMethod::findOrFail($planData['id']);
            $plan->update([
                'display_name_en' => $planData['display_name_en'],
                'display_name_ar' => $planData['display_name_ar'],
                'price' => $planData['price'],
                'features_en' => $planData['features_en'],
                'features_ar' => $planData['features_ar'],
            ]);
        }

        return back()->with('success', [__('messages.settings_updated')]);
    }

    public function payoutsView()
    {
        $payoutRequests = \App\Models\PayoutRequest::with('store')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pages.payouts', compact('payoutRequests'));
    }

    public function processPayoutAction(Request $request, \App\Models\PayoutRequest $payout)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'admin_notes' => 'nullable|string',
        ]);

        if ($request->action === 'approve') {
            $payout->update([
                'status' => 'approved',
                'admin_notes' => $request->admin_notes,
            ]);
            Session::flash('success', [__('messages.payout_approved')]);
        } else {
            $payout->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes,
            ]);
            Session::flash('error', [__('messages.payout_rejected')]);
        }

        return back();
    }

}
