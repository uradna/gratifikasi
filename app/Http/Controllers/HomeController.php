<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gratifikasi;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isActive');
        $this->middleware('preventBackHistory');
    }
    public function index()
    {
        $user = Auth::user();

        if (!$user->admin == 0) {
            if ($user->admin == 1) {
                return redirect()->route('admin');
            } elseif ($user->admin == 2) {
                return redirect()->route('superadmin');
            }
        } else {
            if ($user->status_laporan == 0) {
                return redirect()->route('biodata.index');
            }
            if ($user->status_laporan == 1) {
                return redirect()->route('satu');
            }
            if ($user->status_laporan == 2) {
                return redirect()->route('dua');
            }
            if ($user->status_laporan == 3) {
                return redirect()->route('tiga');
            }
            if ($user->status_laporan == 4) {
                return redirect()->route('gratifikasi.index');
            }
            if ($user->status_laporan == 5) {
                $gratifikasi = Gratifikasi::where('user_id', $user->id)->get();
                return view('dashboard', compact('user', 'gratifikasi'));
            }
            $gratifikasi = Gratifikasi::where('user_id', $user->id)->get();
            return view('dashboard', compact('user', 'gratifikasi'));
        }
    }
    public function selesai(Request $request)
    {
        $user = Auth::user();
        $input=$request->all();
        $input['status_laporan'] = '5';
        // $input['finish'] = '1';
        $user->update($input);
        return redirect()->route('dashboard');
    }

    public function done(Request $request)
    {
        $user = Auth::user();
        $input=$request->all();
        // $input['status_laporan'] = '5';
        $input['finish'] = '1';
        $input['tanggal'] = date("Y-m-d");
        $user->update($input);
        return redirect()->route('dashboard');
    }

    public function print()
    {
        $user = Auth::user();
        abort_if(!$user->finish, 403);
        $gratifikasi = Gratifikasi::where('user_id', '=', $user->id)->get();

        return view('print', compact('user', 'gratifikasi'));
    }
}
