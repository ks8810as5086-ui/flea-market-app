<?php

namespace Tests\Feature\Item;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品詳細ページに必要な情報が表示される(): void
    {
        $user = User::factory()->create([
            'name' => 'コメントユーザー',
        ]);

        $item = Item::factory()->create([
            'name' => 'Laravel入門',
            'brand_name' => 'TECH',
            'description' => 'Laravelの学習本です',
            'price' => 3000,
            'condition' => 1,
        ]);

        $category = Category::factory()->create([
            'name' => '本',
        ]);

        $item->categories()->attach($category->id);

        Favorite::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        Comment::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'とても良い商品です',
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertStatus(200);
        $response->assertSee('Laravel入門');
        $response->assertSee('TECH');
        $response->assertSee('3,000');
        $response->assertSee('Laravelの学習本です');
        $response->assertSee('良好');
        $response->assertSee('本');
        $response->assertSee('コメントユーザー');
        $response->assertSee('とても良い商品です');
    }

    public function test_複数選択されたカテゴリが表示される(): void
    {
        $item = Item::factory()->create([
            'name' => 'カテゴリ確認商品',
        ]);

        $category1 = Category::factory()->create([
            'name' => '本',
        ]);

        $category2 = Category::factory()->create([
            'name' => 'ゲーム',
        ]);

        $item->categories()->attach([
            $category1->id,
            $category2->id,
        ]);

        $response = $this->get("/item/{$item->id}");

        $response->assertStatus(200);
        $response->assertSee('本');
        $response->assertSee('ゲーム');
    }
}
