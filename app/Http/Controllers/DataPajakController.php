<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Pajak;
use App\Clustering;
use App\Imports\PajakImport;
use Maatwebsite\Excel\Facades\Excel;


class DataPajakController extends Controller
{
    public function index(Request $request)
    {
        $pajak = Pajak::paginate(10);
        $numRecords = Pajak::count();
        return view('daftarpajak', compact('pajak', 'numRecords'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function showFormAddPajak()
    {
        return view('view_add_pajak');
    }

    public function add(Request $request)
    {
        $rules = [
            'no_pajak'                   => 'required|unique:tb_objek_pajak,no_pajak',
            'tanggal_bayar'                  => 'required',
            // 'nama_pajak'                  => 'required'

        ];
 
        $messages = [
            'no_pajak.required'          => 'NO. Wajib Pajak Wajib diisi',
            'no_pajak.unique'          => 'NO. Wajib Pajak sudah terdaftar',
            'tanggal_bayar.required'        => 'Tanggal Transaksi wajib diisi',
            // 'nama_pajak.required'         => 'Nama Objek Pajak Lengkap wajib diisi'
            
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $pajak = new Pajak;
        $pajak->no_pajak = $request->no_pajak;
        $pajak->tanggal_bayar = $request->tanggal_bayar;
        $pajak->alamat_pajak = $request->alamat_pajak;                        
        $pajak->kecamatan = $request->kecamatan;
        $pajak->nama_pemilik = $request->nama_pemilik;
        // $pajak->alamat_pemilik = $request->alamat_pemilik;
        $pajak->no_tlpn = $request->no_tlpn;
        $pajak->luas_lahan = $request->luas_lahan/1000;
        $pajak->daya_tampung = $request->daya_tampung/100;
        $pajak->jumlah_pembangkit = $request->jumlah_pembangkit;
        $pajak->kapasitas_pemakaian = $request->kapasitas_pemakaian/1000;
        $pajak->sumber_daya = $request->sumber_daya;
        $pajak->jumlah_kamar = $request->jumlah_kamar;
        $pajak->jumlah_meja = $request->jumlah_meja;
        $pajak->jumlah_sarana_layanan = $request->jumlah_sarana_layanan;
        $pajak->jumlah_lantai = $request->jumlah_lantai;
        $pajak->kebutuhan_keamanan_tambahan = $request->kebutuhan_keamanan_tambahan;
        $pajak->potensi_kecelakaan = $request->potensi_kecelakaan;
        $pajak->kebutuhan_tenaga_medis_darurat = $request->kebutuhan_tenaga_medis_darurat;
        $pajak->tarif = $request->tarif;
        $pajak->updated_at = date('Y-m-d h:i:s');
        $simpan = $pajak->save();
        
        $this->insertCluster($pajak->id, $request->jumlah_kamar, $request->jumlah_meja);
        if($simpan){
            Session::flash('success', 'Tambah Data Pajak berhasil!');
            return redirect()->route('daftarpajak');
        } else {
            Session::flash('errors', ['' => 'Tambah Data Pajak! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('view_add_pajak');
        }
    }

    public function edit_pajak(Pajak $pajak)
    {
        
        return view('view_edit_pajak', compact('pajak'));
    }

    public function update_pajak(Request $request, Pajak $pajak)
    {
 
        $rules = [            
            'tanggal_bayar'                  => 'required',
            // 'nama_pajak'                  => 'required'

        ];
 
        $messages = [            
            'tanggal_bayar.required'        => 'Tanggal Transaksi wajib diisi',
            // 'nama_pajak.required'         => 'Nama Objek Pajak Lengkap wajib diisi'
            
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        // $pajak = Pajak::find($request->no_pajak);
        
        $pajak->tanggal_bayar = $request->tanggal_bayar;
        $pajak->alamat_pajak = $request->alamat_pajak;
        $pajak->kecamatan = $request->kecamatan;
        $pajak->nama_pemilik = $request->nama_pemilik;
        // $pajak->alamat_pemilik = $request->alamat_pemilik;
        $pajak->no_tlpn = $request->no_tlpn;
        $pajak->luas_lahan = $request->luas_lahan/100;
        $pajak->daya_tampung = $request->daya_tampung/10;
        $pajak->jumlah_pembangkit = $request->jumlah_pembangkit;
        $pajak->kapasitas_pemakaian = $request->kapasitas_pemakaian/100;
        $pajak->sumber_daya = $request->sumber_daya;
        $pajak->jumlah_kamar = $request->jumlah_kamar;
        $pajak->jumlah_meja = $request->jumlah_meja;
        $pajak->jumlah_sarana_layanan = $request->jumlah_sarana_layanan;
        $pajak->jumlah_lantai = $request->jumlah_lantai;
        $pajak->kebutuhan_keamanan_tambahan = $request->kebutuhan_keamanan_tambahan;
        $pajak->potensi_kecelakaan = $request->potensi_kecelakaan;
        $pajak->kebutuhan_tenaga_medis_darurat = $request->kebutuhan_tenaga_medis_darurat;
        $pajak->tarif = $request->tarif; 
        $pajak->updated_at = date('Y-m-d h:i:s');
        $simpan = $pajak->save();
 
        if($simpan){
            Session::flash('success', 'Perubahan Data berhasil!');
            return redirect()->route('daftarpajak');
        } else {
            Session::flash('errors', ['' => 'Perubahan Data gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('view_edit_pajak');
        }
    }

    public function delete_pajak(Pajak $pajak){
        $pajak->delete();
        return redirect()->route('daftarpajak');
    }

    public function import() 
    {
        Excel::import(new PajakImport,request()->file('file'));
             
        return back();
    }

    function insertCluster($noPajak, $jumlahKamar, $jumlahMeja)
    {
        $indeks = rand(1,8);
        if($jumlahKamar == 0 && $jumlahMeja == 0) $indeks = rand(1,3);
        else if($jumlahKamar != 0 && $jumlahMeja == 0) $indeks = rand(4,6);
        else if($jumlahKamar == 0 && $jumlahMeja != 0) $indeks = rand(7,8);

        switch ($indeks) {
            case 1:
                $keterangan = 'Golongan Pajak Hiburan Olahraga';
                break;
            case 2:
                $keterangan = 'Golongan Pajak Hiburan Wisata';
                break;
            case 3:
                $keterangan = 'Golongan Pajak Hiburan Lain-Lain';
                break;
            case 4:
                $keterangan = 'Golongan Pajak Perhotelan / Apartemen';
                break;
            case 5:
                $keterangan = 'Golongan Pajak Homestay / Villa';
                break;
            case 6:
                $keterangan = 'Golongan Pajak Rumah Kos';
                break;
            case 7:
                $keterangan = 'Golongan Pajak Cafe';
                break;
                                                          
            default:
                $keterangan = 'Golongan Pajak Restoran';
                break;
        }

        $Clustering = new Clustering;
        $Clustering->no_pajak = $noPajak; 
        $Clustering->cluster = 'C'.$indeks; 
        $Clustering->keterangan = $keterangan;
        $Clustering->updated_at = date('Y-m-d h:i:s');
        $Clustering->save();
    }

}
