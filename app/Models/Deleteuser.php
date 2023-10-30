<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deleteuser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'unit',
        'keterangan',
        'file',
        'tempat',
        'status',
    ];
}
