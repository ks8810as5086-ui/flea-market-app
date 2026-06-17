<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();
            //item_id と category_id の組み合わせを重複禁止
            $table->unique(['item_id', 'category_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_category');
    }
};
