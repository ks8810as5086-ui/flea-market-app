<?php

namespace Tests\Feature\Item;

use App\Models\Favorite;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MyListTest extends TestCase
{
    use RefreshDatabase;

    public function test_いいねした商品だけが表示される(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $favoriteItem = Item::factory()->create([
            'name' => 'いいねした商品',
        ]);

        $notFavoriteItem = Item::factory()->create([
            'name' => 'いいねしていない商品',
        ]);

        Favorite::factory()->create([
            'user_id' => $user->id,
            'item_id' => $favoriteItem->id,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertSee('いいねした商品');
        $response->assertDontSee('いいねしていない商品');
    }

    public function test_購入済み商品は_sol_dと表示される(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = Item::factory()->create([
            'name' => 'いいねした商品',
        ]);

        Favorite::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertSee('SOLD');
    }

    public function test_未認証の場合は何も表示されない(): void
    {
        Item::factory()->create([
            'name' => '商品A',
        ]);

        Item::factory()->create([
            'name' => '商品B',
        ]);

        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);

        $response->assertDontSee('商品A');
        $response->assertDontSee('商品B');
    }
}
