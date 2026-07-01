<?php

namespace Tests\Feature\Item;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_ログイン済みユーザーはコメントを送信できる(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/comment", [
                'comment' => 'テストコメント',
            ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント',
        ]);

        $response->assertRedirect("/item/{$item->id}");
    }

    public function test_ログイン前のユーザーはコメントを送信できない(): void
    {
        $item = Item::factory()->create();

        $response = $this->post("/item/{$item->id}/comment", [
            'comment' => 'テストコメント',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseCount('comments', 0);
    }

    public function test_コメントが入力されていない場合バリデーションメッセージが表示される(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/comment", [
                'comment' => '',
            ]);

        $response->assertSessionHasErrors([
            'comment' => '商品コメントを入力してください',
        ]);
    }

    public function test_コメントが255文字以上の場合バリデーションメッセージが表示される(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->post("/item/{$item->id}/comment", [
                'comment' => str_repeat('あ', 256),
            ]);

        $response->assertSessionHasErrors([
            'comment' => '商品コメントは255文字以内で入力してください',
        ]);
    }
}
