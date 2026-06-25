<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Item;

class PurchaseAddressController extends Controller
{
    public function edit(Item $item)
    {
        return view('purchase.address', compact('item'));
    }

    public function update(AddressRequest $request, Item $item)
    {
        session([
            'purchase_address.'.$item->id => [
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
            ],
        ]);

        return redirect()->route('purchase.show', $item);
    }
}
