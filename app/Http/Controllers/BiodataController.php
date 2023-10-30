<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unit;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BiodataController extends Controller
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
        abort_if($user->finish, 403);

        if ($user->status_laporan != 0) {
            return redirect()->route('biodata.show', $user->id);
        }

        $unit = DB::select('select * from unit');
        $pangkat = DB::select('select * from pangkat');
        return view('biodata.index', compact('user', 'unit', 'pangkat'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        
        $request->validate([
            'email' => 'required', 'string', 'email', 'max:255',
            'hp' => 'required|digits_between:9,14',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'unit' => 'required',
        ], [
            'email.required' => 'Alamat email harus diisi',
            'email.email' => 'Harus diisi dengan alamat email yang benar',
            'hp.required' => 'Nomor HP harus diisi',
            'hp.digits_between' => 'Nomor HP diisi angka antara 9-14 digit',
            'jabatan.required' => 'Jabatan harus diisi',
            'pangkat.required' => 'Pangkat harus diisi',
            'unit.required' => 'Unit harus diisi',
        ]);

        $mail = User::where('email', '=', $request->email)->get();
        if ($mail->count() == 1) {
            if ($mail[0]->id != $user->id) {
                return back()->withInput()->withErrors(['email'=>'Email sudah digunakan, masukkan alamat email lain.']);
            }
        }
        if (Unit::where('unit', '=', $request->unit)->count() != 1) {
            return back()->withInput()->withErrors(['unit'=>'Harus diisi sesuai dengan unit kerja yang ada pada pilihan']);
        }
        if (Pangkat::where('pangkat', '=', $request->pangkat)->count() != 1) {
            return back()->withInput()->withErrors(['pangkat'=>'Harus diisi sesuai dengan pangkat yang ada pada pilihan']);
        }
        $input = $request->all();
        $input['status_laporan'] = '1';
        $user->update($input);
        return redirect()->route('dashboard');
    }

    public function show()
    {
        $user = Auth::user();
        abort_if($user->finish, 403);

        if ($user->status_laporan == 0) {
            return redirect()->route('biodata.index');
        }

        $unit = DB::select('select * from unit');
        $pangkat = DB::select('select * from pangkat');
        return view('biodata.show', compact('user', 'unit', 'pangkat'));
    }
    
    public function patch(Request $request)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        
        $request->validate([
            'hp' => 'required|digits_between:9,14',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'unit' => 'required',
        ], [
            'hp.required' => 'Nomor HP harus diisi',
            'hp.digits_between' => 'Nomor HP diisi angka antara 9-14 digit',
            'jabatan.required' => 'Jabatan harus diisi',
            'pangkat.required' => 'Pangkat harus diisi',
            'unit.required' => 'Unit harus diisi',
        ]);
        
        $mail = User::where('email', '=', $request->email)->get();
        if ($mail->count() == 1) {
            if ($mail[0]->id != $user->id) {
                return back()->withInput()->withErrors(['email'=>'Email sudah digunakan, masukkan alamat email lain.']);
            }
        }

        if (Unit::where('unit', '=', $request->unit)->count() != 1) {
            return back()->withInput()->withErrors(['unit'=>'Harus diisi sesuai dengan unit kerja yang ada pada pilihan']);
        }
        if (Pangkat::where('pangkat', '=', $request->pangkat)->count() != 1) {
            return back()->withInput()->withErrors(['pangkat'=>'Harus diisi sesuai dengan pangkat yang ada pada pilihan']);
        }

        $input = $request->all();
        $user->update($input);
        return redirect()->route('dashboard');
    }

    public function edit(Request $request)
    {
        abort(403);
    }
    public function create()
    {
        abort(403);
    }
    public function store(Request $request)
    {
        abort(403);
    }
    public function destroy(User $user)
    {
        abort(403);
    }
}
