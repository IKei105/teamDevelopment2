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
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');     // 募集した人のID（外部キー制約なし）
            $table->string('title')->nullable(); // ← これを追加
            $table->string('sport_type');              // スポーツ種別
            $table->string('prefecture');              // 都道府県
            $table->string('city');                    // 市区町村
            $table->string('place_name');              // 具体的な場所の名前（例: ○○公園）
            $table->dateTime('scheduled_at');          // 日時
            $table->unsignedInteger('recruit_number'); // 募集人数
            $table->string('mood');                    // 温度感（例: ガチ, ゆるく, 初心者歓迎）
            $table->text('comment')->nullable(); // ← 一言コメント
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruitments');
    }
};
