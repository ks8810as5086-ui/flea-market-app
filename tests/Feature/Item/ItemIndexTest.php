<?php

namespace Tests\Feature\Item;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_全商品を取得できる(): void
    {
        $items = Item::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        foreach ($items as $item) {
            $response->assertSee($item->name);
        }
    }

    public function test_購入済み商品は_sol_dと表示される(): void
    {
        $buyer = User::factory()->create();
        $item = Item::factory()->create();

        Purchase::factory()->create([
            'user_id' => $buyer->id,
            'item_id' => $item->id,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee($item->name);
        $response->assertSee('SOLD');
    }

    public function test_自分が出品した商品は表示されない(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $ownItem = Item::factory()->create([
            'user_id' => $user->id,
            'name' => '自分の商品',
        ]);

        $otherItem = Item::factory()->create([
            'name' => '他人の商品',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertDontSee($ownItem->name);
        $response->assertSee($otherItem->name);
    }
}
