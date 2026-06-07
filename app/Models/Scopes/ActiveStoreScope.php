<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Ensures only products from stores with active or trial subscriptions are publicly visible.
 */
class ActiveStoreScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereHas('store', function (Builder $query) {
            $query->where(function ($q) {
                $q->where('subscription_status', 'active')
                  ->where('subscription_ends_at', '>', now());
            })->orWhere(function ($q) {
                $q->where('subscription_status', 'trial')
                  ->where('trial_ends_at', '>', now());
            });
        });
    }
}
