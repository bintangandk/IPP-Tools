<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'password' => 'required|string',
        ]);
        Log::info('Login attempt:', [
            'user_id' => $request->user_id,
        ]);
        $user = User::where('user_id', $request->user_id)->first();
        if ($user) {
            Log::info('User found:', ['user_id' => $user->user_id]);
        } else {
            Log::warning('User not found:', ['user_id' => $request->user_id]);
        }
        if ($user && password_verify($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->put('user_id', $user->user_id);
            $request->session()->put('full_name', $user->full_name);
            Alert::success('Berhasil', 'Login Berhasil!');
            return redirect('/dashboard');
        } else {
            Alert::error('Gagal', 'User ID atau Password Salah!');
            Log::error('Login failed for user_id:', ['user_id' => $request->user_id]);
            return back()->withInput();
        }
    }

    public function logout(Request $request) {
        Auth::logout();

        Alert::success('Berhasil', 'Anda telah berhasil logout.');
        return redirect()->route('login.get');
    }

}
