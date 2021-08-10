<?php

namespace App\Imports;

use App\Pajak;
use Maatwebsite\Excel\Concerns\ToModel;

class PajakImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pajak([
            'no_pajak' => $row[1],
            'tanggal_bayar' => $row[2],
            'alamat_pajak' => $row[3],
            'kecamatan' => $row[4],
            'nama_pemilik' => $row[5],
            'alamat_pemilik' => $row[6],
            'no_tlpn' => $row[7],
            'luas_lahan' => $this->reducedValue($row[8], 'luas_lahan'),
            'daya_tampung' => $this->reducedValue($row[9], 'daya_tampung'),
            'jumlah_pembangkit' => $row[10],
            'kapasitas_pemakaian' => $this->reducedValue($row[11], 'kapasitas_pemakaian'),
            'sumber_daya' => $this->ubahNilaiSkalar($row[12], 'sumber_daya'),
            'jumlah_kamar' => $row[13],
            'jumlah_meja' => $row[14],
            'jumlah_sarana_layanan' => $row[15],
            'jumlah_lantai' => $row[16],
            'kebutuhan_keamanan_tambahan' => $this->ubahNilaiSkalar($row[17], 'kebutuhan_keamanan_tambahan'),
            'potensi_kecelakaan' => $this->ubahNilaiSkalar($row[18], 'potensi_kecelakaan'),
            'kebutuhan_tenaga_medis_darurat' => $this->ubahNilaiSkalar($row[19], 'kebutuhan_tenaga_medis_darurat'),
            'tarif' => $row[20],
        ]);
    }

    public function ubahNilaiSkalar($stringValue, $column)
    {
        $numValue = 0;
        if($column=='sumber_daya') {
            if($stringValue=='Tidak Ada') $numValue = 1;
            elseif($stringValue=='Gardu Induk PLN') $numValue = 2;
            else $numValue = 3;
        }
        elseif( $column=='kebutuhan_keamanan_tambahan'||
                $column=='potensi_kecelakaan'||
                $column=='kebutuhan_tenaga_medis_darurat' ) {

            if($stringValue=='Sangat Tinggi') $numValue = 5;
            elseif($stringValue=='Tinggi') $numValue = 4;
            elseif($stringValue=='Sedang') $numValue = 3;
            elseif($stringValue=='Rendah') $numValue = 2;
            else $numValue = 1;
        }

        return $numValue;
    }

    public function reducedValue($longValue, $column)
    {
        $reducedValue = $longValue;
        if($column=='luas_lahan' || $column=='kapasitas_pemakaian') $divider = 1000;
        elseif($column=='daya_tampung') $divider = 100;

        $reducedValue = $longValue / $divider;
        return $reducedValue;
    }
}
