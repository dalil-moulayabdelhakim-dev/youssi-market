<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeInformation;
use App\Models\PaymentRequest;
use App\Models\SubscriptionMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    public function subscribeView()
    {
        $user = Auth::user();
        if ($user) {
            $subscreptions = SubscriptionMethod::all();
            $monthly = $subscreptions->where('name', 'monthly')->first() ?? $subscreptions->get(0);
            $yearly = $subscreptions->where('name', 'yearly')->first() ?? $subscreptions->get(1);
            return view('subscribe', compact('monthly', 'yearly'));
        }

        Session::flash('success', [__('messages.auth_required')]);
        return back();
    }

    public function subscribeFormView($id)
    {
        $user = Auth::user();
        if ($user) {
            $subscription_method = SubscriptionMethod::findOrFail($id);
            return view('submit-proof', compact('subscription_method'));
        }
        Session::flash('success', ['You must be authenticated, please login']);
        return back();
    }

    public function submitPaymentProof(Request $request)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
            'subscription_method' => 'required|exists:subscription_methods,id'
        ]);


        $user = Auth::user();
        $store_id = $user->store_id;
        $payment = PaymentRequest::where('store_id', $store_id)->first();
        if($payment){
            Session::flash('error', [ __('messages.you_already_have_arequest')]);
            return back();
        }
        $flie = null;
        if ($request->hasFile('payment_proof')) {
            $postName = time() . "." . $request->file('payment_proof')->getClientOriginalExtension();
            $destination_path = 'payment_proofs/' . $user->id . '/' . $store_id;
            $path = $request->file('payment_proof')->storeAs($destination_path, $postName, 'public');
            $file = 'storage/' . $path;
        } else {
            Session::flash('error', [__('messages.product_banner_exists')]);
            return redirect()->back();
        }
        PaymentRequest::create([
            'store_id' => $store_id,
            'proof_path' => $file,
            'subscription_method_id' => $request->subscription_method,
        ]);

        Session::flash('success', [__('messages.payment_proof_sent')]);

        return redirect()->back();
    }
}
