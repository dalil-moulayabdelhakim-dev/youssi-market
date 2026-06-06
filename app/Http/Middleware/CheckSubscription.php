<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $store = $user->store;
        // Update expired status if needed
        if ($user->subscription_status != 'expired') {

            if (
                $store->trial_ends_at && now()->greaterThan($store->trial_ends_at) &&
                (!$store->subscription_ends_at || now()->greaterThan($store->subscription_ends_at))
            ) {
                $store->subscription_status = 'expired';
                $store->save();
            }
        }

        if ($store->subscription_status === 'expired') {
            return redirect()->route('subscribe-view')->with('error', [__('messages.your_subscription_has_expired')]);
        }

        return $next($request);
    }
}
