<?php

namespace App\Http\Controllers\Mikrotik;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Routers\Dashboard;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        $data =  Dashboard::dashboard();
        if(isset($data['status']) && $data['status'] === 'error') {
            return response()->json($data, 201);
        } else {
            return view('admin.home', $data);
        }
    }

   

    public function reset()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug('false');
        if ($API->connect($ip, $user, $pass)) {
            $resetCommand = '/system/reset-configuration';
            $resetResult = $API->comm($resetCommand);
            if ($resetResult) {
                return redirect()->back()->with('success', 'Reboot command sent successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to send reboot command. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Failed to connect to MikroTik device. Please check your credentials and try again.');
        }
    }

    public function reboot()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug('false');
        if ($API->connect($ip, $user, $pass)) {
            $rebootCommand = '/system/reboot';
            $resetResult = $API->comm($rebootCommand);
            if ($resetResult) {
                return redirect()->back()->with('success', 'Reboot command sent successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to send reboot command. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Failed to connect to MikroTik device. Please check your credentials and try again.');
        }
    }
}
