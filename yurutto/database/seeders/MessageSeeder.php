<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('messages')->insert([
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'message' => 'こんにちは、参加させてください！',
                'is_read' => 0,
                'created_at' => Carbon::now()->subMonth(),
                'updated_at' => Carbon::now()->subMonth(),
            ],
            [
                'sender_id' => 2,
                'receiver_id' => 1,
                'message' => 'こちらこそよろしくお願いします！',
                'is_read' => 0,
                'created_at' => Carbon::now()->subMonth(),
                'updated_at' => Carbon::now()->subMonth(),
            ],
            // 必要に応じて追加
        ]);
    }
}
