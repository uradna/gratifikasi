<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unit;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Dataupdate;
use App\Models\Createuser;
use App\Models\Deleteuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isActive');
        $this->middleware('isAdmin');
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        $user = Auth::user();
        $unit = DB::select('select count(name) as jml, finish
        from users
        where unit = \''.$user->unit.'\' and admin = \'0\'
        group by finish;');
        $title="Data pengisian pernyataan - ".ucwords(strtolower($user->unit));
        session(['title' => $title]);
        $tgl=DB::select('select * from setting;');
        $tanggal=$tgl[0];
        return view('admin.index', compact('user', 'unit', 'tanggal'));
    }

    public function data_pegawai($data)
    {
        $user = Auth::user();
        switch ($data) {
            case "semua":
                $users = User::where('unit', $user->unit)->where('admin', '0')->get();
                $title="Data semua pegawai - ".ucwords(strtolower($user->unit));
              break;
            case "sudah":
                $users = User::where('unit', $user->unit)->where('finish', 1)->where('admin', '0')->get();
                $title="Data pegawai yang sudah mengisi pernyataan - ".ucwords(strtolower($user->unit));
              break;
            case "belum":
                $users = User::where('unit', $user->unit)->where('finish', 0)->where('admin', '0')->get();
                $title="Data pegawai yang belum mengisi pernyataan - ".ucwords(strtolower($user->unit));
                
              break;
            default:
                abort(404);
          }
        session(['title' => $title]);
        return view('admin.dataPegawai', compact('users', 'data'));
    }

    public function password()
    {
        $user = Auth::user();
        $users = User::where('unit', $user->unit)->where('admin', '0')->get();
        $title="Ganti Password - ".ucwords(strtolower($user->unit));
        session(['title' => $title]);
        return view('admin.password', compact('users'));
    }

    public function gantiPassword(Request $request)
    {
        $admin = Auth::user();
        $user = User::where('id', $request->id)->get()->first();
        if ($admin->unit == $user->unit) {
            $request->validate([
            'password' => 'required|min:8|same:confirmPassword',
        ], [
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password harus minimal 8 character',
            'password.same' => 'Password harus sama',
        ]);
            $user->update(['password'=> Hash::make($request->password)]);
            $title="Ganti Password - ".ucwords(strtolower($user->unit));
            session(['title' => $title]);
            return redirect()->route('password')->withBerhasil(['status'=>'Password untuk akun <br>"'.$user->name.'"<br> berhasil diubah.']);
        }
        abort(403);
    }

    public function updaterequest()
    {
        $admin = Auth::user();
        $users = Dataupdate::where('unit_1', $admin->unit)->get();
        $unit = DB::select('select * from unit');

        $title="Ubah Data Pegawai - ".ucwords(strtolower($admin->unit));
        session(['title' => $title]);
        
        return view('admin.requestUpdate', compact('admin', 'users', 'unit'));
    }

    public function sendUpdaterequest(Request $request)
    {
        $admin = Auth::user();
        $unit = Unit::where('unit', '=', $request->unit_2)->count();
        $user = User::where('nip', '=', $request->nip)->count();
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'unit_2' => 'required',
        ], [
            'name.required' => 'Nama pegawai harus diisi',
            'nip.required' => 'NIP pegawai harus diisi',
            'unit_2.required' => 'Unit/SKPD sebelumnya harus diisi',
        ]);
        if ($user != 1) {
            return back()->withInput()->withErrors(['nip'=>'NIP tidak ditemukan']);
        }
        if ($unit != 1) {
            return back()->withInput()->withErrors(['unit_2'=>'Harus diisi sesuai dengan unit kerja yang ada pada pilihan']);
        }

        $input = $request->all();

        $filex = $request->file('file');
        $t=md5(date('YmdHis'));
        $input['file'] = $t.'.'.$filex->getClientOriginalExtension();

        $input['user_id'] = $admin->id;
        $input['unit_1'] = $admin->unit;
        $input['status'] = '0';

        Dataupdate::create($input);

        $upload_folder='storage';
        $filex->move($upload_folder, $input['file']);

        return redirect()->route('updaterequest')->with('message', 'Permintaan perubahan data berhasil disimpan.');
    }

    public function createrequest()
    {
        $admin = Auth::user();
        $users = Createuser::where('unit', $admin->unit)->get();
        $unit = DB::select('select * from unit');
        
        $title="Tambah Data Pegawai - ".ucwords(strtolower($admin->unit));
        session(['title' => $title]);

        return view('admin.requestCreate', compact('admin', 'users', 'unit'));
    }

    public function sendCreaterequest(Request $request)
    {
        $admin = Auth::user();
        $request->validate([
            'name' => 'required',
            'nip' => 'required|digits:18',
            'email' => 'required', 'email', 'max:255',
            'hp' => 'required|digits_between:9,14',
            'keterangan' => 'required',
        ], [
            'name.required' => 'Nama pegawai harus diisi',
            'nip.required' => 'NIP pegawai harus diisi',
            'nip.digits' => 'NIP pegawai harus angka 18 digit',
            'email.required' => 'Email pegawai harus diisi',
            'email.email' => 'Isi dengan alamat email yang benar',
            'email.max' => 'Alamat email maksimal 255 karakter',
            'hp.required' => 'Nomor HP harus diisi',
            'hp.digits_between' => 'Nomor HP harus 9-14 digit',
            'keterangan.required' => 'Keterangan harus diisi'
        ]);
    
        $e_n=0;
        if (Createuser::where('nip', $request->nip)->where('status', '0')->count() !=0) {
            $e['nip']='NIP ini sudah ada di daftar permintaan tambah pegawai. Silahkan tunggu update dari admin inspektorat.';
            $e_n=1;
        }
        if (Createuser::where('email', $request->email)->where('status', '0')->count() !=0) {
            $e['email']='Alamat email ini sudah ada di daftar permintaan tambah pegawai. Silahkan tunggu update dari admin inspektorat.';
            $e_n=1;
        }
        if (Createuser::where('hp', $request->hp)->where('status', '0')->count() !=0) {
            $e['hp']='Nomor HP ini sudah ada di daftar permintaan tambah pegawai. Silahkan tunggu update dari admin inspektorat.';
            $e_n=1;
        }
        if (User::where('nip', $request->nip)->count() != 0) {
            $e['nip']='NIP ini sudah terdaftar. Jika data pegawai tidak ditemukan, gunakan menu UPDATE DATA';
            $e_n=1;
        }
        if (User::where('email', $request->email)->count() != 0) {
            $e['email']='Email sudah digunakan';
            $e_n=1;
        }
        if (User::where('hp', $request->hp)->count() != 0) {
            $e['hp']='HP sudah digunakan';
            $e_n=1;
        }
        if ($e_n == 1) {
            return back()->withInput()->withErrors($e);
        }

        

        $input=$request->all();

        $filex = $request->file('file');
        $t=md5(date('YmdHis'));
        $input['file'] = $t.'.'.$filex->getClientOriginalExtension();

        $input['unit']=$admin->unit;
        $input['user_id']=$admin->id;
        $input['status']='0';
        Createuser::create($input);

        $upload_folder='storage';
        $filex->move($upload_folder, $input['file']);

        return redirect()->route('createrequest')->withBerhasil(['status'=>'Permintaan penambahan pegawai baru berhasil disimpan.']);
    }

    public function deleterequest()
    {
        $admin = Auth::user();
        $data = Deleteuser::where('unit', $admin->unit)->get();
        $unit = DB::select('select * from unit');
        $mode = 'daftarhapus';

        $title="Hapus Data Pegawai - ".ucwords(strtolower($admin->unit));
        session(['title' => $title]);


        return view('admin.requestDelete', compact('data', 'unit', 'mode'));
    }

    public function deleterequest_list()
    {
        $user = Auth::user();
        $data = User::where('unit', $user->unit)->where('admin', '0')->get();
        $unit = DB::select('select * from unit');
        $mode = 'daftaruser';

        $title="Hapus Data Pegawai - ".ucwords(strtolower($user->unit));
        session(['title' => $title]);

        return view('admin.requestDelete', compact('data', 'unit', 'mode'));
    }

    public function sendDeleterequest(Request $request)
    {
        $admin = Auth::user();
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'unit' => 'required',
            'tempat' => 'required',
            'keterangan' => 'required',
        ]);
        $input = $request->all();
        $input['user_id'] = $admin->id;
        $input['status'] = '0';
        
        if (User::where('nip', $input['nip'])->count()==0) {
            return back()->withGagal(['status'=>'Data pegawai tidak ditemukan di SKPD anda.']);
        }
        
        $target=User::where('nip', $input['nip'])->first();
        
        if ($target->unit != $admin->unit) {
            return back()->withGagal(['status'=>'Data pegawai tidak ditemukan di SKPD anda.']);
        }
        if (Deleteuser::where('nip', $input['nip'])->where('status', '1')->count()!=0) {
            return back()->withGagal(['status'=>'Data sudah ada di permintaan hapus.']);
        }
        
        $filex = $request->file('file');
        $t=md5(date('YmdHis'));
        $input['file'] = $t.'.'.$filex->getClientOriginalExtension();

        Deleteuser::create($input);

        $upload_folder='storage';
        $filex->move($upload_folder, $input['file']);

        return redirect()->route('deleterequest')->withBerhasil(['status'=>'Permintaan hapus data pegawai berhasil disimpan.']);
    }
}
