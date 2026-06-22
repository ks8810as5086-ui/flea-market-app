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
    public function show(Item $item)
    {
        $item->load(['categories','comments.user'])
            ->loadCount(['favorites','comments']);

        return view('item.show',compact('item'));
    }
}
