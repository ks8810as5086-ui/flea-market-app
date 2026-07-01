<?php

namespace Tests\Feature\Purchase;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    use RefreshDatabase;

    public function test_支払い方法選択欄が表示される(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->get("/purchase/{$item->id}");

        $response->assertStatus(200);
        $response->assertSee('支払い方法');
        $response->assertSee('選択してください');
        $response->assertSee('コンビニ払い');
        $response->assertSee('カード払い');
    }
}
