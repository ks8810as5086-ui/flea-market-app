<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('item.index', compact('items'));
    }
    public function show()
    {
        return view('item.show');
    }
}
