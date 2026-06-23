<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Item $item)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('item_id', $item->id)
            ->first();

        if($favorite){
            $favorite->delete();
        }else{
            Favorite::create([
                'user_id' => Auth::id(),
                'item_id' => $item->id,
            ]);
        }
        return redirect()->route('item.show', $item);
    }
}
