<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // نفترض عندك العمود user_type_id: 1=admin, 2=seller, 3=customer
        $roles = [
            'admin' => 1,
            'seller' => 2,
            'customer' => 3,
        ];

        if (isset($roles[$role]) && $user->user_type_id == $roles[$role]) {
            return $next($request);
        }

       abort(403, __('messages.unauthorized'));
    }
}
