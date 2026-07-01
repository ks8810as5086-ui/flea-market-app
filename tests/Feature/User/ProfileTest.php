<?php

namespace Tests\Feature\User;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_プロフィールにユーザー名_出品商品一覧が表示される(): void
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'profile_image' => 'profile.jpg',
            'email_verified_at' => now(),
        ]);

        Item::factory()->create([
            'user_id' => $user->id,
            'name' => '出品商品1',
        ]);

        Item::factory()->create([
            'user_id' => $user->id,
            'name' => '出品商品2',
        ]);

        $response = $this->actingAs($user)->get('/mypage');

        $response->assertStatus(200);
        $response->assertSee('テストユーザー');
        $response->assertSee('出品商品1');
        $response->assertSee('出品商品2');
        $response->assertSee('profile.jpg');
    }

    public function test_プロフィールに購入商品一覧が表示される(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = Item::factory()->create([
            'name' => '購入商品1',
        ]);

        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->get('/mypage?page=buy');

        $response->assertStatus(200);
        $response->assertSee('購入商品1');
    }
}
