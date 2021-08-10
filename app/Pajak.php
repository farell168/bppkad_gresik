<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pajak extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'tb_objek_pajak';
    public $timestamps = false;

     protected $fillable = [
        'no_pajak','tanggal_bayar', 'alamat_pajak', 'kecamatan','nama_pemilik', 'alamat_pemilik', 'no_tlpn', 'luas_lahan','daya_tampung','jumlah_pembangkit','kapasitas_pemakaian','sumber_daya','jumlah_kamar','jumlah_meja','jumlah_sarana_layanan','jumlah_lantai','kebutuhan_keamanan_tambahan','potensi_kecelakaan','kebutuhan_tenaga_medis_darurat', 'tarif'
    ];

    protected $primaryKey = 'id';
    public $incrementing =true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function clustering(){
        return $this->hasOne('App\Clustering','no_pajak');
    }
}
