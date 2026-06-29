<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');
        $tab = request('tab');

        if ($tab === 'mylist') {
            if (Auth::check()) {
                /** @var User $user */
                $user = Auth::user();

                $query = $user->favorites()
                    ->with('item.purchase')
                    ->get()
                    ->pluck('item');
                if (! empty($keyword)) {
                    $items = $query->filter(function ($item) use ($keyword) {
                        return str_contains($item->name, $keyword);
                    });
                } else {
                    $items = $query;
                }
            } else {
                $items = collect();
            }
        } else {
            $query = Item::with('purchase');

            if (Auth::check()) {
                $query->where('user_id', '!=', Auth::id());
            }

            if (! empty($keyword)) {
                $query->where('name', 'like', '%'.$keyword.'%');
            }

            $items = $query->get();
        }

        return view('item.index', compact('items', 'keyword', 'tab'));
    }

    public function show(Item $item)
    {
        $item->load(['categories', 'comments.user'])
            ->loadCount(['favorites', 'comments']);

        return view('item.show', compact('item'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('item.sell', compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $imagePath = $request->file('image_path')
            ->store('items', 'public');

        $item = Item::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'image_path' => $imagePath,
            'brand_name' => $request->brand_name,
            'description' => $request->description,
            'condition' => $request->condition,
            'price' => $request->price,
        ]);

        $item->categories()->attach($request->categories);

        return redirect()->route('item.index');
    }
}
