<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pajak;
use App\Clustering;

class GrafikController extends Controller
{
    public function index()
    {
        $record = Clustering::select(\DB::raw("COUNT(*) as count"), \DB::raw("keterangan"), \DB::raw("cluster"))
                        ->groupBy('cluster', 'keterangan')
                        ->orderBy('cluster')
                        ->get();

        $record2 = Clustering::select(\DB::raw('SUM(tb_objek_pajak.tarif) AS count'),
                                        \DB::raw("tb_clustering.keterangan"), 
                                        \DB::raw("tb_clustering.cluster"))
                        ->join('tb_objek_pajak', 'tb_objek_pajak.id', '=', 'tb_clustering.no_pajak')
                        ->groupBy('tb_clustering.cluster', 'tb_clustering.keterangan')
                        ->orderBy('cluster')
                        ->get();
    
        $data = [];
        $data2 = [];

        foreach($record as $row) {
            $data['label'][] = $row->keterangan;
            $data['data'][] = (int) $row->count;
        }

        foreach($record2 as $row) {
            $data2['label'][] = $row->keterangan;
            $data2['data'][] = (int) $row->count;
        }

        $data['chart_data'] = json_encode($data);
        $data['chart_data_2'] = json_encode($data2);

        return view('grafik', $data);
    } 
}