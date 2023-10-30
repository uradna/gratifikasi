<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PernyataanController;
use App\Http\Controllers\GratifikasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\GantiPasswordController;
use App\Http\Controllers\MigrasiController;

Route::get('migrasi', [MigrasiController::class, 'index'])->name('migrasi');


Route::resource('biodata', BiodataController::class);
Route::resource('gratifikasi', GratifikasiController::class);


Route::get('pernyataan/satu', [PernyataanController::class, 'satu'])->name('satu');
Route::get('pernyataan/dua', [PernyataanController::class, 'dua'])->name('dua');
Route::get('pernyataan/tiga', [PernyataanController::class, 'tiga'])->name('tiga');

Route::post('pernyataan/satu/ya', [PernyataanController::class, 'satu_ya'])->name('satu_ya');
Route::post('pernyataan/satu/tidak', [PernyataanController::class, 'satu_tidak'])->name('satu_tidak');
Route::post('pernyataan/dua/ya', [PernyataanController::class, 'dua_ya'])->name('dua_ya');
Route::post('pernyataan/dua/tidak', [PernyataanController::class, 'dua_tidak'])->name('dua_tidak');
Route::post('pernyataan/tiga/ya', [PernyataanController::class, 'tiga_ya'])->name('tiga_ya');
Route::post('pernyataan/tiga/tidak', [PernyataanController::class, 'tiga_tidak'])->name('tiga_tidak');
Route::get('pernyataan/satu/ya', [HomeController::class, 'index'])->name('xx');
Route::get('pernyataan/satu/tidak', [HomeController::class, 'index'])->name('xx');
Route::get('pernyataan/dua/ya', [HomeController::class, 'index'])->name('xx');
Route::get('pernyataan/dua/tidak', [HomeController::class, 'index'])->name('xx');
Route::get('pernyataan/tiga/ya', [HomeController::class, 'index'])->name('xx');
Route::get('pernyataan/tiga/tidak', [HomeController::class, 'index'])->name('xx');

Route::post('/finish', [HomeController::class, 'selesai'])->name('selesai');
Route::post('biodata.patch', [BiodataController::class, 'patch'])->name('patch');
Route::post('/done', [HomeController::class, 'done'])->name('done');
Route::get('/finish', [HomeController::class, 'index'])->name('xx');
Route::get('biodata.patch', [BiodataController::class, 'index'])->name('xx');
Route::get('/done', [HomeController::class, 'index'])->name('xx');

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/print', [HomeController::class, 'print'])->name('print');



// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware(['auth'])->name('admin');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/data/{data}', [AdminController::class, 'data_pegawai'])->name('data_pegawai');

Route::get('/admin/password', [AdminController::class, 'password'])->name('password');
Route::post('/admin/password', [AdminController::class, 'gantiPassword'])->name('gantiPassword');

Route::get('/admin/updateuser', [AdminController::class, 'updaterequest'])->name('updaterequest');
Route::post('/admin/updateuser', [AdminController::class, 'sendUpdaterequest'])->name('sendUpdaterequest');

Route::get('/admin/createuser', [AdminController::class, 'createrequest'])->name('createrequest');
Route::post('/admin/createuser', [AdminController::class, 'sendCreaterequest'])->name('sendCreaterequest');

Route::get('/admin/deleteuser', [AdminController::class, 'deleterequest'])->name('deleterequest');
Route::get('/admin/deleteuser/list', [AdminController::class, 'deleterequest_list'])->name('deleterequest_list');
Route::post('/admin/deleteuser', [AdminController::class, 'sendDeleterequest'])->name('sendDeleterequest');

Route::get('/superadmin', [SuperadminController::class, 'index'])->name('superadmin');
Route::get('/superadmin/status', [SuperadminController::class, 'data_status'])->name('status');
Route::get('/superadmin/status/skpd/{skpd}', [SuperadminController::class, 'data_statusskpd'])->name('statusskpd');
Route::get('/superadmin/status/null', [SuperadminController::class, 'data_null'])->name('datanull');

