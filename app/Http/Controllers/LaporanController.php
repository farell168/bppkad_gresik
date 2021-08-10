<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\Pajak;
use App\Clustering;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan');
    }

    public function laporanPajak() {
        $pajak = Pajak::all();
        return view('laporan', compact('pajak'));
    }
    
    public function laporanKmeansPajak() {
        $cluster = Clustering::all();
        // $pdf = PDF::loadview('laporan_kmeans_pajak', ['cluster' => $cluster]);
        // return $pdf->download('laporan-kmeans-pajak');
        return view('laporan', compact('cluster'));

    } 
}