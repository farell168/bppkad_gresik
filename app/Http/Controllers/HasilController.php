<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use App\Pajak;
use App\Clustering;


class HasilController extends Controller
{
    public function index(Request $request)
    {
        $cluster = Clustering::paginate(10);
        if(isset($request->cluster)) {
            $cluster = Clustering::where('cluster', $request->cluster)->paginate(10);
        }
        $numRecords = Clustering::count();
        return view('daftarclustering', compact('cluster', 'numRecords'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function proses_kmeans()
    {
        // $cluster = Clustering::all();
        // $perhitunganOLD = $this->kmeans();
        $perhitungan = $this->resViewRumus();
        // echo($perhitungan);
        // die();
        // dd($perhitungan);
        return view('perhitunganclustering', compact('perhitungan'));
    }

    public function kmeans()
    {
        
        $resultView = '';
        $resultView .= '<div class="card mb-3">
            <div class="card-body">

            <div class="table-responsive mt-5">';


        $dor = false;
        // implementasikan array
        $kriteria = array();
        $kriteria_temp = array();

        // error_reporting(0);
        // $this->db->query("DELETE FROM tb_hasil");
        Clustering::truncate();

        //menghitung jumlah data 
        // $sql = $this->db->query("SELECT * FROM tb_siswa")->result_array();
        $sql = Pajak::all()->toArray();
        $jmldata = sizeof($sql);


        //menentukan jumlah klaster
        $k=8; 
        $resultView .= 'Klaster = '.$k;
        $resultView .= "<br><br>";

        $resultView .= 'Centroid awal :';
        
        //implementasikan iterasi
        $noiterasi =1;
        $cluster_iterasi= array();


        //mempersiapkan cluster

        // menentukan centroid secara random yaitu 6, 33
        $c1 = $this->setInitialValue('1', '11','1.1','1','13.2','1','0','0','5','1','2','2','2');
        $c2 = $this->setInitialValue('2', '30','15','2','82.5','2','0','0','20','1','4','4','5');
        $c3 = $this->setInitialValue('3', '0.5','0.7','0','7.7','1','0','0','10','2','1','2','1');
        $c4 = $this->setInitialValue('4', '15','0.5','2','66','2','100','0','25','10','5','2','2');
        $c5 = $this->setInitialValue('5', '1','0.3','0','23','1','5','0','1','1','2','1','1');
        $c6 = $this->setInitialValue('6', '0.35','0.2','0','3.6','1','20','0','2','2','2','1','1');
        $c7 = $this->setInitialValue('7', '0.7','0.4','0','2.3','1','0','10','15','1','2','1','1');
        $c8 = $this->setInitialValue('8', '0.8','0.9','1','7.7','2','0','30','30','1','2','2','1');

        // perulangan Centroid
        $resultView .= "<table class='table table-striped table-responsive'>
        <tr>
            <td>
            </td>";
        foreach ($c1 as $key => $value)
        { 
            $resultView .= "<td>". ucfirst(preg_replace('/_/', ' ', $key))."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c1
            </td>";
        foreach ($c1 as $key => $value)
        {
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c2
            </td>";
        foreach ($c2 as $key => $value)
        {
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c3
            </td>";
        foreach ($c3 as $key => $value)
        {
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c4
            </td>";
        foreach ($c4 as $key => $value)
        {
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c5
            </td>";
        foreach ($c5 as $key => $value)
        {
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c6
            </td>";
        foreach ($c6 as $key => $value)
        {
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c7
            </td>";
        foreach ($c7 as $key => $value)
        {
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c8
            </td>";
        foreach ($c8 as $key => $value)
        {
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr> </table> <br><br>";

        $nomor = 1;
        // perulangan untuk iterasi
        $iterasi_terakhir = false;
        while($iterasi_terakhir == false) //selama iterasi terakhir belum ditemukan
        {

        $resultView .= 'Iterasi '.$noiterasi.'  :';
        //tampilan iterasi

        $resultView .= "<table class='table table-striped table-responsive'>
                <tr>
                <td>
                No 
                </td>
                <td>
                C1
                </td>
                <td>
                C2
                </td>
                <td>
                C3
                </td>
                <td>
                C4
                </td>
                <td>
                C5
                </td>
                <td>
                C6
                </td>
                <td>
                C7
                </td>
                <td>
                C8
                </td>
                <td>
                Min
                </td>
                <td>
                Cluster
                </td></tr>";


        //total pekerjaan c1
        $totalluaslahan=0;
        $totaldayatampung=0;
        $totaljumlahpembangkit=0;
        $totalkapasitaspemakaian=0;
        $totalsumberdaya=0;
        $totaljumlahkamar=0;
        $totaljumlahmeja=0;
        $totaljumlahsaranalayanan=0;
        $totaljumlahlantai=0;
        $totalkebutuhankeamanantambahan=0;
        $totalpotensikecelakaan=0;
        $totalkebutuhantenagamedisdarurat=0;

        //total pekerjaan c2
        $totalluaslahan1=0;
        $totaldayatampung1=0;
        $totaljumlahpembangkit1=0;
        $totalkapasitaspemakaian1=0;
        $totalsumberdaya1=0;
        $totaljumlahkamar1=0;
        $totaljumlahmeja1=0;
        $totaljumlahsaranalayanan1=0;
        $totaljumlahlantai1=0;
        $totalkebutuhankeamanantambahan1=0;
        $totalpotensikecelakaan1=0;
        $totalkebutuhantenagamedisdarurat1=0;

        //total pekerjaan c3
        $totalluaslahan2=0;
        $totaldayatampung2=0;
        $totaljumlahpembangkit2=0;
        $totalkapasitaspemakaian2=0;
        $totalsumberdaya2=0;
        $totaljumlahkamar2=0;
        $totaljumlahmeja2=0;
        $totaljumlahsaranalayanan2=0;
        $totaljumlahlantai2=0;
        $totalkebutuhankeamanantambahan2=0;
        $totalpotensikecelakaan2=0;
        $totalkebutuhantenagamedisdarurat2=0;

        //total pekerjaan c4
        $totalluaslahan3=0;
        $totaldayatampung3=0;
        $totaljumlahpembangkit3=0;
        $totalkapasitaspemakaian3=0;
        $totalsumberdaya3=0;
        $totaljumlahkamar3=0;
        $totaljumlahmeja3=0;
        $totaljumlahsaranalayanan3=0;
        $totaljumlahlantai3=0;
        $totalkebutuhankeamanantambahan3=0;
        $totalpotensikecelakaan3=0;
        $totalkebutuhantenagamedisdarurat3=0;

        //total pekerjaan c5
        $totalluaslahan4=0;
        $totaldayatampung4=0;
        $totaljumlahpembangkit4=0;
        $totalkapasitaspemakaian4=0;
        $totalsumberdaya4=0;
        $totaljumlahkamar4=0;
        $totaljumlahmeja4=0;
        $totaljumlahsaranalayanan4=0;
        $totaljumlahlantai4=0;
        $totalkebutuhankeamanantambahan4=0;
        $totalpotensikecelakaan4=0;
        $totalkebutuhantenagamedisdarurat4=0;

        //total pekerjaan c6
        $totalluaslahan5=0;
        $totaldayatampung5=0;
        $totaljumlahpembangkit5=0;
        $totalkapasitaspemakaian5=0;
        $totalsumberdaya5=0;
        $totaljumlahkamar5=0;
        $totaljumlahmeja5=0;
        $totaljumlahsaranalayanan5=0;
        $totaljumlahlantai5=0;
        $totalkebutuhankeamanantambahan5=0;
        $totalpotensikecelakaan5=0;
        $totalkebutuhantenagamedisdarurat5=0;

        //total pekerjaan c7
        $totalluaslahan6=0;
        $totaldayatampung6=0;
        $totaljumlahpembangkit6=0;
        $totalkapasitaspemakaian6=0;
        $totalsumberdaya6=0;
        $totaljumlahkamar6=0;
        $totaljumlahmeja6=0;
        $totaljumlahsaranalayanan6=0;
        $totaljumlahlantai6=0;
        $totalkebutuhankeamanantambahan6=0;
        $totalpotensikecelakaan6=0;
        $totalkebutuhantenagamedisdarurat6=0;

        //total pekerjaan c8
        $totalluaslahan7=0;
        $totaldayatampung7=0;
        $totaljumlahpembangkit7=0;
        $totalkapasitaspemakaian7=0;
        $totalsumberdaya7=0;
        $totaljumlahkamar7=0;
        $totaljumlahmeja7=0;
        $totaljumlahsaranalayanan7=0;
        $totaljumlahlantai7=0;
        $totalkebutuhankeamanantambahan7=0;
        $totalpotensikecelakaan7=0;
        $totalkebutuhantenagamedisdarurat7=0;

        //total
        //jumlah cluster pekerjaan c1
        $jumlahclusterluaslahan=0;
        $jumlahclusterdayatampung=0;
        $jumlahclusterpembangkit=0;
        $jumlahclusterkapasitaspemakaian=0;
        $jumlahclustersumberdaya=0;
        $jumlahclusterjumlahkamar=0;
        $jumlahclusterjumlahmeja=0;
        $jumlahclusterjumlahsaranalayanan=0;
        $jumlahclusterjumlahlantai=0;
        $jumlahclusterkebutuhankeamanantambahan=0;
        $jumlahclusterpotensikecelakaan=0;
        $jumlahclusterkebutuhantenagamedisdarurat=0;

        //jumlah cluster pekerjaan c2
        $jumlahcluster2luaslahan=0;
        $jumlahcluster2dayatampung=0;
        $jumlahcluster2pembangkit=0;
        $jumlahcluster2kapasitaspemakaian=0;
        $jumlahcluster2sumberdaya=0;
        $jumlahcluster2jumlahkamar=0;
        $jumlahcluster2jumlahmeja=0;
        $jumlahcluster2jumlahsaranalayanan=0;
        $jumlahcluster2jumlahlantai=0;
        $jumlahcluster2kebutuhankeamanantambahan=0;
        $jumlahcluster2potensikecelakaan=0;
        $jumlahcluster2kebutuhantenagamedisdarurat=0;

        //jumlah cluster pekerjaan c3
        $jumlahcluster3luaslahan=0;
        $jumlahcluster3dayatampung=0;
        $jumlahcluster3pembangkit=0;
        $jumlahcluster3kapasitaspemakaian=0;
        $jumlahcluster3sumberdaya=0;
        $jumlahcluster3jumlahkamar=0;
        $jumlahcluster3jumlahmeja=0;
        $jumlahcluster3jumlahsaranalayanan=0;
        $jumlahcluster3jumlahlantai=0;
        $jumlahcluster3kebutuhankeamanantambahan=0;
        $jumlahcluster3potensikecelakaan=0;
        $jumlahcluster3kebutuhantenagamedisdarurat=0;

        //jumlah cluster pekerjaan c4
        $jumlahcluster4luaslahan=0;
        $jumlahcluster4dayatampung=0;
        $jumlahcluster4pembangkit=0;
        $jumlahcluster4kapasitaspemakaian=0;
        $jumlahcluster4sumberdaya=0;
        $jumlahcluster4jumlahkamar=0;
        $jumlahcluster4jumlahmeja=0;
        $jumlahcluster4jumlahsaranalayanan=0;
        $jumlahcluster4jumlahlantai=0;
        $jumlahcluster4kebutuhankeamanantambahan=0;
        $jumlahcluster4potensikecelakaan=0;
        $jumlahcluster4kebutuhantenagamedisdarurat=0;

        //jumlah cluster pekerjaan c5
        $jumlahcluster5luaslahan=0;
        $jumlahcluster5dayatampung=0;
        $jumlahcluster5pembangkit=0;
        $jumlahcluster5kapasitaspemakaian=0;
        $jumlahcluster5sumberdaya=0;
        $jumlahcluster5jumlahkamar=0;
        $jumlahcluster5jumlahmeja=0;
        $jumlahcluster5jumlahsaranalayanan=0;
        $jumlahcluster5jumlahlantai=0;
        $jumlahcluster5kebutuhankeamanantambahan=0;
        $jumlahcluster5potensikecelakaan=0;
        $jumlahcluster5kebutuhantenagamedisdarurat=0;

        //jumlah cluster pekerjaan c6
        $jumlahcluster6luaslahan=0;
        $jumlahcluster6dayatampung=0;
        $jumlahcluster6pembangkit=0;
        $jumlahcluster6kapasitaspemakaian=0;
        $jumlahcluster6sumberdaya=0;
        $jumlahcluster6jumlahkamar=0;
        $jumlahcluster6jumlahmeja=0;
        $jumlahcluster6jumlahsaranalayanan=0;
        $jumlahcluster6jumlahlantai=0;
        $jumlahcluster6kebutuhankeamanantambahan=0;
        $jumlahcluster6potensikecelakaan=0;
        $jumlahcluster6kebutuhantenagamedisdarurat=0;

        //jumlah cluster pekerjaan c7
        $jumlahcluster7luaslahan=0;
        $jumlahcluster7dayatampung=0;
        $jumlahcluster7pembangkit=0;
        $jumlahcluster7kapasitaspemakaian=0;
        $jumlahcluster7sumberdaya=0;
        $jumlahcluster7jumlahkamar=0;
        $jumlahcluster7jumlahmeja=0;
        $jumlahcluster7jumlahsaranalayanan=0;
        $jumlahcluster7jumlahlantai=0;
        $jumlahcluster7kebutuhankeamanantambahan=0;
        $jumlahcluster7potensikecelakaan=0;
        $jumlahcluster7kebutuhantenagamedisdarurat=0;

        //jumlah cluster pekerjaan c8
        $jumlahcluster8luaslahan=0;
        $jumlahcluster8dayatampung=0;
        $jumlahcluster8pembangkit=0;
        $jumlahcluster8kapasitaspemakaian=0;
        $jumlahcluster8sumberdaya=0;
        $jumlahcluster8jumlahkamar=0;
        $jumlahcluster8jumlahmeja=0;
        $jumlahcluster8jumlahsaranalayanan=0;
        $jumlahcluster8jumlahlantai=0;
        $jumlahcluster8kebutuhankeamanantambahan=0;
        $jumlahcluster8potensikecelakaan=0;
        $jumlahcluster8kebutuhantenagamedisdarurat=0;

        //array untuk penyimpanan cluster baru
        $temp_cluster = array();
        
        //perulangan perhitungan jarak terdekat
        for($i=0; $i<$jmldata; $i++)
        {
            // $sql = $this->db->query( "SELECT * FROM tb_kriteria WHERE no=$i");
            $sql = Pajak::all();
            $no=0;
            foreach ($sql->toArray() as $row) {
                if($i==$no) {
                    // $row['no']; 
                    //cluster1
                    $var1_c1  = $row['luas_lahan'] - $c1['luas_lahan'];
                    $var2_c1  = $row['daya_tampung'] - $c1['daya_tampung']; 
                    $var3_c1  = $row['jumlah_pembangkit'] - $c1['jumlah_pembangkit'];
                    $var4_c1  = $row['kapasitas_pemakaian'] - $c1['kapasitas_pemakaian'];
                    $var5_c1  = $row['sumber_daya'] - $c1['sumber_daya'];
                    $var6_c1  = $row['jumlah_kamar'] - $c1['jumlah_kamar'];
                    $var7_c1  = $row['jumlah_meja'] - $c1['jumlah_meja'];
                    $var8_c1  = $row['jumlah_sarana_layanan'] - $c1['jumlah_sarana_layanan'];
                    $var9_c1  = $row['jumlah_lantai'] - $c1['jumlah_lantai'];
                    $var10_c1  = $row['kebutuhan_keamanan_tambahan'] - $c1['kebutuhan_keamanan_tambahan'];
                    $var11_c1  = $row['potensi_kecelakaan'] - $c1['potensi_kecelakaan'];
                    $var12_c1  = $row['kebutuhan_tenaga_medis_darurat'] - $c1['kebutuhan_tenaga_medis_darurat'];
                    
                    //cluster2
                    $var1_c2  = $row['luas_lahan'] - $c2['luas_lahan'];
                    $var2_c2  = $row['daya_tampung'] - $c2['daya_tampung']; 
                    $var3_c2  = $row['jumlah_pembangkit'] - $c2['jumlah_pembangkit'];
                    $var4_c2  = $row['kapasitas_pemakaian'] - $c2['kapasitas_pemakaian'];
                    $var5_c2  = $row['sumber_daya'] - $c2['sumber_daya'];
                    $var6_c2  = $row['jumlah_kamar'] - $c2['jumlah_kamar'];
                    $var7_c2  = $row['jumlah_meja'] - $c2['jumlah_meja'];
                    $var8_c2  = $row['jumlah_sarana_layanan'] - $c2['jumlah_sarana_layanan'];
                    $var9_c2  = $row['jumlah_lantai'] - $c2['jumlah_lantai'];
                    $var10_c2  = $row['kebutuhan_keamanan_tambahan'] - $c2['kebutuhan_keamanan_tambahan'];
                    $var11_c2  = $row['potensi_kecelakaan'] - $c2['potensi_kecelakaan'];
                    $var12_c2  = $row['kebutuhan_tenaga_medis_darurat'] - $c2['kebutuhan_tenaga_medis_darurat'];

                    //cluster3
                    $var1_c3  = $row['luas_lahan'] - $c3['luas_lahan'];
                    $var2_c3  = $row['daya_tampung'] - $c3['daya_tampung']; 
                    $var3_c3  = $row['jumlah_pembangkit'] - $c3['jumlah_pembangkit'];
                    $var4_c3  = $row['kapasitas_pemakaian'] - $c3['kapasitas_pemakaian'];
                    $var5_c3  = $row['sumber_daya'] - $c3['sumber_daya'];
                    $var6_c3  = $row['jumlah_kamar'] - $c3['jumlah_kamar'];
                    $var7_c3  = $row['jumlah_meja'] - $c3['jumlah_meja'];
                    $var8_c3  = $row['jumlah_sarana_layanan'] - $c3['jumlah_sarana_layanan'];
                    $var9_c3  = $row['jumlah_lantai'] - $c3['jumlah_lantai'];
                    $var10_c3  = $row['kebutuhan_keamanan_tambahan'] - $c3['kebutuhan_keamanan_tambahan'];
                    $var11_c3  = $row['potensi_kecelakaan'] - $c3['potensi_kecelakaan'];
                    $var12_c3  = $row['kebutuhan_tenaga_medis_darurat'] - $c3['kebutuhan_tenaga_medis_darurat'];

                    //cluster4
                    $var1_c4  = $row['luas_lahan'] - $c4['luas_lahan'];
                    $var2_c4  = $row['daya_tampung'] - $c4['daya_tampung']; 
                    $var3_c4  = $row['jumlah_pembangkit'] - $c4['jumlah_pembangkit'];
                    $var4_c4  = $row['kapasitas_pemakaian'] - $c4['kapasitas_pemakaian'];
                    $var5_c4  = $row['sumber_daya'] - $c4['sumber_daya'];
                    $var6_c4  = $row['jumlah_kamar'] - $c4['jumlah_kamar'];
                    $var7_c4  = $row['jumlah_meja'] - $c4['jumlah_meja'];
                    $var8_c4  = $row['jumlah_sarana_layanan'] - $c4['jumlah_sarana_layanan'];
                    $var9_c4  = $row['jumlah_lantai'] - $c4['jumlah_lantai'];
                    $var10_c4  = $row['kebutuhan_keamanan_tambahan'] - $c4['kebutuhan_keamanan_tambahan'];
                    $var11_c4  = $row['potensi_kecelakaan'] - $c4['potensi_kecelakaan'];
                    $var12_c4  = $row['kebutuhan_tenaga_medis_darurat'] - $c4['kebutuhan_tenaga_medis_darurat'];

                    //cluster5
                    $var1_c5  = $row['luas_lahan'] - $c5['luas_lahan'];
                    $var2_c5  = $row['daya_tampung'] - $c5['daya_tampung']; 
                    $var3_c5  = $row['jumlah_pembangkit'] - $c5['jumlah_pembangkit'];
                    $var4_c5  = $row['kapasitas_pemakaian'] - $c5['kapasitas_pemakaian'];
                    $var5_c5  = $row['sumber_daya'] - $c5['sumber_daya'];
                    $var6_c5  = $row['jumlah_kamar'] - $c5['jumlah_kamar'];
                    $var7_c5  = $row['jumlah_meja'] - $c5['jumlah_meja'];
                    $var8_c5  = $row['jumlah_sarana_layanan'] - $c5['jumlah_sarana_layanan'];
                    $var9_c5  = $row['jumlah_lantai'] - $c5['jumlah_lantai'];
                    $var10_c5  = $row['kebutuhan_keamanan_tambahan'] - $c5['kebutuhan_keamanan_tambahan'];
                    $var11_c5  = $row['potensi_kecelakaan'] - $c5['potensi_kecelakaan'];
                    $var12_c5  = $row['kebutuhan_tenaga_medis_darurat'] - $c5['kebutuhan_tenaga_medis_darurat'];

                    //cluster6
                    $var1_c6  = $row['luas_lahan'] - $c6['luas_lahan'];
                    $var2_c6  = $row['daya_tampung'] - $c6['daya_tampung']; 
                    $var3_c6  = $row['jumlah_pembangkit'] - $c6['jumlah_pembangkit'];
                    $var4_c6  = $row['kapasitas_pemakaian'] - $c6['kapasitas_pemakaian'];
                    $var5_c6  = $row['sumber_daya'] - $c6['sumber_daya'];
                    $var6_c6  = $row['jumlah_kamar'] - $c6['jumlah_kamar'];
                    $var7_c6  = $row['jumlah_meja'] - $c6['jumlah_meja'];
                    $var8_c6  = $row['jumlah_sarana_layanan'] - $c6['jumlah_sarana_layanan'];
                    $var9_c6  = $row['jumlah_lantai'] - $c6['jumlah_lantai'];
                    $var10_c6  = $row['kebutuhan_keamanan_tambahan'] - $c6['kebutuhan_keamanan_tambahan'];
                    $var11_c6  = $row['potensi_kecelakaan'] - $c6['potensi_kecelakaan'];
                    $var12_c6  = $row['kebutuhan_tenaga_medis_darurat'] - $c6['kebutuhan_tenaga_medis_darurat'];

                    //cluster7
                    $var1_c7  = $row['luas_lahan'] - $c7['luas_lahan'];
                    $var2_c7  = $row['daya_tampung'] - $c7['daya_tampung']; 
                    $var3_c7  = $row['jumlah_pembangkit'] - $c7['jumlah_pembangkit'];
                    $var4_c7  = $row['kapasitas_pemakaian'] - $c7['kapasitas_pemakaian'];
                    $var5_c7  = $row['sumber_daya'] - $c7['sumber_daya'];
                    $var6_c7  = $row['jumlah_kamar'] - $c7['jumlah_kamar'];
                    $var7_c7  = $row['jumlah_meja'] - $c7['jumlah_meja'];
                    $var8_c7  = $row['jumlah_sarana_layanan'] - $c7['jumlah_sarana_layanan'];
                    $var9_c7  = $row['jumlah_lantai'] - $c7['jumlah_lantai'];
                    $var10_c7  = $row['kebutuhan_keamanan_tambahan'] - $c7['kebutuhan_keamanan_tambahan'];
                    $var11_c7  = $row['potensi_kecelakaan'] - $c7['potensi_kecelakaan'];
                    $var12_c7  = $row['kebutuhan_tenaga_medis_darurat'] - $c7['kebutuhan_tenaga_medis_darurat'];

                    //cluster8
                    $var1_c8  = $row['luas_lahan'] - $c8['luas_lahan'];
                    $var2_c8  = $row['daya_tampung'] - $c8['daya_tampung']; 
                    $var3_c8  = $row['jumlah_pembangkit'] - $c8['jumlah_pembangkit'];
                    $var4_c8  = $row['kapasitas_pemakaian'] - $c8['kapasitas_pemakaian'];
                    $var5_c8  = $row['sumber_daya'] - $c8['sumber_daya'];
                    $var6_c8  = $row['jumlah_kamar'] - $c8['jumlah_kamar'];
                    $var7_c8  = $row['jumlah_meja'] - $c8['jumlah_meja'];
                    $var8_c8  = $row['jumlah_sarana_layanan'] - $c8['jumlah_sarana_layanan'];
                    $var9_c8  = $row['jumlah_lantai'] - $c8['jumlah_lantai'];
                    $var10_c8  = $row['kebutuhan_keamanan_tambahan'] - $c8['kebutuhan_keamanan_tambahan'];
                    $var11_c8  = $row['potensi_kecelakaan'] - $c8['potensi_kecelakaan'];
                    $var12_c8  = $row['kebutuhan_tenaga_medis_darurat'] - $c8['kebutuhan_tenaga_medis_darurat'];

                    break;

                } else {
                    $no++;
                }
            }

            //peng-kuadrat-an C1
            $kuadratc1 =(pow($var1_c1,2)) + 
                        (pow($var2_c1,2)) + 
                        (pow($var3_c1,2)) + 
                        (pow($var4_c1,2)) + 
                        (pow($var5_c1,2)) +
                        (pow($var6_c1,2)) +
                        (pow($var7_c1,2)) +
                        (pow($var8_c1,2)) +
                        (pow($var9_c1,2)) +
                        (pow($var10_c1,2)) +
                        (pow($var11_c1,2)) +
                        (pow($var12_c1,2));

            //peng-kuadrat-an C2
            $kuadratc2 =(pow($var1_c2,2)) + 
                        (pow($var2_c2,2)) + 
                        (pow($var3_c2,2)) + 
                        (pow($var4_c2,2)) + 
                        (pow($var5_c2,2)) +
                        (pow($var6_c2,2)) +
                        (pow($var7_c2,2)) +
                        (pow($var8_c2,2)) +
                        (pow($var9_c2,2)) +
                        (pow($var10_c2,2)) +
                        (pow($var11_c2,2)) +
                        (pow($var12_c2,2));
                        

            //peng-kuadrat-an c3
            $kuadratc3 =(pow($var1_c3,2)) + 
                        (pow($var2_c3,2)) + 
                        (pow($var3_c3,2)) + 
                        (pow($var4_c3,2)) + 
                        (pow($var5_c3,2)) +
                        (pow($var6_c3,2)) +
                        (pow($var7_c3,2)) +
                        (pow($var8_c3,2)) +
                        (pow($var9_c3,2)) +
                        (pow($var10_c3,2)) +
                        (pow($var11_c3,2)) +
                        (pow($var12_c3,2));

            //peng-kuadrat-an c4
            $kuadratc4 =(pow($var1_c4,2)) + 
                        (pow($var2_c4,2)) + 
                        (pow($var3_c4,2)) + 
                        (pow($var4_c4,2)) + 
                        (pow($var5_c4,2)) +
                        (pow($var6_c4,2)) +
                        (pow($var7_c4,2)) +
                        (pow($var8_c4,2)) +
                        (pow($var9_c4,2)) +
                        (pow($var10_c4,2)) +
                        (pow($var11_c4,2)) +
                        (pow($var12_c4,2));

            //peng-kuadrat-an c5
            $kuadratc5 =(pow($var1_c5,2)) + 
                        (pow($var2_c5,2)) + 
                        (pow($var3_c5,2)) + 
                        (pow($var4_c5,2)) + 
                        (pow($var5_c5,2)) +
                        (pow($var6_c5,2)) +
                        (pow($var7_c5,2)) +
                        (pow($var8_c5,2)) +
                        (pow($var9_c5,2)) +
                        (pow($var10_c5,2)) +
                        (pow($var11_c5,2)) +
                        (pow($var12_c5,2));

            //peng-kuadrat-an c6
            $kuadratc6 =(pow($var1_c6,2)) + 
                        (pow($var2_c6,2)) + 
                        (pow($var3_c6,2)) + 
                        (pow($var4_c6,2)) + 
                        (pow($var5_c6,2)) +
                        (pow($var6_c6,2)) +
                        (pow($var7_c6,2)) +
                        (pow($var8_c6,2)) +
                        (pow($var9_c6,2)) +
                        (pow($var10_c6,2)) +
                        (pow($var11_c6,2)) +
                        (pow($var12_c6,2));

            //peng-kuadrat-an c7
            $kuadratc7 =(pow($var1_c7,2)) + 
                        (pow($var2_c7,2)) + 
                        (pow($var3_c7,2)) + 
                        (pow($var4_c7,2)) + 
                        (pow($var5_c7,2)) +
                        (pow($var6_c7,2)) +
                        (pow($var7_c7,2)) +
                        (pow($var8_c7,2)) +
                        (pow($var9_c7,2)) +
                        (pow($var10_c7,2)) +
                        (pow($var11_c7,2)) +
                        (pow($var12_c7,2));

            //peng-kuadrat-an c8
            $kuadratc8 =(pow($var1_c8,2)) + 
                        (pow($var2_c8,2)) + 
                        (pow($var3_c8,2)) + 
                        (pow($var4_c8,2)) + 
                        (pow($var5_c8,2)) +
                        (pow($var6_c8,2)) +
                        (pow($var7_c8,2)) +
                        (pow($var8_c8,2)) +
                        (pow($var9_c8,2)) +
                        (pow($var10_c8,2)) +
                        (pow($var11_c8,2)) +
                        (pow($var12_c8,2));

            // $kuadratc3 = (pow($var1_c3,2)) + (pow($var2_c3,2)) + (pow($var3_c3,2)) + (pow($var4_c3,2)) + (pow($var5_c3,2));

            //peng-akar-an C1
            $akar1 = sqrt($kuadratc1);

            //peg-akar-an C2
            $akar2 = sqrt($kuadratc2); 

            //peg-akar-an C3
            $akar3 = sqrt($kuadratc3);

            //peg-akar-an C4
            $akar4 = sqrt($kuadratc4);

            //peg-akar-an C5
            $akar5 = sqrt($kuadratc5);

            //peg-akar-an C6
            $akar6 = sqrt($kuadratc6);

            //peg-akar-an C7
            $akar7 = sqrt($kuadratc7);

            //peg-akar-an C8
            $akar8 = sqrt($kuadratc8);

            $resultView .= "<tr>
                <td>".
                $nomor++
                ."</td>
                <td>".
                $akar1."
                </td>
                <td>".
                $akar2."
                </td>
                </td>
                <td>".
                $akar3."
                </td>
                <td>".
                $akar4."
                </td>
                <td>".
                $akar5."
                </td>
                <td>".
                $akar6."
                </td>
                <td>".
                $akar7."
                </td>
                <td>".
                $akar8."
                </td>";

            //minimum dan klaster

            if ($akar1 == (min($akar1, $akar2, $akar3, $akar4, $akar5, $akar6, $akar7, $akar8)))
            {
                $cluster='1';
                //penampilan min dan cluster
                $resultView .= "<td>".
                $akar1."</td>
                <td>".
                $cluster."
                </td><tr>";

                // 
                $jumlahclusterluaslahan++;
                $jumlahclusterdayatampung++;
                $jumlahclusterpembangkit++;
                $jumlahclusterkapasitaspemakaian++;
                $jumlahclustersumberdaya++;
                $jumlahclusterjumlahkamar++;
                $jumlahclusterjumlahmeja++;
                $jumlahclusterjumlahsaranalayanan++;
                $jumlahclusterjumlahlantai++;
                $jumlahclusterkebutuhankeamanantambahan++;
                $jumlahclusterpotensikecelakaan++;
                $jumlahclusterkebutuhantenagamedisdarurat++;

                // $sql3 = $this->db->query( "SELECT * FROM tb_kriteria WHERE no = $i");
                $no=0;
                foreach ($sql->toArray() as $row) 
                {
                    if($i==$no) {
                        $luaslahan= $row['luas_lahan'];
                        $dayatampung= $row['daya_tampung'];
                        $jumlahpembangkit= $row['jumlah_pembangkit'];
                        $kapasitaspemakaian= $row['kapasitas_pemakaian'];
                        $sumberdaya= $row['sumber_daya'];
                        $jumlahkamar= $row['jumlah_kamar'];
                        $jumlahmeja= $row['jumlah_meja'];
                        $jumlahsaranalayanan= $row['jumlah_sarana_layanan'];
                        $jumlahlantai= $row['jumlah_lantai'];
                        $kebutuhankeamanantambahan= $row['kebutuhan_keamanan_tambahan'];
                        $potensikecelakaan= $row['potensi_kecelakaan'];
                        $kebutuhantenagamedisdarurat= $row['kebutuhan_tenaga_medis_darurat'];

                        $totalluaslahan = $totalluaslahan + $luaslahan;
                        $totaldayatampung = $totaldayatampung + $dayatampung;
                        $totaljumlahpembangkit = $totaljumlahpembangkit + $jumlahpembangkit;
                        $totalkapasitaspemakaian = $totalkapasitaspemakaian + $kapasitaspemakaian;
                        $totalsumberdaya = $totalsumberdaya + $sumberdaya;
                        $totaljumlahkamar = $totaljumlahkamar + $jumlahkamar;
                        $totaljumlahmeja = $totaljumlahmeja + $jumlahmeja;
                        $totaljumlahsaranalayanan = $totaljumlahsaranalayanan + $jumlahsaranalayanan;
                        $totaljumlahlantai = $totaljumlahlantai + $jumlahlantai;
                        $totalkebutuhankeamanantambahan = $totalkebutuhankeamanantambahan + $kebutuhankeamanantambahan;
                        $totalpotensikecelakaan = $totalpotensikecelakaan + $potensikecelakaan;
                        $totalkebutuhantenagamedisdarurat = $totalkebutuhantenagamedisdarurat + $kebutuhantenagamedisdarurat;
                        break;

                    }
                    else {
                        $no++;
                    }
                }

                $c1baruluaslahan = $totalluaslahan / $jumlahclusterluaslahan;
                $c1barudayatampung = $totaldayatampung / $jumlahclusterdayatampung;
                $c1barujumlahpembangkit = $totaljumlahpembangkit / $jumlahclusterpembangkit;
                $c1barukapasitaspemakaian = $totalkapasitaspemakaian / $jumlahclusterkapasitaspemakaian;
                $c1barusumberdaya = $totalsumberdaya / $jumlahclustersumberdaya;
                $c1barujumlahkamar = $totaljumlahkamar / $jumlahclusterjumlahkamar;
                $c1barujumlahmeja = $totaljumlahmeja / $jumlahclusterjumlahmeja;
                $c1barujumlahsaranalayanan = $totaljumlahsaranalayanan / $jumlahclusterjumlahsaranalayanan;
                $c1barujumlahlantai = $totaljumlahlantai / $jumlahclusterjumlahlantai;
                $c1barukebutuhankeamanantambahan = $totalkebutuhankeamanantambahan / $jumlahclusterkebutuhankeamanantambahan;
                $c1barupotensikecelakaan = $totalpotensikecelakaan / $jumlahclusterpotensikecelakaan;
                $c1barukebutuhantenagamedisdarurat = $totalkebutuhantenagamedisdarurat / $jumlahclusterkebutuhantenagamedisdarurat;

            }
            
            elseif ($akar2 == (min($akar1, $akar2, $akar3, $akar4, $akar5, $akar6, $akar7, $akar8)))
            {
                $cluster='2';

                $resultView .= "<td>".
                $akar2."</td>
                <td>".
                $cluster."
                </td></tr>";

                $jumlahcluster2luaslahan++;
                $jumlahcluster2dayatampung++;
                $jumlahcluster2pembangkit++;
                $jumlahcluster2kapasitaspemakaian++;
                $jumlahcluster2sumberdaya++;
                $jumlahcluster2jumlahkamar++;
                $jumlahcluster2jumlahmeja++;
                $jumlahcluster2jumlahsaranalayanan++;
                $jumlahcluster2jumlahlantai++;
                $jumlahcluster2kebutuhankeamanantambahan++;
                $jumlahcluster2potensikecelakaan++;
                $jumlahcluster2kebutuhantenagamedisdarurat++;

                // $sql9 = $this->db->query( "SELECT * FROM tb_kriteria WHERE no = $i");
                $no=0;
                foreach ($sql->toArray() as $row) 
                {
                    if($i==$no) {
                        $luaslahan= $row['luas_lahan'];
                        $dayatampung= $row['daya_tampung'];
                        $jumlahpembangkit= $row['jumlah_pembangkit'];
                        $kapasitaspemakaian= $row['kapasitas_pemakaian'];
                        $sumberdaya= $row['sumber_daya'];
                        $jumlahkamar= $row['jumlah_kamar'];
                        $jumlahmeja= $row['jumlah_meja'];
                        $jumlahsaranalayanan= $row['jumlah_sarana_layanan'];
                        $jumlahlantai= $row['jumlah_lantai'];
                        $kebutuhankeamanantambahan= $row['kebutuhan_keamanan_tambahan'];
                        $potensikecelakaan= $row['potensi_kecelakaan'];
                        $kebutuhantenagamedisdarurat= $row['kebutuhan_tenaga_medis_darurat'];

                        $totalluaslahan1 = $totalluaslahan1 + $luaslahan;
                        $totaldayatampung1 = $totaldayatampung1 + $dayatampung;
                        $totaljumlahpembangkit1 = $totaljumlahpembangkit1 + $jumlahpembangkit;
                        $totalkapasitaspemakaian1 = $totalkapasitaspemakaian1 + $kapasitaspemakaian;
                        $totalsumberdaya1 = $totalsumberdaya1 + $sumberdaya;
                        $totaljumlahkamar1 = $totaljumlahkamar1 + $jumlahkamar;
                        $totaljumlahmeja1 = $totaljumlahmeja1 + $jumlahmeja;
                        $totaljumlahsaranalayanan1 = $totaljumlahsaranalayanan1 + $jumlahsaranalayanan;
                        $totaljumlahlantai1 = $totaljumlahlantai1 + $jumlahlantai;
                        $totalkebutuhankeamanantambahan1 = $totalkebutuhankeamanantambahan1 + $kebutuhankeamanantambahan;
                        $totalpotensikecelakaan1 = $totalpotensikecelakaan1 + $potensikecelakaan;
                        $totalkebutuhantenagamedisdarurat1 = $totalkebutuhantenagamedisdarurat1 + $kebutuhantenagamedisdarurat;
                        break;

                    }
                    else {
                        $no++;
                    }

                }

                $c2baruluaslahan = $totalluaslahan1 / $jumlahcluster2luaslahan;
                $c2barudayatampung = $totaldayatampung1 / $jumlahcluster2dayatampung;
                $c2barujumlahpembangkit = $totaljumlahpembangkit1 / $jumlahcluster2pembangkit;
                $c2barukapasitaspemakaian = $totalkapasitaspemakaian1 / $jumlahcluster2kapasitaspemakaian;
                $c2barusumberdaya = $totalsumberdaya1 / $jumlahcluster2sumberdaya;
                $c2barujumlahkamar = $totaljumlahkamar1 / $jumlahcluster2jumlahkamar;
                $c2barujumlahmeja = $totaljumlahmeja1 / $jumlahcluster2jumlahmeja;
                $c2barujumlahsaranalayanan = $totaljumlahsaranalayanan1 / $jumlahcluster2jumlahsaranalayanan;
                $c2barujumlahlantai = $totaljumlahlantai1 / $jumlahcluster2jumlahlantai;
                $c2barukebutuhankeamanantambahan = $totalkebutuhankeamanantambahan1 / $jumlahcluster2kebutuhankeamanantambahan;
                $c2barupotensikecelakaan = $totalpotensikecelakaan1 / $jumlahcluster2potensikecelakaan;
                $c2barukebutuhantenagamedisdarurat = $totalkebutuhantenagamedisdarurat1 / $jumlahcluster2kebutuhantenagamedisdarurat;
                
            }

            elseif ($akar3 == (min($akar1, $akar2, $akar3, $akar4, $akar5, $akar6, $akar7, $akar8)))
            {
                $cluster='3';

                $resultView .= "<td>".
                $akar3."</td>
                <td>".
                $cluster."
                </td></tr>";

                $jumlahcluster3luaslahan++;
                $jumlahcluster3dayatampung++;
                $jumlahcluster3pembangkit++;
                $jumlahcluster3kapasitaspemakaian++;
                $jumlahcluster3sumberdaya++;
                $jumlahcluster3jumlahkamar++;
                $jumlahcluster3jumlahmeja++;
                $jumlahcluster3jumlahsaranalayanan++;
                $jumlahcluster3jumlahlantai++;
                $jumlahcluster3kebutuhankeamanantambahan++;
                $jumlahcluster3potensikecelakaan++;
                $jumlahcluster3kebutuhantenagamedisdarurat++;

                // $sql9 = $this->db->query( "SELECT * FROM tb_kriteria WHERE no = $i");
                $no=0;
                foreach ($sql->toArray() as $row) 
                {
                    if($i==$no) {
                        $luaslahan= $row['luas_lahan'];
                        $dayatampung= $row['daya_tampung'];
                        $jumlahpembangkit= $row['jumlah_pembangkit'];
                        $kapasitaspemakaian= $row['kapasitas_pemakaian'];
                        $sumberdaya= $row['sumber_daya'];
                        $jumlahkamar= $row['jumlah_kamar'];
                        $jumlahmeja= $row['jumlah_meja'];
                        $jumlahsaranalayanan= $row['jumlah_sarana_layanan'];
                        $jumlahlantai= $row['jumlah_lantai'];
                        $kebutuhankeamanantambahan= $row['kebutuhan_keamanan_tambahan'];
                        $potensikecelakaan= $row['potensi_kecelakaan'];
                        $kebutuhantenagamedisdarurat= $row['kebutuhan_tenaga_medis_darurat'];

                        $totalluaslahan2 = $totalluaslahan2 + $luaslahan;
                        $totaldayatampung2 = $totaldayatampung2 + $dayatampung;
                        $totaljumlahpembangkit2 = $totaljumlahpembangkit2 + $jumlahpembangkit;
                        $totalkapasitaspemakaian2 = $totalkapasitaspemakaian2 + $kapasitaspemakaian;
                        $totalsumberdaya2 = $totalsumberdaya2 + $sumberdaya;
                        $totaljumlahkamar2 = $totaljumlahkamar2 + $jumlahkamar;
                        $totaljumlahmeja2 = $totaljumlahmeja2 + $jumlahmeja;
                        $totaljumlahsaranalayanan2 = $totaljumlahsaranalayanan2 + $jumlahsaranalayanan;
                        $totaljumlahlantai2 = $totaljumlahlantai2 + $jumlahlantai;
                        $totalkebutuhankeamanantambahan2 = $totalkebutuhankeamanantambahan2 + $kebutuhankeamanantambahan;
                        $totalpotensikecelakaan2 = $totalpotensikecelakaan2 + $potensikecelakaan;
                        $totalkebutuhantenagamedisdarurat2 = $totalkebutuhantenagamedisdarurat2 + $kebutuhantenagamedisdarurat;
                        break;

                    }
                    else {
                        $no++;
                    }

                }

                $c3baruluaslahan = $totalluaslahan2 / $jumlahcluster3luaslahan;
                $c3barudayatampung = $totaldayatampung2 / $jumlahcluster3dayatampung;
                $c3barujumlahpembangkit = $totaljumlahpembangkit2 / $jumlahcluster3pembangkit;
                $c3barukapasitaspemakaian = $totalkapasitaspemakaian2 / $jumlahcluster3kapasitaspemakaian;
                $c3barusumberdaya = $totalsumberdaya2 / $jumlahcluster3sumberdaya;
                $c3barujumlahkamar = $totaljumlahkamar2 / $jumlahcluster3jumlahkamar;
                $c3barujumlahmeja = $totaljumlahmeja2 / $jumlahcluster3jumlahmeja;
                $c3barujumlahsaranalayanan = $totaljumlahsaranalayanan2 / $jumlahcluster3jumlahsaranalayanan;
                $c3barujumlahlantai = $totaljumlahlantai2 / $jumlahcluster3jumlahlantai;
                $c3barukebutuhankeamanantambahan = $totalkebutuhankeamanantambahan2 / $jumlahcluster3kebutuhankeamanantambahan;
                $c3barupotensikecelakaan = $totalpotensikecelakaan2 / $jumlahcluster3potensikecelakaan;
                $c3barukebutuhantenagamedisdarurat = $totalkebutuhantenagamedisdarurat2 / $jumlahcluster3kebutuhantenagamedisdarurat;

            }

            elseif ($akar4 == (min($akar1, $akar2, $akar3, $akar4, $akar5, $akar6, $akar7, $akar8)))
            {
                $cluster='4';

                $resultView .= "<td>".
                $akar4."</td>
                <td>".
                $cluster."
                </td></tr>";

                $jumlahcluster4luaslahan++;
                $jumlahcluster4dayatampung++;
                $jumlahcluster4pembangkit++;
                $jumlahcluster4kapasitaspemakaian++;
                $jumlahcluster4sumberdaya++;
                $jumlahcluster4jumlahkamar++;
                $jumlahcluster4jumlahmeja++;
                $jumlahcluster4jumlahsaranalayanan++;
                $jumlahcluster4jumlahlantai++;
                $jumlahcluster4kebutuhankeamanantambahan++;
                $jumlahcluster4potensikecelakaan++;
                $jumlahcluster4kebutuhantenagamedisdarurat++;

                // $sql9 = $this->db->query( "SELECT * FROM tb_kriteria WHERE no = $i");
                $no=0;
                foreach ($sql->toArray() as $row) 
                {
                    if($i==$no) {
                        $luaslahan= $row['luas_lahan'];
                        $dayatampung= $row['daya_tampung'];
                        $jumlahpembangkit= $row['jumlah_pembangkit'];
                        $kapasitaspemakaian= $row['kapasitas_pemakaian'];
                        $sumberdaya= $row['sumber_daya'];
                        $jumlahkamar= $row['jumlah_kamar'];
                        $jumlahmeja= $row['jumlah_meja'];
                        $jumlahsaranalayanan= $row['jumlah_sarana_layanan'];
                        $jumlahlantai= $row['jumlah_lantai'];
                        $kebutuhankeamanantambahan= $row['kebutuhan_keamanan_tambahan'];
                        $potensikecelakaan= $row['potensi_kecelakaan'];
                        $kebutuhantenagamedisdarurat= $row['kebutuhan_tenaga_medis_darurat'];

                        $totalluaslahan3 = $totalluaslahan3 + $luaslahan;
                        $totaldayatampung3 = $totaldayatampung3 + $dayatampung;
                        $totaljumlahpembangkit3 = $totaljumlahpembangkit3 + $jumlahpembangkit;
                        $totalkapasitaspemakaian3 = $totalkapasitaspemakaian3 + $kapasitaspemakaian;
                        $totalsumberdaya3 = $totalsumberdaya3 + $sumberdaya;
                        $totaljumlahkamar3 = $totaljumlahkamar3 + $jumlahkamar;
                        $totaljumlahmeja3 = $totaljumlahmeja3 + $jumlahmeja;
                        $totaljumlahsaranalayanan3 = $totaljumlahsaranalayanan3 + $jumlahsaranalayanan;
                        $totaljumlahlantai3 = $totaljumlahlantai3 + $jumlahlantai;
                        $totalkebutuhankeamanantambahan3 = $totalkebutuhankeamanantambahan3 + $kebutuhankeamanantambahan;
                        $totalpotensikecelakaan3 = $totalpotensikecelakaan3 + $potensikecelakaan;
                        $totalkebutuhantenagamedisdarurat3 = $totalkebutuhantenagamedisdarurat3 + $kebutuhantenagamedisdarurat;
                        break;

                    }
                    else {
                        $no++;
                    }

                }

                $c4baruluaslahan = $totalluaslahan3 / $jumlahcluster4luaslahan;
                $c4barudayatampung = $totaldayatampung3 / $jumlahcluster4dayatampung;
                $c4barujumlahpembangkit = $totaljumlahpembangkit3 / $jumlahcluster4pembangkit;
                $c4barukapasitaspemakaian = $totalkapasitaspemakaian3 / $jumlahcluster4kapasitaspemakaian;
                $c4barusumberdaya = $totalsumberdaya3 / $jumlahcluster4sumberdaya;
                $c4barujumlahkamar = $totaljumlahkamar3 / $jumlahcluster4jumlahkamar;
                $c4barujumlahmeja = $totaljumlahmeja3 / $jumlahcluster4jumlahmeja;
                $c4barujumlahsaranalayanan = $totaljumlahsaranalayanan3 / $jumlahcluster4jumlahsaranalayanan;
                $c4barujumlahlantai = $totaljumlahlantai3 / $jumlahcluster4jumlahlantai;
                $c4barukebutuhankeamanantambahan = $totalkebutuhankeamanantambahan3 / $jumlahcluster4kebutuhankeamanantambahan;
                $c4barupotensikecelakaan = $totalpotensikecelakaan3 / $jumlahcluster4potensikecelakaan;
                $c4barukebutuhantenagamedisdarurat = $totalkebutuhantenagamedisdarurat3 / $jumlahcluster4kebutuhantenagamedisdarurat;

            }

            elseif ($akar5 == (min($akar1, $akar2, $akar3, $akar4, $akar5, $akar6, $akar7, $akar8)))
            {
                $cluster='5';

                $resultView .= "<td>".
                $akar5."</td>
                <td>".
                $cluster."
                </td></tr>";

                $jumlahcluster5luaslahan++;
                $jumlahcluster5dayatampung++;
                $jumlahcluster5pembangkit++;
                $jumlahcluster5kapasitaspemakaian++;
                $jumlahcluster5sumberdaya++;
                $jumlahcluster5jumlahkamar++;
                $jumlahcluster5jumlahmeja++;
                $jumlahcluster5jumlahsaranalayanan++;
                $jumlahcluster5jumlahlantai++;
                $jumlahcluster5kebutuhankeamanantambahan++;
                $jumlahcluster5potensikecelakaan++;
                $jumlahcluster5kebutuhantenagamedisdarurat++;

                // $sql9 = $this->db->query( "SELECT * FROM tb_kriteria WHERE no = $i");
                $no=0;
                foreach ($sql->toArray() as $row) 
                {
                    if($i==$no) {
                        $luaslahan= $row['luas_lahan'];
                        $dayatampung= $row['daya_tampung'];
                        $jumlahpembangkit= $row['jumlah_pembangkit'];
                        $kapasitaspemakaian= $row['kapasitas_pemakaian'];
                        $sumberdaya= $row['sumber_daya'];
                        $jumlahkamar= $row['jumlah_kamar'];
                        $jumlahmeja= $row['jumlah_meja'];
                        $jumlahsaranalayanan= $row['jumlah_sarana_layanan'];
                        $jumlahlantai= $row['jumlah_lantai'];
                        $kebutuhankeamanantambahan= $row['kebutuhan_keamanan_tambahan'];
                        $potensikecelakaan= $row['potensi_kecelakaan'];
                        $kebutuhantenagamedisdarurat= $row['kebutuhan_tenaga_medis_darurat'];

                        $totalluaslahan4 = $totalluaslahan4 + $luaslahan;
                        $totaldayatampung4 = $totaldayatampung4 + $dayatampung;
                        $totaljumlahpembangkit4 = $totaljumlahpembangkit4 + $jumlahpembangkit;
                        $totalkapasitaspemakaian4 = $totalkapasitaspemakaian4 + $kapasitaspemakaian;
                        $totalsumberdaya4 = $totalsumberdaya4 + $sumberdaya;
                        $totaljumlahkamar4 = $totaljumlahkamar4 + $jumlahkamar;
                        $totaljumlahmeja4 = $totaljumlahmeja4 + $jumlahmeja;
                        $totaljumlahsaranalayanan4 = $totaljumlahsaranalayanan4 + $jumlahsaranalayanan;
                        $totaljumlahlantai4 = $totaljumlahlantai4 + $jumlahlantai;
                        $totalkebutuhankeamanantambahan4 = $totalkebutuhankeamanantambahan4 + $kebutuhankeamanantambahan;
                        $totalpotensikecelakaan4 = $totalpotensikecelakaan4 + $potensikecelakaan;
                        $totalkebutuhantenagamedisdarurat4 = $totalkebutuhantenagamedisdarurat4 + $kebutuhantenagamedisdarurat;
                        break;

                    }
                    else {
                        $no++;
                    }

                }

                $c5baruluaslahan = $totalluaslahan4 / $jumlahcluster5luaslahan;
                $c5barudayatampung = $totaldayatampung4 / $jumlahcluster5dayatampung;
                $c5barujumlahpembangkit = $totaljumlahpembangkit4 / $jumlahcluster5pembangkit;
                $c5barukapasitaspemakaian = $totalkapasitaspemakaian4 / $jumlahcluster5kapasitaspemakaian;
                $c5barusumberdaya = $totalsumberdaya4 / $jumlahcluster5sumberdaya;
                $c5barujumlahkamar = $totaljumlahkamar4 / $jumlahcluster5jumlahkamar;
                $c5barujumlahmeja = $totaljumlahmeja4 / $jumlahcluster5jumlahmeja;
                $c5barujumlahsaranalayanan = $totaljumlahsaranalayanan4 / $jumlahcluster5jumlahsaranalayanan;
                $c5barujumlahlantai = $totaljumlahlantai4 / $jumlahcluster5jumlahlantai;
                $c5barukebutuhankeamanantambahan = $totalkebutuhankeamanantambahan4 / $jumlahcluster5kebutuhankeamanantambahan;
                $c5barupotensikecelakaan = $totalpotensikecelakaan4 / $jumlahcluster5potensikecelakaan;
                $c5barukebutuhantenagamedisdarurat = $totalkebutuhantenagamedisdarurat4 / $jumlahcluster5kebutuhantenagamedisdarurat;

            }

            elseif ($akar6 == (min($akar1, $akar2, $akar3, $akar4, $akar5, $akar6, $akar7, $akar8)))
            {
                $cluster='6';

                $resultView .= "<td>".
                $akar6."</td>
                <td>".
                $cluster."
                </td></tr>";

                $jumlahcluster6luaslahan++;
                $jumlahcluster6dayatampung++;
                $jumlahcluster6pembangkit++;
                $jumlahcluster6kapasitaspemakaian++;
                $jumlahcluster6sumberdaya++;
                $jumlahcluster6jumlahkamar++;
                $jumlahcluster6jumlahmeja++;
                $jumlahcluster6jumlahsaranalayanan++;
                $jumlahcluster6jumlahlantai++;
                $jumlahcluster6kebutuhankeamanantambahan++;
                $jumlahcluster6potensikecelakaan++;
                $jumlahcluster6kebutuhantenagamedisdarurat++;

                // $sql9 = $this->db->query( "SELECT * FROM tb_kriteria WHERE no = $i");
                $no=0;
                foreach ($sql->toArray() as $row) 
                {
                    if($i==$no) {
                        $luaslahan= $row['luas_lahan'];
                        $dayatampung= $row['daya_tampung'];
                        $jumlahpembangkit= $row['jumlah_pembangkit'];
                        $kapasitaspemakaian= $row['kapasitas_pemakaian'];
                        $sumberdaya= $row['sumber_daya'];
                        $jumlahkamar= $row['jumlah_kamar'];
                        $jumlahmeja= $row['jumlah_meja'];
                        $jumlahsaranalayanan= $row['jumlah_sarana_layanan'];
                        $jumlahlantai= $row['jumlah_lantai'];
                        $kebutuhankeamanantambahan= $row['kebutuhan_keamanan_tambahan'];
                        $potensikecelakaan= $row['potensi_kecelakaan'];
                        $kebutuhantenagamedisdarurat= $row['kebutuhan_tenaga_medis_darurat'];

                        $totalluaslahan5 = $totalluaslahan5 + $luaslahan;
                        $totaldayatampung5 = $totaldayatampung5 + $dayatampung;
                        $totaljumlahpembangkit5 = $totaljumlahpembangkit5 + $jumlahpembangkit;
                        $totalkapasitaspemakaian5 = $totalkapasitaspemakaian5 + $kapasitaspemakaian;
                        $totalsumberdaya5 = $totalsumberdaya5 + $sumberdaya;
                        $totaljumlahkamar5 = $totaljumlahkamar5 + $jumlahkamar;
                        $totaljumlahmeja5 = $totaljumlahmeja5 + $jumlahmeja;
                        $totaljumlahsaranalayanan5 = $totaljumlahsaranalayanan5 + $jumlahsaranalayanan;
                        $totaljumlahlantai5 = $totaljumlahlantai5 + $jumlahlantai;
                        $totalkebutuhankeamanantambahan5 = $totalkebutuhankeamanantambahan5 + $kebutuhankeamanantambahan;
                        $totalpotensikecelakaan5 = $totalpotensikecelakaan5 + $potensikecelakaan;
                        $totalkebutuhantenagamedisdarurat5 = $totalkebutuhantenagamedisdarurat5 + $kebutuhantenagamedisdarurat;
                        break;

                    }
                    else {
                        $no++;
                    }

                }

                $c6baruluaslahan = $totalluaslahan5 / $jumlahcluster6luaslahan;
                $c6barudayatampung = $totaldayatampung5 / $jumlahcluster6dayatampung;
                $c6barujumlahpembangkit = $totaljumlahpembangkit5 / $jumlahcluster6pembangkit;
                $c6barukapasitaspemakaian = $totalkapasitaspemakaian5 / $jumlahcluster6kapasitaspemakaian;
                $c6barusumberdaya = $totalsumberdaya5 / $jumlahcluster6sumberdaya;
                $c6barujumlahkamar = $totaljumlahkamar5 / $jumlahcluster6jumlahkamar;
                $c6barujumlahmeja = $totaljumlahmeja5 / $jumlahcluster6jumlahmeja;
                $c6barujumlahsaranalayanan = $totaljumlahsaranalayanan5 / $jumlahcluster6jumlahsaranalayanan;
                $c6barujumlahlantai = $totaljumlahlantai5 / $jumlahcluster6jumlahlantai;
                $c6barukebutuhankeamanantambahan = $totalkebutuhankeamanantambahan5 / $jumlahcluster6kebutuhankeamanantambahan;
                $c6barupotensikecelakaan = $totalpotensikecelakaan5 / $jumlahcluster6potensikecelakaan;
                $c6barukebutuhantenagamedisdarurat = $totalkebutuhantenagamedisdarurat5 / $jumlahcluster6kebutuhantenagamedisdarurat;

            }

            elseif ($akar7 == (min($akar1, $akar2, $akar3, $akar4, $akar5, $akar6, $akar7, $akar8)))
            {
                $cluster='7';

                $resultView .= "<td>".
                $akar7."</td>
                <td>".
                $cluster."
                </td></tr>";

                $jumlahcluster7luaslahan++;
                $jumlahcluster7dayatampung++;
                $jumlahcluster7pembangkit++;
                $jumlahcluster7kapasitaspemakaian++;
                $jumlahcluster7sumberdaya++;
                $jumlahcluster7jumlahkamar++;
                $jumlahcluster7jumlahmeja++;
                $jumlahcluster7jumlahsaranalayanan++;
                $jumlahcluster7jumlahlantai++;
                $jumlahcluster7kebutuhankeamanantambahan++;
                $jumlahcluster7potensikecelakaan++;
                $jumlahcluster7kebutuhantenagamedisdarurat++;

                // $sql9 = $this->db->query( "SELECT * FROM tb_kriteria WHERE no = $i");
                $no=0;
                foreach ($sql->toArray() as $row) 
                {
                    if($i==$no) {
                        $luaslahan= $row['luas_lahan'];
                        $dayatampung= $row['daya_tampung'];
                        $jumlahpembangkit= $row['jumlah_pembangkit'];
                        $kapasitaspemakaian= $row['kapasitas_pemakaian'];
                        $sumberdaya= $row['sumber_daya'];
                        $jumlahkamar= $row['jumlah_kamar'];
                        $jumlahmeja= $row['jumlah_meja'];
                        $jumlahsaranalayanan= $row['jumlah_sarana_layanan'];
                        $jumlahlantai= $row['jumlah_lantai'];
                        $kebutuhankeamanantambahan= $row['kebutuhan_keamanan_tambahan'];
                        $potensikecelakaan= $row['potensi_kecelakaan'];
                        $kebutuhantenagamedisdarurat= $row['kebutuhan_tenaga_medis_darurat'];

                        $totalluaslahan6 = $totalluaslahan6 + $luaslahan;
                        $totaldayatampung6 = $totaldayatampung6 + $dayatampung;
                        $totaljumlahpembangkit6 = $totaljumlahpembangkit6 + $jumlahpembangkit;
                        $totalkapasitaspemakaian6 = $totalkapasitaspemakaian6 + $kapasitaspemakaian;
                        $totalsumberdaya6 = $totalsumberdaya6 + $sumberdaya;
                        $totaljumlahkamar6 = $totaljumlahkamar6 + $jumlahkamar;
                        $totaljumlahmeja6 = $totaljumlahmeja6 + $jumlahmeja;
                        $totaljumlahsaranalayanan6 = $totaljumlahsaranalayanan6 + $jumlahsaranalayanan;
                        $totaljumlahlantai6 = $totaljumlahlantai6 + $jumlahlantai;
                        $totalkebutuhankeamanantambahan6 = $totalkebutuhankeamanantambahan6 + $kebutuhankeamanantambahan;
                        $totalpotensikecelakaan6 = $totalpotensikecelakaan6 + $potensikecelakaan;
                        $totalkebutuhantenagamedisdarurat6 = $totalkebutuhantenagamedisdarurat6 + $kebutuhantenagamedisdarurat;
                        break;

                    }
                    else {
                        $no++;
                    }

                }

                $c7baruluaslahan = $totalluaslahan6 / $jumlahcluster7luaslahan;
                $c7barudayatampung = $totaldayatampung6 / $jumlahcluster7dayatampung;
                $c7barujumlahpembangkit = $totaljumlahpembangkit6 / $jumlahcluster7pembangkit;
                $c7barukapasitaspemakaian = $totalkapasitaspemakaian6 / $jumlahcluster7kapasitaspemakaian;
                $c7barusumberdaya = $totalsumberdaya6 / $jumlahcluster7sumberdaya;
                $c7barujumlahkamar = $totaljumlahkamar6 / $jumlahcluster7jumlahkamar;
                $c7barujumlahmeja = $totaljumlahmeja6 / $jumlahcluster7jumlahmeja;
                $c7barujumlahsaranalayanan = $totaljumlahsaranalayanan6 / $jumlahcluster7jumlahsaranalayanan;
                $c7barujumlahlantai = $totaljumlahlantai6 / $jumlahcluster7jumlahlantai;
                $c7barukebutuhankeamanantambahan = $totalkebutuhankeamanantambahan6 / $jumlahcluster7kebutuhankeamanantambahan;
                $c7barupotensikecelakaan = $totalpotensikecelakaan6 / $jumlahcluster7potensikecelakaan;
                $c7barukebutuhantenagamedisdarurat = $totalkebutuhantenagamedisdarurat6 / $jumlahcluster7kebutuhantenagamedisdarurat;

            }

            else
            {
                $cluster='8';

                $resultView .= "<td>".
                $akar8."</td>
                <td>".
                $cluster."
                </td></tr>";

                $jumlahcluster8luaslahan++;
                $jumlahcluster8dayatampung++;
                $jumlahcluster8pembangkit++;
                $jumlahcluster8kapasitaspemakaian++;
                $jumlahcluster8sumberdaya++;
                $jumlahcluster8jumlahkamar++;
                $jumlahcluster8jumlahmeja++;
                $jumlahcluster8jumlahsaranalayanan++;
                $jumlahcluster8jumlahlantai++;
                $jumlahcluster8kebutuhankeamanantambahan++;
                $jumlahcluster8potensikecelakaan++;
                $jumlahcluster8kebutuhantenagamedisdarurat++;

                // $sql9 = $this->db->query( "SELECT * FROM tb_kriteria WHERE no = $i");
                $no=0;
                foreach ($sql->toArray() as $row) 
                {
                    if($i==$no) {
                        $luaslahan= $row['luas_lahan'];
                        $dayatampung= $row['daya_tampung'];
                        $jumlahpembangkit= $row['jumlah_pembangkit'];
                        $kapasitaspemakaian= $row['kapasitas_pemakaian'];
                        $sumberdaya= $row['sumber_daya'];
                        $jumlahkamar= $row['jumlah_kamar'];
                        $jumlahmeja= $row['jumlah_meja'];
                        $jumlahsaranalayanan= $row['jumlah_sarana_layanan'];
                        $jumlahlantai= $row['jumlah_lantai'];
                        $kebutuhankeamanantambahan= $row['kebutuhan_keamanan_tambahan'];
                        $potensikecelakaan= $row['potensi_kecelakaan'];
                        $kebutuhantenagamedisdarurat= $row['kebutuhan_tenaga_medis_darurat'];

                        $totalluaslahan7 = $totalluaslahan7 + $luaslahan;
                        $totaldayatampung7 = $totaldayatampung7 + $dayatampung;
                        $totaljumlahpembangkit7 = $totaljumlahpembangkit7 + $jumlahpembangkit;
                        $totalkapasitaspemakaian7 = $totalkapasitaspemakaian7 + $kapasitaspemakaian;
                        $totalsumberdaya7 = $totalsumberdaya7 + $sumberdaya;
                        $totaljumlahkamar7 = $totaljumlahkamar7 + $jumlahkamar;
                        $totaljumlahmeja7 = $totaljumlahmeja7 + $jumlahmeja;
                        $totaljumlahsaranalayanan7 = $totaljumlahsaranalayanan7 + $jumlahsaranalayanan;
                        $totaljumlahlantai7 = $totaljumlahlantai7 + $jumlahlantai;
                        $totalkebutuhankeamanantambahan7 = $totalkebutuhankeamanantambahan7 + $kebutuhankeamanantambahan;
                        $totalpotensikecelakaan7 = $totalpotensikecelakaan7 + $potensikecelakaan;
                        $totalkebutuhantenagamedisdarurat7 = $totalkebutuhantenagamedisdarurat7 + $kebutuhantenagamedisdarurat;
                        break;

                    }
                    else {
                        $no++;
                    }

                }

                $c8baruluaslahan = $totalluaslahan7 / $jumlahcluster8luaslahan;
                $c8barudayatampung = $totaldayatampung7 / $jumlahcluster8dayatampung;
                $c8barujumlahpembangkit = $totaljumlahpembangkit7 / $jumlahcluster8pembangkit;
                $c8barukapasitaspemakaian = $totalkapasitaspemakaian7 / $jumlahcluster8kapasitaspemakaian;
                $c8barusumberdaya = $totalsumberdaya7 / $jumlahcluster8sumberdaya;
                $c8barujumlahkamar = $totaljumlahkamar7 / $jumlahcluster8jumlahkamar;
                $c8barujumlahmeja = $totaljumlahmeja7 / $jumlahcluster8jumlahmeja;
                $c8barujumlahsaranalayanan = $totaljumlahsaranalayanan7 / $jumlahcluster8jumlahsaranalayanan;
                $c8barujumlahlantai = $totaljumlahlantai7 / $jumlahcluster8jumlahlantai;
                $c8barukebutuhankeamanantambahan = $totalkebutuhankeamanantambahan7 / $jumlahcluster8kebutuhankeamanantambahan;
                $c8barupotensikecelakaan = $totalpotensikecelakaan7 / $jumlahcluster8potensikecelakaan;
                $c8barukebutuhantenagamedisdarurat = $totalkebutuhantenagamedisdarurat7 / $jumlahcluster8kebutuhantenagamedisdarurat;

            }

            // menampung hasil cluster dari 1 iterasi
            $temp_cluster[] = $cluster;

        }  
        
        $resultView .= "</table><br><br>" ;
        // menyimpan cluster untuk seluruh iterasi
        $cluster_iterasi[$noiterasi] = $temp_cluster;
        
        //variabel baru untuk centroid 1 baru
        $c1['luas_lahan'] = $c1baruluaslahan;
        $c1['daya_tampung'] = $c1barudayatampung; 
        $c1['jumlah_pembangkit'] = $c1barujumlahpembangkit;
        $c1['kapasitas_pemakaian'] = $c1barukapasitaspemakaian;
        $c1['sumber_daya'] = $c1barusumberdaya;
        $c1['jumlah_kamar'] = $c1barujumlahkamar;
        $c1['jumlah_meja'] = $c1barujumlahmeja;
        $c1['jumlah_sarana_layanan'] = $c1barujumlahsaranalayanan;
        $c1['jumlah_lantai'] = $c1barujumlahlantai;
        $c1['kebutuhan_keamanan_tambahan'] = $c1barukebutuhankeamanantambahan;
        $c1['potensi_kecelakaan'] = $c1barupotensikecelakaan;
        $c1['kebutuhan_tenaga_medis_darurat'] = $c1barukebutuhantenagamedisdarurat;

        // variabel baru untuk centroid 2 baru
        $c2['luas_lahan'] = $c2baruluaslahan;
        $c2['daya_tampung'] = $c2barudayatampung; 
        $c2['jumlah_pembangkit'] = $c2barujumlahpembangkit;
        $c2['kapasitas_pemakaian'] = $c2barukapasitaspemakaian;
        $c2['sumber_daya'] = $c2barusumberdaya;
        $c2['jumlah_kamar'] = $c2barujumlahkamar;
        $c2['jumlah_meja'] = $c2barujumlahmeja;
        $c2['jumlah_sarana_layanan'] = $c2barujumlahsaranalayanan;
        $c2['jumlah_lantai'] = $c2barujumlahlantai;
        $c2['kebutuhan_keamanan_tambahan'] = $c2barukebutuhankeamanantambahan;
        $c2['potensi_kecelakaan'] = $c2barupotensikecelakaan;
        $c2['kebutuhan_tenaga_medis_darurat'] = $c2barukebutuhantenagamedisdarurat;

        // variabel baru untuk centroid 3 baru
        $c3['luas_lahan'] = $c3baruluaslahan;
        $c3['daya_tampung'] = $c3barudayatampung; 
        $c3['jumlah_pembangkit'] = $c3barujumlahpembangkit;
        $c3['kapasitas_pemakaian'] = $c3barukapasitaspemakaian;
        $c3['sumber_daya'] = $c3barusumberdaya;
        $c3['jumlah_kamar'] = $c3barujumlahkamar;
        $c3['jumlah_meja'] = $c3barujumlahmeja;
        $c3['jumlah_sarana_layanan'] = $c3barujumlahsaranalayanan;
        $c3['jumlah_lantai'] = $c3barujumlahlantai;
        $c3['kebutuhan_keamanan_tambahan'] = $c3barukebutuhankeamanantambahan;
        $c3['potensi_kecelakaan'] = $c3barupotensikecelakaan;
        $c3['kebutuhan_tenaga_medis_darurat'] = $c3barukebutuhantenagamedisdarurat;

        // variabel baru untuk centroid 4 baru
        $c4['luas_lahan'] = $c4baruluaslahan;
        $c4['daya_tampung'] = $c4barudayatampung; 
        $c4['jumlah_pembangkit'] = $c4barujumlahpembangkit;
        $c4['kapasitas_pemakaian'] = $c4barukapasitaspemakaian;
        $c4['sumber_daya'] = $c4barusumberdaya;
        $c4['jumlah_kamar'] = $c4barujumlahkamar;
        $c4['jumlah_meja'] = $c4barujumlahmeja;
        $c4['jumlah_sarana_layanan'] = $c4barujumlahsaranalayanan;
        $c4['jumlah_lantai'] = $c4barujumlahlantai;
        $c4['kebutuhan_keamanan_tambahan'] = $c4barukebutuhankeamanantambahan;
        $c4['potensi_kecelakaan'] = $c4barupotensikecelakaan;
        $c4['kebutuhan_tenaga_medis_darurat'] = $c4barukebutuhantenagamedisdarurat;

        // variabel baru untuk centroid 5 baru
        $c5['luas_lahan'] = $c5baruluaslahan;
        $c5['daya_tampung'] = $c5barudayatampung; 
        $c5['jumlah_pembangkit'] = $c5barujumlahpembangkit;
        $c5['kapasitas_pemakaian'] = $c5barukapasitaspemakaian;
        $c5['sumber_daya'] = $c5barusumberdaya;
        $c5['jumlah_kamar'] = $c5barujumlahkamar;
        $c5['jumlah_meja'] = $c5barujumlahmeja;
        $c5['jumlah_sarana_layanan'] = $c5barujumlahsaranalayanan;
        $c5['jumlah_lantai'] = $c5barujumlahlantai;
        $c5['kebutuhan_keamanan_tambahan'] = $c5barukebutuhankeamanantambahan;
        $c5['potensi_kecelakaan'] = $c5barupotensikecelakaan;
        $c5['kebutuhan_tenaga_medis_darurat'] = $c5barukebutuhantenagamedisdarurat;

        // variabel baru untuk centroid 6 baru
        $c6['luas_lahan'] = $c6baruluaslahan;
        $c6['daya_tampung'] = $c6barudayatampung; 
        $c6['jumlah_pembangkit'] = $c6barujumlahpembangkit;
        $c6['kapasitas_pemakaian'] = $c6barukapasitaspemakaian;
        $c6['sumber_daya'] = $c6barusumberdaya;
        $c6['jumlah_kamar'] = $c6barujumlahkamar;
        $c6['jumlah_meja'] = $c6barujumlahmeja;
        $c6['jumlah_sarana_layanan'] = $c6barujumlahsaranalayanan;
        $c6['jumlah_lantai'] = $c6barujumlahlantai;
        $c6['kebutuhan_keamanan_tambahan'] = $c6barukebutuhankeamanantambahan;
        $c6['potensi_kecelakaan'] = $c6barupotensikecelakaan;
        $c6['kebutuhan_tenaga_medis_darurat'] = $c6barukebutuhantenagamedisdarurat;

        // variabel baru untuk centroid 7 baru
        $c7['luas_lahan'] = $c7baruluaslahan;
        $c7['daya_tampung'] = $c7barudayatampung; 
        $c7['jumlah_pembangkit'] = $c7barujumlahpembangkit;
        $c7['kapasitas_pemakaian'] = $c7barukapasitaspemakaian;
        $c7['sumber_daya'] = $c7barusumberdaya;
        $c7['jumlah_kamar'] = $c7barujumlahkamar;
        $c7['jumlah_meja'] = $c7barujumlahmeja;
        $c7['jumlah_sarana_layanan'] = $c7barujumlahsaranalayanan;
        $c7['jumlah_lantai'] = $c7barujumlahlantai;
        $c7['kebutuhan_keamanan_tambahan'] = $c7barukebutuhankeamanantambahan;
        $c7['potensi_kecelakaan'] = $c7barupotensikecelakaan;
        $c7['kebutuhan_tenaga_medis_darurat'] = $c7barukebutuhantenagamedisdarurat;

        // variabel baru untuk centroid 8 baru
        $c8['luas_lahan'] = $c8baruluaslahan;
        $c8['daya_tampung'] = $c8barudayatampung; 
        $c8['jumlah_pembangkit'] = $c8barujumlahpembangkit;
        $c8['kapasitas_pemakaian'] = $c8barukapasitaspemakaian;
        $c8['sumber_daya'] = $c8barusumberdaya;
        $c8['jumlah_kamar'] = $c8barujumlahkamar;
        $c8['jumlah_meja'] = $c8barujumlahmeja;
        $c8['jumlah_sarana_layanan'] = $c8barujumlahsaranalayanan;
        $c8['jumlah_lantai'] = $c8barujumlahlantai;
        $c8['kebutuhan_keamanan_tambahan'] = $c8barukebutuhankeamanantambahan;
        $c8['potensi_kecelakaan'] = $c8barupotensikecelakaan;
        $c8['kebutuhan_tenaga_medis_darurat'] = $c8barukebutuhantenagamedisdarurat;

        // tampilan centroid baru
        $resultView .= 'Centroid baru :';
        $resultView .= "<table class='table table-striped table-responsive'>
        <tr>
            <td>
            </td>";
        foreach ($c1 as $key => $value)
        {

            if ( $key != 'no') 
            $resultView .= "<td>". ucfirst(preg_replace('/_/', ' ', $key))."</td>";

        }
        $resultView .= "</tr>
            <tr>
            <td>
                c1 Baru
            </td>";
        foreach ($c1 as $key => $value)
        {
            if ( $key != 'no') 
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c2 Baru 
            </td>";
        foreach ($c2 as $key => $value)
        {
            if ( $key != 'no') 
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c3 Baru 
            </td>";
        foreach ($c3 as $key => $value)
        {
            if ( $key != 'no') 
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c4 Baru 
            </td>";
        foreach ($c4 as $key => $value)
        {
            if ( $key != 'no') 
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c5 Baru 
            </td>";
        foreach ($c5 as $key => $value)
        {
            if ( $key != 'no') 
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c6 Baru 
            </td>";
        foreach ($c6 as $key => $value)
        {
            if ( $key != 'no') 
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c7 Baru 
            </td>";
        foreach ($c7 as $key => $value)
        {
            if ( $key != 'no') 
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr>
            <tr>
            <td>
                c8 Baru 
            </td>";
        foreach ($c8 as $key => $value)
        {
            if ( $key != 'no') 
            $resultView .= "<td>". $value."</td>";
        }

        $resultView .= "</tr> </table> <br><br>";

            if ($noiterasi > 1)
            {
                if ($cluster_iterasi[$noiterasi] == $cluster_iterasi[$noiterasi -1]) // jika iterasi saat ini sama dengan iterasi sebelumnya
                {
                    $iterasi_terakhir = true; // tandai bahwa iterasinya menjadi iterasi terakhir
                }
            }
            
            $noiterasi++; // naikan no iterasi
            $nomor=1;
        }
        
            // memasukan hasil ke database 
            $i = 0;
            $sql=Pajak::all();
            
            foreach($sql->toArray() as $row)
            {
                $Clustering = new Clustering;
                $Clustering->no_pajak = $row['id']; 
                $Clustering->cluster = 'C'.$cluster_iterasi[$noiterasi -1][$i]; 
                $Clustering->keterangan = $this->getKeterangan($cluster_iterasi[$noiterasi -1][$i]);
        $Clustering->updated_at = date('Y-m-d h:i:s');
                $Clustering->save();
                $i++;
            }

        return $resultView;
    }

    public function setInitialValue($arrNumber, $v1, $v2, $v3, $v4, $v5, $v6, $v7, $v8, $v9, $v10, $v11, $v12)
    {
        ${'data_cluster'.$arrNumber}['luas_lahan'] = $v1;
        ${'data_cluster'.$arrNumber}['daya_tampung'] = $v2;
        ${'data_cluster'.$arrNumber}['jumlah_pembangkit'] = $v3;
        ${'data_cluster'.$arrNumber}['kapasitas_pemakaian'] = $v4;
        ${'data_cluster'.$arrNumber}['sumber_daya'] = $v5;
        ${'data_cluster'.$arrNumber}['jumlah_kamar'] = $v6;
        ${'data_cluster'.$arrNumber}['jumlah_meja'] = $v7;
        ${'data_cluster'.$arrNumber}['jumlah_sarana_layanan'] = $v8;
        ${'data_cluster'.$arrNumber}['jumlah_lantai'] = $v9;
        ${'data_cluster'.$arrNumber}['kebutuhan_keamanan_tambahan'] = $v10;
        ${'data_cluster'.$arrNumber}['potensi_kecelakaan'] = $v11;
        ${'data_cluster'.$arrNumber}['kebutuhan_tenaga_medis_darurat'] = $v12;

        return ${'data_cluster'.$arrNumber};
    }

    public function getKeterangan($cluster)
    {
        switch ($cluster) {
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
        
        return $keterangan;
    } 

    function resViewRumus()
    {
        $ret = '<div class="card-body">

        <div class="table-responsive mt-5">Klaster = 8<br><br>Centroid awal :<table class="table table-striped table-responsive">
    <tbody><tr>
        <td>
        </td><td>Luas lahan</td><td>Daya tampung</td><td>Jumlah pembangkit</td><td>Kapasitas pemakaian</td><td>Sumber daya</td><td>Jumlah kamar</td><td>Jumlah meja</td><td>Jumlah sarana layanan</td><td>Jumlah lantai</td><td>Kebutuhan keamanan tambahan</td><td>Potensi kecelakaan</td><td>Kebutuhan tenaga medis darurat</td></tr>
        <tr>
        <td>
            c1
        </td><td>11</td><td>1.1</td><td>1</td><td>13.2</td><td>1</td><td>0</td><td>0</td><td>5</td><td>1</td><td>2</td><td>2</td><td>2</td></tr>
        <tr>
        <td>
            c2
        </td><td>30</td><td>15</td><td>2</td><td>82.5</td><td>2</td><td>0</td><td>0</td><td>20</td><td>1</td><td>4</td><td>4</td><td>5</td></tr>
        <tr>
        <td>
            c3
        </td><td>0.5</td><td>0.7</td><td>0</td><td>7.7</td><td>1</td><td>0</td><td>0</td><td>10</td><td>2</td><td>1</td><td>2</td><td>1</td></tr>
        <tr>
        <td>
            c4
        </td><td>15</td><td>0.5</td><td>2</td><td>66</td><td>2</td><td>100</td><td>0</td><td>25</td><td>10</td><td>5</td><td>2</td><td>2</td></tr>
        <tr>
        <td>
            c5
        </td><td>1</td><td>0.3</td><td>0</td><td>23</td><td>1</td><td>5</td><td>0</td><td>1</td><td>1</td><td>2</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c6
        </td><td>0.35</td><td>0.2</td><td>0</td><td>3.6</td><td>1</td><td>20</td><td>0</td><td>2</td><td>2</td><td>2</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c7
        </td><td>0.7</td><td>0.4</td><td>0</td><td>2.3</td><td>1</td><td>0</td><td>10</td><td>15</td><td>1</td><td>2</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c8
        </td><td>0.8</td><td>0.9</td><td>1</td><td>7.7</td><td>2</td><td>0</td><td>30</td><td>30</td><td>1</td><td>2</td><td>2</td><td>1</td></tr> </tbody></table> <br><br>Iterasi 1  :<table class="table table-striped table-responsive">
            <tbody><tr>
            <td>
            No 
            </td>
            <td>
            C1
            </td>
            <td>
            C2
            </td>
            <td>
            C3
            </td>
            <td>
            C4
            </td>
            <td>
            C5
            </td>
            <td>
            C6
            </td>
            <td>
            C7
            </td>
            <td>
            C8
            </td>
            <td>
            Min
            </td>
            <td>
            Cluster
            </td></tr><tr>
            <td>1</td>
            <td>20.992599291179
            </td>
            <td>88.863486455349
            </td>
            
            <td>17.520679924021
            </td>
            <td>109.28480784171
            </td>
            <td>21.898612398963
            </td>
            <td>5.1045298510245
            </td>
            <td>22.309599391293
            </td>
            <td>43.945707697112
            </td><td>5.1045298510245</td>
            <td>6
            </td></tr><tr>
            <td>2</td>
            <td>67.133467808538
            </td>
            <td>48.934369312376
            </td>
            
            <td>72.107991928773
            </td>
            <td>61.16962072794
            </td>
            <td>58.609747482821
            </td>
            <td>68.110975620674
            </td>
            <td>77.005730306257
            </td>
            <td>79.29648478968
            </td><td>48.934369312376</td>
            <td>2
            </td></tr><tr>
            <td>3</td>
            <td>15.465043679214
            </td>
            <td>76.957972790348
            </td>
            
            <td>16.33075552447
            </td>
            <td>106.88339242371
            </td>
            <td>8.504562069854
            </td>
            <td>16.539464199302
            </td>
            <td>24.549199090805
            </td>
            <td>43.827707857017
            </td><td>8.504562069854</td>
            <td>5
            </td></tr><tr>
            <td>4</td>
            <td>13.120237231087
            </td>
            <td>82.397151801503
            </td>
            
            <td>5.9182450946205
            </td>
            <td>118.11663991581
            </td>
            <td>18.823406307042
            </td>
            <td>22.316935833577
            </td>
            <td>14.007341824915
            </td>
            <td>36.947538821957
            </td><td>5.9182450946205</td>
            <td>3
            </td></tr><tr>
            <td>5</td>
            <td>21.779488056426
            </td>
            <td>89.099035348313
            </td>
            
            <td>18.38760723966
            </td>
            <td>108.52455067864
            </td>
            <td>22.375926796448
            </td>
            <td>4.1245120923571
            </td>
            <td>22.995871368574
            </td>
            <td>44.29988826171
            </td><td>4.1245120923571</td>
            <td>6
            </td></tr><tr>
            <td>6</td>
            <td>21.021248773562
            </td>
            <td>88.90333458313
            </td>
            
            <td>17.524636943458
            </td>
            <td>109.29113825009
            </td>
            <td>21.900066209946
            </td>
            <td>5.1020976078472
            </td>
            <td>22.311093653158
            </td>
            <td>43.948275279014
            </td><td>5.1020976078472</td>
            <td>6
            </td></tr><tr>
            <td>7</td>
            <td>15.180600284574
            </td>
            <td>79.852492916627
            </td>
            
            <td>14.816059698854
            </td>
            <td>108.46460540195
            </td>
            <td>11.233460063578
            </td>
            <td>14.115085015684
            </td>
            <td>22.800342650934
            </td>
            <td>43.28707226182
            </td><td>11.233460063578</td>
            <td>5
            </td></tr><tr>
            <td>8</td>
            <td>17.867938465307
            </td>
            <td>88.252213711612
            </td>
            
            <td>13.534704466666
            </td>
            <td>113.31859170057
            </td>
            <td>20.094855684976
            </td>
            <td>10.100011138608
            </td>
            <td>19.284507382871
            </td>
            <td>42.492813804219
            </td><td>10.100011138608</td>
            <td>6
            </td></tr><tr>
            <td>9</td>
            <td>13.116401945656
            </td>
            <td>72.575340164549
            </td>
            
            <td>24.796370702181
            </td>
            <td>115.58754258137
            </td>
            <td>25.943014474035
            </td>
            <td>32.690862637746
            </td>
            <td>29.470493718294
            </td>
            <td>45.811024873932
            </td><td>13.116401945656</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>10</td>
            <td>75.365828072144
            </td>
            <td>10.705607922953
            </td>
            
            <td>83.845566615057
            </td>
            <td>106.07657630693
            </td>
            <td>71.302651009622
            </td>
            <td>90.396033325583
            </td>
            <td>89.341819105053
            </td>
            <td>90.847379934701
            </td><td>10.705607922953</td>
            <td>2
            </td></tr><tr>
            <td>11</td>
            <td>64.881493694273
            </td>
            <td>71.556915976026
            </td>
            
            <td>68.378799521489
            </td>
            <td>51.791430024667
            </td>
            <td>60.137244898648
            </td>
            <td>58.335686539202
            </td>
            <td>71.483826310572
            </td>
            <td>74.701880993721
            </td><td>51.791430024667</td>
            <td>4
            </td></tr><tr>
            <td>12</td>
            <td>13.326800066032
            </td>
            <td>82.34077726133
            </td>
            
            <td>2.2457960726655
            </td>
            <td>117.895731899
            </td>
            <td>18.982191654285
            </td>
            <td>22.35942977806
            </td>
            <td>12.090889131904
            </td>
            <td>35.569897385289
            </td><td>2.2457960726655</td>
            <td>3
            </td></tr><tr>
            <td>13</td>
            <td>82.053031631988
            </td>
            <td>21.307275752663
            </td>
            
            <td>91.541138293119
            </td>
            <td>110.25198410913
            </td>
            <td>80.245498316105
            </td>
            <td>97.695816184727
            </td>
            <td>96.524038456749
            </td>
            <td>97.73581738544
            </td><td>21.307275752663</td>
            <td>2
            </td></tr><tr>
            <td>14</td>
            <td>12.440357711899
            </td>
            <td>83.983525170119
            </td>
            
            <td>9.2251016254565
            </td>
            <td>119.47963215544
            </td>
            <td>16.130793532868
            </td>
            <td>20.493779544047
            </td>
            <td>18.059969545932
            </td>
            <td>41.775740567942
            </td><td>9.2251016254565</td>
            <td>3
            </td></tr><tr>
            <td>15</td>
            <td>4.0152613862612
            </td>
            <td>71.464161115905
            </td>
            
            <td>14.906519513287
            </td>
            <td>113.64852099346
            </td>
            <td>14.483173823441
            </td>
            <td>26.74212826235
            </td>
            <td>22.502922565747
            </td>
            <td>40.860557069135
            </td><td>4.0152613862612</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>16</td>
            <td>3.1638584039113
            </td>
            <td>74.17202976864
            </td>
            
            <td>15.510963864312
            </td>
            <td>115.25662670753
            </td>
            <td>17.565022060903
            </td>
            <td>26.289208812743
            </td>
            <td>22.317257896077
            </td>
            <td>41.623310776535
            </td><td>3.1638584039113</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>17</td>
            <td>4.5081676987441
            </td>
            <td>72.345294083306
            </td>
            
            <td>12.612595926295
            </td>
            <td>113.78889038918
            </td>
            <td>12.242694801391
            </td>
            <td>25.516705821873
            </td>
            <td>21.084780672324
            </td>
            <td>40.129330619885
            </td><td>4.5081676987441</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>18</td>
            <td>9.8086696345631
            </td>
            <td>74.642414216047
            </td>
            
            <td>17.634908562281
            </td>
            <td>116.46926633237
            </td>
            <td>17.808144204268
            </td>
            <td>26.563555861368
            </td>
            <td>24.800403222528
            </td>
            <td>44.284308733455
            </td><td>9.8086696345631</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>19</td>
            <td>2.1069886093665
            </td>
            <td>75.110328191268
            </td>
            
            <td>11.375869241513
            </td>
            <td>115.21628097192
            </td>
            <td>14.826307733215
            </td>
            <td>24.381923652575
            </td>
            <td>19.458674184024
            </td>
            <td>39.800625635786
            </td><td>2.1069886093665</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>20</td>
            <td>17.847128620593
            </td>
            <td>88.240466907196
            </td>
            
            <td>13.53440061473
            </td>
            <td>113.31407679543
            </td>
            <td>20.09378013217
            </td>
            <td>10.100123761618
            </td>
            <td>19.283931134496
            </td>
            <td>42.492469921152
            </td><td>10.100123761618</td>
            <td>6
            </td></tr><tr>
            <td>21</td>
            <td>1.4035668847618
            </td>
            <td>75.223998830161
            </td>
            
            <td>11.922667486767
            </td>
            <td>115.36572281228
            </td>
            <td>14.645477117527
            </td>
            <td>24.317946048135
            </td>
            <td>20.034470294969
            </td>
            <td>40.431423422877
            </td><td>1.4035668847618</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>22</td>
            <td>12.480785231707
            </td>
            <td>83.980057156446
            </td>
            
            <td>9.1678787077491
            </td>
            <td>119.48744703943
            </td>
            <td>16.164467204334
            </td>
            <td>20.517370689248
            </td>
            <td>18.088117646676
            </td>
            <td>41.763620532708
            </td><td>9.1678787077491</td>
            <td>3
            </td></tr><tr>
            <td>23</td>
            <td>7.3320017048552
            </td>
            <td>70.5445408873
            </td>
            
            <td>14.99484074607
            </td>
            <td>112.90944269192
            </td>
            <td>17.356792589646
            </td>
            <td>28.242341422056
            </td>
            <td>21.411502726338
            </td>
            <td>38.391288712415
            </td><td>7.3320017048552</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>24</td>
            <td>3.1874754901018
            </td>
            <td>73.903585839931
            </td>
            
            <td>14.217594733287
            </td>
            <td>114.92101635471
            </td>
            <td>17.477986154017
            </td>
            <td>26.131829250935
            </td>
            <td>20.935854412944
            </td>
            <td>40.15532343289
            </td><td>3.1874754901018</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>25</td>
            <td>11.895108238263
            </td>
            <td>82.988635366537
            </td>
            
            <td>4.3604586914681
            </td>
            <td>118.58926426958
            </td>
            <td>16.922576635962
            </td>
            <td>20.880950648857
            </td>
            <td>14.567758921674
            </td>
            <td>38.459687986254
            </td><td>4.3604586914681</td>
            <td>3
            </td></tr><tr>
            <td>26</td>
            <td>47.861632274715
            </td>
            <td>43.4819484844
            </td>
            
            <td>57.794617777091
            </td>
            <td>109.37568214187
            </td>
            <td>52.090458281724
            </td>
            <td>64.915937519226
            </td>
            <td>61.700105704934
            </td>
            <td>66.311316108188
            </td><td>43.4819484844</td>
            <td>2
            </td></tr><tr>
            <td>27</td>
            <td>17.257581783089
            </td>
            <td>88.094756535222
            </td>
            
            <td>12.809415638506
            </td>
            <td>114.10037742707
            </td>
            <td>19.865853341853
            </td>
            <td>11.091236585701
            </td>
            <td>18.782702920506
            </td>
            <td>42.266243374589
            </td><td>11.091236585701</td>
            <td>6
            </td></tr><tr>
            <td>28</td>
            <td>103.21209425256
            </td>
            <td>89.660673653503
            </td>
            
            <td>106.30360483069
            </td>
            <td>16.239963054145
            </td>
            <td>96.365431561323
            </td>
            <td>95.411859325767
            </td>
            <td>109.32865315186
            </td>
            <td>109.57982661056
            </td><td>16.239963054145</td>
            <td>4
            </td></tr><tr>
            <td>29</td>
            <td>31.500793640796
            </td>
            <td>43.783558557979
            </td>
            
            <td>40.491727550205
            </td>
            <td>105.00238092539
            </td>
            <td>30.511309378655
            </td>
            <td>49.114890817348
            </td>
            <td>46.418638497914
            </td>
            <td>54.019348385555
            </td><td>30.511309378655</td>
            <td>5
            </td></tr><tr>
            <td>30</td>
            <td>10.10198000394
            </td>
            <td>65.921847668281
            </td>
            
            <td>18.670565069113
            </td>
            <td>111.02923038552
            </td>
            <td>11.781765572273
            </td>
            <td>29.907900294069
            </td>
            <td>26.525836461835
            </td>
            <td>42.388913644961
            </td><td>10.10198000394</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>31</td>
            <td>15.616097463835
            </td>
            <td>77.044224313053
            </td>
            
            <td>16.329191651763
            </td>
            <td>106.9138087433
            </td>
            <td>8.5148399867525
            </td>
            <td>16.535870101086
            </td>
            <td>24.55
            </td>
            <td>43.828672122253
            </td><td>8.5148399867525</td>
            <td>5
            </td></tr><tr>
            <td>32</td>
            <td>83.944624604557
            </td>
            <td>23.323807579381
            </td>
            
            <td>93.256527921642
            </td>
            <td>110.73165762328
            </td>
            <td>82.724482470427
            </td>
            <td>99.711446183475
            </td>
            <td>97.8912151319
            </td>
            <td>98.343733913249
            </td><td>23.323807579381</td>
            <td>2
            </td></tr><tr>
            <td>33</td>
            <td>17.75725203966
            </td>
            <td>88.179249259676
            </td>
            
            <td>13.497407158414
            </td>
            <td>113.21342676556
            </td>
            <td>20.113676938839
            </td>
            <td>10.05348198387
            </td>
            <td>19.307770456477
            </td>
            <td>42.502823435626
            </td><td>10.05348198387</td>
            <td>6
            </td></tr><tr>
            <td>34</td>
            <td>17.826963426226
            </td>
            <td>88.215251657522
            </td>
            
            <td>13.530174610847
            </td>
            <td>113.3105494868
            </td>
            <td>20.09230263061
            </td>
            <td>10.099783413519
            </td>
            <td>19.282261926444
            </td>
            <td>42.490476874236
            </td><td>10.099783413519</td>
            <td>6
            </td></tr><tr>
            <td>35</td>
            <td>76.809504620197
            </td>
            <td>12.845232578665
            </td>
            
            <td>85.97546161551
            </td>
            <td>106.61378897685
            </td>
            <td>73.826418035822
            </td>
            <td>92.435775000808
            </td>
            <td>91.245219052836
            </td>
            <td>92.587742169253
            </td><td>12.845232578665</td>
            <td>2
            </td></tr><tr>
            <td>36</td>
            <td>14.332131732579
            </td>
            <td>72.079747502332
            </td>
            
            <td>25.872572349884
            </td>
            <td>115.73715911495
            </td>
            <td>26.994999536951
            </td>
            <td>33.559238668361
            </td>
            <td>30.401644692352
            </td>
            <td>46.405818600688
            </td><td>14.332131732579</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>37</td>
            <td>10.0521092314
            </td>
            <td>65.295626959238
            </td>
            
            <td>20.50758152489
            </td>
            <td>111.10557546766
            </td>
            <td>13.775227765812
            </td>
            <td>30.843530926274
            </td>
            <td>28.00665813695
            </td>
            <td>43.692137736668
            </td><td>10.0521092314</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>38</td>
            <td>22.079810710239
            </td>
            <td>71.708437725277
            </td>
            
            <td>33.425873825526
            </td>
            <td>116.64403131322
            </td>
            <td>34.20318758537
            </td>
            <td>39.716405187277
            </td>
            <td>37.009872209993
            </td>
            <td>50.87687530696
            </td><td>22.079810710239</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>39</td>
            <td>89.563385375945
            </td>
            <td>74.989999333244
            </td>
            
            <td>93.252238579028
            </td>
            <td>30.577769702841
            </td>
            <td>82.056322120846
            </td>
            <td>83.775130557941
            </td>
            <td>96.895768741468
            </td>
            <td>97.950446655439
            </td><td>30.577769702841</td>
            <td>4
            </td></tr><tr>
            <td>40</td>
            <td>11.065712810298
            </td>
            <td>64.173592699801
            </td>
            
            <td>20.352641106254
            </td>
            <td>110.66729417493
            </td>
            <td>15.417198189036
            </td>
            <td>31.524950436123
            </td>
            <td>27.344834978474
            </td>
            <td>42.184594344381
            </td><td>11.065712810298</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>41</td>
            <td>48.042689350202
            </td>
            <td>44.911023145771
            </td>
            
            <td>58.75525508412
            </td>
            <td>108.99770639789
            </td>
            <td>53.144519943264
            </td>
            <td>65.785047693226
            </td>
            <td>62.413860640085
            </td>
            <td>66.848261009543
            </td><td>44.911023145771</td>
            <td>2
            </td></tr><tr>
            <td>42</td>
            <td>9.8595131725659
            </td>
            <td>72.453364311121
            </td>
            
            <td>21.377324435018
            </td>
            <td>115.44734730603
            </td>
            <td>22.850164113196
            </td>
            <td>30.221225984397
            </td>
            <td>26.729384579522
            </td>
            <td>44.087413169747
            </td><td>9.8595131725659</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>43</td>
            <td>47.656059425848
            </td>
            <td>45.122056690714
            </td>
            
            <td>58.610408631915
            </td>
            <td>109.19478009502
            </td>
            <td>52.662510384523
            </td>
            <td>65.426848464526
            </td>
            <td>62.453903000533
            </td>
            <td>67.317828247798
            </td><td>45.122056690714</td>
            <td>2
            </td></tr><tr>
            <td>44</td>
            <td>29.533878851245
            </td>
            <td>79.762083724035
            </td>
            
            <td>26.812124123239
            </td>
            <td>116.68028968082
            </td>
            <td>34.977278338945
            </td>
            <td>38.325350618096
            </td>
            <td>18.368995617616
            </td>
            <td>12.305283418109
            </td><td>12.305283418109</td>
            <td>8
            </td></tr><tr>
            <td>45</td>
            <td>21.018756504608
            </td>
            <td>88.90167672772
            </td>
            
            <td>17.52464336299
            </td>
            <td>109.29047591167
            </td>
            <td>21.899957191739
            </td>
            <td>5.102266653165
            </td>
            <td>22.311053874705
            </td>
            <td>43.948243707798
            </td><td>5.102266653165</td>
            <td>6
            </td></tr><tr>
            <td>46</td>
            <td>18.567040690428
            </td>
            <td>87.458018500307
            </td>
            
            <td>9.5060507046828
            </td>
            <td>120.65054910774
            </td>
            <td>25.430198583574
            </td>
            <td>23.931830268494
            </td>
            <td>3.6117862616716
            </td>
            <td>29.165819035302
            </td><td>3.6117862616716</td>
            <td>7
            </td></tr><tr>
            <td>47</td>
            <td>20.339343376815
            </td>
            <td>88.754058436784
            </td>
            
            <td>16.677046770936
            </td>
            <td>110.07557807706
            </td>
            <td>21.462825745926
            </td>
            <td>6.0845122236709
            </td>
            <td>21.65189804613
            </td>
            <td>43.617520436173
            </td><td>6.0845122236709</td>
            <td>6
            </td></tr><tr>
            <td>48</td>
            <td>17.772543121343
            </td>
            <td>88.184450381005
            </td>
            
            <td>13.529977420528
            </td>
            <td>113.29875237177
            </td>
            <td>20.089880263456
            </td>
            <td>10.100885555237
            </td>
            <td>19.281169285082
            </td>
            <td>42.489764520411
            </td><td>10.100885555237</td>
            <td>6
            </td></tr><tr>
            <td>49</td>
            <td>64.535452187151
            </td>
            <td>72.446674105855
            </td>
            
            <td>67.313056601227
            </td>
            <td>51.577714073037
            </td>
            <td>58.916250635966
            </td>
            <td>57.019075658941
            </td>
            <td>70.4378760966
            </td>
            <td>73.70676894967
            </td><td>51.577714073037</td>
            <td>4
            </td></tr><tr>
            <td>50</td>
            <td>17.622918061434
            </td>
            <td>86.051410453287
            </td>
            
            <td>7.8144891707648
            </td>
            <td>119.76984278607
            </td>
            <td>24.403836604108
            </td>
            <td>23.875771003258
            </td>
            <td>5.2673181980966
            </td>
            <td>30.022472266621
            </td><td>5.2673181980966</td>
            <td>7
            </td></tr><tr>
            <td>51</td>
            <td>27.594428785536
            </td>
            <td>82.806778104211
            </td>
            
            <td>23.879960217722
            </td>
            <td>118.25359402572
            </td>
            <td>33.514362592775
            </td>
            <td>35.279384915273
            </td>
            <td>14.272788795467
            </td>
            <td>13.553689534588
            </td><td>13.553689534588</td>
            <td>8
            </td></tr><tr>
            <td>52</td>
            <td>27.437121295792
            </td>
            <td>79.364133114399
            </td>
            
            <td>25.000612492497
            </td>
            <td>116.58179800037
            </td>
            <td>33.034763885943
            </td>
            <td>36.645949639762
            </td>
            <td>16.775894163948
            </td>
            <td>13.981975003554
            </td><td>13.981975003554</td>
            <td>8
            </td></tr><tr>
            <td>53</td>
            <td>18.596101742032
            </td>
            <td>88.798451563076
            </td>
            
            <td>10.405046852369
            </td>
            <td>121.58912369122
            </td>
            <td>25.32222344108
            </td>
            <td>23.114984317537
            </td>
            <td>5.488624600025
            </td>
            <td>30.473677165711
            </td><td>5.488624600025</td>
            <td>7
            </td></tr><tr>
            <td>54</td>
            <td>28.814452207182
            </td>
            <td>78.03271529301
            </td>
            
            <td>28.60469639762
            </td>
            <td>116.44047687982
            </td>
            <td>33.834784704502
            </td>
            <td>38.615100103457
            </td>
            <td>20.964070597095
            </td>
            <td>15.782555433136
            </td><td>15.782555433136</td>
            <td>8
            </td></tr><tr>
            <td>55</td>
            <td>26.3859705336
            </td>
            <td>79.678864456015
            </td>
            
            <td>23.751640806479
            </td>
            <td>116.72125530939
            </td>
            <td>31.551219326676
            </td>
            <td>35.349529572542
            </td>
            <td>15.522307850317
            </td>
            <td>14.67439405904
            </td><td>14.67439405904</td>
            <td>8
            </td></tr><tr>
            <td>56</td>
            <td>18.873166136078
            </td>
            <td>87.181514095593
            </td>
            
            <td>9.0783478673159
            </td>
            <td>120.3649301084
            </td>
            <td>25.974533682051
            </td>
            <td>24.428321677921
            </td>
            <td>5.0054370438554
            </td>
            <td>29.710240658736
            </td><td>5.0054370438554</td>
            <td>7
            </td></tr><tr>
            <td>57</td>
            <td>21.281464329317
            </td>
            <td>81.405200841224
            </td>
            
            <td>18.114875765514
            </td>
            <td>117.66008976709
            </td>
            <td>28.387686133252
            </td>
            <td>30.639543469184
            </td>
            <td>9.9539702631664
            </td>
            <td>19.973430451477
            </td><td>9.9539702631664</td>
            <td>7
            </td></tr><tr>
            <td>58</td>
            <td>26.014997905055
            </td>
            <td>82.198832814098
            </td>
            
            <td>23.423366880105
            </td>
            <td>118.24410393757
            </td>
            <td>32.583740055433
            </td>
            <td>34.520614363015
            </td>
            <td>14.119579172199
            </td>
            <td>15.456769261395
            </td><td>14.119579172199</td>
            <td>7
            </td></tr><tr>
            <td>59</td>
            <td>26.014479448953
            </td>
            <td>78.949383411145
            </td>
            
            <td>24.335655754469
            </td>
            <td>116.48126519316
            </td>
            <td>31.990829013953
            </td>
            <td>35.757907391233
            </td>
            <td>16.438848530235
            </td>
            <td>15.617667591545
            </td><td>15.617667591545</td>
            <td>8
            </td></tr><tr>
            <td>60</td>
            <td>22.072150801406
            </td>
            <td>81.602462223881
            </td>
            
            <td>18.377998830123
            </td>
            <td>117.65921910756
            </td>
            <td>28.881132959079
            </td>
            <td>31.050356535795
            </td>
            <td>9.946478824187
            </td>
            <td>19.208806339802
            </td><td>9.946478824187</td>
            <td>7
            </td></tr><tr>
            <td>61</td>
            <td>17.750792235841
            </td>
            <td>87.435808596936
            </td>
            
            <td>8.5050352732955
            </td>
            <td>120.69122016535
            </td>
            <td>24.710941402545
            </td>
            <td>23.21154077178
            </td>
            <td>5.0015622559356
            </td>
            <td>30.537691874141
            </td><td>5.0015622559356</td>
            <td>7
            </td></tr><tr>
            <td>62</td>
            <td>18.122424479081
            </td>
            <td>87.52255862919
            </td>
            
            <td>9.2398738627754
            </td>
            <td>120.74658698696
            </td>
            <td>24.972830616492
            </td>
            <td>23.489607680845
            </td>
            <td>4.2461828740647
            </td>
            <td>29.75932574841
            </td><td>4.2461828740647</td>
            <td>7
            </td></tr><tr>
            <td>63</td>
            <td>19.588916483563
            </td>
            <td>88.296385254437
            </td>
            
            <td>10.450772650862
            </td>
            <td>121.08154958126
            </td>
            <td>26.722006829578
            </td>
            <td>24.481606340271
            </td>
            <td>3.3243719707638
            </td>
            <td>28.800917502746
            </td><td>3.3243719707638</td>
            <td>7
            </td></tr><tr>
            <td>64</td>
            <td>18.203633593324
            </td>
            <td>87.391843303594
            </td>
            
            <td>8.8016064442805
            </td>
            <td>120.59379866312
            </td>
            <td>25.173245241724
            </td>
            <td>23.658900566172
            </td>
            <td>4.4808342973156
            </td>
            <td>29.962854937405
            </td><td>4.4808342973156</td>
            <td>7
            </td></tr><tr>
            <td>65</td>
            <td>17.75207483648
            </td>
            <td>87.62201869964
            </td>
            
            <td>9.0789405218891
            </td>
            <td>120.85631204451
            </td>
            <td>24.548648863023
            </td>
            <td>23.081788513891
            </td>
            <td>5.0044740982445
            </td>
            <td>30.375624454487
            </td><td>5.0044740982445</td>
            <td>7
            </td></tr><tr>
            <td>66</td>
            <td>23.590579920807
            </td>
            <td>76.891270382274
            </td>
            
            <td>23.383679372588
            </td>
            <td>115.71537262179
            </td>
            <td>28.918081903888
            </td>
            <td>34.458137805169
            </td>
            <td>16.923476622727
            </td>
            <td>18.874264515472
            </td><td>16.923476622727</td>
            <td>7
            </td></tr><tr>
            <td>67</td>
            <td>19.81366457776
            </td>
            <td>87.355453773648
            </td>
            
            <td>11.018316749849
            </td>
            <td>120.51217906917
            </td>
            <td>26.712942630867
            </td>
            <td>25.215400135631
            </td>
            <td>2.0056181092122
            </td>
            <td>27.232188747877
            </td><td>2.0056181092122</td>
            <td>7
            </td></tr><tr>
            <td>68</td>
            <td>26.799478521046
            </td>
            <td>79.318963993486
            </td>
            
            <td>24.492346743422
            </td>
            <td>116.52548240192
            </td>
            <td>32.404815213175
            </td>
            <td>36.080333271742
            </td>
            <td>16.37827368803
            </td>
            <td>14.570492407602
            </td><td>14.570492407602</td>
            <td>8
            </td></tr><tr>
            <td>69</td>
            <td>18.084243307366
            </td>
            <td>87.507187453374
            </td>
            
            <td>9.2435845860791
            </td>
            <td>120.73826177314
            </td>
            <td>24.971981419183
            </td>
            <td>23.490456700541
            </td>
            <td>4.2473822526351
            </td>
            <td>29.760098386934
            </td><td>4.2473822526351</td>
            <td>7
            </td></tr><tr>
            <td>70</td>
            <td>25.542371091972
            </td>
            <td>82.385743432951
            </td>
            
            <td>22.876007540653
            </td>
            <td>118.32658501368
            </td>
            <td>31.91727934834
            </td>
            <td>33.911294888282
            </td>
            <td>13.568571074362
            </td>
            <td>15.936069810339
            </td><td>13.568571074362</td>
            <td>7
            </td></tr><tr>
            <td>71</td>
            <td>26.002759392034
            </td>
            <td>80.087086949146
            </td>
            
            <td>25.012746670448
            </td>
            <td>117.35932641252
            </td>
            <td>31.104718227304
            </td>
            <td>35.095786014848
            </td>
            <td>17.14327553299
            </td>
            <td>17.257435962506
            </td><td>17.14327553299</td>
            <td>7
            </td></tr><tr>
            <td>72</td>
            <td>31.822253989936
            </td>
            <td>84.382592096949
            </td>
            
            <td>29.471492140711
            </td>
            <td>119.60230703879
            </td>
            <td>37.204782609229
            </td>
            <td>38.875303844472
            </td>
            <td>19.531555212015
            </td>
            <td>11.885413286882
            </td><td>11.885413286882</td>
            <td>8
            </td></tr><tr>
            <td>73</td>
            <td>17.07273850324
            </td>
            <td>86.934563897221
            </td>
            
            <td>10.247848554697
            </td>
            <td>120.68437512785
            </td>
            <td>23.052947750776
            </td>
            <td>22.762840332437
            </td>
            <td>7.1902990202077
            </td>
            <td>30.743721310212
            </td><td>7.1902990202077</td>
            <td>7
            </td></tr><tr>
            <td>74</td>
            <td>30.188713122622
            </td>
            <td>77.921873694105
            </td>
            
            <td>29.134488154076
            </td>
            <td>116.11769201978
            </td>
            <td>35.324190011945
            </td>
            <td>39.817921844315
            </td>
            <td>21.218397677487
            </td>
            <td>13.417019042992
            </td><td>13.417019042992</td>
            <td>8
            </td></tr><tr>
            <td>75</td>
            <td>17.523683431288
            </td>
            <td>86.677433516458
            </td>
            
            <td>10.052088389981
            </td>
            <td>120.4164751228
            </td>
            <td>23.736627414188
            </td>
            <td>23.370050941322
            </td>
            <td>5.2636566187395
            </td>
            <td>29.346173191747
            </td><td>5.2636566187395</td>
            <td>7
            </td></tr><tr>
            <td>76</td>
            <td>26.154063623078
            </td>
            <td>78.884022742251
            </td>
            
            <td>23.117245597173
            </td>
            <td>116.13353970322
            </td>
            <td>31.924834283047
            </td>
            <td>35.610155068463
            </td>
            <td>15.524246970465
            </td>
            <td>15.65981621859
            </td><td>15.524246970465</td>
            <td>7
            </td></tr><tr>
            <td>77</td>
            <td>25.558023182555
            </td>
            <td>79.286748886557
            </td>
            
            <td>23.001859685686
            </td>
            <td>116.44367114189
            </td>
            <td>31.016004723368
            </td>
            <td>34.85291880173
            </td>
            <td>15.090670926105
            </td>
            <td>15.555698280694
            </td><td>15.090670926105</td>
            <td>7
            </td></tr><tr>
            <td>78</td>
            <td>18.141887553394
            </td>
            <td>87.688471785064
            </td>
            
            <td>9.8702626104881
            </td>
            <td>120.91272920582
            </td>
            <td>24.851560997249
            </td>
            <td>23.405084575793
            </td>
            <td>4.4758109879663
            </td>
            <td>29.624943611761
            </td><td>4.4758109879663</td>
            <td>7
            </td></tr><tr>
            <td>79</td>
            <td>19.566506305419
            </td>
            <td>88.624252713352
            </td>
            
            <td>11.368780453505
            </td>
            <td>121.40629377837
            </td>
            <td>26.420374126798
            </td>
            <td>24.235774569838
            </td>
            <td>3.3245103398847
            </td>
            <td>28.451800804167
            </td><td>3.3245103398847</td>
            <td>7
            </td></tr><tr>
            <td>80</td>
            <td>18.567347683501
            </td>
            <td>88.120158874119
            </td>
            
            <td>11.552939020007
            </td>
            <td>121.30656371359
            </td>
            <td>24.851446637973
            </td>
            <td>23.490698159059
            </td>
            <td>6.0040319785957
            </td>
            <td>29.558220514774
            </td><td>6.0040319785957</td>
            <td>7
            </td></tr><tr>
            <td>81</td>
            <td>23.492567420357
            </td>
            <td>82.011015869821
            </td>
            
            <td>20.667576635881
            </td>
            <td>118.08004371612
            </td>
            <td>30.080902978468
            </td>
            <td>32.214618172501
            </td>
            <td>11.75080950403
            </td>
            <td>17.830813890566
            </td><td>11.75080950403</td>
            <td>7
            </td></tr><tr>
            <td>82</td>
            <td>24.969183326653
            </td>
            <td>79.238425754176
            </td>
            
            <td>23.228304199833
            </td>
            <td>116.62653264159
            </td>
            <td>30.586600268745
            </td>
            <td>34.547544283205
            </td>
            <td>15.422143690162
            </td>
            <td>16.487926370529
            </td><td>15.422143690162</td>
            <td>7
            </td></tr><tr>
            <td>83</td>
            <td>30.451125447182
            </td>
            <td>83.333768911528
            </td>
            
            <td>28.396092002246
            </td>
            <td>119.02406076504
            </td>
            <td>36.58419113497
            </td>
            <td>38.28252657545
            </td>
            <td>18.67168018685
            </td>
            <td>12.572885150195
            </td><td>12.572885150195</td>
            <td>8
            </td></tr><tr>
            <td>84</td>
            <td>23.572438164093
            </td>
            <td>78.989124827409
            </td>
            
            <td>20.75116481068
            </td>
            <td>116.30052382083
            </td>
            <td>29.053052180451
            </td>
            <td>33.168428376997
            </td>
            <td>13.322628907239
            </td>
            <td>17.429808977725
            </td><td>13.322628907239</td>
            <td>7
            </td></tr><tr>
            <td>85</td>
            <td>19.150373782253
            </td>
            <td>88.545247280698
            </td>
            
            <td>10.595320476512
            </td>
            <td>121.34117527039
            </td>
            <td>26.097371821699
            </td>
            <td>23.88204589226
            </td>
            <td>3.7507887170567
            </td>
            <td>29.198445438071
            </td><td>3.7507887170567</td>
            <td>7
            </td></tr><tr>
            <td>86</td>
            <td>25.823100123726
            </td>
            <td>82.769635132698
            </td>
            
            <td>22.553547392816
            </td>
            <td>118.35502735414
            </td>
            <td>31.738816928172
            </td>
            <td>33.688870565811
            </td>
            <td>13.113828579023
            </td>
            <td>15.559000610579
            </td><td>13.113828579023</td>
            <td>7
            </td></tr><tr>
            <td>87</td>
            <td>18.494319560341
            </td>
            <td>87.592852767792
            </td>
            
            <td>10.022168228482
            </td>
            <td>120.80036364184
            </td>
            <td>25.270533354087
            </td>
            <td>23.807594502595
            </td>
            <td>3.6111294632012
            </td>
            <td>28.994196936629
            </td><td>3.6111294632012</td>
            <td>7
            </td></tr><tr>
            <td>88</td>
            <td>20.257344347174
            </td>
            <td>76.796744722677
            </td>
            
            <td>18.208239892972
            </td>
            <td>115.19479154892
            </td>
            <td>24.981593223812
            </td>
            <td>31.158826999744
            </td>
            <td>13.126690367339
            </td>
            <td>21.048752932181
            </td><td>13.126690367339</td>
            <td>7
            </td></tr><tr>
            <td>89</td>
            <td>23.641184932232
            </td>
            <td>79.10471303911
            </td>
            
            <td>21.933094286945
            </td>
            <td>116.60748528718
            </td>
            <td>29.278757231139
            </td>
            <td>33.449299320016
            </td>
            <td>14.401410521195
            </td>
            <td>17.651221629111
            </td><td>14.401410521195</td>
            <td>7
            </td></tr><tr>
            <td>90</td>
            <td>25.612550068277
            </td>
            <td>79.395344454193
            </td>
            
            <td>23.520240666286
            </td>
            <td>116.68886288331
            </td>
            <td>31.074470566689
            </td>
            <td>34.97035774767
            </td>
            <td>15.480184785719
            </td>
            <td>15.615643470571
            </td><td>15.480184785719</td>
            <td>7
            </td></tr><tr>
            <td>91</td>
            <td>24.602052678588
            </td>
            <td>77.889338140724
            </td>
            
            <td>24.26921910569
            </td>
            <td>116.23282236959
            </td>
            <td>29.078875425298
            </td>
            <td>34.600024508662
            </td>
            <td>17.636309024283
            </td>
            <td>19.004120500565
            </td><td>17.636309024283</td>
            <td>7
            </td></tr><tr>
            <td>92</td>
            <td>21.946659176285
            </td>
            <td>82.093981807438
            </td>
            
            <td>19.737498549715
            </td>
            <td>118.28656664643
            </td>
            <td>28.516589014116
            </td>
            <td>30.859184192068
            </td>
            <td>11.422856429107
            </td>
            <td>20.006575144187
            </td><td>11.422856429107</td>
            <td>7
            </td></tr><tr>
            <td>93</td>
            <td>20.160482236296
            </td>
            <td>81.501405165801
            </td>
            
            <td>17.277645788706
            </td>
            <td>117.72802998437
            </td>
            <td>27.244908588579
            </td>
            <td>29.61643368132
            </td>
            <td>9.5641122954512
            </td>
            <td>21.244760389329
            </td><td>9.5641122954512</td>
            <td>7
            </td></tr><tr>
            <td>94</td>
            <td>24.527995209556
            </td>
            <td>82.898604023228
            </td>
            
            <td>22.432020617858
            </td>
            <td>118.80243494559
            </td>
            <td>30.448030297541
            </td>
            <td>32.646224115508
            </td>
            <td>13.571969238102
            </td>
            <td>18.278122140964
            </td><td>13.571969238102</td>
            <td>7
            </td></tr><tr>
            <td>95</td>
            <td>18.836031960049
            </td>
            <td>88.509141335796
            </td>
            
            <td>9.8617493377189
            </td>
            <td>121.29677695636
            </td>
            <td>25.811084828035
            </td>
            <td>23.564838212897
            </td>
            <td>4.372653656534
            </td>
            <td>29.960475630403
            </td><td>4.372653656534</td>
            <td>7
            </td></tr><tr>
            <td>96</td>
            <td>28.253203287415
            </td>
            <td>80.304554640444
            </td>
            
            <td>26.789130183714
            </td>
            <td>117.36776174061
            </td>
            <td>33.368300765847
            </td>
            <td>37.035580135864
            </td>
            <td>18.326262466744
            </td>
            <td>14.487204561267
            </td><td>14.487204561267</td>
            <td>8
            </td></tr><tr>
            <td>97</td>
            <td>16.863172180821
            </td>
            <td>87.81181341938
            </td>
            
            <td>8.3313009788388
            </td>
            <td>121.06334943326
            </td>
            <td>23.531395538727
            </td>
            <td>22.084389871581
            </td>
            <td>7.2160221729149
            </td>
            <td>32.399478020487
            </td><td>7.2160221729149</td>
            <td>7
            </td></tr><tr>
            <td>98</td>
            <td>17.896532513311
            </td>
            <td>87.831531217439
            </td>
            
            <td>9.8181401497432
            </td>
            <td>121.04494155478
            </td>
            <td>24.467894801147
            </td>
            <td>23.037807534572
            </td>
            <td>5.389645257343
            </td>
            <td>30.276615993205
            </td><td>5.389645257343</td>
            <td>7
            </td></tr><tr>
            <td>99</td>
            <td>20.255556867191
            </td>
            <td>87.642521552041
            </td>
            
            <td>12.183578456266
            </td>
            <td>120.75210798988
            </td>
            <td>26.881361275055
            </td>
            <td>25.432138801131
            </td>
            <td>1.0201882179284
            </td>
            <td>26.242453848678
            </td><td>1.0201882179284</td>
            <td>7
            </td></tr><tr>
            <td>100</td>
            <td>19.351114205647
            </td>
            <td>88.11146134868
            </td>
            
            <td>12.387276577198
            </td>
            <td>121.26396670487
            </td>
            <td>25.604328169276
            </td>
            <td>24.245008166631
            </td>
            <td>5.1025700387158
            </td>
            <td>28.171688288067
            </td><td>5.1025700387158</td>
            <td>7
            </td></tr><tr>
            <td>101</td>
            <td>21.848938189303
            </td>
            <td>79.138259394556
            </td>
            
            <td>19.430339677937
            </td>
            <td>116.48186167812
            </td>
            <td>27.152902238987
            </td>
            <td>31.605626081443
            </td>
            <td>12.430289618508
            </td>
            <td>19.207865576373
            </td><td>12.430289618508</td>
            <td>7
            </td></tr><tr>
            <td>102</td>
            <td>25.566310821079
            </td>
            <td>82.406591053143
            </td>
            
            <td>22.837803068597
            </td>
            <td>118.33729863826
            </td>
            <td>31.893702340744
            </td>
            <td>33.886658864515
            </td>
            <td>13.508887778052
            </td>
            <td>15.882425790792
            </td><td>13.508887778052</td>
            <td>7
            </td></tr><tr>
            <td>103</td>
            <td>19.644874751446
            </td>
            <td>86.617048575901
            </td>
            
            <td>12.250922577504
            </td>
            <td>120.24488805766
            </td>
            <td>25.815210709967
            </td>
            <td>25.360662530778
            </td>
            <td>2.5919691356187
            </td>
            <td>25.889146451747
            </td><td>2.5919691356187</td>
            <td>7
            </td></tr><tr>
            <td>104</td>
            <td>29.221405099687
            </td>
            <td>83.289222087855
            </td>
            
            <td>26.901087636005
            </td>
            <td>118.91439995223
            </td>
            <td>35.194012502129
            </td>
            <td>36.9671099222
            </td>
            <td>17.213509694423
            </td>
            <td>13.265523585596
            </td><td>13.265523585596</td>
            <td>8
            </td></tr><tr>
            <td>105</td>
            <td>17.557957768488
            </td>
            <td>86.711359584543
            </td>
            
            <td>10.055688986837
            </td>
            <td>120.4226302694
            </td>
            <td>23.73752053185
            </td>
            <td>23.369139500632
            </td>
            <td>5.2667334278469
            </td>
            <td>29.348599302181
            </td><td>5.2667334278469</td>
            <td>7
            </td></tr><tr>
            <td>106</td>
            <td>28.295902901304
            </td>
            <td>80.386044317406
            </td>
            
            <td>26.715784117259
            </td>
            <td>117.38852636012
            </td>
            <td>33.314353077915
            </td>
            <td>36.981737668747
            </td>
            <td>18.222697961608
            </td>
            <td>14.357037333656
            </td><td>14.357037333656</td>
            <td>8
            </td></tr><tr>
            <td>107</td>
            <td>30.877577689968
            </td>
            <td>78.978432524329
            </td>
            
            <td>29.611531605103
            </td>
            <td>116.69718421624
            </td>
            <td>35.233177602936
            </td>
            <td>39.760858944444
            </td>
            <td>21.420644341382
            </td>
            <td>13.001676968761
            </td><td>13.001676968761</td>
            <td>8
            </td></tr><tr>
            <td>108</td>
            <td>18.274542401932
            </td>
            <td>87.429256544935
            </td>
            
            <td>8.7995965816621
            </td>
            <td>120.60885083608
            </td>
            <td>25.175521841662
            </td>
            <td>23.657988080139
            </td>
            <td>4.4845178113148
            </td>
            <td>29.96332591686
            </td><td>4.4845178113148</td>
            <td>7
            </td></tr><tr>
            <td>109</td>
            <td>18.8763713674
            </td>
            <td>87.487012727604
            </td>
            
            <td>10.266420797922
            </td>
            <td>120.69315389035
            </td>
            <td>25.721069106863
            </td>
            <td>24.245125200749
            </td>
            <td>2.8319244340201
            </td>
            <td>28.382688315239
            </td><td>2.8319244340201</td>
            <td>7
            </td></tr><tr>
            <td>110</td>
            <td>19.135422650153
            </td>
            <td>88.360989129819
            </td>
            
            <td>10.110608290306
            </td>
            <td>121.17328253373
            </td>
            <td>26.249655235831
            </td>
            <td>24.00755922621
            </td>
            <td>3.7478527185577
            </td>
            <td>29.368050667349
            </td><td>3.7478527185577</td>
            <td>7
            </td></tr><tr>
            <td>111</td>
            <td>18.818115633612
            </td>
            <td>88.641804336329
            </td>
            
            <td>10.450620842802
            </td>
            <td>121.45488658757
            </td>
            <td>25.692050832894
            </td>
            <td>23.480634062989
            </td>
            <td>4.5886682163783
            </td>
            <td>29.824504622877
            </td><td>4.5886682163783</td>
            <td>7
            </td></tr><tr>
            <td>112</td>
            <td>26.1989038702
            </td>
            <td>77.554345874361
            </td>
            
            <td>24.257670209647
            </td>
            <td>115.66324638363
            </td>
            <td>30.854862890637
            </td>
            <td>35.945996494742
            </td>
            <td>16.995227683088
            </td>
            <td>15.470273559314
            </td><td>15.470273559314</td>
            <td>8
            </td></tr><tr>
            <td>113</td>
            <td>19.242825286324
            </td>
            <td>88.725725271761
            </td>
            
            <td>11.235360474858
            </td>
            <td>121.5200161496
            </td>
            <td>26.020190717979
            </td>
            <td>23.840308827698
            </td>
            <td>4.2486850907075
            </td>
            <td>29.0946442666
            </td><td>4.2486850907075</td>
            <td>7
            </td></tr><tr>
            <td>114</td>
            <td>19.152256290056
            </td>
            <td>88.54087711899
            </td>
            
            <td>10.593296040421
            </td>
            <td>121.34190092874
            </td>
            <td>26.097297197219
            </td>
            <td>23.881941315563
            </td>
            <td>3.7486425543122
            </td>
            <td>29.197508814966
            </td><td>3.7486425543122</td>
            <td>7
            </td></tr><tr>
            <td>115</td>
            <td>26.422031413198
            </td>
            <td>77.659949420535
            </td>
            
            <td>25.495798555841
            </td>
            <td>116.01046394184
            </td>
            <td>31.244899487756
            </td>
            <td>36.361955997993
            </td>
            <td>18.163175493289
            </td>
            <td>16.126330766793
            </td><td>16.126330766793</td>
            <td>8
            </td></tr></tbody></table><br><br>Centroid baru :<table class="table table-striped table-responsive">
    <tbody><tr>
        <td>
        </td><td>Luas lahan</td><td>Daya tampung</td><td>Jumlah pembangkit</td><td>Kapasitas pemakaian</td><td>Sumber daya</td><td>Jumlah kamar</td><td>Jumlah meja</td><td>Jumlah sarana layanan</td><td>Jumlah lantai</td><td>Kebutuhan keamanan tambahan</td><td>Potensi kecelakaan</td><td>Kebutuhan tenaga medis darurat</td></tr>
        <tr>
        <td>
            c1 Baru
        </td><td>15.112333333333</td><td>2.6013333333333</td><td>0.46666666666667</td><td>15.82</td><td>1.8</td><td>0</td><td>0</td><td>5.7333333333333</td><td>1</td><td>2.2</td><td>2.0666666666667</td><td>2.0666666666667</td></tr>
        <tr>
        <td>
            c2 Baru 
        </td><td>39.766625</td><td>16.04375</td><td>2.375</td><td>65.0625</td><td>2</td><td>5</td><td>0</td><td>14</td><td>1.375</td><td>3.625</td><td>3.5</td><td>3.125</td></tr>
        <tr>
        <td>
            c3 Baru 
        </td><td>0.609</td><td>0.53</td><td>0.4</td><td>7.7</td><td>1</td><td>0</td><td>0</td><td>5.6</td><td>1</td><td>2.6</td><td>2</td><td>2.4</td></tr>
        <tr>
        <td>
            c4 Baru 
        </td><td>15.79875</td><td>3.1125</td><td>2</td><td>53.75</td><td>2</td><td>66.25</td><td>0</td><td>21.25</td><td>11.75</td><td>3.25</td><td>2</td><td>2</td></tr>
        <tr>
        <td>
            c5 Baru 
        </td><td>5.71275</td><td>2.425</td><td>1</td><td>21.925</td><td>3</td><td>7.5</td><td>0</td><td>3.25</td><td>1</td><td>2</td><td>1.25</td><td>1.25</td></tr>
        <tr>
        <td>
            c6 Baru 
        </td><td>0.48390909090909</td><td>0.16181818181818</td><td>0</td><td>3.6</td><td>1</td><td>12.181818181818</td><td>0</td><td>2</td><td>1.5454545454545</td><td>1</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c7 Baru 
        </td><td>2.8965192307692</td><td>0.35711538461538</td><td>0.38461538461538</td><td>5.2576923076923</td><td>1.8076923076923</td><td>0</td><td>12.173076923077</td><td>14.384615384615</td><td>1.1153846153846</td><td>2</td><td>1.4038461538462</td><td>1</td></tr>
        <tr>
        <td>
            c8 Baru 
        </td><td>6.9871875</td><td>0.625</td><td>1</td><td>10.8625</td><td>3</td><td>0</td><td>22.625</td><td>21</td><td>1.75</td><td>2</td><td>2</td><td>1</td></tr> </tbody></table> <br><br>Iterasi 2  :<table class="table table-striped table-responsive">
            <tbody><tr>
            <td>
            No 
            </td>
            <td>
            C1
            </td>
            <td>
            C2
            </td>
            <td>
            C3
            </td>
            <td>
            C4
            </td>
            <td>
            C5
            </td>
            <td>
            C6
            </td>
            <td>
            C7
            </td>
            <td>
            C8
            </td>
            <td>
            Min
            </td>
            <td>
            Cluster
            </td></tr><tr>
            <td>1</td>
            <td>24.713570226362
            </td>
            <td>76.360719437111
            </td>
            
            <td>16.171111155391
            </td>
            <td>76.545736624011
            </td>
            <td>20.778789186632
            </td>
            <td>2.8590960601197
            </td>
            <td>23.183951773377
            </td>
            <td>34.627260193887
            </td><td>2.8590960601197</td>
            <td>6
            </td></tr><tr>
            <td>2</td>
            <td>64.996702211215
            </td>
            <td>46.582452803638
            </td>
            
            <td>72.499236416669
            </td>
            <td>30.818045165333
            </td>
            <td>56.63305362209
            </td>
            <td>70.828668918282
            </td>
            <td>74.549174658947
            </td>
            <td>72.365575865947
            </td><td>30.818045165333</td>
            <td>4
            </td></tr><tr>
            <td>3</td>
            <td>18.422871645503
            </td>
            <td>65.896637590268
            </td>
            
            <td>14.365656580888
            </td>
            <td>72.925950105655
            </td>
            <td>8.3944282451219
            </td>
            <td>13.361670377651
            </td>
            <td>23.673203028698
            </td>
            <td>32.932926155447
            </td><td>8.3944282451219</td>
            <td>5
            </td></tr><tr>
            <td>4</td>
            <td>17.572715783282
            </td>
            <td>71.520767109652
            </td>
            
            <td>5.1424853913259
            </td>
            <td>83.808757569317
            </td>
            <td>18.708392503433
            </td>
            <td>15.897047676422
            </td>
            <td>14.709748697831
            </td>
            <td>27.091190192296
            </td><td>5.1424853913259</td>
            <td>3
            </td></tr><tr>
            <td>5</td>
            <td>25.412273379872
            </td>
            <td>76.586009960718
            </td>
            
            <td>17.105910703614
            </td>
            <td>75.908325517116
            </td>
            <td>21.203063164611
            </td>
            <td>3.8452928495985
            </td>
            <td>23.8554121021
            </td>
            <td>35.094844018177
            </td><td>3.8452928495985</td>
            <td>6
            </td></tr><tr>
            <td>6</td>
            <td>24.75448925616
            </td>
            <td>76.414889054445
            </td>
            
            <td>16.174125045887
            </td>
            <td>76.560362510979
            </td>
            <td>20.805850200424
            </td>
            <td>2.8548559602402
            </td>
            <td>23.189375070847
            </td>
            <td>34.637366678345
            </td><td>2.8548559602402</td>
            <td>6
            </td></tr><tr>
            <td>7</td>
            <td>18.680419517059
            </td>
            <td>68.434257707329
            </td>
            
            <td>12.617414790677
            </td>
            <td>74.687869465613
            </td>
            <td>10.881128161294
            </td>
            <td>10.20976080697
            </td>
            <td>22.30634816127
            </td>
            <td>32.551114973763
            </td><td>10.20976080697</td>
            <td>6
            </td></tr><tr>
            <td>8</td>
            <td>22.17160391131
            </td>
            <td>76.011628208802
            </td>
            
            <td>11.648795474211
            </td>
            <td>80.153280003457
            </td>
            <td>19.589466048428
            </td>
            <td>2.2529563021003
            </td>
            <td>20.316541115731
            </td>
            <td>32.822644980793
            </td><td>2.2529563021003</td>
            <td>6
            </td></tr><tr>
            <td>9</td>
            <td>9.511025093718
            </td>
            <td>57.187157948294
            </td>
            
            <td>24.079488802713
            </td>
            <td>80.558042167201
            </td>
            <td>21.926063544615
            </td>
            <td>28.515893890459
            </td>
            <td>27.403326581181
            </td>
            <td>32.738485692074
            </td><td>9.511025093718</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>10</td>
            <td>71.410448497868
            </td>
            <td>20.22208791033
            </td>
            
            <td>83.916210257614
            </td>
            <td>77.564866571873
            </td>
            <td>69.595361505365
            </td>
            <td>88.97774483395
            </td>
            <td>86.145361636281
            </td>
            <td>82.451844238229
            </td><td>20.22208791033</td>
            <td>2
            </td></tr><tr>
            <td>11</td>
            <td>63.263075325712
            </td>
            <td>61.945582725511
            </td>
            
            <td>69.275288732708
            </td>
            <td>17.047140869146
            </td>
            <td>56.421354295714
            </td>
            <td>63.357845349104
            </td>
            <td>69.740767879943
            </td>
            <td>68.544364661948
            </td><td>17.047140869146</td>
            <td>4
            </td></tr><tr>
            <td>12</td>
            <td>17.660639427835
            </td>
            <td>71.555303885897
            </td>
            
            <td>5.5536745493412
            </td>
            <td>83.52782265696
            </td>
            <td>18.829354278958
            </td>
            <td>15.767827105997
            </td>
            <td>13.155254815218
            </td>
            <td>25.899399518332
            </td><td>5.5536745493412</td>
            <td>3
            </td></tr><tr>
            <td>13</td>
            <td>77.570121384891
            </td>
            <td>21.611109046116
            </td>
            
            <td>91.645980713832
            </td>
            <td>82.933064321852
            </td>
            <td>77.701581467577
            </td>
            <td>96.366935223509
            </td>
            <td>93.24715998987
            </td>
            <td>89.104154338674
            </td><td>21.611109046116</td>
            <td>2
            </td></tr><tr>
            <td>14</td>
            <td>17.3989204167
            </td>
            <td>72.600000924264
            </td>
            
            <td>4.7806569632217
            </td>
            <td>85.310689000925
            </td>
            <td>17.271838714002
            </td>
            <td>12.985913865314
            </td>
            <td>18.441979912674
            </td>
            <td>31.128987823412
            </td><td>4.7806569632217</td>
            <td>3
            </td></tr><tr>
            <td>15</td>
            <td>4.2119076833821
            </td>
            <td>58.990165126936
            </td>
            
            <td>14.178400086046
            </td>
            <td>78.428292004942
            </td>
            <td>11.375763515584
            </td>
            <td>21.469569246835
            </td>
            <td>20.550095514083
            </td>
            <td>28.118739226006
            </td><td>4.2119076833821</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>16</td>
            <td>3.4799997605364
            </td>
            <td>60.818498700668
            </td>
            
            <td>14.519978684557
            </td>
            <td>80.170135697855
            </td>
            <td>14.569566313467
            </td>
            <td>20.886394545234
            </td>
            <td>20.620491116089
            </td>
            <td>28.796478871733
            </td><td>3.4799997605364</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>17</td>
            <td>7.0552119505134
            </td>
            <td>60.573204675856
            </td>
            
            <td>11.77355617475
            </td>
            <td>78.662480057601
            </td>
            <td>10.176136376961
            </td>
            <td>19.944077681199
            </td>
            <td>19.396015521222
            </td>
            <td>27.805863458274
            </td><td>7.0552119505134</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>18</td>
            <td>10.090939748111
            </td>
            <td>61.32456305758
            </td>
            
            <td>15.803283867602
            </td>
            <td>81.461758867658
            </td>
            <td>15.129400601561
            </td>
            <td>21.265751911745
            </td>
            <td>23.478343540531
            </td>
            <td>32.061040538482
            </td><td>10.090939748111</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>19</td>
            <td>6.5412084510433
            </td>
            <td>62.769631904713
            </td>
            
            <td>10.459821413389
            </td>
            <td>80.207490836658
            </td>
            <td>12.742184391324
            </td>
            <td>18.460981735667
            </td>
            <td>18.082886360809
            </td>
            <td>27.478410221211
            </td><td>6.5412084510433</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>20</td>
            <td>22.148339253015
            </td>
            <td>75.993491393692
            </td>
            
            <td>11.648114911864
            </td>
            <td>80.146548009334
            </td>
            <td>19.579940310494
            </td>
            <td>2.251380346101
            </td>
            <td>20.312209667119
            </td>
            <td>32.815601402537
            </td><td>2.251380346101</td>
            <td>6
            </td></tr><tr>
            <td>21</td>
            <td>6.4284989175805
            </td>
            <td>62.779344407242
            </td>
            
            <td>10.608910453011
            </td>
            <td>80.370639277117
            </td>
            <td>12.558043739472
            </td>
            <td>18.375523859177
            </td>
            <td>18.63021181657
            </td>
            <td>28.033630614142
            </td><td>6.4284989175805</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>22</td>
            <td>17.44330621375
            </td>
            <td>72.615608406204
            </td>
            
            <td>4.6734335343514
            </td>
            <td>85.321038775981
            </td>
            <td>17.309938259927
            </td>
            <td>13.024287270993
            </td>
            <td>18.45968643015
            </td>
            <td>31.133042260758
            </td><td>4.6734335343514</td>
            <td>3
            </td></tr><tr>
            <td>23</td>
            <td>6.4336465554147
            </td>
            <td>58.264187761035
            </td>
            
            <td>15.752844314599
            </td>
            <td>77.600418647791
            </td>
            <td>13.940153624064
            </td>
            <td>23.306208039707
            </td>
            <td>19.433009626353
            </td>
            <td>25.971918706271
            </td><td>6.4336465554147</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>24</td>
            <td>3.956058434014
            </td>
            <td>60.847179755541
            </td>
            
            <td>13.680927636677
            </td>
            <td>79.796526602431
            </td>
            <td>14.4056503693
            </td>
            <td>20.743612922998
            </td>
            <td>19.296427529654
            </td>
            <td>27.528831620869
            </td><td>3.956058434014</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>25</td>
            <td>16.813325617894
            </td>
            <td>71.88923955783
            </td>
            
            <td>0.92048954366685
            </td>
            <td>84.278613288381
            </td>
            <td>17.383025702176
            </td>
            <td>13.59051169045
            </td>
            <td>15.236067987341
            </td>
            <td>28.191557165402
            </td><td>0.92048954366685</td>
            <td>3
            </td></tr><tr>
            <td>26</td>
            <td>42.885894880096
            </td>
            <td>24.966561471359
            </td>
            
            <td>58.189252521406
            </td>
            <td>75.682198744569
            </td>
            <td>47.680892143106
            </td>
            <td>62.908027728864
            </td>
            <td>58.771534863855
            </td>
            <td>56.244269180603
            </td><td>24.966561471359</td>
            <td>2
            </td></tr><tr>
            <td>27</td>
            <td>21.656695192634
            </td>
            <td>75.879667473923
            </td>
            
            <td>10.797731057958
            </td>
            <td>80.8347120321
            </td>
            <td>19.448345175426
            </td>
            <td>3.2283025245603
            </td>
            <td>19.829068568437
            </td>
            <td>32.508917161837
            </td><td>3.2283025245603</td>
            <td>6
            </td></tr><tr>
            <td>28</td>
            <td>101.5836500542
            </td>
            <td>86.03083254975
            </td>
            
            <td>107.08432070569
            </td>
            <td>22.9732019495
            </td>
            <td>93.513452896161
            </td>
            <td>100.96472289778
            </td>
            <td>107.58575673898
            </td>
            <td>105.2476826724
            </td><td>22.9732019495</td>
            <td>4
            </td></tr><tr>
            <td>29</td>
            <td>27.478131880946
            </td>
            <td>31.736091980632
            </td>
            
            <td>40.672027008744
            </td>
            <td>69.617010549236
            </td>
            <td>27.623337281409
            </td>
            <td>46.434121709335
            </td>
            <td>43.434064972353
            </td>
            <td>42.890664140465
            </td><td>27.478131880946</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>30</td>
            <td>9.0275429473731
            </td>
            <td>54.532836751843
            </td>
            
            <td>18.104413301734
            </td>
            <td>75.654449028544
            </td>
            <td>9.2722307220269
            </td>
            <td>25.311815868359
            </td>
            <td>24.240750020596
            </td>
            <td>29.91955373013
            </td><td>9.0275429473731</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>31</td>
            <td>18.599889739817
            </td>
            <td>66.030782853175
            </td>
            
            <td>14.365593652892
            </td>
            <td>72.972996086309
            </td>
            <td>8.5306220501497
            </td>
            <td>13.359486748752
            </td>
            <td>23.694992980169
            </td>
            <td>32.976639578801
            </td><td>8.5306220501497</td>
            <td>5
            </td></tr><tr>
            <td>32</td>
            <td>79.386290157684
            </td>
            <td>23.263496818044
            </td>
            
            <td>93.683145661319
            </td>
            <td>83.702453117053
            </td>
            <td>79.948478800803
            </td>
            <td>98.375214103078
            </td>
            <td>94.633299758063
            </td>
            <td>90.064572365665
            </td><td>23.263496818044</td>
            <td>2
            </td></tr><tr>
            <td>33</td>
            <td>22.038693208385
            </td>
            <td>75.891726058926
            </td>
            
            <td>11.689096671685
            </td>
            <td>79.98030793772
            </td>
            <td>19.552211193686
            </td>
            <td>2.2325413177671
            </td>
            <td>20.307547479643
            </td>
            <td>32.768411929939
            </td><td>2.2325413177671</td>
            <td>6
            </td></tr><tr>
            <td>34</td>
            <td>22.120661683895
            </td>
            <td>75.959622681745
            </td>
            
            <td>11.644430256565
            </td>
            <td>80.138051793842
            </td>
            <td>19.561545185964
            </td>
            <td>2.2500620817882
            </td>
            <td>20.308132300203
            </td>
            <td>32.809144472771
            </td><td>2.2500620817882</td>
            <td>6
            </td></tr><tr>
            <td>35</td>
            <td>72.606632376113
            </td>
            <td>18.320692787204
            </td>
            
            <td>86.076197528701
            </td>
            <td>78.436762157884
            </td>
            <td>71.812354525962
            </td>
            <td>91.036241658369
            </td>
            <td>87.941608031122
            </td>
            <td>83.909897779762
            </td><td>18.320692787204</td>
            <td>2
            </td></tr><tr>
            <td>36</td>
            <td>10.393799353461
            </td>
            <td>56.318394279339
            </td>
            
            <td>25.263645441622
            </td>
            <td>80.653599782108
            </td>
            <td>22.716552611752
            </td>
            <td>29.472437429033
            </td>
            <td>28.343227382994
            </td>
            <td>33.403129649932
            </td><td>10.393799353461</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>37</td>
            <td>7.6794647165889
            </td>
            <td>53.1142359373
            </td>
            
            <td>19.755416497761
            </td>
            <td>75.68631849821
            </td>
            <td>10.82922723755
            </td>
            <td>26.395514336705
            </td>
            <td>25.604097103473
            </td>
            <td>30.890499678868
            </td><td>7.6794647165889</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>38</td>
            <td>17.946238826005
            </td>
            <td>54.526579201827
            </td>
            
            <td>32.833524696566
            </td>
            <td>81.865276682562
            </td>
            <td>29.505242636903
            </td>
            <td>36.329652092885
            </td>
            <td>34.796947599105
            </td>
            <td>38.125963834179
            </td><td>17.946238826005</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>39</td>
            <td>87.801084266274
            </td>
            <td>71.489843923477
            </td>
            
            <td>93.855483489245
            </td>
            <td>13.042264290088
            </td>
            <td>79.403726377057
            </td>
            <td>88.713256285267
            </td>
            <td>94.935001448478
            </td>
            <td>92.7392463869
            </td><td>13.042264290088</td>
            <td>4
            </td></tr><tr>
            <td>40</td>
            <td>8.1249655383885
            </td>
            <td>52.009090880375
            </td>
            
            <td>20.280724370692
            </td>
            <td>75.092830269024
            </td>
            <td>11.669522807832
            </td>
            <td>27.192616391037
            </td>
            <td>24.941215503495
            </td>
            <td>29.636406165562
            </td><td>8.1249655383885</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>41</td>
            <td>42.986863090174
            </td>
            <td>25.961077292807
            </td>
            
            <td>59.190250725943
            </td>
            <td>75.543154274974
            </td>
            <td>48.776385296191
            </td>
            <td>63.785897734738
            </td>
            <td>59.328227812797
            </td>
            <td>56.382845976504
            </td><td>25.961077292807</td>
            <td>2
            </td></tr><tr>
            <td>42</td>
            <td>6.1604976801121
            </td>
            <td>57.631070475943
            </td>
            
            <td>20.670795364475
            </td>
            <td>80.254380925981
            </td>
            <td>18.770169486781
            </td>
            <td>25.63474249049
            </td>
            <td>24.811076156075
            </td>
            <td>31.118980468681
            </td><td>6.1604976801121</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>43</td>
            <td>42.587209327841
            </td>
            <td>25.883924242725
            </td>
            
            <td>58.897247652161
            </td>
            <td>75.728252045142
            </td>
            <td>48.338760457448
            </td>
            <td>63.416407575851
            </td>
            <td>59.342812409237
            </td>
            <td>56.621774260528
            </td><td>25.883924242725</td>
            <td>2
            </td></tr><tr>
            <td>44</td>
            <td>30.284168553883
            </td>
            <td>69.746257313229
            </td>
            
            <td>29.506995458704
            </td>
            <td>82.846843076924
            </td>
            <td>33.089099603381
            </td>
            <td>34.883324028553
            </td>
            <td>15.479533013959
            </td>
            <td>4.3548832257773
            </td><td>4.3548832257773</td>
            <td>8
            </td></tr><tr>
            <td>45</td>
            <td>24.751542174176
            </td>
            <td>76.412321178938
            </td>
            
            <td>16.174098305624
            </td>
            <td>76.559364843973
            </td>
            <td>20.804602857601
            </td>
            <td>2.8549235476296
            </td>
            <td>23.188863188697
            </td>
            <td>34.636433470194
            </td><td>2.8549235476296</td>
            <td>6
            </td></tr><tr>
            <td>46</td>
            <td>22.480180122351
            </td>
            <td>76.300099093665
            </td>
            
            <td>11.682545998197
            </td>
            <td>86.706809322062
            </td>
            <td>24.939180771679
            </td>
            <td>17.927530753491
            </td>
            <td>6.6272283642402
            </td>
            <td>20.726734889031
            </td><td>6.6272283642402</td>
            <td>7
            </td></tr><tr>
            <td>47</td>
            <td>24.185017400586
            </td>
            <td>76.311590623267
            </td>
            
            <td>15.251818776789
            </td>
            <td>77.241054202493
            </td>
            <td>20.477173512536
            </td>
            <td>1.8742661373772
            </td>
            <td>22.559445691488
            </td>
            <td>34.223335770862
            </td><td>1.8742661373772</td>
            <td>6
            </td></tr><tr>
            <td>48</td>
            <td>22.059684222581
            </td>
            <td>75.912014088372
            </td>
            
            <td>11.643339898843
            </td>
            <td>80.120453314447
            </td>
            <td>19.536877131786
            </td>
            <td>2.2495341960445
            </td>
            <td>20.297141226885
            </td>
            <td>32.790867364789
            </td><td>2.2495341960445</td>
            <td>6
            </td></tr><tr>
            <td>49</td>
            <td>63.22190079395
            </td>
            <td>63.763116991354
            </td>
            
            <td>68.16185645946
            </td>
            <td>16.904818967161
            </td>
            <td>55.53856709587
            </td>
            <td>62.206997493771
            </td>
            <td>68.829743301745
            </td>
            <td>67.921001253553
            </td><td>16.904818967161</td>
            <td>4
            </td></tr><tr>
            <td>50</td>
            <td>21.513337506456
            </td>
            <td>75.063444987911
            </td>
            
            <td>10.768463214405
            </td>
            <td>85.708202328088
            </td>
            <td>23.854750869848
            </td>
            <td>17.852302792869
            </td>
            <td>7.7923800688842
            </td>
            <td>21.45209834224
            </td><td>7.7923800688842</td>
            <td>7
            </td></tr><tr>
            <td>51</td>
            <td>28.991593580439
            </td>
            <td>72.372851672455
            </td>
            
            <td>26.380585304348
            </td>
            <td>84.454303666613
            </td>
            <td>31.866075418264
            </td>
            <td>31.512643563686
            </td>
            <td>11.518173767817
            </td>
            <td>4.680178459221
            </td><td>4.680178459221</td>
            <td>8
            </td></tr><tr>
            <td>52</td>
            <td>28.274914205587
            </td>
            <td>69.099612628821
            </td>
            
            <td>27.51601817124
            </td>
            <td>82.639990139838
            </td>
            <td>31.153646256297
            </td>
            <td>33.014781913962
            </td>
            <td>13.600168869973
            </td>
            <td>3.4014875106571
            </td><td>3.4014875106571</td>
            <td>8
            </td></tr><tr>
            <td>53</td>
            <td>22.742058650585
            </td>
            <td>77.390259055666
            </td>
            
            <td>11.312368496473
            </td>
            <td>87.744589763771
            </td>
            <td>25.083865084203
            </td>
            <td>16.822172997919
            </td>
            <td>7.701156133451
            </td>
            <td>21.814100409143
            </td><td>7.701156133451</td>
            <td>7
            </td></tr><tr>
            <td>54</td>
            <td>29.151107348893
            </td>
            <td>67.402663212985
            </td>
            
            <td>30.276118459935
            </td>
            <td>82.533222121837
            </td>
            <td>31.968367342773
            </td>
            <td>35.191191986956
            </td>
            <td>17.087486821318
            </td>
            <td>4.4905747304946
            </td><td>4.4905747304946</td>
            <td>8
            </td></tr><tr>
            <td>55</td>
            <td>27.488533148691
            </td>
            <td>69.451871119165
            </td>
            
            <td>26.054915927709
            </td>
            <td>82.760315377072
            </td>
            <td>29.91714421636
            </td>
            <td>31.574370407731
            </td>
            <td>12.127467183703
            </td>
            <td>3.104410094552
            </td><td>3.104410094552</td>
            <td>8
            </td></tr><tr>
            <td>56</td>
            <td>22.6669353538
            </td>
            <td>76.137605026709
            </td>
            
            <td>12.087586235473
            </td>
            <td>86.397022563353
            </td>
            <td>25.315486812671
            </td>
            <td>18.584803097964
            </td>
            <td>8.1821343383161
            </td>
            <td>21.627579797799
            </td><td>8.1821343383161</td>
            <td>7
            </td></tr><tr>
            <td>57</td>
            <td>22.989589926747
            </td>
            <td>70.269607919805
            </td>
            
            <td>20.404481885115
            </td>
            <td>83.454599943996
            </td>
            <td>26.561457086585
            </td>
            <td>26.190910435928
            </td>
            <td>6.3195068350263
            </td>
            <td>8.853317141623
            </td><td>6.3195068350263</td>
            <td>7
            </td></tr><tr>
            <td>58</td>
            <td>27.249813130858
            </td>
            <td>71.246002903343
            </td>
            
            <td>25.579834342701
            </td>
            <td>84.352843809871
            </td>
            <td>30.729537119236
            </td>
            <td>30.637492242632
            </td>
            <td>10.840104474707
            </td>
            <td>4.2966565676298
            </td><td>4.2966565676298</td>
            <td>8
            </td></tr><tr>
            <td>59</td>
            <td>26.759568780781
            </td>
            <td>68.26910787064
            </td>
            
            <td>26.617945901215
            </td>
            <td>82.369552179871
            </td>
            <td>29.995946277164
            </td>
            <td>32.035579840789
            </td>
            <td>12.877740212634
            </td>
            <td>2.7872532689292
            </td><td>2.7872532689292</td>
            <td>8
            </td></tr><tr>
            <td>60</td>
            <td>23.816305786862
            </td>
            <td>70.680209142681
            </td>
            
            <td>20.853775293697
            </td>
            <td>83.506527147957
            </td>
            <td>27.130281846352
            </td>
            <td>26.673763468129
            </td>
            <td>6.6389390880522
            </td>
            <td>8.6613498246611
            </td><td>6.6389390880522</td>
            <td>7
            </td></tr><tr>
            <td>61</td>
            <td>21.826905567823
            </td>
            <td>76.185637609415
            </td>
            
            <td>10.471540287847
            </td>
            <td>86.71796437482
            </td>
            <td>24.279187590661
            </td>
            <td>16.953560562181
            </td>
            <td>7.6603509047626
            </td>
            <td>21.859839570206
            </td><td>7.6603509047626</td>
            <td>7
            </td></tr><tr>
            <td>62</td>
            <td>22.135814419171
            </td>
            <td>76.287402603268
            </td>
            
            <td>11.076028891259
            </td>
            <td>86.796620955614
            </td>
            <td>24.552315574351
            </td>
            <td>17.332300925495
            </td>
            <td>6.8845983280032
            </td>
            <td>21.113749608612
            </td><td>6.8845983280032</td>
            <td>7
            </td></tr><tr>
            <td>63</td>
            <td>23.407668686423
            </td>
            <td>77.106687232387
            </td>
            
            <td>12.810509591738
            </td>
            <td>87.209231101487
            </td>
            <td>26.124520858046
            </td>
            <td>18.654693070477
            </td>
            <td>6.9913925310026
            </td>
            <td>20.789679892561
            </td><td>6.9913925310026</td>
            <td>7
            </td></tr><tr>
            <td>64</td>
            <td>22.182925859017
            </td>
            <td>76.222275505282
            </td>
            
            <td>11.115101843888
            </td>
            <td>86.630600966474
            </td>
            <td>24.680760737111
            </td>
            <td>17.561117142169
            </td>
            <td>7.428081159685
            </td>
            <td>21.484843062265
            </td><td>7.428081159685</td>
            <td>7
            </td></tr><tr>
            <td>65</td>
            <td>21.867256983902
            </td>
            <td>76.321297581036
            </td>
            
            <td>10.531352429769
            </td>
            <td>86.907397822697
            </td>
            <td>24.214725541755
            </td>
            <td>16.775199207843
            </td>
            <td>7.28685486018
            </td>
            <td>21.55461147377
            </td><td>7.28685486018</td>
            <td>7
            </td></tr><tr>
            <td>66</td>
            <td>24.224025154104
            </td>
            <td>66.040894731622
            </td>
            
            <td>25.015954589022
            </td>
            <td>81.447225068215
            </td>
            <td>27.045603303726
            </td>
            <td>30.561328494879
            </td>
            <td>12.747439482842
            </td>
            <td>5.5323238367937
            </td><td>5.5323238367937</td>
            <td>8
            </td></tr><tr>
            <td>67</td>
            <td>23.431203973903
            </td>
            <td>76.320419100678
            </td>
            
            <td>13.60467011728
            </td>
            <td>86.599412623946
            </td>
            <td>26.046427117025
            </td>
            <td>19.607130196786
            </td>
            <td>5.6872930785234
            </td>
            <td>19.22013886943
            </td><td>5.6872930785234</td>
            <td>7
            </td></tr><tr>
            <td>68</td>
            <td>27.672993814668
            </td>
            <td>68.945707831983
            </td>
            
            <td>26.92881089094
            </td>
            <td>82.493222535627
            </td>
            <td>30.54807956423
            </td>
            <td>32.399560615835
            </td>
            <td>13.039231273924
            </td>
            <td>2.8341283995536
            </td><td>2.8341283995536</td>
            <td>8
            </td></tr><tr>
            <td>69</td>
            <td>22.094751616617
            </td>
            <td>76.261359135562
            </td>
            
            <td>11.077658823055
            </td>
            <td>86.785890695507
            </td>
            <td>24.542148980122
            </td>
            <td>17.332792882256
            </td>
            <td>6.8623383001449
            </td>
            <td>21.093371681885
            </td><td>6.8623383001449</td>
            <td>7
            </td></tr><tr>
            <td>70</td>
            <td>26.916311485789
            </td>
            <td>71.450910830116
            </td>
            
            <td>24.904413263516
            </td>
            <td>84.43507906263
            </td>
            <td>30.191409193055
            </td>
            <td>29.951322000101
            </td>
            <td>10.161986112632
            </td>
            <td>4.6659046052353
            </td><td>4.6659046052353</td>
            <td>8
            </td></tr><tr>
            <td>71</td>
            <td>27.006009497888
            </td>
            <td>69.25751125115
            </td>
            
            <td>26.420814238021
            </td>
            <td>83.392453428428
            </td>
            <td>29.561922325223
            </td>
            <td>31.297918984104
            </td>
            <td>13.176380135838
            </td>
            <td>5.023817040872
            </td><td>5.023817040872</td>
            <td>8
            </td></tr><tr>
            <td>72</td>
            <td>32.926658196665
            </td>
            <td>73.838586734533
            </td>
            
            <td>31.246643915787
            </td>
            <td>86.235285349516
            </td>
            <td>35.685507423357
            </td>
            <td>35.487333603428
            </td>
            <td>16.488431501168
            </td>
            <td>5.5395895637814
            </td><td>5.5395895637814</td>
            <td>8
            </td></tr><tr>
            <td>73</td>
            <td>21.238524077723
            </td>
            <td>75.579964237906
            </td>
            
            <td>10.349648351514
            </td>
            <td>86.718229674115
            </td>
            <td>23.025774744023
            </td>
            <td>16.333066093305
            </td>
            <td>7.7004463421748
            </td>
            <td>21.291554555977
            </td><td>7.7004463421748</td>
            <td>7
            </td></tr><tr>
            <td>74</td>
            <td>30.485830123737
            </td>
            <td>67.703249509925
            </td>
            
            <td>31.344971223467
            </td>
            <td>82.267741902963
            </td>
            <td>33.347898023151
            </td>
            <td>36.508713191749
            </td>
            <td>17.724275748018
            </td>
            <td>3.7980646927292
            </td><td>3.7980646927292</td>
            <td>8
            </td></tr><tr>
            <td>75</td>
            <td>21.532068827681
            </td>
            <td>75.440848530177
            </td>
            
            <td>10.987716960315
            </td>
            <td>86.432235834279
            </td>
            <td>23.517279775997
            </td>
            <td>17.168991745403
            </td>
            <td>6.1375992161385
            </td>
            <td>20.126622034886
            </td><td>6.1375992161385</td>
            <td>7
            </td></tr><tr>
            <td>76</td>
            <td>27.092879993336
            </td>
            <td>68.715947779268
            </td>
            
            <td>25.988716955633
            </td>
            <td>82.059198337618
            </td>
            <td>29.991134532767
            </td>
            <td>31.863463516714
            </td>
            <td>12.699387199914
            </td>
            <td>6.4802476349408
            </td><td>6.4802476349408</td>
            <td>8
            </td></tr><tr>
            <td>77</td>
            <td>26.619173290444
            </td>
            <td>68.928625700453
            </td>
            
            <td>25.4109790445
            </td>
            <td>82.340947524986
            </td>
            <td>29.272637224249
            </td>
            <td>31.030051136821
            </td>
            <td>11.657955533234
            </td>
            <td>3.7704197425693
            </td><td>3.7704197425693</td>
            <td>8
            </td></tr><tr>
            <td>78</td>
            <td>22.174810897352
            </td>
            <td>76.391299077206
            </td>
            
            <td>11.220555289289
            </td>
            <td>86.984804056872
            </td>
            <td>24.510994626137
            </td>
            <td>17.217005293633
            </td>
            <td>6.5981410627614
            </td>
            <td>20.826411192526
            </td><td>6.5981410627614</td>
            <td>7
            </td></tr><tr>
            <td>79</td>
            <td>23.445105558872
            </td>
            <td>77.321601269976
            </td>
            
            <td>12.904390105697
            </td>
            <td>87.574144125492
            </td>
            <td>25.983290554941
            </td>
            <td>18.330520513095
            </td>
            <td>6.1263067415687
            </td>
            <td>20.128771386629
            </td><td>6.1263067415687</td>
            <td>7
            </td></tr><tr>
            <td>80</td>
            <td>22.587896131926
            </td>
            <td>76.727952267757
            </td>
            
            <td>12.013774635809
            </td>
            <td>87.446694093102
            </td>
            <td>24.693031660015
            </td>
            <td>17.33295245293
            </td>
            <td>6.9496084576663
            </td>
            <td>20.566873435458
            </td><td>6.9496084576663</td>
            <td>7
            </td></tr><tr>
            <td>81</td>
            <td>25.050374148902
            </td>
            <td>70.970541756444
            </td>
            
            <td>22.701164749854
            </td>
            <td>84.045643859825
            </td>
            <td>28.363903161633
            </td>
            <td>28.017205240045
            </td>
            <td>8.1177401473244
            </td>
            <td>6.4522263142388
            </td><td>6.4522263142388</td>
            <td>8
            </td></tr><tr>
            <td>82</td>
            <td>25.955871185533
            </td>
            <td>68.561061687397
            </td>
            
            <td>25.266458497383
            </td>
            <td>82.497604564087
            </td>
            <td>28.812574538949
            </td>
            <td>30.682525734737
            </td>
            <td>11.61882009531
            </td>
            <td>3.3126662464179
            </td><td>3.3126662464179</td>
            <td>8
            </td></tr><tr>
            <td>83</td>
            <td>31.373153618978
            </td>
            <td>72.50770210435
            </td>
            
            <td>30.37408013422
            </td>
            <td>85.460015658274
            </td>
            <td>34.759231767438
            </td>
            <td>34.830910818737
            </td>
            <td>15.556700902958
            </td>
            <td>4.0602562462431
            </td><td>4.0602562462431</td>
            <td>8
            </td></tr><tr>
            <td>84</td>
            <td>24.810699734859
            </td>
            <td>68.583093503087
            </td>
            
            <td>23.181327485716
            </td>
            <td>82.11752295529
            </td>
            <td>27.389454048274
            </td>
            <td>29.112150279863
            </td>
            <td>9.8199293385883
            </td>
            <td>6.0433004877431
            </td><td>6.0433004877431</td>
            <td>8
            </td></tr><tr>
            <td>85</td>
            <td>23.10755041828
            </td>
            <td>77.236489324691
            </td>
            
            <td>12.22853503082
            </td>
            <td>87.484817904666
            </td>
            <td>25.663972423662
            </td>
            <td>17.860481028061
            </td>
            <td>6.7135858027027
            </td>
            <td>20.831659413262
            </td><td>6.7135858027027</td>
            <td>7
            </td></tr><tr>
            <td>86</td>
            <td>27.377165637321
            </td>
            <td>72.062908605628
            </td>
            
            <td>24.654849036244
            </td>
            <td>84.466404758416
            </td>
            <td>30.204477111225
            </td>
            <td>29.72036468651
            </td>
            <td>9.8267084061491
            </td>
            <td>4.9341072303058
            </td><td>4.9341072303058</td>
            <td>8
            </td></tr><tr>
            <td>87</td>
            <td>22.431630547065
            </td>
            <td>76.359641809028
            </td>
            
            <td>11.735183211182
            </td>
            <td>86.872267288315
            </td>
            <td>24.845866387842
            </td>
            <td>17.760228295244
            </td>
            <td>6.1437393417594
            </td>
            <td>20.363701257634
            </td><td>6.1437393417594</td>
            <td>7
            </td></tr><tr>
            <td>88</td>
            <td>21.642174836801
            </td>
            <td>66.418994152299
            </td>
            
            <td>20.277371156045
            </td>
            <td>80.746459103867
            </td>
            <td>23.479283689297
            </td>
            <td>26.802306970061
            </td>
            <td>9.1938043531553
            </td>
            <td>9.1723263357862
            </td><td>9.1723263357862</td>
            <td>8
            </td></tr><tr>
            <td>89</td>
            <td>24.763165656542
            </td>
            <td>68.365599649627
            </td>
            
            <td>23.856388159149
            </td>
            <td>82.45229208647
            </td>
            <td>27.557660914209
            </td>
            <td>29.426148039844
            </td>
            <td>10.445971666677
            </td>
            <td>4.7786103926933
            </td><td>4.7786103926933</td>
            <td>8
            </td></tr><tr>
            <td>90</td>
            <td>26.633046339714
            </td>
            <td>68.909579584069
            </td>
            
            <td>25.669433184237
            </td>
            <td>82.660405130343
            </td>
            <td>29.34324775928
            </td>
            <td>31.145331745764
            </td>
            <td>11.853521069848
            </td>
            <td>2.9644840672799
            </td><td>2.9644840672799</td>
            <td>8
            </td></tr><tr>
            <td>91</td>
            <td>25.46037278465
            </td>
            <td>67.186538753705
            </td>
            
            <td>25.546700863321
            </td>
            <td>82.081042505639
            </td>
            <td>27.586269257776
            </td>
            <td>30.741032040538
            </td>
            <td>13.448803679405
            </td>
            <td>6.4760124814701
            </td><td>6.4760124814701</td>
            <td>8
            </td></tr><tr>
            <td>92</td>
            <td>23.674842202924
            </td>
            <td>70.794681233502
            </td>
            
            <td>21.24506427385
            </td>
            <td>84.199313769843
            </td>
            <td>26.924996565692
            </td>
            <td>26.446961174621
            </td>
            <td>7.3525968923246
            </td>
            <td>8.2726690091624
            </td><td>7.3525968923246</td>
            <td>7
            </td></tr><tr>
            <td>93</td>
            <td>22.03314502441
            </td>
            <td>70.212776466987
            </td>
            
            <td>19.264563555918
            </td>
            <td>83.440110449427
            </td>
            <td>25.523776181484
            </td>
            <td>25.004787505397
            </td>
            <td>5.4663140322783
            </td>
            <td>9.6941275734414
            </td><td>5.4663140322783</td>
            <td>7
            </td></tr><tr>
            <td>94</td>
            <td>26.135844862309
            </td>
            <td>71.767736072368
            </td>
            
            <td>23.770314596151
            </td>
            <td>84.926860529002
            </td>
            <td>29.015207910034
            </td>
            <td>28.513242233121
            </td>
            <td>9.8006399076531
            </td>
            <td>7.0850945678344
            </td><td>7.0850945678344</td>
            <td>8
            </td></tr><tr>
            <td>95</td>
            <td>22.873980232278
            </td>
            <td>77.21356371586
            </td>
            
            <td>11.60009400824
            </td>
            <td>87.42456109591
            </td>
            <td>25.399899361267
            </td>
            <td>17.435176167973
            </td>
            <td>7.4237090319994
            </td>
            <td>21.589246783067
            </td><td>7.4237090319994</td>
            <td>7
            </td></tr><tr>
            <td>96</td>
            <td>29.108844286001
            </td>
            <td>69.768844154846
            </td>
            
            <td>28.57350914746
            </td>
            <td>83.542227578707
            </td>
            <td>31.729674621126
            </td>
            <td>33.458513062775
            </td>
            <td>14.659964884241
            </td>
            <td>2.4482111142947
            </td><td>2.4482111142947</td>
            <td>8
            </td></tr><tr>
            <td>97</td>
            <td>21.24195649338
            </td>
            <td>76.395856806525
            </td>
            
            <td>8.9619264112132
            </td>
            <td>87.110005991347
            </td>
            <td>23.397689556076
            </td>
            <td>15.374891219396
            </td>
            <td>9.0818026433813
            </td>
            <td>23.285681199187
            </td><td>8.9619264112132</td>
            <td>3
            </td></tr><tr>
            <td>98</td>
            <td>22.027302656779
            </td>
            <td>76.490338113406
            </td>
            
            <td>10.774846866661
            </td>
            <td>87.126414300214
            </td>
            <td>24.235240901681
            </td>
            <td>16.715134350998
            </td>
            <td>7.1956211860637
            </td>
            <td>21.355620575393
            </td><td>7.1956211860637</td>
            <td>7
            </td></tr><tr>
            <td>99</td>
            <td>23.845149185247
            </td>
            <td>76.575015665706
            </td>
            
            <td>14.258782170999
            </td>
            <td>86.891620550042
            </td>
            <td>26.314214990429
            </td>
            <td>19.885196778442
            </td>
            <td>4.4235741578786
            </td>
            <td>18.119926859956
            </td><td>4.4235741578786</td>
            <td>7
            </td></tr><tr>
            <td>100</td>
            <td>23.200970985428
            </td>
            <td>76.794325242515
            </td>
            
            <td>13.157233903826
            </td>
            <td>87.42949849057
            </td>
            <td>25.357481205011
            </td>
            <td>18.342249225344
            </td>
            <td>5.9265288114822
            </td>
            <td>19.379945453617
            </td><td>5.9265288114822</td>
            <td>7
            </td></tr><tr>
            <td>101</td>
            <td>23.357526089036
            </td>
            <td>68.533702633836
            </td>
            
            <td>21.381084654432
            </td>
            <td>82.242483746617
            </td>
            <td>25.654688412891
            </td>
            <td>27.319766483913
            </td>
            <td>8.3901222843077
            </td>
            <td>7.1836282030849
            </td><td>7.1836282030849</td>
            <td>8
            </td></tr><tr>
            <td>102</td>
            <td>26.954625453405
            </td>
            <td>71.493143314259
            </td>
            
            <td>24.870785190661
            </td>
            <td>84.447761008285
            </td>
            <td>30.180835642217
            </td>
            <td>29.924232365169
            </td>
            <td>10.11442364529
            </td>
            <td>4.6836366783896
            </td><td>4.6836366783896</td>
            <td>8
            </td></tr><tr>
            <td>103</td>
            <td>23.197009426504
            </td>
            <td>75.609033086022
            </td>
            
            <td>14.005518519498
            </td>
            <td>86.324552948813
            </td>
            <td>25.350076736817
            </td>
            <td>19.793236218675
            </td>
            <td>3.4103655149611
            </td>
            <td>17.247400366726
            </td><td>3.4103655149611</td>
            <td>7
            </td></tr><tr>
            <td>104</td>
            <td>30.331881505549
            </td>
            <td>72.497860862946
            </td>
            
            <td>28.832300029654
            </td>
            <td>85.273065259861
            </td>
            <td>33.492280477186
            </td>
            <td>33.383382965033
            </td>
            <td>14.029418665771
            </td>
            <td>3.5996746603209
            </td><td>3.5996746603209</td>
            <td>8
            </td></tr><tr>
            <td>105</td>
            <td>21.576466068381
            </td>
            <td>75.487677401369
            </td>
            
            <td>10.989960145515
            </td>
            <td>86.44429516349
            </td>
            <td>23.537228449044
            </td>
            <td>17.167918688623
            </td>
            <td>6.1574019795644
            </td>
            <td>20.144156306114
            </td><td>6.1574019795644</td>
            <td>7
            </td></tr><tr>
            <td>106</td>
            <td>29.191461674035
            </td>
            <td>69.904521952826
            </td>
            
            <td>28.50609240145
            </td>
            <td>83.573355241443
            </td>
            <td>31.71597867105
            </td>
            <td>33.400153610277
            </td>
            <td>14.576112620927
            </td>
            <td>2.4505302049059
            </td><td>2.4505302049059</td>
            <td>8
            </td></tr><tr>
            <td>107</td>
            <td>31.431406262951
            </td>
            <td>68.973010639692
            </td>
            
            <td>31.515982437487
            </td>
            <td>83.011436060416
            </td>
            <td>33.619208282803
            </td>
            <td>36.452330016676
            </td>
            <td>17.852752822191
            </td>
            <td>4.1146370629931
            </td><td>4.1146370629931</td>
            <td>8
            </td></tr><tr>
            <td>108</td>
            <td>22.262413428617
            </td>
            <td>76.280891917328
            </td>
            
            <td>11.115204946379
            </td>
            <td>86.651810037716
            </td>
            <td>24.70454791253
            </td>
            <td>17.560913850964
            </td>
            <td>7.4676307914856
            </td>
            <td>21.522136898091
            </td><td>7.4676307914856</td>
            <td>7
            </td></tr><tr>
            <td>109</td>
            <td>22.705990890805
            </td>
            <td>76.312208654337
            </td>
            
            <td>12.307880605531
            </td>
            <td>86.764272248504
            </td>
            <td>25.204222891462
            </td>
            <td>18.342486101178
            </td>
            <td>5.8162872461951
            </td>
            <td>19.931272855996
            </td><td>5.8162872461951</td>
            <td>7
            </td></tr><tr>
            <td>110</td>
            <td>23.05650244508
            </td>
            <td>77.09945894235
            </td>
            
            <td>12.17821912268
            </td>
            <td>87.293353743641
            </td>
            <td>25.72381877876
            </td>
            <td>18.027872682677
            </td>
            <td>7.1081037733933
            </td>
            <td>21.139210792037
            </td><td>7.1081037733933</td>
            <td>7
            </td></tr><tr>
            <td>111</td>
            <td>22.866373761487
            </td>
            <td>77.271794172927
            </td>
            
            <td>11.734995739241
            </td>
            <td>87.598676752634
            </td>
            <td>25.3413792356
            </td>
            <td>17.320328781498
            </td>
            <td>7.1364558931494
            </td>
            <td>21.28859154947
            </td><td>7.1364558931494</td>
            <td>7
            </td></tr><tr>
            <td>112</td>
            <td>27.022779766955
            </td>
            <td>67.505096023953
            </td>
            
            <td>26.515412291722
            </td>
            <td>81.586097172328
            </td>
            <td>29.183158337687
            </td>
            <td>32.238858004942
            </td>
            <td>13.412401145362
            </td>
            <td>3.7300206983549
            </td><td>3.7300206983549</td>
            <td>8
            </td></tr><tr>
            <td>113</td>
            <td>23.210530225166
            </td>
            <td>77.363008185134
            </td>
            
            <td>12.438474022162
            </td>
            <td>87.688880539738
            </td>
            <td>25.667302255253
            </td>
            <td>17.804555425996
            </td>
            <td>6.5876646544494
            </td>
            <td>20.601905974573
            </td><td>6.5876646544494</td>
            <td>7
            </td></tr><tr>
            <td>114</td>
            <td>23.107757514162
            </td>
            <td>77.231823887262
            </td>
            
            <td>12.227399560005
            </td>
            <td>87.484693811618
            </td>
            <td>25.661869847353
            </td>
            <td>17.860479188041
            </td>
            <td>6.7149327151292
            </td>
            <td>20.832953692051
            </td><td>6.7149327151292</td>
            <td>7
            </td></tr><tr>
            <td>115</td>
            <td>27.075375891512
            </td>
            <td>67.242007548876
            </td>
            
            <td>27.327197240112
            </td>
            <td>81.97074314542
            </td>
            <td>29.51747280108
            </td>
            <td>32.696248436578
            </td>
            <td>14.267726244094
            </td>
            <td>3.2554756810881
            </td><td>3.2554756810881</td>
            <td>8
            </td></tr></tbody></table><br><br>Centroid baru :<table class="table table-striped table-responsive">
    <tbody><tr>
        <td>
        </td><td>Luas lahan</td><td>Daya tampung</td><td>Jumlah pembangkit</td><td>Kapasitas pemakaian</td><td>Sumber daya</td><td>Jumlah kamar</td><td>Jumlah meja</td><td>Jumlah sarana layanan</td><td>Jumlah lantai</td><td>Kebutuhan keamanan tambahan</td><td>Potensi kecelakaan</td><td>Kebutuhan tenaga medis darurat</td></tr>
        <tr>
        <td>
            c1 Baru
        </td><td>15.4803125</td><td>3.00125</td><td>0.5</td><td>17.425</td><td>1.875</td><td>0</td><td>0</td><td>6</td><td>1</td><td>2.1875</td><td>2.0625</td><td>2.0625</td></tr>
        <tr>
        <td>
            c2 Baru 
        </td><td>43.590428571429</td><td>18.142857142857</td><td>2.4285714285714</td><td>64.928571428571</td><td>2</td><td>0</td><td>0</td><td>13.857142857143</td><td>1</td><td>3.5714285714286</td><td>3.7142857142857</td><td>3.2857142857143</td></tr>
        <tr>
        <td>
            c3 Baru 
        </td><td>0.59483333333333</td><td>0.475</td><td>0.33333333333333</td><td>6.8</td><td>1</td><td>0</td><td>1</td><td>6.1666666666667</td><td>1</td><td>2.5</td><td>1.8333333333333</td><td>2.1666666666667</td></tr>
        <tr>
        <td>
            c4 Baru 
        </td><td>15.239</td><td>2.76</td><td>2</td><td>56.2</td><td>2</td><td>61</td><td>0</td><td>20</td><td>10.2</td><td>3.4</td><td>2</td><td>2</td></tr>
        <tr>
        <td>
            c5 Baru 
        </td><td>0.613</td><td>0.25</td><td>1</td><td>16.5</td><td>3</td><td>10</td><td>0</td><td>1</td><td>1</td><td>2</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c6 Baru 
        </td><td>0.49566666666667</td><td>0.165</td><td>0.083333333333333</td><td>4.4</td><td>1.1666666666667</td><td>12</td><td>0</td><td>1.9166666666667</td><td>1.5</td><td>1.0833333333333</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c7 Baru 
        </td><td>1.2586764705882</td><td>0.25029411764706</td><td>0.11764705882353</td><td>2.8617647058824</td><td>1.2352941176471</td><td>0</td><td>8.7941176470588</td><td>12.5</td><td>1.0294117647059</td><td>2</td><td>1.1176470588235</td><td>1</td></tr>
        <tr>
        <td>
            c8 Baru 
        </td><td>6.6392424242424</td><td>0.60181818181818</td><td>0.96969696969697</td><td>10.533333333333</td><td>3</td><td>0</td><td>20.909090909091</td><td>19.69696969697</td><td>1.5151515151515</td><td>2</td><td>2</td><td>1</td></tr> </tbody></table> <br><br>Iterasi 3  :<table class="table table-striped table-responsive">
            <tbody><tr>
            <td>
            No 
            </td>
            <td>
            C1
            </td>
            <td>
            C2
            </td>
            <td>
            C3
            </td>
            <td>
            C4
            </td>
            <td>
            C5
            </td>
            <td>
            C6
            </td>
            <td>
            C7
            </td>
            <td>
            C8
            </td>
            <td>
            Min
            </td>
            <td>
            Cluster
            </td></tr><tr>
            <td>1</td>
            <td>25.837521500429
            </td>
            <td>79.520076746668
            </td>
            
            <td>16.095008319524
            </td>
            <td>74.216830139801
            </td>
            <td>14.121430664065
            </td>
            <td>3.1562070943178
            </td>
            <td>20.387256822966
            </td>
            <td>32.674253407245
            </td><td>3.1562070943178</td>
            <td>6
            </td></tr><tr>
            <td>2</td>
            <td>63.749257214576
            </td>
            <td>53.237088918443
            </td>
            
            <td>73.166965880368
            </td>
            <td>24.654436132266
            </td>
            <td>60.974566574925
            </td>
            <td>70.204139395211
            </td>
            <td>76.340174622238
            </td>
            <td>72.042055269041
            </td><td>24.654436132266</td>
            <td>4
            </td></tr><tr>
            <td>3</td>
            <td>18.839409031606
            </td>
            <td>69.182716536483
            </td>
            
            <td>15.119599007212
            </td>
            <td>69.610468099274
            </td>
            <td>0.113
            </td>
            <td>12.51408098459
            </td>
            <td>22.355740893185
            </td>
            <td>30.963274713171
            </td><td>0.113</td>
            <td>5
            </td></tr><tr>
            <td>4</td>
            <td>18.666963593074
            </td>
            <td>73.866754633473
            </td>
            
            <td>5.1901489515127
            </td>
            <td>80.676419082654
            </td>
            <td>16.539729260178
            </td>
            <td>15.574377351563
            </td>
            <td>11.976072205504
            </td>
            <td>24.962793148633
            </td><td>5.1901489515127</td>
            <td>3
            </td></tr><tr>
            <td>5</td>
            <td>26.510322784911
            </td>
            <td>79.808315853471
            </td>
            
            <td>17.033437100956
            </td>
            <td>73.629033139109
            </td>
            <td>14.506711171041
            </td>
            <td>4.1159107808061
            </td>
            <td>21.138086330289
            </td>
            <td>33.168075698921
            </td><td>4.1159107808061</td>
            <td>6
            </td></tr><tr>
            <td>6</td>
            <td>25.879621237765
            </td>
            <td>79.578214836161
            </td>
            
            <td>16.097484362644
            </td>
            <td>74.230863264548
            </td>
            <td>14.121920867927
            </td>
            <td>3.1526858743335
            </td>
            <td>20.389023637321
            </td>
            <td>32.684378347975
            </td><td>3.1526858743335</td>
            <td>6
            </td></tr><tr>
            <td>7</td>
            <td>19.369732310622
            </td>
            <td>71.604660742731
            </td>
            
            <td>13.24692339648
            </td>
            <td>71.566211273198
            </td>
            <td>3.3004005817476
            </td>
            <td>9.358947406389
            </td>
            <td>20.512852775781
            </td>
            <td>30.520103845681
            </td><td>3.3004005817476</td>
            <td>5
            </td></tr><tr>
            <td>8</td>
            <td>23.424434727121
            </td>
            <td>78.878830620653
            </td>
            
            <td>11.541716776065
            </td>
            <td>77.572362836258
            </td>
            <td>13.171712265306
            </td>
            <td>2.2270855144985
            </td>
            <td>17.030462487269
            </td>
            <td>30.745203902293
            </td><td>2.2270855144985</td>
            <td>6
            </td></tr><tr>
            <td>9</td>
            <td>9.8431979259871
            </td>
            <td>58.576006735537
            </td>
            
            <td>24.362954722397
            </td>
            <td>77.231384300684
            </td>
            <td>26.190537776075
            </td>
            <td>28.171744500869
            </td>
            <td>27.646855414224
            </td>
            <td>31.15110217603
            </td><td>9.8431979259871</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>10</td>
            <td>69.704650630608
            </td>
            <td>21.079036155016
            </td>
            
            <td>84.722893231241
            </td>
            <td>72.036836576851
            </td>
            <td>77.449185044131
            </td>
            <td>88.241125207518
            </td>
            <td>88.456481222661
            </td>
            <td>82.250233372937
            </td><td>21.079036155016</td>
            <td>2
            </td></tr><tr>
            <td>11</td>
            <td>62.551359632786
            </td>
            <td>67.865363784872
            </td>
            
            <td>69.614956372934
            </td>
            <td>16.374499961831
            </td>
            <td>58.609090259106
            </td>
            <td>63.028794659443
            </td>
            <td>71.094152283315
            </td>
            <td>68.231692808465
            </td><td>16.374499961831</td>
            <td>4
            </td></tr><tr>
            <td>12</td>
            <td>18.725148742004
            </td>
            <td>73.922585177788
            </td>
            
            <td>5.1240884853363
            </td>
            <td>80.420337235055
            </td>
            <td>16.837615894182
            </td>
            <td>15.480255431427
            </td>
            <td>10.228853201821
            </td>
            <td>23.770325850183
            </td><td>5.1240884853363</td>
            <td>3
            </td></tr><tr>
            <td>13</td>
            <td>75.902897971093
            </td>
            <td>19.282345572983
            </td>
            
            <td>92.382445461636
            </td>
            <td>77.929896195234
            </td>
            <td>85.821420805065
            </td>
            <td>95.686147664586
            </td>
            <td>95.656094926815
            </td>
            <td>88.990018933652
            </td><td>19.282345572983</td>
            <td>2
            </td></tr><tr>
            <td>14</td>
            <td>18.620572840548
            </td>
            <td>74.909474182005
            </td>
            
            <td>5.4405388341189
            </td>
            <td>82.119234172026
            </td>
            <td>13.54575833979
            </td>
            <td>12.568940086136
            </td>
            <td>15.311137705095
            </td>
            <td>28.936099925572
            </td><td>5.4405388341189</td>
            <td>3
            </td></tr><tr>
            <td>15</td>
            <td>4.6920649143161
            </td>
            <td>61.143874838159
            </td>
            
            <td>14.791511106224
            </td>
            <td>74.823530049043
            </td>
            <td>15.6798488832
            </td>
            <td>20.879392301714
            </td>
            <td>20.408293817227
            </td>
            <td>26.17947589342
            </td><td>4.6920649143161</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>16</td>
            <td>5.1093586104477
            </td>
            <td>62.751289065384
            </td>
            
            <td>14.957001575814
            </td>
            <td>76.754366136396
            </td>
            <td>17.7105694149
            </td>
            <td>20.423912167414
            </td>
            <td>20.130017742043
            </td>
            <td>26.848595981455
            </td><td>5.1093586104477</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>17</td>
            <td>7.5181304298447
            </td>
            <td>62.866291335059
            </td>
            
            <td>12.50172002055
            </td>
            <td>75.045275167728
            </td>
            <td>13.693097567753
            </td>
            <td>19.31790116849
            </td>
            <td>18.940827215016
            </td>
            <td>25.799949760221
            </td><td>7.5181304298447</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>18</td>
            <td>10.628495679547
            </td>
            <td>63.115390873238
            </td>
            
            <td>16.372667145955
            </td>
            <td>78.057585928595
            </td>
            <td>17.912070483336
            </td>
            <td>20.795997729264
            </td>
            <td>22.544719536975
            </td>
            <td>30.123505623082
            </td><td>10.628495679547</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>19</td>
            <td>7.7250941440966
            </td>
            <td>64.91806901953
            </td>
            
            <td>11.000761676912
            </td>
            <td>76.776041471282
            </td>
            <td>14.880280373703
            </td>
            <td>17.94371286056
            </td>
            <td>17.200305597516
            </td>
            <td>25.418669496918
            </td><td>7.7250941440966</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>20</td>
            <td>23.401865212204
            </td>
            <td>78.859656130886
            </td>
            
            <td>11.541072861981
            </td>
            <td>77.565659418328
            </td>
            <td>13.171099764257
            </td>
            <td>2.2253063209864
            </td>
            <td>17.028661725965
            </td>
            <td>30.738080470711
            </td><td>2.2253063209864</td>
            <td>6
            </td></tr><tr>
            <td>21</td>
            <td>7.6480255890103
            </td>
            <td>64.912424911867
            </td>
            
            <td>11.199989410957
            </td>
            <td>76.931761457801
            </td>
            <td>14.636210882602
            </td>
            <td>17.84632702329
            </td>
            <td>17.697985001647
            </td>
            <td>25.971003938418
            </td><td>7.6480255890103</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>22</td>
            <td>18.663176857388
            </td>
            <td>74.92544328061
            </td>
            
            <td>5.377895760012
            </td>
            <td>82.129519181595
            </td>
            <td>13.583175954099
            </td>
            <td>12.608663221064
            </td>
            <td>15.340790383455
            </td>
            <td>28.939299327546
            </td><td>5.377895760012</td>
            <td>3
            </td></tr><tr>
            <td>23</td>
            <td>6.54063319069
            </td>
            <td>60.418169022916
            </td>
            
            <td>16.127406822101
            </td>
            <td>74.044109988574
            </td>
            <td>18.437790973975
            </td>
            <td>22.78528248429
            </td>
            <td>19.818251556723
            </td>
            <td>24.140573410119
            </td><td>6.54063319069</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>24</td>
            <td>5.3795836651321
            </td>
            <td>62.82866265325
            </td>
            
            <td>14.07159891906
            </td>
            <td>76.389794612893
            </td>
            <td>17.603700434852
            </td>
            <td>20.282484764501
            </td>
            <td>18.887421028783
            </td>
            <td>25.573147910537
            </td><td>5.3795836651321</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>25</td>
            <td>18.00044292261
            </td>
            <td>74.230538763245
            </td>
            
            <td>1.5070775711806
            </td>
            <td>81.12329283874
            </td>
            <td>14.476370712302
            </td>
            <td>13.224294873032
            </td>
            <td>12.060434688817
            </td>
            <td>25.999763928875
            </td><td>1.5070775711806</td>
            <td>3
            </td></tr><tr>
            <td>26</td>
            <td>41.469822077749
            </td>
            <td>23.91080858874
            </td>
            
            <td>58.687041279476
            </td>
            <td>71.576308433727
            </td>
            <td>55.694551807156
            </td>
            <td>62.393265418277
            </td>
            <td>60.877819297447
            </td>
            <td>55.856907707644
            </td><td>23.91080858874</td>
            <td>2
            </td></tr><tr>
            <td>27</td>
            <td>22.934539428233
            </td>
            <td>78.680775506901
            </td>
            
            <td>10.682679726496
            </td>
            <td>78.210300830517
            </td>
            <td>13.207365369369
            </td>
            <td>3.1526734510394
            </td>
            <td>16.457145419355
            </td>
            <td>30.411348206235
            </td><td>3.1526734510394</td>
            <td>6
            </td></tr><tr>
            <td>28</td>
            <td>100.7411871228
            </td>
            <td>92.138101685592
            </td>
            
            <td>107.48648266707
            </td>
            <td>26.890925625571
            </td>
            <td>95.509672750984
            </td>
            <td>100.62170382952
            </td>
            <td>109.07222651366
            </td>
            <td>105.18642202729
            </td><td>26.890925625571</td>
            <td>4
            </td></tr><tr>
            <td>29</td>
            <td>25.760748638387
            </td>
            <td>34.173042750038
            </td>
            
            <td>41.395421197747
            </td>
            <td>64.790560431285
            </td>
            <td>36.058178947362
            </td>
            <td>45.733213913838
            </td>
            <td>45.259795457815
            </td>
            <td>42.049766512445
            </td><td>25.760748638387</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>30</td>
            <td>8.1189620894642
            </td>
            <td>56.966824876503
            </td>
            
            <td>18.899750337122
            </td>
            <td>71.677895623407
            </td>
            <td>16.070727083738
            </td>
            <td>24.603431770566
            </td>
            <td>24.660086163457
            </td>
            <td>28.162628634947
            </td><td>8.1189620894642</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>31</td>
            <td>19.016922934853
            </td>
            <td>69.322969245998
            </td>
            
            <td>15.119327458771
            </td>
            <td>69.657937243361
            </td>
            <td>0.113
            </td>
            <td>12.511961805497
            </td>
            <td>22.362267251956
            </td>
            <td>31.007228875522
            </td><td>0.113</td>
            <td>5
            </td></tr><tr>
            <td>32</td>
            <td>77.725433710016
            </td>
            <td>20.646217071593
            </td>
            
            <td>94.358962987831
            </td>
            <td>78.854516173774
            </td>
            <td>88.145551612092
            </td>
            <td>97.714029297515
            </td>
            <td>97.149405690718
            </td>
            <td>90.035986829474
            </td><td>20.646217071593</td>
            <td>2
            </td></tr><tr>
            <td>33</td>
            <td>23.294960193358
            </td>
            <td>78.756645393599
            </td>
            
            <td>11.582677992253
            </td>
            <td>77.415346805398
            </td>
            <td>13.207296051804
            </td>
            <td>2.2256957464028
            </td>
            <td>17.047375928855
            </td>
            <td>30.697615396377
            </td><td>2.2256957464028</td>
            <td>6
            </td></tr><tr>
            <td>34</td>
            <td>23.373567438137
            </td>
            <td>78.823143157479
            </td>
            
            <td>11.537861419643
            </td>
            <td>77.55751540631
            </td>
            <td>13.169959908823
            </td>
            <td>2.223697346513
            </td>
            <td>17.026830372394
            </td>
            <td>30.731545523554
            </td><td>2.223697346513</td>
            <td>6
            </td></tr><tr>
            <td>35</td>
            <td>70.915437638149
            </td>
            <td>18.328447660756
            </td>
            
            <td>86.852425965766
            </td>
            <td>73.024754165968
            </td>
            <td>79.811642440185
            </td>
            <td>90.316544377109
            </td>
            <td>90.353283557318
            </td>
            <td>83.756845853861
            </td><td>18.328447660756</td>
            <td>2
            </td></tr><tr>
            <td>36</td>
            <td>10.560831899531
            </td>
            <td>57.566289683623
            </td>
            
            <td>25.529895471889
            </td>
            <td>77.352535323672
            </td>
            <td>27.252124119048
            </td>
            <td>29.141748773119
            </td>
            <td>28.636078070088
            </td>
            <td>31.861777473191
            </td><td>10.560831899531</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>37</td>
            <td>6.4726073115983
            </td>
            <td>55.40224112998
            </td>
            
            <td>20.516390914069
            </td>
            <td>71.717370427254
            </td>
            <td>17.763281481753
            </td>
            <td>25.718870923032
            </td>
            <td>26.095637502233
            </td>
            <td>29.183165448068
            </td><td>6.4726073115983</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>38</td>
            <td>17.856954374561
            </td>
            <td>55.248672067521
            </td>
            
            <td>33.060882789266
            </td>
            <td>78.671569350052
            </td>
            <td>34.347725747129
            </td>
            <td>36.045473750374
            </td>
            <td>35.43901488723
            </td>
            <td>36.8560505977
            </td><td>17.856954374561</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>39</td>
            <td>86.847962960625
            </td>
            <td>77.824595777548
            </td>
            
            <td>94.343753879835
            </td>
            <td>13.343339949203
            </td>
            <td>81.962175843495
            </td>
            <td>88.284709066117
            </td>
            <td>96.487231536557
            </td>
            <td>92.580715726101
            </td><td>13.343339949203</td>
            <td>4
            </td></tr><tr>
            <td>40</td>
            <td>6.7017662157193
            </td>
            <td>54.246074190504
            </td>
            
            <td>20.94114521237
            </td>
            <td>71.157506427643
            </td>
            <td>18.967083829624
            </td>
            <td>26.539106771371
            </td>
            <td>25.689714631042
            </td>
            <td>27.994644782144
            </td><td>6.7017662157193</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>41</td>
            <td>41.633969549037
            </td>
            <td>25.150012654275
            </td>
            
            <td>59.652042961429
            </td>
            <td>71.430166743471
            </td>
            <td>56.69053068194
            </td>
            <td>63.277870182939
            </td>
            <td>61.565103963688
            </td>
            <td>56.049051705488
            </td><td>25.150012654275</td>
            <td>2
            </td></tr><tr>
            <td>42</td>
            <td>6.6582126287883
            </td>
            <td>59.13963374394
            </td>
            
            <td>20.994615884528
            </td>
            <td>76.904386877473
            </td>
            <td>23.071806799642
            </td>
            <td>25.25605250672
            </td>
            <td>24.821586244774
            </td>
            <td>29.400028088931
            </td><td>6.6582126287883</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>43</td>
            <td>41.234238448287
            </td>
            <td>25.050411903005
            </td>
            
            <td>59.383215048296
            </td>
            <td>71.590982120655
            </td>
            <td>56.23892130011
            </td>
            <td>62.902746534277
            </td>
            <td>61.5225709146
            </td>
            <td>56.243080248795
            </td><td>25.050411903005</td>
            <td>2
            </td></tr><tr>
            <td>44</td>
            <td>30.543509669161
            </td>
            <td>71.889364358984
            </td>
            
            <td>28.536632529766
            </td>
            <td>79.892763883846
            </td>
            <td>34.410888814444
            </td>
            <td>34.699138148119
            </td>
            <td>20.118436003729
            </td>
            <td>5.3491304979857
            </td><td>5.3491304979857</td>
            <td>8
            </td></tr><tr>
            <td>45</td>
            <td>25.876731193973
            </td>
            <td>79.575508777667
            </td>
            
            <td>16.097461895349
            </td>
            <td>74.229871992346
            </td>
            <td>14.121888825508
            </td>
            <td>3.1527284303529
            </td>
            <td>20.388843103975
            </td>
            <td>32.683442605841
            </td><td>3.1527284303529</td>
            <td>6
            </td></tr><tr>
            <td>46</td>
            <td>23.676102438116
            </td>
            <td>78.528113851548
            </td>
            
            <td>10.267119661273
            </td>
            <td>83.903973809349
            </td>
            <td>22.352717262114
            </td>
            <td>17.927226636847
            </td>
            <td>2.090590867993
            </td>
            <td>18.695141974538
            </td><td>2.090590867993</td>
            <td>7
            </td></tr><tr>
            <td>47</td>
            <td>25.33614715254
            </td>
            <td>79.418139076456
            </td>
            
            <td>15.170448558702
            </td>
            <td>74.86229983109
            </td>
            <td>13.799963768068
            </td>
            <td>2.2224753216978
            </td>
            <td>19.666479650013
            </td>
            <td>32.244874279436
            </td><td>2.2224753216978</td>
            <td>6
            </td></tr><tr>
            <td>48</td>
            <td>23.314414881896
            </td>
            <td>78.772799381305
            </td>
            
            <td>11.536873961587
            </td>
            <td>77.539995383028
            </td>
            <td>13.168967917039
            </td>
            <td>2.2226765896599
            </td>
            <td>17.022573837692
            </td>
            <td>30.713074311443
            </td><td>2.2226765896599</td>
            <td>6
            </td></tr><tr>
            <td>49</td>
            <td>62.538432403884
            </td>
            <td>69.800230045232
            </td>
            
            <td>68.510580517213
            </td>
            <td>16.028600562744
            </td>
            <td>57.321714035782
            </td>
            <td>61.868732516694
            </td>
            <td>70.083177880461
            </td>
            <td>67.5795415005
            </td><td>16.028600562744</td>
            <td>4
            </td></tr><tr>
            <td>50</td>
            <td>22.656904787176
            </td>
            <td>77.331121649115
            </td>
            
            <td>9.4917676684705
            </td>
            <td>82.848229914706
            </td>
            <td>21.573447939539
            </td>
            <td>17.798317726372
            </td>
            <td>4.2117359493144
            </td>
            <td>19.40926164957
            </td><td>4.2117359493144</td>
            <td>7
            </td></tr><tr>
            <td>51</td>
            <td>29.489397169324
            </td>
            <td>74.507115149754
            </td>
            
            <td>25.278921973433
            </td>
            <td>81.601098160503
            </td>
            <td>32.246639654389
            </td>
            <td>31.38544548389
            </td>
            <td>16.093505162413
            </td>
            <td>4.1332319285748
            </td><td>4.1332319285748</td>
            <td>8
            </td></tr><tr>
            <td>52</td>
            <td>28.570329863954
            </td>
            <td>71.246451320721
            </td>
            
            <td>26.553125920292
            </td>
            <td>79.628184055647
            </td>
            <td>32.436404609636
            </td>
            <td>32.813594691157
            </td>
            <td>18.335312190375
            </td>
            <td>3.495971182479
            </td><td>3.495971182479</td>
            <td>8
            </td></tr><tr>
            <td>53</td>
            <td>24.028402759238
            </td>
            <td>79.588135561932
            </td>
            
            <td>9.8228159305545
            </td>
            <td>84.95961758977
            </td>
            <td>21.93345775294
            </td>
            <td>16.854601396124
            </td>
            <td>3.17295736067
            </td>
            <td>19.764788099032
            </td><td>3.17295736067</td>
            <td>7
            </td></tr><tr>
            <td>54</td>
            <td>29.319299640512
            </td>
            <td>69.45749480445
            </td>
            
            <td>29.379719492742
            </td>
            <td>79.424921334553
            </td>
            <td>33.707626866927
            </td>
            <td>34.943087769813
            </td>
            <td>21.931580607472
            </td>
            <td>5.5899344382448
            </td><td>5.5899344382448</td>
            <td>8
            </td></tr><tr>
            <td>55</td>
            <td>27.828193900883
            </td>
            <td>71.648701968674
            </td>
            
            <td>25.080248287026
            </td>
            <td>79.713155275651
            </td>
            <td>30.909561045088
            </td>
            <td>31.359073294485
            </td>
            <td>16.939733564497
            </td>
            <td>2.0662150052977
            </td><td>2.0662150052977</td>
            <td>8
            </td></tr><tr>
            <td>56</td>
            <td>23.831502951139
            </td>
            <td>78.373760619566
            </td>
            
            <td>10.806030236503
            </td>
            <td>83.613694338906
            </td>
            <td>22.970493878017
            </td>
            <td>18.593465202114
            </td>
            <td>4.6376663947615
            </td>
            <td>19.647647329116
            </td><td>4.6376663947615</td>
            <td>7
            </td></tr><tr>
            <td>57</td>
            <td>23.642906111774
            </td>
            <td>72.394011527761
            </td>
            
            <td>19.338741500045
            </td>
            <td>80.492342126441
            </td>
            <td>26.895873754165
            </td>
            <td>26.022660667622
            </td>
            <td>11.001587294607
            </td>
            <td>6.8055780948934
            </td><td>6.8055780948934</td>
            <td>8
            </td></tr><tr>
            <td>58</td>
            <td>27.77144171915
            </td>
            <td>73.300741570573
            </td>
            
            <td>24.489672724209
            </td>
            <td>81.460019794989
            </td>
            <td>31.302568281213
            </td>
            <td>30.498932859291
            </td>
            <td>15.573741068967
            </td>
            <td>3.0530415623523
            </td><td>3.0530415623523</td>
            <td>8
            </td></tr><tr>
            <td>59</td>
            <td>27.072753499324
            </td>
            <td>70.373103888764
            </td>
            
            <td>25.666502244603
            </td>
            <td>79.344612444702
            </td>
            <td>31.387554285098
            </td>
            <td>31.823938231394
            </td>
            <td>17.709842552551
            </td>
            <td>2.125392418582
            </td><td>2.125392418582</td>
            <td>8
            </td></tr><tr>
            <td>60</td>
            <td>24.447940752447
            </td>
            <td>72.832637460895
            </td>
            
            <td>19.782957416395
            </td>
            <td>80.55663488503
            </td>
            <td>27.406252279361
            </td>
            <td>26.512037100574
            </td>
            <td>11.253873307117
            </td>
            <td>6.7135949065556
            </td><td>6.7135949065556</td>
            <td>8
            </td></tr><tr>
            <td>61</td>
            <td>23.066236792879
            </td>
            <td>78.410086888078
            </td>
            
            <td>9.0402422242008
            </td>
            <td>83.901314626173
            </td>
            <td>21.532362712903
            </td>
            <td>16.948261362813
            </td>
            <td>2.9766759294724
            </td>
            <td>19.793433544447
            </td><td>2.9766759294724</td>
            <td>7
            </td></tr><tr>
            <td>62</td>
            <td>23.35980685462
            </td>
            <td>78.510889854822
            </td>
            
            <td>9.6304412916658
            </td>
            <td>83.982319424984
            </td>
            <td>21.832086478392
            </td>
            <td>17.327134882092
            </td>
            <td>2.0700835591931
            </td>
            <td>19.056206267161
            </td><td>2.0700835591931</td>
            <td>7
            </td></tr><tr>
            <td>63</td>
            <td>24.613071604031
            </td>
            <td>79.311409520205
            </td>
            
            <td>11.406288008765
            </td>
            <td>84.466969378568
            </td>
            <td>23.538115897412
            </td>
            <td>18.70167487746
            </td>
            <td>2.9047429876659
            </td>
            <td>18.817463077964
            </td><td>2.9047429876659</td>
            <td>7
            </td></tr><tr>
            <td>64</td>
            <td>23.395349461168
            </td>
            <td>78.453908826932
            </td>
            
            <td>9.7194182339045
            </td>
            <td>83.824970438408
            </td>
            <td>22.060176087239
            </td>
            <td>17.560807390955
            </td>
            <td>2.9887604652284
            </td>
            <td>19.444560018077
            </td><td>2.9887604652284</td>
            <td>7
            </td></tr><tr>
            <td>65</td>
            <td>23.117597237498
            </td>
            <td>78.542466435655
            </td>
            
            <td>9.0611649805947
            </td>
            <td>84.08184860004
            </td>
            <td>21.345791716402
            </td>
            <td>16.764888444471
            </td>
            <td>2.5029692368995
            </td>
            <td>19.477012034228
            </td><td>2.5029692368995</td>
            <td>7
            </td></tr><tr>
            <td>66</td>
            <td>24.462878934932
            </td>
            <td>68.181106973132
            </td>
            
            <td>24.177618316787
            </td>
            <td>78.237164212413
            </td>
            <td>28.756533588039
            </td>
            <td>30.268667813801
            </td>
            <td>17.519582967463
            </td>
            <td>4.2655396006228
            </td><td>4.2655396006228</td>
            <td>8
            </td></tr><tr>
            <td>67</td>
            <td>24.556915841778
            </td>
            <td>78.54409530555
            </td>
            
            <td>12.237506042445
            </td>
            <td>83.823829959028
            </td>
            <td>23.804367687464
            </td>
            <td>19.615259609691
            </td>
            <td>2.7549956871398
            </td>
            <td>17.264826878515
            </td><td>2.7549956871398</td>
            <td>7
            </td></tr><tr>
            <td>68</td>
            <td>27.983403117476
            </td>
            <td>71.096801877613
            </td>
            
            <td>25.966003853864
            </td>
            <td>79.480108303902
            </td>
            <td>31.795430489301
            </td>
            <td>32.193327619589
            </td>
            <td>17.828799555469
            </td>
            <td>2.5680611173925
            </td><td>2.5680611173925</td>
            <td>8
            </td></tr><tr>
            <td>69</td>
            <td>23.320636438789
            </td>
            <td>78.483462319479
            </td>
            
            <td>9.6321347654032
            </td>
            <td>83.971492930637
            </td>
            <td>21.832259182228
            </td>
            <td>17.327587990126
            </td>
            <td>2.0496658983802
            </td>
            <td>19.034862586595
            </td><td>2.0496658983802</td>
            <td>7
            </td></tr><tr>
            <td>70</td>
            <td>27.463808949874
            </td>
            <td>73.530475925265
            </td>
            
            <td>23.806358117225
            </td>
            <td>81.525441427814
            </td>
            <td>30.601385197406
            </td>
            <td>29.80700220679
            </td>
            <td>14.926505629081
            </td>
            <td>3.1075318413634
            </td><td>3.1075318413634</td>
            <td>8
            </td></tr><tr>
            <td>71</td>
            <td>27.376774465962
            </td>
            <td>71.365860289048
            </td>
            
            <td>25.454821484457
            </td>
            <td>80.322523148865
            </td>
            <td>30.474136591543
            </td>
            <td>31.068142937027
            </td>
            <td>17.898208495651
            </td>
            <td>4.326774331391
            </td><td>4.326774331391</td>
            <td>8
            </td></tr><tr>
            <td>72</td>
            <td>33.368127476458
            </td>
            <td>75.864138865448
            </td>
            
            <td>30.128710108559
            </td>
            <td>83.421499123427
            </td>
            <td>36.08081068934
            </td>
            <td>35.369293319049
            </td>
            <td>21.028378501744
            </td>
            <td>6.7509008395241
            </td><td>6.7509008395241</td>
            <td>8
            </td></tr><tr>
            <td>73</td>
            <td>22.463365629624
            </td>
            <td>77.811953943531
            </td>
            
            <td>8.9478527855694
            </td>
            <td>83.804611812239
            </td>
            <td>20.035567099536
            </td>
            <td>16.24316763716
            </td>
            <td>4.6058584370388
            </td>
            <td>19.184652091512
            </td><td>4.6058584370388</td>
            <td>7
            </td></tr><tr>
            <td>74</td>
            <td>30.619140997261
            </td>
            <td>69.787609661203
            </td>
            
            <td>30.438025606231
            </td>
            <td>79.208212711814
            </td>
            <td>35.196817313502
            </td>
            <td>36.278981447787
            </td>
            <td>22.579523314687
            </td>
            <td>5.6700994160166
            </td><td>5.6700994160166</td>
            <td>8
            </td></tr><tr>
            <td>75</td>
            <td>22.717652900006
            </td>
            <td>77.680020612557
            </td>
            
            <td>9.5608838924838
            </td>
            <td>83.538628214737
            </td>
            <td>20.818916494381
            </td>
            <td>17.093235247378
            </td>
            <td>2.6814474253624
            </td>
            <td>18.028513600126
            </td><td>2.6814474253624</td>
            <td>7
            </td></tr><tr>
            <td>76</td>
            <td>27.399600807496
            </td>
            <td>70.908272206897
            </td>
            
            <td>25.063835782635
            </td>
            <td>79.036866265054
            </td>
            <td>31.298226802808
            </td>
            <td>31.657806349918
            </td>
            <td>17.150338105079
            </td>
            <td>5.8789291845717
            </td><td>5.8789291845717</td>
            <td>8
            </td></tr><tr>
            <td>77</td>
            <td>26.962602689376
            </td>
            <td>71.120039029167
            </td>
            
            <td>24.451931201282
            </td>
            <td>79.300773110985
            </td>
            <td>30.369135647891
            </td>
            <td>30.812240693522
            </td>
            <td>16.454721905911
            </td>
            <td>2.4933119679113
            </td><td>2.4933119679113</td>
            <td>8
            </td></tr><tr>
            <td>78</td>
            <td>23.407648870832
            </td>
            <td>78.607669741727
            </td>
            
            <td>9.7519085040941
            </td>
            <td>84.162249975865
            </td>
            <td>21.69435698517
            </td>
            <td>17.206923457983
            </td>
            <td>1.9021607066192
            </td>
            <td>18.760532440422
            </td><td>1.9021607066192</td>
            <td>7
            </td></tr><tr>
            <td>79</td>
            <td>24.669973576904
            </td>
            <td>79.515184261131
            </td>
            
            <td>11.436050344075
            </td>
            <td>84.814413892923
            </td>
            <td>23.195807293561
            </td>
            <td>18.369235455571
            </td>
            <td>1.7907622598919
            </td>
            <td>18.131044405549
            </td><td>1.7907622598919</td>
            <td>7
            </td></tr><tr>
            <td>80</td>
            <td>23.822076062135
            </td>
            <td>78.931249067574
            </td>
            
            <td>10.57319863959
            </td>
            <td>84.609981213802
            </td>
            <td>21.694526245115
            </td>
            <td>17.313306680765
            </td>
            <td>3.7974600103591
            </td>
            <td>18.517003736769
            </td><td>3.7974600103591</td>
            <td>7
            </td></tr><tr>
            <td>81</td>
            <td>25.651257462553
            </td>
            <td>73.074570851163
            </td>
            
            <td>21.609880212661
            </td>
            <td>81.104976055727
            </td>
            <td>28.677308538285
            </td>
            <td>27.859986866871
            </td>
            <td>12.933298771718
            </td>
            <td>4.4566072018014
            </td><td>4.4566072018014</td>
            <td>8
            </td></tr><tr>
            <td>82</td>
            <td>26.31403095613
            </td>
            <td>70.706385853827
            </td>
            
            <td>24.307867110716
            </td>
            <td>79.438950301474
            </td>
            <td>29.942958788336
            </td>
            <td>30.456382564068
            </td>
            <td>16.499242380137
            </td>
            <td>1.3656730141036
            </td><td>1.3656730141036</td>
            <td>8
            </td></tr><tr>
            <td>83</td>
            <td>31.809294349846
            </td>
            <td>74.489807123018
            </td>
            
            <td>29.272593623938
            </td>
            <td>82.645732037414
            </td>
            <td>35.457798352408
            </td>
            <td>34.712502712359
            </td>
            <td>20.19311690391
            </td>
            <td>5.3117564486081
            </td><td>5.3117564486081</td>
            <td>8
            </td></tr><tr>
            <td>84</td>
            <td>25.197550615787
            </td>
            <td>70.805358510468
            </td>
            
            <td>22.238339359588
            </td>
            <td>79.02986412743
            </td>
            <td>28.389657694308
            </td>
            <td>28.87851181338
            </td>
            <td>14.546160388903
            </td>
            <td>4.2615823167055
            </td><td>4.2615823167055</td>
            <td>8
            </td></tr><tr>
            <td>85</td>
            <td>24.35035274714
            </td>
            <td>79.434924966983
            </td>
            
            <td>10.760746758732
            </td>
            <td>84.721823923945
            </td>
            <td>22.826484376706
            </td>
            <td>17.900243095804
            </td>
            <td>1.9623799328532
            </td>
            <td>18.816590835224
            </td><td>1.9623799328532</td>
            <td>7
            </td></tr><tr>
            <td>86</td>
            <td>27.932612241968
            </td>
            <td>74.196824687132
            </td>
            
            <td>23.544382475208
            </td>
            <td>81.568042277598
            </td>
            <td>30.398797163704
            </td>
            <td>29.57696719108
            </td>
            <td>14.561881530446
            </td>
            <td>3.4357236624154
            </td><td>3.4357236624154</td>
            <td>8
            </td></tr><tr>
            <td>87</td>
            <td>23.640052536112
            </td>
            <td>78.578965745631
            </td>
            
            <td>10.284844196141
            </td>
            <td>84.060761506187
            </td>
            <td>22.173126549948
            </td>
            <td>17.755148705532
            </td>
            <td>1.2699980318351
            </td>
            <td>18.316872327785
            </td><td>1.2699980318351</td>
            <td>7
            </td></tr><tr>
            <td>88</td>
            <td>21.968782861373
            </td>
            <td>68.737818614928
            </td>
            
            <td>19.488729122381
            </td>
            <td>77.482544621353
            </td>
            <td>24.742640703854
            </td>
            <td>26.469602469416
            </td>
            <td>13.578441916627
            </td>
            <td>7.2295154785212
            </td><td>7.2295154785212</td>
            <td>8
            </td></tr><tr>
            <td>89</td>
            <td>25.154601935534
            </td>
            <td>70.527631647432
            </td>
            
            <td>22.906771112611
            </td>
            <td>79.354204022219
            </td>
            <td>28.601754211936
            </td>
            <td>29.185984020112
            </td>
            <td>15.320312243429
            </td>
            <td>2.6495390038582
            </td><td>2.6495390038582</td>
            <td>8
            </td></tr><tr>
            <td>90</td>
            <td>26.98084138857
            </td>
            <td>71.07178084622
            </td>
            
            <td>24.70302316463
            </td>
            <td>79.600173366645
            </td>
            <td>30.434434050923
            </td>
            <td>30.924004385303
            </td>
            <td>16.72192941129
            </td>
            <td>1.2053276530255
            </td><td>1.2053276530255</td>
            <td>8
            </td></tr><tr>
            <td>91</td>
            <td>25.725962667316
            </td>
            <td>69.358545259472
            </td>
            
            <td>24.690509718086
            </td>
            <td>78.876227248772
            </td>
            <td>28.902517208714
            </td>
            <td>30.446573516389
            </td>
            <td>18.100409070799
            </td>
            <td>5.5528144973569
            </td><td>5.5528144973569</td>
            <td>8
            </td></tr><tr>
            <td>92</td>
            <td>24.339924635979
            </td>
            <td>72.889910099871
            </td>
            
            <td>20.159509901588
            </td>
            <td>81.219126540489
            </td>
            <td>27.033773321532
            </td>
            <td>26.270774190259
            </td>
            <td>12.022713653294
            </td>
            <td>6.2400559699993
            </td><td>6.2400559699993</td>
            <td>8
            </td></tr><tr>
            <td>93</td>
            <td>22.738362395084
            </td>
            <td>72.343043373293
            </td>
            
            <td>18.194299404087
            </td>
            <td>80.465124302396
            </td>
            <td>25.68596895194
            </td>
            <td>24.823645372015
            </td>
            <td>10.170024151208
            </td>
            <td>7.5583982506073
            </td><td>7.5583982506073</td>
            <td>8
            </td></tr><tr>
            <td>94</td>
            <td>26.744661968048
            </td>
            <td>73.852313689041
            </td>
            
            <td>22.673044336221
            </td>
            <td>81.970864433651
            </td>
            <td>29.059841706382
            </td>
            <td>28.350029568866
            </td>
            <td>14.346353996778
            </td>
            <td>5.548349333532
            </td><td>5.548349333532</td>
            <td>8
            </td></tr><tr>
            <td>95</td>
            <td>24.131042541924
            </td>
            <td>79.419663771972
            </td>
            
            <td>10.139755723827
            </td>
            <td>84.658635241776
            </td>
            <td>22.496103418148
            </td>
            <td>17.476004164441
            </td>
            <td>2.5795324817483
            </td>
            <td>19.561907250222
            </td><td>2.5795324817483</td>
            <td>7
            </td></tr><tr>
            <td>96</td>
            <td>29.42733474442
            </td>
            <td>71.871077138732
            </td>
            
            <td>27.584831643596
            </td>
            <td>80.524156158261
            </td>
            <td>32.78113788446
            </td>
            <td>33.251203069296
            </td>
            <td>19.485576483215
            </td>
            <td>3.2743456981736
            </td><td>3.2743456981736</td>
            <td>8
            </td></tr><tr>
            <td>97</td>
            <td>22.552438979191
            </td>
            <td>78.61648918604
            </td>
            
            <td>7.4682720093443
            </td>
            <td>84.260873630648
            </td>
            <td>20.165575146769
            </td>
            <td>15.352870705145
            </td>
            <td>4.5824515338068
            </td>
            <td>21.172087078659
            </td><td>4.5824515338068</td>
            <td>7
            </td></tr><tr>
            <td>98</td>
            <td>23.281059311383
            </td>
            <td>78.70715741965
            </td>
            
            <td>9.2965891669412
            </td>
            <td>84.293082901268
            </td>
            <td>21.251880410919
            </td>
            <td>16.699833498837
            </td>
            <td>2.783848426134
            </td>
            <td>19.276988127462
            </td><td>2.783848426134</td>
            <td>7
            </td></tr><tr>
            <td>99</td>
            <td>24.964121042211
            </td>
            <td>78.792481776564
            </td>
            
            <td>12.84948860742
            </td>
            <td>84.110410110759
            </td>
            <td>23.992623470559
            </td>
            <td>19.889048818103
            </td>
            <td>2.1095877909971
            </td>
            <td>16.162507208546
            </td><td>2.1095877909971</td>
            <td>7
            </td></tr><tr>
            <td>100</td>
            <td>24.392578523706
            </td>
            <td>78.996249618548
            </td>
            
            <td>11.72368674119
            </td>
            <td>84.607182224679
            </td>
            <td>22.553296965189
            </td>
            <td>18.32822062346
            </td>
            <td>3.4375834108785
            </td>
            <td>17.364111113188
            </td><td>3.4375834108785</td>
            <td>7
            </td></tr><tr>
            <td>101</td>
            <td>23.806245538937
            </td>
            <td>70.769830896235
            </td>
            
            <td>20.441091282159
            </td>
            <td>79.109773865181
            </td>
            <td>26.399213416312
            </td>
            <td>27.058493211724
            </td>
            <td>13.18013097546
            </td>
            <td>5.0259704438708
            </td><td>5.0259704438708</td>
            <td>8
            </td></tr><tr>
            <td>102</td>
            <td>27.501568705897
            </td>
            <td>73.575678979025
            </td>
            
            <td>23.77136735947
            </td>
            <td>81.538092423112
            </td>
            <td>30.575141863939
            </td>
            <td>29.77982611135
            </td>
            <td>14.87896371513
            </td>
            <td>3.118734449954
            </td><td>3.118734449954</td>
            <td>8
            </td></tr><tr>
            <td>103</td>
            <td>24.269052503346
            </td>
            <td>77.849411091975
            </td>
            
            <td>12.626600392514
            </td>
            <td>83.47205262242
            </td>
            <td>23.160946029901
            </td>
            <td>19.740228204242
            </td>
            <td>2.4498255762005
            </td>
            <td>15.235052541195
            </td><td>2.4498255762005</td>
            <td>7
            </td></tr><tr>
            <td>104</td>
            <td>30.802916666448
            </td>
            <td>74.526501330132
            </td>
            
            <td>27.725520196002
            </td>
            <td>82.430841467257
            </td>
            <td>34.011133191942
            </td>
            <td>33.257644317593
            </td>
            <td>18.682508310331
            </td>
            <td>4.2436857614645
            </td><td>4.2436857614645</td>
            <td>8
            </td></tr><tr>
            <td>105</td>
            <td>22.762302926882
            </td>
            <td>77.730660724408
            </td>
            
            <td>9.5628125642454
            </td>
            <td>83.550348317646
            </td>
            <td>20.818765189127
            </td>
            <td>17.092210444787
            </td>
            <td>2.6923013883239
            </td>
            <td>18.046993946603
            </td><td>2.6923013883239</td>
            <td>7
            </td></tr><tr>
            <td>106</td>
            <td>29.512432118264
            </td>
            <td>72.018008736477
            </td>
            
            <td>27.514896525438
            </td>
            <td>80.554475878129
            </td>
            <td>32.722684853172
            </td>
            <td>33.192583577594
            </td>
            <td>19.397166189352
            </td>
            <td>3.243953848212
            </td><td>3.243953848212</td>
            <td>8
            </td></tr><tr>
            <td>107</td>
            <td>31.597479182051
            </td>
            <td>71.105519628599
            </td>
            
            <td>30.584887675761
            </td>
            <td>79.937415325991
            </td>
            <td>35.087519447804
            </td>
            <td>36.218171445959
            </td>
            <td>22.695064015066
            </td>
            <td>5.9310054740293
            </td><td>5.9310054740293</td>
            <td>8
            </td></tr><tr>
            <td>108</td>
            <td>23.472195554744
            </td>
            <td>78.516193557736
            </td>
            
            <td>9.7195222519194
            </td>
            <td>83.846174158396
            </td>
            <td>22.060631654601
            </td>
            <td>17.560683022657
            </td>
            <td>3.0191856421958
            </td>
            <td>19.483544808289
            </td><td>3.0191856421958</td>
            <td>7
            </td></tr><tr>
            <td>109</td>
            <td>23.88791860251
            </td>
            <td>78.531627662792
            </td>
            
            <td>10.882165997886
            </td>
            <td>83.964490262253
            </td>
            <td>22.685905337896
            </td>
            <td>18.342082003476
            </td>
            <td>1.255738475365
            </td>
            <td>17.908457213036
            </td><td>1.255738475365</td>
            <td>7
            </td></tr><tr>
            <td>110</td>
            <td>24.289917824278
            </td>
            <td>79.3012788904
            </td>
            
            <td>10.744178399125
            </td>
            <td>84.539214338672
            </td>
            <td>23.000924959662
            </td>
            <td>18.071855509481
            </td>
            <td>2.5302794894997
            </td>
            <td>19.135440627108
            </td><td>2.5302794894997</td>
            <td>7
            </td></tr><tr>
            <td>111</td>
            <td>24.132330444036
            </td>
            <td>79.467457493682
            </td>
            
            <td>10.252016231237
            </td>
            <td>84.824676981407
            </td>
            <td>22.361664092817
            </td>
            <td>17.356534952448
            </td>
            <td>2.4238302820452
            </td>
            <td>19.253328835978
            </td><td>2.4238302820452</td>
            <td>7
            </td></tr><tr>
            <td>112</td>
            <td>27.231799782794
            </td>
            <td>69.740156531812
            </td>
            
            <td>25.636032144989
            </td>
            <td>78.428254532407
            </td>
            <td>30.674315656588
            </td>
            <td>31.972850715707
            </td>
            <td>18.217223413112
            </td>
            <td>3.2129974478099
            </td><td>3.2129974478099</td>
            <td>8
            </td></tr><tr>
            <td>113</td>
            <td>24.458226857954
            </td>
            <td>79.554447339606
            </td>
            
            <td>10.959443848673
            </td>
            <td>84.918056242474
            </td>
            <td>22.738592832451
            </td>
            <td>17.839753638683
            </td>
            <td>2.2876541158589
            </td>
            <td>18.58453542419
            </td><td>2.2876541158589</td>
            <td>7
            </td></tr><tr>
            <td>114</td>
            <td>24.349998116738
            </td>
            <td>79.429668556143
            </td>
            
            <td>10.759651642698
            </td>
            <td>84.721815962596
            </td>
            <td>22.826367998435
            </td>
            <td>17.900238747632
            </td>
            <td>1.9633231883828
            </td>
            <td>18.81794355395
            </td><td>1.9633231883828</td>
            <td>7
            </td></tr><tr>
            <td>115</td>
            <td>27.283656040021
            </td>
            <td>69.401715264488
            </td>
            
            <td>26.442903852242
            </td>
            <td>78.806900262604
            </td>
            <td>31.084383555091
            </td>
            <td>32.428333849
            </td>
            <td>19.135889519611
            </td>
            <td>3.1065121033271
            </td><td>3.1065121033271</td>
            <td>8
            </td></tr></tbody></table><br><br>Centroid baru :<table class="table table-striped table-responsive">
    <tbody><tr>
        <td>
        </td><td>Luas lahan</td><td>Daya tampung</td><td>Jumlah pembangkit</td><td>Kapasitas pemakaian</td><td>Sumber daya</td><td>Jumlah kamar</td><td>Jumlah meja</td><td>Jumlah sarana layanan</td><td>Jumlah lantai</td><td>Kebutuhan keamanan tambahan</td><td>Potensi kecelakaan</td><td>Kebutuhan tenaga medis darurat</td></tr>
        <tr>
        <td>
            c1 Baru
        </td><td>15.4803125</td><td>3.00125</td><td>0.5</td><td>17.425</td><td>1.875</td><td>0</td><td>0</td><td>6</td><td>1</td><td>2.1875</td><td>2.0625</td><td>2.0625</td></tr>
        <tr>
        <td>
            c2 Baru 
        </td><td>43.590428571429</td><td>18.142857142857</td><td>2.4285714285714</td><td>64.928571428571</td><td>2</td><td>0</td><td>0</td><td>13.857142857143</td><td>1</td><td>3.5714285714286</td><td>3.7142857142857</td><td>3.2857142857143</td></tr>
        <tr>
        <td>
            c3 Baru 
        </td><td>0.609</td><td>0.53</td><td>0.4</td><td>7.7</td><td>1</td><td>0</td><td>0</td><td>5.6</td><td>1</td><td>2.6</td><td>2</td><td>2.4</td></tr>
        <tr>
        <td>
            c4 Baru 
        </td><td>15.239</td><td>2.76</td><td>2</td><td>56.2</td><td>2</td><td>61</td><td>0</td><td>20</td><td>10.2</td><td>3.4</td><td>2</td><td>2</td></tr>
        <tr>
        <td>
            c5 Baru 
        </td><td>0.617</td><td>0.23333333333333</td><td>1</td><td>15.4</td><td>3</td><td>10</td><td>0</td><td>1</td><td>1</td><td>2</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c6 Baru 
        </td><td>0.48390909090909</td><td>0.16181818181818</td><td>0</td><td>3.6</td><td>1</td><td>12.181818181818</td><td>0</td><td>2</td><td>1.5454545454545</td><td>1</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c7 Baru 
        </td><td>0.62177419354839</td><td>0.21</td><td>0</td><td>2.2193548387097</td><td>1</td><td>0</td><td>7.8064516129032</td><td>11.806451612903</td><td>1</td><td>2</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c8 Baru 
        </td><td>6.5713243243243</td><td>0.59621621621622</td><td>0.97297297297297</td><td>10.227027027027</td><td>3</td><td>0</td><td>20.351351351351</td><td>19.405405405405</td><td>1.4864864864865</td><td>2</td><td>2</td><td>1</td></tr> </tbody></table> <br><br>Iterasi 4  :<table class="table table-striped table-responsive">
            <tbody><tr>
            <td>
            No 
            </td>
            <td>
            C1
            </td>
            <td>
            C2
            </td>
            <td>
            C3
            </td>
            <td>
            C4
            </td>
            <td>
            C5
            </td>
            <td>
            C6
            </td>
            <td>
            C7
            </td>
            <td>
            C8
            </td>
            <td>
            Min
            </td>
            <td>
            Cluster
            </td></tr><tr>
            <td>1</td>
            <td>25.837521500429
            </td>
            <td>79.520076746668
            </td>
            
            <td>16.171111155391
            </td>
            <td>74.216830139801
            </td>
            <td>13.124296112342
            </td>
            <td>2.8590960601197
            </td>
            <td>19.647510895563
            </td>
            <td>32.084531706728
            </td><td>2.8590960601197</td>
            <td>6
            </td></tr><tr>
            <td>2</td>
            <td>63.749257214576
            </td>
            <td>53.237088918443
            </td>
            
            <td>72.499236416669
            </td>
            <td>24.654436132266
            </td>
            <td>61.870393836183
            </td>
            <td>70.828668918282
            </td>
            <td>76.900131400351
            </td>
            <td>72.107407445343
            </td><td>24.654436132266</td>
            <td>4
            </td></tr><tr>
            <td>3</td>
            <td>18.839409031606
            </td>
            <td>69.182716536483
            </td>
            
            <td>14.365656580888
            </td>
            <td>69.610468099274
            </td>
            <td>1.1055129025831
            </td>
            <td>13.361670377651
            </td>
            <td>22.060584137507
            </td>
            <td>30.460001995564
            </td><td>1.1055129025831</td>
            <td>5
            </td></tr><tr>
            <td>4</td>
            <td>18.666963593074
            </td>
            <td>73.866754633473
            </td>
            
            <td>5.1424853913259
            </td>
            <td>80.676419082654
            </td>
            <td>15.98200577038
            </td>
            <td>15.897047676422
            </td>
            <td>11.402036626409
            </td>
            <td>24.320486631134
            </td><td>5.1424853913259</td>
            <td>3
            </td></tr><tr>
            <td>5</td>
            <td>26.510322784911
            </td>
            <td>79.808315853471
            </td>
            
            <td>17.105910703614
            </td>
            <td>73.629033139109
            </td>
            <td>13.53784572145
            </td>
            <td>3.8452928495985
            </td>
            <td>20.421688653385
            </td>
            <td>32.587028016914
            </td><td>3.8452928495985</td>
            <td>6
            </td></tr><tr>
            <td>6</td>
            <td>25.879621237765
            </td>
            <td>79.578214836161
            </td>
            
            <td>16.174125045887
            </td>
            <td>74.230863264548
            </td>
            <td>13.124646793131
            </td>
            <td>2.8548559602402
            </td>
            <td>19.647577944079
            </td>
            <td>32.094721277713
            </td><td>2.8548559602402</td>
            <td>6
            </td></tr><tr>
            <td>7</td>
            <td>19.369732310622
            </td>
            <td>71.604660742731
            </td>
            
            <td>12.617414790677
            </td>
            <td>71.566211273198
            </td>
            <td>2.2002670544984
            </td>
            <td>10.20976080697
            </td>
            <td>20.082200123757
            </td>
            <td>29.975459597532
            </td><td>2.2002670544984</td>
            <td>5
            </td></tr><tr>
            <td>8</td>
            <td>23.424434727121
            </td>
            <td>78.878830620653
            </td>
            
            <td>11.648795474211
            </td>
            <td>77.572362836258
            </td>
            <td>12.096333402225
            </td>
            <td>2.2529563021003
            </td>
            <td>16.127349257354
            </td>
            <td>30.116293995597
            </td><td>2.2529563021003</td>
            <td>6
            </td></tr><tr>
            <td>9</td>
            <td>9.8431979259871
            </td>
            <td>58.576006735537
            </td>
            
            <td>24.079488802713
            </td>
            <td>77.231384300684
            </td>
            <td>26.071871179065
            </td>
            <td>28.515893890459
            </td>
            <td>27.956619616095
            </td>
            <td>30.70780304659
            </td><td>9.8431979259871</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>10</td>
            <td>69.704650630608
            </td>
            <td>21.079036155016
            </td>
            
            <td>83.916210257614
            </td>
            <td>72.036836576851
            </td>
            <td>78.391257338501
            </td>
            <td>88.97774483395
            </td>
            <td>89.179426821062
            </td>
            <td>82.371065175773
            </td><td>21.079036155016</td>
            <td>2
            </td></tr><tr>
            <td>11</td>
            <td>62.551359632786
            </td>
            <td>67.865363784872
            </td>
            
            <td>69.275288732708
            </td>
            <td>16.374499961831
            </td>
            <td>59.086115143727
            </td>
            <td>63.357845349104
            </td>
            <td>71.574717633806
            </td>
            <td>68.220447756199
            </td><td>16.374499961831</td>
            <td>4
            </td></tr><tr>
            <td>12</td>
            <td>18.725148742004
            </td>
            <td>73.922585177788
            </td>
            
            <td>5.5536745493412
            </td>
            <td>80.420337235055
            </td>
            <td>16.290007983765
            </td>
            <td>15.767827105997
            </td>
            <td>9.6289375542433
            </td>
            <td>23.120182323045
            </td><td>5.5536745493412</td>
            <td>3
            </td></tr><tr>
            <td>13</td>
            <td>75.902897971093
            </td>
            <td>19.282345572983
            </td>
            
            <td>91.645980713832
            </td>
            <td>77.929896195234
            </td>
            <td>86.672835806715
            </td>
            <td>96.366935223509
            </td>
            <td>96.428440121315
            </td>
            <td>89.116295293661
            </td><td>19.282345572983</td>
            <td>2
            </td></tr><tr>
            <td>14</td>
            <td>18.620572840548
            </td>
            <td>74.909474182005
            </td>
            
            <td>4.7806569632217
            </td>
            <td>82.119234172026
            </td>
            <td>12.858609312225
            </td>
            <td>12.985913865314
            </td>
            <td>14.450649601571
            </td>
            <td>28.301934378585
            </td><td>4.7806569632217</td>
            <td>3
            </td></tr><tr>
            <td>15</td>
            <td>4.6920649143161
            </td>
            <td>61.143874838159
            </td>
            
            <td>14.178400086046
            </td>
            <td>74.823530049043
            </td>
            <td>15.716530663957
            </td>
            <td>21.469569246835
            </td>
            <td>20.59924750828
            </td>
            <td>25.667849911578
            </td><td>4.6920649143161</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>16</td>
            <td>5.1093586104477
            </td>
            <td>62.751289065384
            </td>
            
            <td>14.519978684557
            </td>
            <td>76.754366136396
            </td>
            <td>17.536603627207
            </td>
            <td>20.886394545234
            </td>
            <td>20.234724219271
            </td>
            <td>26.30709760054
            </td><td>5.1093586104477</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>17</td>
            <td>7.5181304298447
            </td>
            <td>62.866291335059
            </td>
            
            <td>11.77355617475
            </td>
            <td>75.045275167728
            </td>
            <td>13.73608120163
            </td>
            <td>19.944077681199
            </td>
            <td>19.027153048557
            </td>
            <td>25.272035262846
            </td><td>7.5181304298447</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>18</td>
            <td>10.628495679547
            </td>
            <td>63.115390873238
            </td>
            
            <td>15.803283867602
            </td>
            <td>78.057585928595
            </td>
            <td>17.749210314202
            </td>
            <td>21.265751911745
            </td>
            <td>22.446521385161
            </td>
            <td>29.597342472959
            </td><td>10.628495679547</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>19</td>
            <td>7.7250941440966
            </td>
            <td>64.91806901953
            </td>
            
            <td>10.459821413389
            </td>
            <td>76.776041471282
            </td>
            <td>14.673922462806
            </td>
            <td>18.460981735667
            </td>
            <td>17.194809205602
            </td>
            <td>24.845303908374
            </td><td>7.7250941440966</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>20</td>
            <td>23.401865212204
            </td>
            <td>78.859656130886
            </td>
            
            <td>11.648114911864
            </td>
            <td>77.565659418328
            </td>
            <td>12.095654871803
            </td>
            <td>2.251380346101
            </td>
            <td>16.126829969809
            </td>
            <td>30.109100722647
            </td><td>2.251380346101</td>
            <td>6
            </td></tr><tr>
            <td>21</td>
            <td>7.6480255890103
            </td>
            <td>64.912424911867
            </td>
            
            <td>10.608910453011
            </td>
            <td>76.931761457801
            </td>
            <td>14.426436385254
            </td>
            <td>18.375523859177
            </td>
            <td>17.66566378977
            </td>
            <td>25.398919116223
            </td><td>7.6480255890103</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>22</td>
            <td>18.663176857388
            </td>
            <td>74.92544328061
            </td>
            
            <td>4.6734335343514
            </td>
            <td>82.129519181595
            </td>
            <td>12.898116145822
            </td>
            <td>13.024287270993
            </td>
            <td>14.485928646314
            </td>
            <td>28.304975407391
            </td><td>4.6734335343514</td>
            <td>3
            </td></tr><tr>
            <td>23</td>
            <td>6.54063319069
            </td>
            <td>60.418169022916
            </td>
            
            <td>15.752844314599
            </td>
            <td>74.044109988574
            </td>
            <td>18.468456291141
            </td>
            <td>23.306208039707
            </td>
            <td>20.206743413005
            </td>
            <td>23.648903226429
            </td><td>6.54063319069</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>24</td>
            <td>5.3795836651321
            </td>
            <td>62.82866265325
            </td>
            
            <td>13.680927636677
            </td>
            <td>76.389794612893
            </td>
            <td>17.429375589632
            </td>
            <td>20.743612922998
            </td>
            <td>19.039480196829
            </td>
            <td>25.024751646623
            </td><td>5.3795836651321</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>25</td>
            <td>18.00044292261
            </td>
            <td>74.230538763245
            </td>
            
            <td>0.92048954366685
            </td>
            <td>81.12329283874
            </td>
            <td>13.835739714393
            </td>
            <td>13.59051169045
            </td>
            <td>11.26272411775
            </td>
            <td>25.349312445541
            </td><td>0.92048954366685</td>
            <td>3
            </td></tr><tr>
            <td>26</td>
            <td>41.469822077749
            </td>
            <td>23.91080858874
            </td>
            
            <td>58.189252521406
            </td>
            <td>71.576308433727
            </td>
            <td>56.200451980191
            </td>
            <td>62.908027728864
            </td>
            <td>61.636147766191
            </td>
            <td>55.84214121342
            </td><td>23.91080858874</td>
            <td>2
            </td></tr><tr>
            <td>27</td>
            <td>22.934539428233
            </td>
            <td>78.680775506901
            </td>
            
            <td>10.797731057958
            </td>
            <td>78.210300830517
            </td>
            <td>12.135220659075
            </td>
            <td>3.2283025245603
            </td>
            <td>15.525346850968
            </td>
            <td>29.775648899404
            </td><td>3.2283025245603</td>
            <td>6
            </td></tr><tr>
            <td>28</td>
            <td>100.7411871228
            </td>
            <td>92.138101685592
            </td>
            
            <td>107.08432070569
            </td>
            <td>26.890925625571
            </td>
            <td>96.08431269868
            </td>
            <td>100.96472289778
            </td>
            <td>109.5528464893
            </td>
            <td>105.26432633756
            </td><td>26.890925625571</td>
            <td>4
            </td></tr><tr>
            <td>29</td>
            <td>25.760748638387
            </td>
            <td>34.173042750038
            </td>
            
            <td>40.672027008744
            </td>
            <td>64.790560431285
            </td>
            <td>36.831116375212
            </td>
            <td>46.434121709335
            </td>
            <td>45.898902225656
            </td>
            <td>41.960524954231
            </td><td>25.760748638387</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>30</td>
            <td>8.1189620894642
            </td>
            <td>56.966824876503
            </td>
            
            <td>18.104413301734
            </td>
            <td>71.677895623407
            </td>
            <td>16.544942835938
            </td>
            <td>25.311815868359
            </td>
            <td>24.948386715654
            </td>
            <td>27.755882363672
            </td><td>8.1189620894642</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>31</td>
            <td>19.016922934853
            </td>
            <td>69.322969245998
            </td>
            
            <td>14.365593652892
            </td>
            <td>69.657937243361
            </td>
            <td>1.1063303203735
            </td>
            <td>13.359486748752
            </td>
            <td>22.060674024687
            </td>
            <td>30.504178142746
            </td><td>1.1063303203735</td>
            <td>5
            </td></tr><tr>
            <td>32</td>
            <td>77.725433710016
            </td>
            <td>20.646217071593
            </td>
            
            <td>93.683145661319
            </td>
            <td>78.854516173774
            </td>
            <td>88.974594501901
            </td>
            <td>98.375214103078
            </td>
            <td>97.962487223118
            </td>
            <td>90.179189067773
            </td><td>20.646217071593</td>
            <td>2
            </td></tr><tr>
            <td>33</td>
            <td>23.294960193358
            </td>
            <td>78.756645393599
            </td>
            
            <td>11.689096671685
            </td>
            <td>77.415346805398
            </td>
            <td>12.134993480747
            </td>
            <td>2.2325413177671
            </td>
            <td>16.156297075683
            </td>
            <td>30.069194262963
            </td><td>2.2325413177671</td>
            <td>6
            </td></tr><tr>
            <td>34</td>
            <td>23.373567438137
            </td>
            <td>78.823143157479
            </td>
            
            <td>11.644430256565
            </td>
            <td>77.55751540631
            </td>
            <td>12.094543195636
            </td>
            <td>2.2500620817882
            </td>
            <td>16.126133484672
            </td>
            <td>30.102504245778
            </td><td>2.2500620817882</td>
            <td>6
            </td></tr><tr>
            <td>35</td>
            <td>70.915437638149
            </td>
            <td>18.328447660756
            </td>
            
            <td>86.076197528701
            </td>
            <td>73.024754165968
            </td>
            <td>80.724749200257
            </td>
            <td>91.036241658369
            </td>
            <td>91.117226159161
            </td>
            <td>83.884664580196
            </td><td>18.328447660756</td>
            <td>2
            </td></tr><tr>
            <td>36</td>
            <td>10.560831899531
            </td>
            <td>57.566289683623
            </td>
            
            <td>25.263645441622
            </td>
            <td>77.352535323672
            </td>
            <td>27.139610660026
            </td>
            <td>29.472437429033
            </td>
            <td>28.956951358386
            </td>
            <td>31.431146204552
            </td><td>10.560831899531</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>37</td>
            <td>6.4726073115983
            </td>
            <td>55.40224112998
            </td>
            
            <td>19.755416497761
            </td>
            <td>71.717370427254
            </td>
            <td>18.192746726222
            </td>
            <td>26.395514336705
            </td>
            <td>26.405411524503
            </td>
            <td>28.787784625146
            </td><td>6.4726073115983</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>38</td>
            <td>17.856954374561
            </td>
            <td>55.248672067521
            </td>
            
            <td>32.833524696566
            </td>
            <td>78.671569350052
            </td>
            <td>34.258126439009
            </td>
            <td>36.329652092885
            </td>
            <td>35.854430244158
            </td>
            <td>36.498570128631
            </td><td>17.856954374561</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>39</td>
            <td>86.847962960625
            </td>
            <td>77.824595777548
            </td>
            
            <td>93.855483489245
            </td>
            <td>13.343339949203
            </td>
            <td>82.631118836133
            </td>
            <td>88.713256285267
            </td>
            <td>96.982488607418
            </td>
            <td>92.650767884404
            </td><td>13.343339949203</td>
            <td>4
            </td></tr><tr>
            <td>40</td>
            <td>6.7017662157193
            </td>
            <td>54.246074190504
            </td>
            
            <td>20.280724370692
            </td>
            <td>71.157506427643
            </td>
            <td>19.372311859398
            </td>
            <td>27.192616391037
            </td>
            <td>26.093093877517
            </td>
            <td>27.614500310663
            </td><td>6.7017662157193</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>41</td>
            <td>41.633969549037
            </td>
            <td>25.150012654275
            </td>
            
            <td>59.190250725943
            </td>
            <td>71.430166743471
            </td>
            <td>57.183743028747
            </td>
            <td>63.785897734738
            </td>
            <td>62.372105528841
            </td>
            <td>56.044871312017
            </td><td>25.150012654275</td>
            <td>2
            </td></tr><tr>
            <td>42</td>
            <td>6.6582126287883
            </td>
            <td>59.13963374394
            </td>
            
            <td>20.670795364475
            </td>
            <td>76.904386877473
            </td>
            <td>22.940396686002
            </td>
            <td>25.63474249049
            </td>
            <td>25.065968441442
            </td>
            <td>28.921233765916
            </td><td>6.6582126287883</td>
            <td>1
            </td></tr><tr></tr><tr>
            <td>43</td>
            <td>41.234238448287
            </td>
            <td>25.050411903005
            </td>
            
            <td>58.897247652161
            </td>
            <td>71.590982120655
            </td>
            <td>56.736059669119
            </td>
            <td>63.416407575851
            </td>
            <td>62.309753285923
            </td>
            <td>56.22854454814
            </td><td>25.050411903005</td>
            <td>2
            </td></tr><tr>
            <td>44</td>
            <td>30.543509669161
            </td>
            <td>71.889364358984
            </td>
            
            <td>29.506995458704
            </td>
            <td>79.892763883846
            </td>
            <td>34.251824283938
            </td>
            <td>34.883324028553
            </td>
            <td>21.61094181579
            </td>
            <td>5.7094663311009
            </td><td>5.7094663311009</td>
            <td>8
            </td></tr><tr>
            <td>45</td>
            <td>25.876731193973
            </td>
            <td>79.575508777667
            </td>
            
            <td>16.174098305624
            </td>
            <td>74.229871992346
            </td>
            <td>13.124610792113
            </td>
            <td>2.8549235476296
            </td>
            <td>19.64755268034
            </td>
            <td>32.09377892444
            </td><td>2.8549235476296</td>
            <td>6
            </td></tr><tr>
            <td>46</td>
            <td>23.676102438116
            </td>
            <td>78.528113851548
            </td>
            
            <td>11.682545998197
            </td>
            <td>83.903973809349
            </td>
            <td>21.670596825602
            </td>
            <td>17.927530753491
            </td>
            <td>1.445052640285
            </td>
            <td>18.019020966656
            </td><td>1.445052640285</td>
            <td>7
            </td></tr><tr>
            <td>47</td>
            <td>25.33614715254
            </td>
            <td>79.418139076456
            </td>
            
            <td>15.251818776789
            </td>
            <td>74.86229983109
            </td>
            <td>12.777584556993
            </td>
            <td>1.8742661373772
            </td>
            <td>18.895436469132
            </td>
            <td>31.646948118553
            </td><td>1.8742661373772</td>
            <td>6
            </td></tr><tr>
            <td>48</td>
            <td>23.314414881896
            </td>
            <td>78.772799381305
            </td>
            
            <td>11.643339898843
            </td>
            <td>77.539995383028
            </td>
            <td>12.093432561151
            </td>
            <td>2.2495341960445
            </td>
            <td>16.125273291136
            </td>
            <td>30.083854510208
            </td><td>2.2495341960445</td>
            <td>6
            </td></tr><tr>
            <td>49</td>
            <td>62.538432403884
            </td>
            <td>69.800230045232
            </td>
            
            <td>68.16185645946
            </td>
            <td>16.028600562744
            </td>
            <td>57.809784354477
            </td>
            <td>62.206997493771
            </td>
            <td>70.525188728322
            </td>
            <td>67.563133304896
            </td><td>16.028600562744</td>
            <td>4
            </td></tr><tr>
            <td>50</td>
            <td>22.656904787176
            </td>
            <td>77.331121649115
            </td>
            
            <td>10.768463214405
            </td>
            <td>82.848229914706
            </td>
            <td>20.934243600166
            </td>
            <td>17.852302792869
            </td>
            <td>3.8204627828484
            </td>
            <td>18.736279426074
            </td><td>3.8204627828484</td>
            <td>7
            </td></tr><tr>
            <td>51</td>
            <td>29.489397169324
            </td>
            <td>74.507115149754
            </td>
            
            <td>26.380585304348
            </td>
            <td>81.601098160503
            </td>
            <td>31.963640282532
            </td>
            <td>31.512643563686
            </td>
            <td>17.578139366406
            </td>
            <td>3.9972007572904
            </td><td>3.9972007572904</td>
            <td>8
            </td></tr><tr>
            <td>52</td>
            <td>28.570329863954
            </td>
            <td>71.246451320721
            </td>
            
            <td>27.51601817124
            </td>
            <td>79.628184055647
            </td>
            <td>32.267534898787
            </td>
            <td>33.014781913962
            </td>
            <td>19.846196609807
            </td>
            <td>3.7269569105374
            </td><td>3.7269569105374</td>
            <td>8
            </td></tr><tr>
            <td>53</td>
            <td>24.028402759238
            </td>
            <td>79.588135561932
            </td>
            
            <td>11.312368496473
            </td>
            <td>84.95961758977
            </td>
            <td>21.185958402783
            </td>
            <td>16.822172997919
            </td>
            <td>2.0442720222457
            </td>
            <td>19.093517446732
            </td><td>2.0442720222457</td>
            <td>7
            </td></tr><tr>
            <td>54</td>
            <td>29.319299640512
            </td>
            <td>69.45749480445
            </td>
            
            <td>30.276118459935
            </td>
            <td>79.424921334553
            </td>
            <td>33.617018191849
            </td>
            <td>35.191191986956
            </td>
            <td>23.433920498017
            </td>
            <td>6.1573630677537
            </td><td>6.1573630677537</td>
            <td>8
            </td></tr><tr>
            <td>55</td>
            <td>27.828193900883
            </td>
            <td>71.648701968674
            </td>
            
            <td>26.054915927709
            </td>
            <td>79.713155275651
            </td>
            <td>30.732398655346
            </td>
            <td>31.574370407731
            </td>
            <td>18.449666586837
            </td>
            <td>2.1479071717389
            </td><td>2.1479071717389</td>
            <td>8
            </td></tr><tr>
            <td>56</td>
            <td>23.831502951139
            </td>
            <td>78.373760619566
            </td>
            
            <td>12.087586235473
            </td>
            <td>83.613694338906
            </td>
            <td>22.307229323946
            </td>
            <td>18.584803097964
            </td>
            <td>4.2524429075041
            </td>
            <td>18.977503590903
            </td><td>4.2524429075041</td>
            <td>7
            </td></tr><tr>
            <td>57</td>
            <td>23.642906111774
            </td>
            <td>72.394011527761
            </td>
            
            <td>20.404481885115
            </td>
            <td>80.492342126441
            </td>
            <td>26.555675076672
            </td>
            <td>26.190910435928
            </td>
            <td>12.530796945962
            </td>
            <td>6.1155700670857
            </td><td>6.1155700670857</td>
            <td>8
            </td></tr><tr>
            <td>58</td>
            <td>27.77144171915
            </td>
            <td>73.300741570573
            </td>
            
            <td>25.579834342701
            </td>
            <td>81.460019794989
            </td>
            <td>31.010729542818
            </td>
            <td>30.637492242632
            </td>
            <td>17.093610282443
            </td>
            <td>2.6939687094688
            </td><td>2.6939687094688</td>
            <td>8
            </td></tr><tr>
            <td>59</td>
            <td>27.072753499324
            </td>
            <td>70.373103888764
            </td>
            
            <td>26.617945901215
            </td>
            <td>79.344612444702
            </td>
            <td>31.212937388917
            </td>
            <td>32.035579840789
            </td>
            <td>19.239193290151
            </td>
            <td>2.2893011625826
            </td><td>2.2893011625826</td>
            <td>8
            </td></tr><tr>
            <td>60</td>
            <td>24.447940752447
            </td>
            <td>72.832637460895
            </td>
            
            <td>20.853775293697
            </td>
            <td>80.55663488503
            </td>
            <td>27.072540093444
            </td>
            <td>26.673763468129
            </td>
            <td>12.772268361608
            </td>
            <td>6.0534743052526
            </td><td>6.0534743052526</td>
            <td>8
            </td></tr><tr>
            <td>61</td>
            <td>23.066236792879
            </td>
            <td>78.410086888078
            </td>
            
            <td>10.471540287847
            </td>
            <td>83.901314626173
            </td>
            <td>20.823412507186
            </td>
            <td>16.953560562181
            </td>
            <td>1.8208081875297
            </td>
            <td>19.112010224988
            </td><td>1.8208081875297</td>
            <td>7
            </td></tr><tr>
            <td>62</td>
            <td>23.35980685462
            </td>
            <td>78.510889854822
            </td>
            
            <td>11.076028891259
            </td>
            <td>83.982319424984
            </td>
            <td>21.133156266345
            </td>
            <td>17.332300925495
            </td>
            <td>0.83426962704748
            </td>
            <td>18.37773679055
            </td><td>0.83426962704748</td>
            <td>7
            </td></tr><tr>
            <td>63</td>
            <td>24.613071604031
            </td>
            <td>79.311409520205
            </td>
            
            <td>12.810509591738
            </td>
            <td>84.466969378568
            </td>
            <td>22.843197830232
            </td>
            <td>18.654693070477
            </td>
            <td>2.5116050653242
            </td>
            <td>18.145233439385
            </td><td>2.5116050653242</td>
            <td>7
            </td></tr><tr>
            <td>64</td>
            <td>23.395349461168
            </td>
            <td>78.453908826932
            </td>
            
            <td>11.115101843888
            </td>
            <td>83.824970438408
            </td>
            <td>21.368636490063
            </td>
            <td>17.561117142169
            </td>
            <td>2.1679538973273
            </td>
            <td>18.765783481589
            </td><td>2.1679538973273</td>
            <td>7
            </td></tr><tr>
            <td>65</td>
            <td>23.117597237498
            </td>
            <td>78.542466435655
            </td>
            
            <td>10.531352429769
            </td>
            <td>84.08184860004
            </td>
            <td>20.630349175695
            </td>
            <td>16.775199207843
            </td>
            <td>1.1434234410107
            </td>
            <td>18.798270300735
            </td><td>1.1434234410107</td>
            <td>7
            </td></tr><tr>
            <td>66</td>
            <td>24.462878934932
            </td>
            <td>68.181106973132
            </td>
            
            <td>25.015954589022
            </td>
            <td>78.237164212413
            </td>
            <td>28.650372431165
            </td>
            <td>30.561328494879
            </td>
            <td>19.004880300333
            </td>
            <td>4.234622906984
            </td><td>4.234622906984</td>
            <td>8
            </td></tr><tr>
            <td>67</td>
            <td>24.556915841778
            </td>
            <td>78.54409530555
            </td>
            
            <td>13.60467011728
            </td>
            <td>83.823829959028
            </td>
            <td>23.165005995634
            </td>
            <td>19.607130196786
            </td>
            <td>3.2016795749944
            </td>
            <td>16.599801615618
            </td><td>3.2016795749944</td>
            <td>7
            </td></tr><tr>
            <td>68</td>
            <td>27.983403117476
            </td>
            <td>71.096801877613
            </td>
            
            <td>26.92881089094
            </td>
            <td>79.480108303902
            </td>
            <td>31.623129516929
            </td>
            <td>32.399560615835
            </td>
            <td>19.347151878522
            </td>
            <td>2.7833019136867
            </td><td>2.7833019136867</td>
            <td>8
            </td></tr><tr>
            <td>69</td>
            <td>23.320636438789
            </td>
            <td>78.483462319479
            </td>
            
            <td>11.077658823055
            </td>
            <td>83.971492930637
            </td>
            <td>21.133281811189
            </td>
            <td>17.332792882256
            </td>
            <td>0.83564398826897
            </td>
            <td>18.355851658539
            </td><td>0.83564398826897</td>
            <td>7
            </td></tr><tr>
            <td>70</td>
            <td>27.463808949874
            </td>
            <td>73.530475925265
            </td>
            
            <td>24.904413263516
            </td>
            <td>81.525441427814
            </td>
            <td>30.302752269573
            </td>
            <td>29.951322000101
            </td>
            <td>16.443583798345
            </td>
            <td>2.633976795446
            </td><td>2.633976795446</td>
            <td>8
            </td></tr><tr>
            <td>71</td>
            <td>27.376774465962
            </td>
            <td>71.365860289048
            </td>
            
            <td>26.420814238021
            </td>
            <td>80.322523148865
            </td>
            <td>30.294300125785
            </td>
            <td>31.297918984104
            </td>
            <td>19.361613725008
            </td>
            <td>4.4465075091827
            </td><td>4.4465075091827</td>
            <td>8
            </td></tr><tr>
            <td>72</td>
            <td>33.368127476458
            </td>
            <td>75.864138865448
            </td>
            
            <td>31.246643915787
            </td>
            <td>83.421499123427
            </td>
            <td>35.827941895181
            </td>
            <td>35.487333603428
            </td>
            <td>22.469510639782
            </td>
            <td>7.1614134439861
            </td><td>7.1614134439861</td>
            <td>8
            </td></tr><tr>
            <td>73</td>
            <td>22.463365629624
            </td>
            <td>77.811953943531
            </td>
            
            <td>10.349648351514
            </td>
            <td>83.804611812239
            </td>
            <td>19.345672731762
            </td>
            <td>16.333066093305
            </td>
            <td>4.2234536820193
            </td>
            <td>18.530057287641
            </td><td>4.2234536820193</td>
            <td>7
            </td></tr><tr>
            <td>74</td>
            <td>30.619140997261
            </td>
            <td>69.787609661203
            </td>
            
            <td>31.344971223467
            </td>
            <td>79.208212711814
            </td>
            <td>35.110061047765
            </td>
            <td>36.508713191749
            </td>
            <td>24.10233316984
            </td>
            <td>6.3217339694557
            </td><td>6.3217339694557</td>
            <td>8
            </td></tr><tr>
            <td>75</td>
            <td>22.717652900006
            </td>
            <td>77.680020612557
            </td>
            
            <td>10.987716960315
            </td>
            <td>83.538628214737
            </td>
            <td>20.15583175604
            </td>
            <td>17.168991745403
            </td>
            <td>2.571598926042
            </td>
            <td>17.363995378042
            </td><td>2.571598926042</td>
            <td>7
            </td></tr><tr>
            <td>76</td>
            <td>27.399600807496
            </td>
            <td>70.908272206897
            </td>
            
            <td>25.988716955633
            </td>
            <td>79.036866265054
            </td>
            <td>31.123227705008
            </td>
            <td>31.863463516714
            </td>
            <td>18.616172084204
            </td>
            <td>5.7783957047878
            </td><td>5.7783957047878</td>
            <td>8
            </td></tr><tr>
            <td>77</td>
            <td>26.962602689376
            </td>
            <td>71.120039029167
            </td>
            
            <td>25.4109790445
            </td>
            <td>79.300773110985
            </td>
            <td>30.188767013208
            </td>
            <td>31.030051136821
            </td>
            <td>17.968924663222
            </td>
            <td>2.3595319799387
            </td><td>2.3595319799387</td>
            <td>8
            </td></tr><tr>
            <td>78</td>
            <td>23.407648870832
            </td>
            <td>78.607669741727
            </td>
            
            <td>11.220555289289
            </td>
            <td>84.162249975865
            </td>
            <td>20.990805100753
            </td>
            <td>17.217005293633
            </td>
            <td>0.83521863332462
            </td>
            <td>18.085923627552
            </td><td>0.83521863332462</td>
            <td>7
            </td></tr><tr>
            <td>79</td>
            <td>24.669973576904
            </td>
            <td>79.515184261131
            </td>
            
            <td>12.904390105697
            </td>
            <td>84.814413892923
            </td>
            <td>22.490292226746
            </td>
            <td>18.330520513095
            </td>
            <td>1.5193300744506
            </td>
            <td>17.46304111242
            </td><td>1.5193300744506</td>
            <td>7
            </td></tr><tr>
            <td>80</td>
            <td>23.822076062135
            </td>
            <td>78.931249067574
            </td>
            
            <td>12.013774635809
            </td>
            <td>84.609981213802
            </td>
            <td>20.990944081781
            </td>
            <td>17.33295245293
            </td>
            <td>3.5638950743444
            </td>
            <td>17.863082732409
            </td><td>3.5638950743444</td>
            <td>7
            </td></tr><tr>
            <td>81</td>
            <td>25.651257462553
            </td>
            <td>73.074570851163
            </td>
            
            <td>22.701164749854
            </td>
            <td>81.104976055727
            </td>
            <td>28.358488654683
            </td>
            <td>28.017205240045
            </td>
            <td>14.463131141752
            </td>
            <td>3.7804879496338
            </td><td>3.7804879496338</td>
            <td>8
            </td></tr><tr>
            <td>82</td>
            <td>26.31403095613
            </td>
            <td>70.706385853827
            </td>
            
            <td>25.266458497383
            </td>
            <td>79.438950301474
            </td>
            <td>29.759906139712
            </td>
            <td>30.682525734737
            </td>
            <td>18.021616846952
            </td>
            <td>1.1384946685424
            </td><td>1.1384946685424</td>
            <td>8
            </td></tr><tr>
            <td>83</td>
            <td>31.809294349846
            </td>
            <td>74.489807123018
            </td>
            
            <td>30.37408013422
            </td>
            <td>82.645732037414
            </td>
            <td>35.200284474861
            </td>
            <td>34.830910818737
            </td>
            <td>21.67709123158
            </td>
            <td>5.7002351612967
            </td><td>5.7002351612967</td>
            <td>8
            </td></tr><tr>
            <td>84</td>
            <td>25.197550615787
            </td>
            <td>70.805358510468
            </td>
            
            <td>23.181327485716
            </td>
            <td>79.02986412743
            </td>
            <td>28.196733151988
            </td>
            <td>29.112150279863
            </td>
            <td>16.044388037193
            </td>
            <td>3.8179391394392
            </td><td>3.8179391394392</td>
            <td>8
            </td></tr><tr>
            <td>85</td>
            <td>24.35035274714
            </td>
            <td>79.434924966983
            </td>
            
            <td>12.22853503082
            </td>
            <td>84.721823923945
            </td>
            <td>22.109179513898
            </td>
            <td>17.860481028061
            </td>
            <td>0.96088479268198
            </td>
            <td>18.142928425148
            </td><td>0.96088479268198</td>
            <td>7
            </td></tr><tr>
            <td>86</td>
            <td>27.932612241968
            </td>
            <td>74.196824687132
            </td>
            
            <td>24.654849036244
            </td>
            <td>81.568042277598
            </td>
            <td>30.098325536666
            </td>
            <td>29.72036468651
            </td>
            <td>16.064126524781
            </td>
            <td>2.9945807543099
            </td><td>2.9945807543099</td>
            <td>8
            </td></tr><tr>
            <td>87</td>
            <td>23.640052536112
            </td>
            <td>78.578965745631
            </td>
            
            <td>11.735183211182
            </td>
            <td>84.060761506187
            </td>
            <td>21.485241448751
            </td>
            <td>17.760228295244
            </td>
            <td>0.29222876197189
            </td>
            <td>17.641841950533
            </td><td>0.29222876197189</td>
            <td>7
            </td></tr><tr>
            <td>88</td>
            <td>21.968782861373
            </td>
            <td>68.737818614928
            </td>
            
            <td>20.277371156045
            </td>
            <td>77.482544621353
            </td>
            <td>24.619541021536
            </td>
            <td>26.802306970061
            </td>
            <td>14.984912833149
            </td>
            <td>6.7806505589207
            </td><td>6.7806505589207</td>
            <td>8
            </td></tr><tr>
            <td>89</td>
            <td>25.154601935534
            </td>
            <td>70.527631647432
            </td>
            
            <td>23.856388159149
            </td>
            <td>79.354204022219
            </td>
            <td>28.410041800587
            </td>
            <td>29.426148039844
            </td>
            <td>16.836892208183
            </td>
            <td>2.1578247873732
            </td><td>2.1578247873732</td>
            <td>8
            </td></tr><tr>
            <td>90</td>
            <td>26.98084138857
            </td>
            <td>71.07178084622
            </td>
            
            <td>25.669433184237
            </td>
            <td>79.600173366645
            </td>
            <td>30.254368198842
            </td>
            <td>31.145331745764
            </td>
            <td>18.243925097739
            </td>
            <td>1.1569980854604
            </td><td>1.1569980854604</td>
            <td>8
            </td></tr><tr>
            <td>91</td>
            <td>25.725962667316
            </td>
            <td>69.358545259472
            </td>
            
            <td>25.546700863321
            </td>
            <td>78.876227248772
            </td>
            <td>28.797027394816
            </td>
            <td>30.741032040538
            </td>
            <td>19.535076943737
            </td>
            <td>5.6155054983671
            </td><td>5.6155054983671</td>
            <td>8
            </td></tr><tr>
            <td>92</td>
            <td>24.339924635979
            </td>
            <td>72.889910099871
            </td>
            
            <td>21.24506427385
            </td>
            <td>81.219126540489
            </td>
            <td>26.695344546277
            </td>
            <td>26.446961174621
            </td>
            <td>13.507759012973
            </td>
            <td>5.6246950021362
            </td><td>5.6246950021362</td>
            <td>8
            </td></tr><tr>
            <td>93</td>
            <td>22.738362395084
            </td>
            <td>72.343043373293
            </td>
            
            <td>19.264563555918
            </td>
            <td>80.465124302396
            </td>
            <td>25.329534199779
            </td>
            <td>25.004787505397
            </td>
            <td>11.688825315755
            </td>
            <td>6.8627366420698
            </td><td>6.8627366420698</td>
            <td>8
            </td></tr><tr>
            <td>94</td>
            <td>26.744661968048
            </td>
            <td>73.852313689041
            </td>
            
            <td>23.770314596151
            </td>
            <td>81.970864433651
            </td>
            <td>28.745289244984
            </td>
            <td>28.513242233121
            </td>
            <td>15.788337733633
            </td>
            <td>5.1757320231214
            </td><td>5.1757320231214</td>
            <td>8
            </td></tr><tr>
            <td>95</td>
            <td>24.131042541924
            </td>
            <td>79.419663771972
            </td>
            
            <td>11.60009400824
            </td>
            <td>84.658635241776
            </td>
            <td>21.767941261814
            </td>
            <td>17.435176167973
            </td>
            <td>1.2510175359003
            </td>
            <td>18.884773370243
            </td><td>1.2510175359003</td>
            <td>7
            </td></tr><tr>
            <td>96</td>
            <td>29.42733474442
            </td>
            <td>71.871077138732
            </td>
            
            <td>28.57350914746
            </td>
            <td>80.524156158261
            </td>
            <td>32.613973796178
            </td>
            <td>33.458513062775
            </td>
            <td>20.984338758541
            </td>
            <td>3.8256420555675
            </td><td>3.8256420555675</td>
            <td>8
            </td></tr><tr>
            <td>97</td>
            <td>22.552438979191
            </td>
            <td>78.61648918604
            </td>
            
            <td>8.9619264112132
            </td>
            <td>84.260873630648
            </td>
            <td>19.406693693443
            </td>
            <td>15.374891219396
            </td>
            <td>3.3400002275885
            </td>
            <td>20.493461616555
            </td><td>3.3400002275885</td>
            <td>7
            </td></tr><tr>
            <td>98</td>
            <td>23.281059311383
            </td>
            <td>78.70715741965
            </td>
            
            <td>10.774846866661
            </td>
            <td>84.293082901268
            </td>
            <td>20.533193292271
            </td>
            <td>16.715134350998
            </td>
            <td>1.8192345707789
            </td>
            <td>18.605055004808
            </td><td>1.8192345707789</td>
            <td>7
            </td></tr><tr>
            <td>99</td>
            <td>24.964121042211
            </td>
            <td>78.792481776564
            </td>
            
            <td>14.258782170999
            </td>
            <td>84.110410110759
            </td>
            <td>23.358384706805
            </td>
            <td>19.885196778442
            </td>
            <td>3.1036164915696
            </td>
            <td>15.503193224764
            </td><td>3.1036164915696</td>
            <td>7
            </td></tr><tr>
            <td>100</td>
            <td>24.392578523706
            </td>
            <td>78.996249618548
            </td>
            
            <td>13.157233903826
            </td>
            <td>84.607182224679
            </td>
            <td>21.877371424475
            </td>
            <td>18.342249225344
            </td>
            <td>3.6710330449433
            </td>
            <td>16.715953161076
            </td><td>3.6710330449433</td>
            <td>7
            </td></tr><tr>
            <td>101</td>
            <td>23.806245538937
            </td>
            <td>70.769830896235
            </td>
            
            <td>21.381084654432
            </td>
            <td>79.109773865181
            </td>
            <td>26.19164243503
            </td>
            <td>27.319766483913
            </td>
            <td>14.6699602998
            </td>
            <td>4.4582217218427
            </td><td>4.4582217218427</td>
            <td>8
            </td></tr><tr>
            <td>102</td>
            <td>27.501568705897
            </td>
            <td>73.575678979025
            </td>
            
            <td>24.870785190661
            </td>
            <td>81.538092423112
            </td>
            <td>30.276335430681
            </td>
            <td>29.924232365169
            </td>
            <td>16.395064324293
            </td>
            <td>2.6436899534096
            </td><td>2.6436899534096</td>
            <td>8
            </td></tr><tr>
            <td>103</td>
            <td>24.269052503346
            </td>
            <td>77.849411091975
            </td>
            
            <td>14.005518519498
            </td>
            <td>83.47205262242
            </td>
            <td>22.5667514154
            </td>
            <td>19.793236218675
            </td>
            <td>3.6806723400936
            </td>
            <td>14.579754758328
            </td><td>3.6806723400936</td>
            <td>7
            </td></tr><tr>
            <td>104</td>
            <td>30.802916666448
            </td>
            <td>74.526501330132
            </td>
            
            <td>28.832300029654
            </td>
            <td>82.430841467257
            </td>
            <td>33.742669526547
            </td>
            <td>33.383382965033
            </td>
            <td>20.165234925108
            </td>
            <td>4.5236241572112
            </td><td>4.5236241572112</td>
            <td>8
            </td></tr><tr>
            <td>105</td>
            <td>22.762302926882
            </td>
            <td>77.730660724408
            </td>
            
            <td>10.989960145515
            </td>
            <td>83.550348317646
            </td>
            <td>20.155602706058
            </td>
            <td>17.167918688623
            </td>
            <td>2.5689878270975
            </td>
            <td>17.382954615495
            </td><td>2.5689878270975</td>
            <td>7
            </td></tr><tr>
            <td>106</td>
            <td>29.512432118264
            </td>
            <td>72.018008736477
            </td>
            
            <td>28.50609240145
            </td>
            <td>80.554475878129
            </td>
            <td>32.555273210001
            </td>
            <td>33.400153610277
            </td>
            <td>20.893091999378
            </td>
            <td>3.7942867188569
            </td><td>3.7942867188569</td>
            <td>8
            </td></tr><tr>
            <td>107</td>
            <td>31.597479182051
            </td>
            <td>71.105519628599
            </td>
            
            <td>31.515982437487
            </td>
            <td>79.937415325991
            </td>
            <td>35.000639081467
            </td>
            <td>36.452330016676
            </td>
            <td>24.192199766046
            </td>
            <td>6.6208111817884
            </td><td>6.6208111817884</td>
            <td>8
            </td></tr><tr>
            <td>108</td>
            <td>23.472195554744
            </td>
            <td>78.516193557736
            </td>
            
            <td>11.115204946379
            </td>
            <td>83.846174158396
            </td>
            <td>21.369153784005
            </td>
            <td>17.560913850964
            </td>
            <td>2.1736456007617
            </td>
            <td>18.805729298132
            </td><td>2.1736456007617</td>
            <td>7
            </td></tr><tr>
            <td>109</td>
            <td>23.88791860251
            </td>
            <td>78.531627662792
            </td>
            
            <td>12.307880605531
            </td>
            <td>83.964490262253
            </td>
            <td>22.014089127445
            </td>
            <td>18.342486101178
            </td>
            <td>1.2163584882362
            </td>
            <td>17.234485521517
            </td><td>1.2163584882362</td>
            <td>7
            </td></tr><tr>
            <td>110</td>
            <td>24.289917824278
            </td>
            <td>79.3012788904
            </td>
            
            <td>12.17821912268
            </td>
            <td>84.539214338672
            </td>
            <td>22.289260196586
            </td>
            <td>18.027872682677
            </td>
            <td>1.7088705110444
            </td>
            <td>18.459095505118
            </td><td>1.7088705110444</td>
            <td>7
            </td></tr><tr>
            <td>111</td>
            <td>24.132330444036
            </td>
            <td>79.467457493682
            </td>
            
            <td>11.734995739241
            </td>
            <td>84.824676981407
            </td>
            <td>21.62898425981
            </td>
            <td>17.320328781498
            </td>
            <td>1.2391210090746
            </td>
            <td>18.57974067698
            </td><td>1.2391210090746</td>
            <td>7
            </td></tr><tr>
            <td>112</td>
            <td>27.231799782794
            </td>
            <td>69.740156531812
            </td>
            
            <td>26.515412291722
            </td>
            <td>78.428254532407
            </td>
            <td>30.575004542563
            </td>
            <td>32.238858004942
            </td>
            <td>19.716324393375
            </td>
            <td>3.4756150771271
            </td><td>3.4756150771271</td>
            <td>8
            </td></tr><tr>
            <td>113</td>
            <td>24.458226857954
            </td>
            <td>79.554447339606
            </td>
            
            <td>12.438474022162
            </td>
            <td>84.918056242474
            </td>
            <td>22.01844412709
            </td>
            <td>17.804555425996
            </td>
            <td>1.7089707912813
            </td>
            <td>17.917086416347
            </td><td>1.7089707912813</td>
            <td>7
            </td></tr><tr>
            <td>114</td>
            <td>24.349998116738
            </td>
            <td>79.429668556143
            </td>
            
            <td>12.227399560005
            </td>
            <td>84.721815962596
            </td>
            <td>22.109090779838
            </td>
            <td>17.860479188041
            </td>
            <td>0.95984864615061
            </td>
            <td>18.144317514949
            </td><td>0.95984864615061</td>
            <td>7
            </td></tr><tr>
            <td>115</td>
            <td>27.283656040021
            </td>
            <td>69.401715264488
            </td>
            
            <td>27.327197240112
            </td>
            <td>78.806900262604
            </td>
            <td>30.986230320006
            </td>
            <td>32.696248436578
            </td>
            <td>20.640682858741
            </td>
            <td>3.5588079012314
            </td><td>3.5588079012314</td>
            <td>8
            </td></tr></tbody></table><br><br>Centroid baru :<table class="table table-striped table-responsive">
    <tbody><tr>
        <td>
        </td><td>Luas lahan</td><td>Daya tampung</td><td>Jumlah pembangkit</td><td>Kapasitas pemakaian</td><td>Sumber daya</td><td>Jumlah kamar</td><td>Jumlah meja</td><td>Jumlah sarana layanan</td><td>Jumlah lantai</td><td>Kebutuhan keamanan tambahan</td><td>Potensi kecelakaan</td><td>Kebutuhan tenaga medis darurat</td></tr>
        <tr>
        <td>
            c1 Baru
        </td><td>15.4803125</td><td>3.00125</td><td>0.5</td><td>17.425</td><td>1.875</td><td>0</td><td>0</td><td>6</td><td>1</td><td>2.1875</td><td>2.0625</td><td>2.0625</td></tr>
        <tr>
        <td>
            c2 Baru 
        </td><td>43.590428571429</td><td>18.142857142857</td><td>2.4285714285714</td><td>64.928571428571</td><td>2</td><td>0</td><td>0</td><td>13.857142857143</td><td>1</td><td>3.5714285714286</td><td>3.7142857142857</td><td>3.2857142857143</td></tr>
        <tr>
        <td>
            c3 Baru 
        </td><td>0.609</td><td>0.53</td><td>0.4</td><td>7.7</td><td>1</td><td>0</td><td>0</td><td>5.6</td><td>1</td><td>2.6</td><td>2</td><td>2.4</td></tr>
        <tr>
        <td>
            c4 Baru 
        </td><td>15.239</td><td>2.76</td><td>2</td><td>56.2</td><td>2</td><td>61</td><td>0</td><td>20</td><td>10.2</td><td>3.4</td><td>2</td><td>2</td></tr>
        <tr>
        <td>
            c5 Baru 
        </td><td>0.617</td><td>0.23333333333333</td><td>1</td><td>15.4</td><td>3</td><td>10</td><td>0</td><td>1</td><td>1</td><td>2</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c6 Baru 
        </td><td>0.48390909090909</td><td>0.16181818181818</td><td>0</td><td>3.6</td><td>1</td><td>12.181818181818</td><td>0</td><td>2</td><td>1.5454545454545</td><td>1</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c7 Baru 
        </td><td>0.62177419354839</td><td>0.21</td><td>0</td><td>2.2193548387097</td><td>1</td><td>0</td><td>7.8064516129032</td><td>11.806451612903</td><td>1</td><td>2</td><td>1</td><td>1</td></tr>
        <tr>
        <td>
            c8 Baru 
        </td><td>6.5713243243243</td><td>0.59621621621622</td><td>0.97297297297297</td><td>10.227027027027</td><td>3</td><td>0</td><td>20.351351351351</td><td>19.405405405405</td><td>1.4864864864865</td><td>2</td><td>2</td><td>1</td></tr> </tbody></table> <br><br></div></div>';
        return $ret;
    }
    
}
