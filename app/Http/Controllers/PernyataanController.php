<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PernyataanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isActive');
        $this->middleware('preventBackHistory');
    }
    public function index()
    {
        //
    }

    public function satu()
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        if ($user->status_laporan < 1) {
            return redirect()->route('dashboard');
        }
        return view('pernyataan.satu');
    }
    public function dua()
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        if ($user->status_laporan < 2) {
            return redirect()->route('dashboard');
        }
        if ($user->status_1 == 0) {
            return redirect()->route('dashboard');
        }
        return view('pernyataan.dua');
    }
    public function tiga()
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        if ($user->status_laporan < 3) {
            return redirect()->route('dashboard');
        }
        if ($user->status_1 == 0) {
            return redirect()->route('dashboard');
        }
        return view('pernyataan.tiga');
    }
    //satu
    public function satu_ya(Request $request)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        
        $input = $request->all();
        $input['status_1'] = '1';
        $input['status_2'] = '0';
        $input['status_3'] = '0';
        $input['status_laporan'] = '2';
        $user->update($input);
        return redirect()->route('dashboard');
    }
    public function satu_tidak(Request $request)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);

        $input = $request->all();
        $input['status_1'] = '0';
        $input['status_2'] = '0';
        $input['status_3'] = '0';
        $input['status_laporan'] = '5';
        $user->update($input);
        return redirect()->route('dashboard');
    }

    //dua
    public function dua_ya(Request $request)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        if ($user->status_1 == 0) {
            return redirect()->route('dashboard');
        }
        $input = $request->all();
        $input['status_2'] = '1';
        $input['status_laporan'] = '3';
        $user->update($input);
        return redirect()->route('dashboard');
    }
    public function dua_tidak(Request $request)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);

        $input = $request->all();
        
        $input['status_2'] = '0';
        $input['status_laporan'] = '3';
        $user->update($input);
        return redirect()->route('dashboard');
    }

    //dua
    public function tiga_ya(Request $request)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        if ($user->status_1 == 0) {
            return redirect()->route('dashboard');
        }
        $input = $request->all();
        $input['status_3'] = '1';
        $input['status_laporan'] = '4';
        $user->update($input);
        return redirect()->route('dashboard');
    }
    public function tiga_tidak(Request $request)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);

        $input = $request->all();
        
        $input['status_3'] = '0';
        $input['status_laporan'] = '5';
        $user->update($input);
        $deleted = DB::table('gratifikasi')->where('user_id', '=', $user->id)->delete();
        return redirect()->route('dashboard');
    }
}
