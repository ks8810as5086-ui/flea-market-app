<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            '腕時計' => ['ファッション', 'メンズ'],
            'HDD' => ['家電'],
            '玉ねぎ3束' => ['キッチン'],
            '革靴' => ['ファッション', 'メンズ'],
            'ノートPC' => ['家電'],
            'マイク' => ['家電'],
            'ショルダーバッグ' => ['ファッション', 'レディース'],
            'タンブラー' => ['キッチン'],
            'コーヒーミル' => ['キッチン'],
            'メイクセット' => ['ファッション', 'コスメ', 'レディース'],
        ];
        foreach ($items as $itemName => $categoryNames) {
            $item = Item::where('name', $itemName)->firstOrFail();
            $categoryIds = Category::whereIn('name', $categoryNames)->pluck('id');
            $item->categories()->attach($categoryIds);
        }
    }
}
