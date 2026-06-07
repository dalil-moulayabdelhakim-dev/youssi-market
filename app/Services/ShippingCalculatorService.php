<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class ShippingCalculatorService
{
    /**
     * Calculates the exact shipping cost for a product to a specific Wilaya.
     *
     * @param Product $product The product being purchased.
     * @param int $wilayaId The destination Wilaya ID.
     * @param string $deliveryType 'home' or 'office'.
     * @return float The calculated shipping fee.
     * @throws \Exception If the store doesn't deliver to the requested Wilaya.
     */
    public function calculateShippingCost(Product $product, int $wilayaId, string $deliveryType = 'home'): float
    {
        // Fetch the shipping configuration from the store_wilayas pivot table
        $shippingConfig = DB::table('store_wilayas')
            ->where('store_id', $product->store_id)
            ->where('wilaya_id', $wilayaId)
            ->first();

        if (!$shippingConfig) {
            // Default to a high value or throw error if Wilaya is not supported by the seller
            throw new \Exception(__('messages.delivery_unavailable_for_wilaya'));
        }

        // Determine base and extra prices based on delivery type
        $basePrice = ($deliveryType === 'home') 
            ? ($shippingConfig->price_to_home ?? 0) 
            : ($shippingConfig->price_to_office ?? 0);
            
        $extraPricePerKg = ($deliveryType === 'home') 
            ? ($shippingConfig->extra_price_per_kg_home ?? 0) 
            : ($shippingConfig->extra_price_per_kg_office ?? 0);

        $baseWeight = $shippingConfig->base_weight ?? 5.00;

        // Calculate chargeable extra weight
        $chargeableExtraWeight = 0;
        if ($product->weight > $baseWeight) {
            // We use ceil to round up (e.g., 5.1kg becomes 6kg for the extra 1kg charge)
            $chargeableExtraWeight = ceil($product->weight - $baseWeight);
        }

        return (float) ($basePrice + ($chargeableExtraWeight * $extraPricePerKg));
    }
}
