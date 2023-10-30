<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MigrasiController extends Controller
{
    public function index()
    {
        $data=User::all()->sortBy('admin');
        return view('migrasi', compact('data'));
    }
}
