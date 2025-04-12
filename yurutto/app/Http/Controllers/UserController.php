<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    public function register(Request $request)
    {
    
        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('userProfileImages', 'public');
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

}
