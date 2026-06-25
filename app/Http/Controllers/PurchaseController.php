<?php

namespace App\Http\Controllers;

use App\Models\Item;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        return view('purchase.show', compact('item'));
    }
}