Route::get('/superadmin/pernyataan', [SuperadminController::class, 'data_pernyataan'])->name('pernyataan');
Route::get('/superadmin/pernyataan/skpd/{skpd}', [SuperadminController::class, 'data_pernyataanskpd'])->name('pernyataanskpd');

Route::get('/superadmin/gratifikasi', [SuperadminController::class, 'gratifikasi'])->name('gratifikasi');
Route::get('/superadmin/gratifikasi/skpd/{skpd}', [SuperadminController::class, 'gratifikasiskpd'])->name('gratifikasiskpd');

Route::get('/superadmin/dataadmin', [SuperadminController::class, 'dataadmin'])->name('dataadmin');
Route::post('/superadmin/dataadmin/create', [SuperadminController::class, 'admin_create'])->name('admin_create');
Route::post('/superadmin/dataadmin/patch', [SuperadminController::class, 'admin_patch'])->name('admin_patch');
Route::post('/superadmin/dataadmin/password', [SuperadminController::class, 'admin_password'])->name('admin_password');
Route::post('/superadmin/dataadmin/delete/', [SuperadminController::class, 'admin_delete'])->name('admin_delete');

Route::get('/superadmin/dataadmin/create', [HomeController::class, 'index'])->name('xx');
Route::get('/superadmin/dataadmin/patch', [HomeController::class, 'index'])->name('xx');
Route::get('/superadmin/dataadmin/password', [HomeController::class, 'index'])->name('xx');
Route::get('/superadmin/dataadmin/delete/', [HomeController::class, 'index'])->name('xx');

Route::get('/superadmin/updatedata', [SuperadminController::class, 'updatedata'])->name('updatedata');
Route::get('/superadmin/updatedata/nip/{nip}', [SuperadminController::class, 'updatedata_search'])->name('updatedata_search');
Route::get('/superadmin/updatedata/tolak/{id}', [SuperadminController::class, 'updatedata_tolak'])->name('updatedata_tolak');
Route::post('/superadmin/updatedata', [SuperadminController::class, 'updatedata_post'])->name('updatedata_post');

Route::get('/superadmin/createuser', [SuperadminController::class, 'createuser'])->name('createuser');
Route::get('/superadmin/createuser/tolak/{id}', [SuperadminController::class, 'createuser_tolak'])->name('createuser_tolak');
Route::post('/superadmin/createuser', [SuperadminController::class, 'createuser_post'])->name('createuser_post');

Route::get('/superadmin/deleteuser', [SuperadminController::class, 'deleteuser'])->name('deleteuser');
Route::get('/superadmin/deleteuser/nip/{nip}', [SuperadminController::class, 'deleteuser_search'])->name('deleteuser_search');
Route::get('/superadmin/deleteuser/tolak/{id}', [SuperadminController::class, 'deleteuser_tolak'])->name('deleteuser_tolak');
Route::post('/superadmin/deleteuser', [SuperadminController::class, 'deleteuser_post'])->name('deleteuser_post');

Route::post('/superadmin/tanggal', [SuperadminController::class, 'updateTanggal'])->name('updateTanggal');
Route::post('/password/changecred', [GantiPasswordController::class, 'changecred'])->name('changecred');
Route::get('/key', [GantiPasswordController::class, 'index'])->name('ganti_password');

Route::get('/superadmin/reset/', [SuperadminController::class, 'reset'])->name('reset');
Route::post('/superadmin/reset/', [SuperadminController::class, 'reset_view'])->name('reset_view');
Route::post('/superadmin/reset/done', [SuperadminController::class, 'reset_post'])->name('reset_post');

Route::get('/superadmin/tanggal', [HomeController::class, 'index'])->name('x');
Route::get('/password/changecred', [HomeController::class, 'index'])->name('x');

require __DIR__.'/auth.php';
