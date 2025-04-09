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

        // 種目（複数選択）
        if ($request->filled('sport_type')) {
            $query->whereIn('sport_type', $request->input('sport_type'));
        }

        // 都道府県
        if ($request->filled('prefecture')) {
            $query->where('prefecture', $request->prefecture);
        }

        // 市区町村
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // 開催日（指定日以降）
        if ($request->filled('date')) {
            $query->whereDate('scheduled_at', '>=', $request->date);
        }

        $results = $query->latest()->get();

        return view('search.result', compact('results'));
    }

}
