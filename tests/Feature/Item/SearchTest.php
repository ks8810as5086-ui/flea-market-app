<?php

namespace Tests\Feature\Item;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品名で部分一致検索ができる(): void
    {
        Item::factory()->create(['name' => 'Laravel入門']);
        Item::factory()->create(['name' => 'PHP入門']);
        Item::factory()->create(['name' => 'Java入門']);

        $response = $this->get('/?keyword=laravel');

        $response->assertStatus(200);
        $response->assertSee('Laravel入門');
        $response->assertDontSee('PHP入門');
        $response->assertDontSee('Java入門');
    }

    public function test_検索状態がマイリストでも保持されている(): void
    {
        $response = $this->get('/?keyword=Laravel');

        $response->assertStatus(200);

        $response->assertSee('value="Laravel"', false);

        $response->assertSee('tab=mylist', false);
        $response->assertSee('keyword=Laravel', false);
    }
}
