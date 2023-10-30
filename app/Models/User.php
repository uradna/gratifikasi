<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nip',
        'email',
        'hp',
        'password',
        'pangkat',
        'jabatan',
        'unit',
        'tempat',
        'status_1',
        'status_2',
        'status_3',
        'status_laporan',
        'finish',
        'tanggal',
        'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gratifikasi()
    {
        return $this->hasMany(Gratifikasi::class);
    }

    public function dataupdate()
    {
        return $this->hasMany(Dataupdate::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'p_nip');
    }

    public function createuser()
    {
        return $this->hasMany(Createuser::class);
    }
}
