<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recruitment;
use App\Models\User;

class RatingController extends Controller
{
    public function store(Request $request)
{
    // \Log::info('🔻評価リクエスト受信', $request->all());

    // $request->validate([
    //     'recruitment_id' => 'required|exists:recruitments,id',
    //     'rating' => 'required|integer|min:1|max:5',
    // ]);

    // $recruitment = Recruitment::find($request->recruitment_id);
    // \Log::info('📦 募集データ', ['recruitment' => $recruitment]);

    // if (!$recruitment) {
    //     \Log::error('❌ 募集が見つかりません');
    //     return response()->json(['success' => false, 'message' => '募集が見つかりません'], 404);
    // }

    // $targetUser = $recruitment->user;

    // if (!$targetUser) {
    //     \Log::error('❌ 投稿者が見つかりません');
    //     return response()->json(['success' => false, 'message' => '投稿者が見つかりません'], 404);
    // }

    // // ★ ログイン中ユーザーと評価されるユーザー確認
    // \Log::info('👤 評価するユーザー: ' . Auth::id());
    // \Log::info('👤 評価されるユーザー: ' . $targetUser->id);

    // // 平均値の計算
    // $currentTotal = $targetUser->rating * $targetUser->rate_count;
    // $newCount = $targetUser->rate_count + 1;
    // $newAverage = ($currentTotal + $request->rating) / $newCount;

    // $targetUser->rating = $newAverage;
    // $targetUser->rate_count = $newCount;
    // $targetUser->save();

    // return response()->json(['success' => true]);
}

}