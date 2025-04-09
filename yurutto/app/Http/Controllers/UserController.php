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
        
        $request->validate([
            'userid' => 'required|string|max:255|unique:users,userid',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'userid' => $request['userid'],
            'name' => $request['name'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('/login');
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
            return redirect('/messages'); // チャット一覧にリダイレクト
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

}
