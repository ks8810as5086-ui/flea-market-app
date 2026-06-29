<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
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

    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('mypage.profile', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $profileImagePath = $user->profile_image;

        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user->update([
            'profile_image' => $profileImagePath,
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('item.index');
    }
}
