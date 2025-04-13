<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;


class UserController extends Controller
{
    public function register(Request $request)
    {
    
        $imagePath = null;

        if ($request->hasFile('profile_image')) {
            // 指定したパスに保存（storageではなくassetsに保存するならpublic配下に直で置く必要があります）
            $filename = uniqid() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $request->file('profile_image')->move(public_path('assets/images/users'), $filename);
            $imagePath = 'assets/images/users/' . $filename;
        } else {
            // デフォルト画像
            $imagePath = 'assets/images/logos2/sample.png';
        }
    
        User::create([
            'userid' => $request->userid,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'residence' => $request->residence,
            'favorite_sport' => $request->favorite_sport,
            'mood' => $request->mood,
            'introduction' => $request->introduction,
            'rating' => 0, // 初期値
            'profile_image' => $imagePath,
            
        ]);
    
        return redirect('/index');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'userid' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('userid', $request->userid)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect('/index'); // チャット一覧にリダイレクト
        }

        return back()->withErrors([
            'login' => 'ユーザーIDまたはパスワードが間違っています。',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function profile()
    {
        $user = auth()->user(); // ログイン中のユーザー情報を取得
        return view('profile', compact('user'));
    }

    public function showProfile()
    {
        $user = Auth::user();
        $today = Carbon::today();

        $participated = $user->participatedRecruitments()->get();

        $past = $participated->filter(function ($item) use ($today) {
            return Carbon::parse($item->scheduled_at)->lt($today);
        });

        $ongoing = $participated->filter(function ($item) use ($today) {
            return Carbon::parse($item->scheduled_at)->gte($today);
        });

        return view('profile', compact('user', 'past', 'ongoing'));
    }


}
