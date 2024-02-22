<?php

namespace App\Http\Controllers\Mikrotik;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'ip' => 'required',
            'user' => 'required'
        ]);
 
        $ip = $request->post('ip');
        $user = $request->post('user');
        $password = $request->post('password');
 
        $data = [
            'ip' => $ip,
            'user' => $user,
            'password' => $password,
        ];
 
        $request->session()->put($data);
 
        return redirect('dashboard');
    }


    public function logout()
    {
        session()->flush();
        return redirect('/')->with('logout', true);
    }
}
error_reporting(0);
