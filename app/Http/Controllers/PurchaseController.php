<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        if ($item->purchase) {
            return redirect()
                ->route('item.index')
                ->with('error', 'この商品は購入済みです');
        }

        return view('purchase.show', compact('item'));
    }

    public function store(PurchaseRequest $request, Item $item)
    {
        $purchaseAddress = session('purchase_address.'.$item->id);

        $postalcode = $purchaseAddress['postal_code'] ?? Auth::user()->postal_code;
        $address = $purchaseAddress['address'] ?? Auth::user()->address;
        $building = $purchaseAddress['building'] ?? Auth::user()->building;

        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'payment_method' => $request->payment_method,
            'postal_code' => $postalcode,
            'address' => $address,
            'building' => $building,
        ]);

        session()->forget('purchase_address.'.$item->id);

        return redirect()->route('item.index');
    }
}
