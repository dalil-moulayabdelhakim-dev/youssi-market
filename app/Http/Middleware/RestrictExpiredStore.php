<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictExpiredStore
{
    /**
     * Handle an incoming request.
     *
     * Prevents expired stores from adding/editing products, while allowing 
     * access to order fulfillment and payouts.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        // If not a seller or doesn't have a store, proceed (let other middlewares handle it)
        if (!$user || $user->user_type_id != 2 || !$user->store) {
            return $next($request);
        }

        $store = $user->store;

        // If the store is expired/invalid, block restricted actions
        if (!$store->hasActiveSubscription()) {
            // Define restricted routes/prefixes
            $restrictedPatterns = [
                'p/add*',
                'p/update*',
                'api/product/edit*',
            ];

            foreach ($restrictedPatterns as $pattern) {
                if ($request->is($pattern)) {
                    if ($request->expectsJson()) {
                        return response()->json(['error' => __('messages.subscription_required_for_action')], 403);
                    }
                    return redirect()->route('dashboard')
                        ->with('error', [__('messages.subscription_required_for_action')]);
                }
            }
        }

        return $next($request);
    }
}
