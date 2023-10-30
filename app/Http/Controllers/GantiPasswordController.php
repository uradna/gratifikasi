<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GantiPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isActive');
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        return view('cPassword');
    }

    public function changecred(Request $request)
    {
        $user=Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput()->withErrors(['password'=>'Password tidak sesuai']);
        }
        $request->validate([
            'password1' => 'required|min:8|different:password',
            'password2' => 'required|same:password1',
        ], [
            'password1.required' => 'Password baru harus diisi',
            'password1.min' => 'Password minimal 8 karakter',
            'password1.different' => 'Password baru tidak boleh sama dengan password lama',
            'password2.required' => 'Password baru harus diisi',
            'password2.same' => 'Masukkan password yang sama dengan password baru',
        ]);

        $user->update(['password'=> Hash::make($request->password1)]);
        return redirect()->back()->withBerhasil(['status'=>'Password berhasil diupdate']);
    }
}
