<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DataUserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('daftaruser', compact('user'));
    }
}
