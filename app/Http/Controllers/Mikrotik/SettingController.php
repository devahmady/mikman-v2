<?php

namespace App\Http\Controllers\Mikrotik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show()
    {
        return view('admin/setting/ping');
    }
    public function ping(Request $request)
    {
        $request->validate([
            'dns' => 'required|string',
        ]);

        $dns = $request->input('dns');

        // Jalankan perintah nslookup untuk mendapatkan informasi DNS
        $nslookup_result = shell_exec("nslookup $dns");

        // Jalankan perintah ping untuk mendapatkan hasil ping
        $ping_result = shell_exec("ping -c 4 $dns");

        return view('admin/setting/ping')->with([
            'ping_result' => $ping_result,
            'nslookup_result' => $nslookup_result,
        ]);
    }
    public function isolir()
    {
        return view('admin/setting/isolir');
    }
}
