<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $page = request('page');

        if ($page === 'buy') {
            // 購入した商品
            $items = $user->purchases()->with('item')->get()->pluck('item');
        } else {
            // 出品した商品
            $items = $user->items()->get();
        }

        return view('mypage.index', compact('user', 'items', 'page'));
    }
}
