<?php

namespace App\Http\Controllers;

use App\Models\Gratifikasi;
use App\Models\User;
use App\Models\Unit;
use App\Models\Jenis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GratifikasiController extends Controller
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
        if ($user->status_laporan < 4) {
            return redirect()->route('dashboard');
        }
        if ($user->status_1 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }
        if ($user->status_3 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }
        // $gratifikasi = DB::select('select * from gratifikasi where user_id = '.$user->id);
        $unit = DB::select('select * from unit');
        $gratifikasi = Gratifikasi::where('user_id', $user->id)->get();
        return view('gratifikasi.index', compact('user', 'gratifikasi', 'unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        if ($user->status_laporan < 4) {
            return redirect()->route('dashboard');
        }
        if ($user->status_1 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }
        if ($user->status_3 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }
        //--------------
        $jenis = DB::select('select * from jenis');
        $unit = DB::select('select * from unit');
        return view('gratifikasi.create', compact('jenis', 'unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGratifikasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        if ($user->status_laporan < 4) {
            return redirect()->route('dashboard');
        }
        if ($user->status_1 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }
        if ($user->status_3 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }

        $input = $request->all();
        $input['user_id'] = $user->id;

        $request->validate([
            'jenis' => 'required',
            'bentuk' => 'required',
            'nilai' => 'required|numeric',
            'waktu' => 'required',
            'nama' => 'required',
            'hubungan' => 'required',
            'alamat' => 'required',
            'alasan' => 'required',
            'unit' => 'required',
            'jabatan' => 'required',
        ], [
            'jenis.required' => 'Jenis gratifikasi harus dipilih sesuai dengan pilihan yang tersedia',
            'bentuk.required' => 'Bentuk gratifikasi harus dipilih, sesuai dengan jenis. Contoh: Jenis > barang',
            'nilai.required' => 'Nilai gratifikasi harus diisi, dalam bentuk angka tanpa titik atau koma',
            'nilai.numeric' => 'Nilai gratifikasi harus dalam bentuk angka tanpa titik atau koma, contoh: 500000',
            'waktu.required' => 'Waktu harus dipilih',
            'nama.required' => ' Nama pemberi gratifikasi harus diisi',
            'hubungan.required' => 'Hubungan dengan pemberi gratifikasi harus diisi',
            'alamat.required' => 'Alamat pemberi gratifikasi harus diisi',
            'alasan.required' => 'Alasan pemberian gratifikasi harus diisi',
            'unit.required' => 'Instansi penerima pada saat menerima gratifikasi harus diisi',
            'jabatan.required' => 'Jabatan penerima pada saat menerima gratifikasi harus diisi',
        ]);

        if (Jenis::where('jenis', '=', $request->jenis)->count() != 1) {
            return back()->withInput()->withErrors(['jenis'=>'Harus diisi sesuai dengan jenis gratifikasi yang ada pada pilihan']);
        }

        if (Unit::where('unit', '=', $request->unit)->count() != 1) {
            return back()->withInput()->withErrors(['unit'=>'Harus diisi sesuai dengan unit kerja yang ada pada pilihan']);
        }
  
        Gratifikasi::create($input);
        return redirect()->route('gratifikasi.index')->with('message', 'Data gratifikasi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gratifikasi  $gratifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Gratifikasi $gratifikasi)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gratifikasi  $gratifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Gratifikasi $gratifikasi)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        abort_if($user->id != $gratifikasi->user_id, 403);
        if ($user->status_laporan < 4) {
            return redirect()->route('dashboard');
        }
        if ($user->status_1 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }
        if ($user->status_3 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }
        //--------------
        $jenis = DB::select('select * from jenis');
        $unit = DB::select('select * from unit');
        return view('gratifikasi.edit', compact('gratifikasi', 'jenis', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGratifikasiRequest  $request
     * @param  \App\Models\Gratifikasi  $gratifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gratifikasi $gratifikasi)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        abort_if($user->id != $gratifikasi->user_id, 403);
        if ($user->status_laporan < 4) {
            return redirect()->route('dashboard');
        }
        if ($user->status_1 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }
        if ($user->status_3 == 0 && $user->status_laporan == 5) {
            return redirect()->route('dashboard');
        }
        //--------------
        $request->validate([
            'jenis' => 'required',
            'bentuk' => 'required',
            'nilai' => 'required|numeric',
            'waktu' => 'required',
            'nama' => 'required',
            'hubungan' => 'required',
            'alamat' => 'required',
            'alasan' => 'required',
            'unit' => 'required',
            'jabatan' => 'required',
        ], [
            'jenis.required' => 'Jenis gratifikasi harus dipilih sesuai dengan pilihan yang tersedia',
            'bentuk.required' => 'Bentuk gratifikasi harus dipilih, sesuai dengan jenis. Contoh: Jenis > barang',
            'nilai.required' => 'Nilai gratifikasi harus diisi, dalam bentuk angka tanpa titik atau koma',
            'nilai.numeric' => 'Nilai gratifikasi harus dalam bentuk angka tanpa titik atau koma, contoh: 500000',
            'waktu.required' => 'Waktu harus dipilih',
            'nama.required' => ' Nama pemberi gratifikasi harus diisi',
            'hubungan.required' => 'Hubungan dengan pemberi gratifikasi harus diisi',
            'alamat.required' => 'Alamat pemberi gratifikasi harus diisi',
            'alasan.required' => 'Alasan pemberian gratifikasi harus diisi',
            'unit.required' => 'Instansi penerima pada saat menerima gratifikasi harus diisi',
            'jabatan.required' => 'Jabatan penerima pada saat menerima gratifikasi harus diisi',
        ]);

        if (Jenis::where('jenis', '=', $request->jenis)->count() != 1) {
            return back()->withInput()->withErrors(['jenis'=>'Harus diisi sesuai dengan jenis gratifikasi yang ada pada pilihan']);
        }

        if (Unit::where('unit', '=', $request->unit)->count() != 1) {
            return back()->withInput()->withErrors(['unit'=>'Harus diisi sesuai dengan unit kerja yang ada pada pilihan']);
        }
        
        $gratifikasi->update($request->all());
        return redirect()->route('gratifikasi.index')->with('message', 'Data gratifikasi berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gratifikasi  $gratifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gratifikasi $gratifikasi)
    {
        $user = Auth::user();
        abort_if($user->finish, 403);
        if ($user->id != $gratifikasi->user_id) {
            abort(403);
        }

        $gratifikasi->delete();
        return redirect()->route('gratifikasi.index')->with('message', 'Data gratifikasi berhasil dihapus.');
    }
}
