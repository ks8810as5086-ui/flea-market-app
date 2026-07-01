<?php

namespace Tests\Feature\Sell;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SellItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品出品画面で入力した商品情報が保存される(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $category = Category::factory()->create([
            'name' => '本',
        ]);

        $response = $this->actingAs($user)->post('/sell', [
            'image_path' => UploadedFile::fake()->image('item.jpg'),
            'categories' => [$category->id],
            'condition' => 1,
            'name' => 'Laravel入門',
            'brand_name' => 'TECH',
            'description' => 'Laravelの学習本です',
            'price' => 3000,
        ]);
        $this->assertDatabaseHas('items', [
            'user_id' => $user->id,
            'name' => 'Laravel入門',
            'brand_name' => 'TECH',
            'description' => 'Laravelの学習本です',
            'condition' => 1,
            'price' => 3000,
        ]);

        $item = Item::where('name', 'Laravel入門')->first();

        $this->assertDatabaseHas('item_category', [
            'item_id' => $item->id,
            'category_id' => $category->id,
        ]);

        Storage::disk('public')->assertExists($item->image_path);

        $response->assertRedirect('/');
    }
}
