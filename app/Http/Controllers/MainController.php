<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeInformation;
use App\Models\Category;
use App\Models\Commune;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::join('stores', 'products.store_id', '=', 'stores.id')
            ->where('stores.subscription_status', '!=', 'expired')
            ->select('products.*')
            ->paginate(16);

        return view('index', compact('products'));
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $images = ProductImages::where('product_id', $id)->get();
        $user = Auth::user();
        $is_owner = false;

        if ($user) {
            if ($user->store_id && $user->store_id == $product->store_id) {
                $is_owner = true;
            }
        }

        // Fetch dynamic related products from the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('product_details', compact('product', 'images', 'is_owner', 'relatedProducts'));
    }

    public function getCommunes($wilaya_id)
    {
        $communes = Wilaya::findOrFail($wilaya_id)->communes;

        return response()->json($communes);
    }

    public function profile()
    {
        $user = Auth::user();
        $store = null;

        if ($user->user_type_id == 2 && $user->store) {
            $store = $user->store;
        }

        $wilayas = Wilaya::all();

        return view('profile', compact('user', 'store', 'wilayas'));
    }

    public function updatePersonal(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', [__('messages.you_must_login')]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'wilaya_id' => 'nullable|exists:wilayas,id',
            'commune_id' => 'nullable|exists:communes,id',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($request->only('name', 'email', 'wilaya_id', 'commune_id', 'address'));

        return back()->with('success', [__('messages.personal_info_updated')]);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', [__('messages.you_must_login')]);
        }

        $request->validate([
            'current_password' => 'required',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // ✅ تحقق من كلمة المرور الحالية
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => __('messages.current_password_invalid'),
            ]);
        }

        // ✅ إذا فيه كلمة مرور جديدة → حدثها
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return back()->with('success', __('messages.password_updated'));
    }

    public function updateStore(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', [__('messages.you_must_login')]);
        }

        if (!$user->store) {
            return back()->with('error', __('messages.no_store'));
        }

        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_contact' => 'nullable|string|max:255',
            'store_category' => 'nullable|string|max:255',
            'store_address' => 'nullable|string|max:255',
        ]);

        $user->store->update([
            'name' => $request->store_name,
            'contact' => $request->store_contact,
            'category' => $request->store_category,
            'address' => $request->store_address,
        ]);

        return back()->with('success', __('messages.store_updated'));
    }

    public function viewContact()
    {
        $user = Auth::user();
        if ($user) {
            $tickets = Ticket::with(['messages.user'])
                ->where('user_id', $user->id)
                ->withCount('messages')
                ->orderByDesc(
                    TicketMessage::select('created_at')
                        ->whereColumn('ticket_id', 'tickets.id')
                        ->latest()
                        ->take(1)
                )
                ->get();
            return view('contact', compact('tickets'));
        }

        return back()->with('error', [__('messages.you_must_login')]);
    }

}
