<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataupdate extends Model
{
    use HasFactory;
    protected $table = 'dataupdate';
    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'unit_1',
        'unit_2',
        'keterangan',
        'file',
        'status',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'nip', 'nip');
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
