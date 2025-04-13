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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userid')->unique();       // ログイン用ID
            $table->string('name');                   // 表示名
            $table->string('password');               // ハッシュ化パスワード
            $table->string('profile_image')->nullable(); // プロフィール画像（ファイル名など）
            $table->string('residence')->nullable(); // 住んでる地域（例：東京都新宿区など）
            $table->string('favorite_sport')->nullable(); // 好きなスポーツ
            $table->string('mood')->nullable();          // 温度感（ゆるく、ガチなど）
            $table->string('introduction')->nullable();  // 自己紹介
            $table->float('rating')->default(0);       // 評価の平均値
            $table->unsignedInteger('rate_count')->default(0); // 評価された回数
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
