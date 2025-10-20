<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\ShippingAddress;
use App\Models\Zone;

class OrderController extends Controller
{
    public function calculateShipping($shippingAddressId)
    {
        $address = ShippingAddress::with(['zone.city'])->find($shippingAddressId);
        
        $shippingPrice = $address->shipping_price;
        $cityName = $address->city_name;
        $zoneName = $address->zone_name;
        
        return [
            'price' => $shippingPrice,
            'city' => $cityName,
            'zone' => $zoneName
        ];
    }

    public function createShippingAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'zone_id' => 'required|exists:zones,id',
        ]);

        $address = ShippingAddress::create([
            'user_id' => auth()->id(),
            'address' => $request->address,
            'zone_id' => $request->zone_id,
        ]);

        // Obtener información completa
        $shippingCost = $address->shipping_price;
        $fullLocation = $address->full_location;
        
        return response()->json([
            'address' => $address,
            'shipping_cost' => $shippingCost,
            'location' => $fullLocation
        ]);
    }
}
