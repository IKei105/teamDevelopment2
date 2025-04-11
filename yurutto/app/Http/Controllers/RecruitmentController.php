<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use Illuminate\Support\Facades\Auth;

class RecruitmentController extends Controller
{
    public function create()
    {
        return view('recruitments.create');
    }

    public function store(Request $request)
{
    // バリデーション
    $request->validate([
        'title' => 'required|string|max:255', // ← タイトルを追加
        'sport_type' => 'required|string|max:255',
        'prefecture' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'place_name' => 'required|string|max:255',
        'scheduled_at' => 'required|date',
        'recruit_number' => 'required|integer|min:1',
        'mood' => 'required|string|max:255',
        'comment' => 'nullable|string|max:1000',
    ]);

    // 保存処理
    Recruitment::create([
        'user_id' => Auth::id(),
        'title' => $request->title, // ← タイトルを追加
        'sport_type' => $request->sport_type,
        'prefecture' => $request->prefecture,
        'city' => $request->city,
        'place_name' => $request->place_name,
        'scheduled_at' => $request->scheduled_at,
        'recruit_number' => $request->recruit_number,
        'mood' => $request->mood,
        'comment' => $request->comment,
    ]);

    return redirect('/')->with('success', '募集を投稿しました');
}

}
