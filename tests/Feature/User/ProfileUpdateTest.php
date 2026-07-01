<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_プロフィール編集画面に登録済みの情報が初期値として表示される(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'profile_image' => 'profile.jpg',
            'name' => 'テストユーザー',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区',
            'building' => 'テストビル101',
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage/profile');

        $response->assertStatus(200);
        $response->assertSee('profile.jpg');
        $response->assertSee('テストユーザー');
        $response->assertSee('123-4567');
        $response->assertSee('東京都渋谷区');
        $response->assertSee('テストビル101');
    }
}
