<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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
        Stripe::setApiKey(config('services.stripe.secret'));

        session([
            'payment_method' => $request->payment_method,
        ]);

        $checkoutSession = Session::create([
            'mode' => 'payment',

            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],

            'success_url' => route('purchase.success', $item),
            'cancel_url' => route('purchase.show', $item),
        ]);

        return redirect($checkoutSession->url);
    }

    public function success(Item $item)
    {
        $purchaseAddress = session('purchase_address.'.$item->id);
        $postalCode = $purchaseAddress['postal_code'] ?? Auth::user()->postal_code;
        $address = $purchaseAddress['address'] ?? Auth::user()->address;
        $building = $purchaseAddress['building'] ?? Auth::user()->building;

        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'payment_method' => session('payment_method'),
            'postal_code' => $postalCode,
            'address' => $address,
            'building' => $building,
        ]);

        session()->forget('purchase_address.'.$item->id);
        session()->forget('payment_method');

        return redirect()->route('item.index');
    }
}
