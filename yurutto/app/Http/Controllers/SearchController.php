<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recruitment;

class SearchController extends Controller
{
    public function index()
    {
        // 検索フォームを表示
        return view('search.index');
    }

    public function search(Request $request)
    {
        $query = Recruitment::query();

        // 種目（複数選択）※ カンマ区切りを配列化
        if ($request->filled('sport_types')) {
            $sports = explode(',', $request->sport_types);
            $query->whereIn('sport_type', $sports);
        }

        // 都道府県
        if ($request->filled('prefecture')) {
            $query->where('prefecture', $request->prefecture);
        }

        // 市区町村
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // 温度感
        if ($request->filled('mood')) {
            $query->where('mood', $request->mood);
        }

        // 募集人数（最小値〜最大値の範囲内に入っている募集）
        if ($request->filled('min_people') && $request->filled('max_people')) {
            $query->whereBetween('recruit_number', [$request->min_people, $request->max_people]);
        }

        // 開催日（指定した期間内）
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('scheduled_at', [$request->start_date, $request->end_date]);
        }

        $results = $query->latest()->get();

        return view('search.result', compact('results'));
    }


}
