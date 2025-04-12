<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Participation;

class ParticipationController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            $participation = Participation::create([
                'recruitment_id' => $request->recruitment_id,
                'user_id' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => '参加が完了しました',
                'data' => $participation,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
