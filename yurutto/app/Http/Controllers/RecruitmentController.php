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

        //dd($request);
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

        return redirect('/index')->with('success', '募集を投稿しました');
    }

    public function index()
    {
        $latest = Recruitment::latest()->take(10)->get(); // 最新5件

        $recommended = collect();

        if (Auth::check()) {
            $user = Auth::user();

        
            $recommended = Recruitment::where('sport_type', $user->favorite_sport)
                ->where('prefecture', $user->residence)
                ->latest()
                ->get();
        }

        return view('result', [
            'latest' => $latest,
            'recommended' => $recommended,
        ]);
    }



    public function show($id)
    {
        $recruitment = Recruitment::with('user')->findOrFail($id);

        return view('detail', compact('recruitment'));
    }




}
