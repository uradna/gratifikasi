<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Unit;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Dataupdate;
use App\Models\Createuser;
use App\Models\Deleteuser;
use App\Models\Gratifikasi;
use App\Models\Jenis;
use App\Models\Backupuser;

class SuperadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isActive');
        $this->middleware('isSuperAdmin');
        $this->middleware('notif');
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);

        $count = DB::select('select count(name) as jml, finish
        from users
        where admin = \'0\'
        group by finish;');

        $max=DB::select('select count(name) as max
        from users
        where admin = \'0\';');

        $pelapor=DB::select('select count(name) as n
        from users
        where admin = \'0\' and status_3 = \'1\' and finish = \'1\';');

        $pelaporkpk=DB::select('select count(name) as n
        from users
        where admin = \'0\' and status_2 = \'1\' and finish = \'1\';');

        $laporan=DB::select('select count(id) as n from gratifikasi;');

        $tanggal=DB::select('select * from setting;');

        // $updatedata=DB::select('select count(id) as n from dataupdate where status = \'0\' ;');
        // session(['updatedata' => $updatedata[0]->n]);

        // $createuser=DB::select('select count(id) as n from createusers where status = \'0\' ;');
        // session(['createuser' => $createuser[0]->n]);

        // $deleteuser=DB::select('select count(id) as n from deleteusers where status = \'0\' ;');
        // session(['deleteuser' => $deleteuser[0]->n]);

        // $notif=$updatedata[0]->n + $createuser[0]->n + $deleteuser[0]->n;
        // session(['notif' => $notif]);
        
        return view('superadmin.index', compact('count', 'max', 'pelapor', 'pelaporkpk', 'laporan', 'tanggal'));
    }

    public function data_status()
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $data = DB::select('select unit,
                                count(id) as total,
                                count(case when finish = 0 then finish end) as belum,
                                count(case when finish = 1 then finish end) as sudah
                                from users
                                where admin =\'0\'
                                group by unit
                                order by unit asc');
        
        return view('superadmin.dataStatus', compact('data'));
    }

    public function data_statusskpd($skpd)
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $unit = DB::select('select * from unit');
        $data = User::where('unit', $skpd)->where('admin', '0')->get();
        
        return view('superadmin.dataStatusSkpd', compact('data', 'unit', 'skpd'));
    }

    public function data_null()
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $unit = DB::select('select * from unit');
        $data = User::where('unit', null)->where('admin', '0')->get();
        $skpd = "PEGAWAI TANPA DATA SKPD";
        
        return view('superadmin.dataStatusSkpd', compact('data', 'unit', 'skpd'));
    }

    public function data_pernyataan()
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $data = DB::select('SELECT unit,
                            COUNT(unit) AS n,
                            COUNT(CASE WHEN finish = 1 THEN status_1 END) AS c,
                            COUNT(CASE WHEN status_1 = 1 THEN status_1 END) AS p1,
                            COUNT(CASE WHEN status_2 = 1 THEN status_2 END) AS p2,
                            COUNT(CASE WHEN status_3 = 1 THEN status_3 END) AS p3
                            FROM users
                            WHERE admin =\'0\' AND unit IS NOT NULL
                            GROUP BY unit
                            ORDER BY unit ASC');
        
        return view('superadmin.dataPernyataan', compact('data'));
    }

    public function data_pernyataanskpd($skpd)
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $unit = DB::select('select * from unit');
        $data = User::where('unit', $skpd)->where('admin', '0')->where('finish', '1')->get();
        
        return view('superadmin.dataPernyataanSkpd', compact('data', 'unit', 'skpd'));
    }

    public function updateTanggal(Request $request)
    {
        $request->validate([
            'tgl_1' => 'required|date',
            'tgl_2' => 'required|date|after:tgl_1',
        ], [
            'tgl_1.required' => 'Tanggal dibuka harus diisi',
            'tgl_1.date' => 'Input harus tanggal',
            'tgl_2.required' => 'Tanggal ditutup harus diisi',
            'tgl_2.date' => 'Input harus tanggal',
            'tgl_2.after' => 'Tanggal ditutup harus setelah tanggal dibuka',
        ]);
        
        $unit = DB::select('update setting set tgl_1 = \''.$request->tgl_1.'\', tgl_2 = \''.$request->tgl_2.'\' where setting.id = 1; ');
        return redirect()->route('superadmin')->withBerhasil(['status'=>'Tanggal berhasil diupdate.']);
    }

    public function gratifikasi()
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $data = DB::select('SELECT users.unit, COUNT(gratifikasi.id) as p1
                            FROM users
                            LEFT JOIN gratifikasi
                            ON users.id = gratifikasi.user_id
                            WHERE users.admin = \'0\' AND users.unit IS NOT NULL
                            GROUP BY users.unit  
                            ORDER BY users.unit ASC');
        
        
        return view('superadmin.dataGratifikasi', compact('data'));
    }

    public function gratifikasiskpd($skpd)
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $data = DB::select('SELECT users.id as userid, gratifikasi.id as gratid,users.name,users.nip,users.email,users.hp,users.pangkat,users.jabatan,users.unit,users.tempat,gratifikasi.jenis,gratifikasi.bentuk,gratifikasi.nilai,gratifikasi.waktu,gratifikasi.nama,gratifikasi.hubungan,gratifikasi.alamat,gratifikasi.alasan,gratifikasi.unit as unitgrat,gratifikasi.jabatan as jabgrat,gratifikasi.keterangan 
                            FROM users
                            INNER JOIN gratifikasi 
                            ON users.id = gratifikasi.user_id 
                            WHERE users.unit=\''.$skpd.'\'  
                            ORDER BY `users`.`name`  ASC');
        // dd($data);
        return view('superadmin.dataGratifikasiSkpd', compact('data', 'skpd'));
    }

    public function dataadmin()
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $data = DB::select('SELECT *
                            FROM users
                            WHERE users.admin != \'0\'
                            ORDER BY users.admin DESC');
        $unit = DB::select('SELECT *
                            FROM unit
                            ORDER BY unit ASC');
        // dd($unit);
        return view('superadmin.dataAdmin', compact('data', 'unit'));
    }

    public function admin_create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
            'unit' => 'required',
            'admin' => 'required|in:1,2',
        ], [
            'name.required' => 'Harus diisi',
            'nip.required' => 'Harus diisi',
            'password.required' => 'Harus diisi',
            'password.min' => 'Minimal 8 karakter',
            'confirmPassword.required' => 'Harus diisi',
            'confirmPassword.same' => 'Password harus sama',
            'unit.required' => 'Harus diisi',
            'admin.required' => 'Harus diisi',
            'admin.in' => 'Harus diisi sesuai pilihan',
        ]);
        if (Unit::where('unit', '=', $request->unit)->count() != 1) {
            return back()->withInput()->withErrors(['unit'=>'Harus diisi sesuai dengan unit kerja yang ada pada pilihan']);
        }
        if (User::where('nip', '=', $request->nip)->count() != 0) {
            return back()->withInput()->withErrors(['nip'=>'Username sudah dipakai, pilih yang lain']);
        }
        $input = $request->all();
        $input['status_laporan'] = '5';
        $input['finish'] = '1';
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return redirect()->route('dataadmin')->withBerhasil(['status'=>'Akun berhasil dibuat.<br>Username : '.$input['nip'].'<br>Password : '.$request->password]);
    }

    public function admin_patch(Request $request)
    {
        $user=User::where('id', $request->id)->get()->first();
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'unit' => 'required',
            'admin' => 'required',
        ], [
            'name.required' => 'Harus diisi',
            'nip.required' => 'Harus diisi',
            'unit.required' => 'Harus diisi',
            'admin.required' => 'Harus diisi',
        ]);
        $nip = User::where('nip', '=', $request->nip)->get();
        if ($nip->count() == 1) {
            if ($nip[0]->id != $user->id) {
                return back()->withInput()->withErrors(['nip'=>'Username sudah digunakan, masukkan username lain.']);
            }
        }
        $user->update($request->all());
        return redirect()->route('dataadmin')->withBerhasil(['status'=>'Data akun <br>"'.$user->name.'"<br> berhasil diupdate.']);
    }

    public function admin_delete(Request $request)
    {
        $user=Auth::user();
        $data=$request->all();
        if ($user->id == $data['id']) {
            return redirect()->route('dataadmin')->withGagal(['status'=>'Tidak bisa menghapus akun sendiri.']);
        }
        $user = User::where('id', $data['id'])->firstorfail()->delete();
        return redirect()->route('dataadmin')->withBerhasil(['status'=>'Akun berhasil dihapus.']);
    }

    public function admin_password(Request $request)
    {
        $user=User::where('id', $request->id)->get()->first();
        $request->validate([
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ], [
            'password.required' => 'Password baru harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'confirmPassword.required' => 'Password baru harus diisi',
            'confirmPassword.same' => 'Masukkan password yang sama dengan password baru',
        ]);
        $user->update(['password'=> Hash::make($request->password)]);
        return redirect()->route('dataadmin')->withBerhasil(['status'=>'Password untuk akun <br>"'.$user->name.'"<br> berhasil diubah.<br>Password baru:<b> '.$request->password.'</b>']);
    }

    public function updatedata()
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $data = DB::select('SELECT d.id, d.name, d.nip, u.email, u.hp, s.name as pemohon, d.unit_1, d.unit_2, d.keterangan, d.status, d.file
                            FROM dataupdate d
                            JOIN users u
                            ON d.nip = u.nip
                            JOIN users s
                            ON d.user_id = s.id
                            WHERE d.status = \'0\';');
        $unit = DB::select('SELECT *
                            FROM unit
                            ORDER BY unit ASC');
        return view('superadmin.dataUpdate', compact('data', 'unit'));
    }

    public function updatedata_search($nip)
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $data = DB::select('SELECT d.id, d.name, d.nip, u.email, u.hp, s.name as pemohon, d.unit_1, d.unit_2, d.keterangan, d.status
                            FROM dataupdate d
                            JOIN users u
                            ON d.nip = u.nip
                            JOIN users s
                            ON d.user_id = s.id
                            WHERE d.status = \'0\';');
        $unit = DB::select('SELECT *
                            FROM unit
                            ORDER BY unit ASC');
        $pegawai = User::where('nip', $nip)->first();
        return view('superadmin.dataUpdate', compact('data', 'unit', 'pegawai'));
    }

    public function updatedata_post(Request $request)
    {
        $user=User::where('nip', '=', $request->nip)->get()->first();
        $data=Dataupdate::where('id', '=', $request->id)->get()->first();
        // $update_user['id']= $user->id;
        $update_user['unit']= $request->unit;
        $update_user['tempat']= '';
        // $update_data['id'] = $request->id;
        $update_data['status'] = '1';
        
        $user->update($update_user);
        $data->update($update_data);

        $updatedata=DB::select('select count(id) as n from dataupdate where status = \'0\' ;');
        session(['updatedata' => $updatedata[0]->n]);
        
        return redirect()->route('updatedata')->withBerhasil(['status'=>'Data pegawai berhasil diupdate.']);
    }

    public function updatedata_tolak($id)
    {
        $data=Dataupdate::where('id', $id)->first();
        $data->update(['status'=> '2']);
        return redirect()->route('updatedata')->withWarning(['status'=>'Permintaan ditolak.']);
    }

    public function createuser()
    {
        $data = DB::select('SELECT c.id, c.name, c.nip, c.email, c.hp, c.unit, c.keterangan, c.status, c.file, u.name AS pemohon
                            FROM createusers c
                            JOIN users u 
                            ON c.user_id = u.id
                            WHERE c.status = \'0\';');
        $unit = DB::select('SELECT *
                            FROM unit
                            ORDER BY unit ASC');
        return view('superadmin.createUser', compact('data', 'unit'));
    }

    public function createuser_post(Request $request)
    {
        $data=Createuser::where('id', '=', $request->id)->get()->first();
        // dd($data);
        $input = array( 'name'      =>  $data->name,
                        'nip'       =>  $data->nip,
                        'email'     =>  $data->email,
                        'hp'        =>  $data->hp,
                        'unit'      =>  $data->unit,
                        'password'  =>  Hash::make($data->nip),
                        'status_1'  =>  '0',
                        'status_2'  =>  '0',
                        'status_3'  =>  '0',
                        'finish'    =>  '0',
                        'admin'     =>  '0');
        // dd($input);
        User::create($input);
        $data->update(["status"=>'1']);
        return redirect()->route('createuser')->withBerhasil(['status'=>'Data pegawai berhasil ditambahkan. Password = NIP.']);
    }

    public function createuser_tolak($id)
    {
        $data=Createuser::where('id', $id);
        $data->first()->update(["status"=>'2']);
        return redirect()->route('createuser')->withWarning(['status'=>'Data pegawai ditolak.']);
    }

    public function deleteuser()
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $data = DB::select('SELECT d.id, d.name, d.nip, u.email, u.hp, u.unit, u.tempat, d.keterangan, d.status, s.name as pemohon, d.file
                            FROM deleteusers d
                            JOIN users u
                            ON d.nip = u.nip
                            JOIN users s
                            ON d.user_id = s.id
                            WHERE d.status = \'0\';');
        $unit = DB::select('SELECT *
                            FROM unit
                            ORDER BY unit ASC');
        return view('superadmin.deleteUser', compact('data', 'unit'));
    }

    public function deleteuser_search($nip)
    {
        $title="Dashboard Superadmin - Super Gratifikasi Inspektorat Ponorogo";
        session(['title' => $title]);
        $data = DB::select('SELECT d.id, d.name, d.nip, u.email, u.hp, u.unit, u.tempat, d.keterangan, d.status, s.name as pemohon
                            FROM deleteusers d
                            JOIN users u
                            ON d.nip = u.nip
                            JOIN users s
                            ON d.user_id = s.id
                            WHERE d.status = \'0\';');
        $unit = DB::select('SELECT *
                            FROM unit
                            ORDER BY unit ASC');
        $pegawai = User::where('nip', $nip)->first();
        return view('superadmin.deleteUser', compact('data', 'unit', 'pegawai'));
    }

    public function deleteuser_post(Request $request)
    {
        $data=Deleteuser::where('id', '=', $request->id)->get()->first();
        $user=User::where('nip', '=', $data->nip)->get()->first();
        Backupuser::create($user->getAttributes());
        $user->delete();
        $data->update(['status'=>'1']);
        $deleteuser=DB::select('select count(id) as n from deleteusers where status = \'0\' ;');
        session(['deleteuser' => $deleteuser[0]->n]);
        return redirect()->route('deleteuser')->withBerhasil(['status'=>'Data pegawai dengan NIP "'.$data->nip.'" berhasil dihapus.']);
    }

    public function deleteuser_tolak($id)
    {
        $data=Deleteuser::where('id', $id)->first();
        $data->update(['status'=> '2']);
        return redirect()->route('deleteuser')->withWarning(['status'=>'Permintaan hapus pegawai dengan ID='.$data->id.' ditolak.']);
    }

    public function reset()
    {
        return view('superadmin.resetUser');
    }

    public function reset_view(Request $request)
    {
        $user=User::where('nip', 'like', '%'.$request->nip.'%')->get();
        return view('superadmin.resetUser', compact('user'));
    }

    public function reset_post(Request $request)
    {
        $userx=User::where('id', $request->id)->first();
        $userx->update(['finish'=>'0', 'status_laporan'=>'0']);
        $gratifikasi=DB::select('DELETE FROM gratifikasi WHERE user_id = \''.$request->id.'\'');
        // return redirect()->route('reset')->withBerhasil(['status'=>'Data pegawai dengan NIP "'.$request->nip.'" berhasil direset.']);
        $user=User::where('id', $request->id)->get();
        $alert=$request->nip;
        return view('superadmin.resetUser', compact('user', 'alert'));
    }
}
