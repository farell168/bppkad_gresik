<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Pajak;
use App\Clustering;


class DataClusteringController extends Controller
{
    public function index()
    {
        $cluster = Clustering::all();
        return view('daftarclustering', compact('cluster'));
    }
    
}
