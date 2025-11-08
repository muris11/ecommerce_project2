<?php

namespace App\Http\Controllers\Api\Concerns;

use App\Models\Address;

trait TransformsAddresses
{
    protected function transformAddress(Address $address): array
    {
        return [
            'id' => $address->id,
            'first_name' => $address->first_name,
            'last_name' => $address->last_name,
            'full_name' => $address->full_name,
            'phone' => $address->phone,
            'street_address' => $address->street_address,
            'city' => $address->city,
            'state' => $address->state,
            'zip_code' => $address->zip_code,
            'order_id' => $address->order_id,
            'created_at' => optional($address->created_at)->toIso8601String(),
            'updated_at' => optional($address->updated_at)->toIso8601String(),
        ];
    }
}