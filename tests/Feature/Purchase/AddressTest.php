<?php

namespace Tests\Feature\Purchase;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_送付先住所変更画面で登録した住所が購入画面に反映される(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)->patch("/purchase/address/{$item->id}", [
            'postal_code' => '000-0000',
            'address' => '東京都渋谷区',
            'building' => 'テストビル101',
        ]);

        $response = $this->actingAs($user)->get("/purchase/{$item->id}");

        $response->assertStatus(200);
        $response->assertSee('000-0000');
        $response->assertSee('東京都渋谷区');
        $response->assertSee('テストビル101');

    }

    public function test_購入した商品に送付先住所が紐づいて登録される(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = Item::factory()->create();

        $this->actingAs($user)->patch("/purchase/address/{$item->id}", [
            'postal_code' => '000-0000',
            'address' => '東京都渋谷区',
            'building' => 'テストビル101',
        ]);

        $this->actingAs($user)->withSession([
            'payment_method' => 2,
        ])
            ->get("/purchase/{$item->id}/success");

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'payment_method' => 2,
            'postal_code' => '000-0000',
            'address' => '東京都渋谷区',
            'building' => 'テストビル101',
        ]);
    }
}
