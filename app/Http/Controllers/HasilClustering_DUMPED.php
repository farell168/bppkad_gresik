<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use App\Pajak;
use App\Clustering;


class HasilController extends Controller
{
    public function index()
    {
        $cluster = Clustering::all();
        return view('daftarclustering', compact('cluster'));
    }

    public function proses_kmeans()
    {
        // $cluster = Clustering::all();
        $perhitungan = $this->kmeans();
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
        $k=3; 
        $resultView .= 'Klaster = '.$k;
        $resultView .= "<br><br>";

        $resultView .= 'Centroid awal :';
        
        //implementasikan iterasi
        $noiterasi =1;
        $cluster_iterasi= array();


        //mempersiapkan cluster
        //Cluster 1 (Nilai tertinggi)
        $data_cluster1 = array();
        $query = DB::table('tb_objek_pajak')
                    ->select(DB::raw('  max(luas_lahan) as luas_lahan, 
                                        max(daya_tampung) as daya_tampung, 
                                        max(jumlah_pembangkit) as jumlah_pembangkit,
                                        max(kapasitas_pemakaian) as kapasitas_pemakaian,
                                        max(sumber_daya) as sumber_daya,
                                        max(jumlah_kamar) as jumlah_kamar,
                                        max(jumlah_meja) as jumlah_meja,
                                        max(jumlah_sarana_layanan) as jumlah_sarana_layanan,
                                        max(jumlah_lantai) as jumlah_lantai,
                                        max(kebutuhan_keamanan_tambahan) as kebutuhan_keamanan_tambahan,
                                        max(potensi_kecelakaan) as potensi_kecelakaan,
                                        max(kebutuhan_tenaga_medis_darurat) as kebutuhan_tenaga_medis_darurat
                                        '))
                    ->first();
        $res = $query;
        $data_cluster1['luas_lahan'] = $res->luas_lahan;
        $data_cluster1['daya_tampung'] = $res->daya_tampung;
        $data_cluster1['jumlah_pembangkit'] = $res->jumlah_pembangkit;
        $data_cluster1['kapasitas_pemakaian'] = $res->kapasitas_pemakaian;
        $data_cluster1['sumber_daya'] = $res->sumber_daya;
        $data_cluster1['jumlah_kamar'] = $res->jumlah_kamar;
        $data_cluster1['jumlah_meja'] = $res->jumlah_meja;
        $data_cluster1['jumlah_sarana_layanan'] = $res->jumlah_sarana_layanan;
        $data_cluster1['jumlah_lantai'] = $res->jumlah_lantai;
        $data_cluster1['kebutuhan_keamanan_tambahan'] = $res->kebutuhan_keamanan_tambahan;
        $data_cluster1['potensi_kecelakaan'] = $res->potensi_kecelakaan;
        $data_cluster1['kebutuhan_tenaga_medis_darurat'] = $res->kebutuhan_tenaga_medis_darurat;

        //Cluster 2 (Nilai Tengah)
        $data_cluster2 = array();

        function getMedValue($res, $columnName) {
            $dattt = array();
            for($i=0; $i < sizeof($res); $i++) {
                $dattt[$i] = $res[$i]->$columnName;
            }
            sort($dattt);
            $count = sizeof($dattt);
            $index = floor($count / 2);
            if($count & 1) $index = $index;
            else $index = $index - 1;
            return $dattt[$index];
        }

        $data_cluster2['luas_lahan'] = getMedValue(DB::table('tb_objek_pajak')->select('luas_lahan')->get(), 'luas_lahan');
        $data_cluster2['daya_tampung'] = getMedValue(DB::table('tb_objek_pajak')->select('daya_tampung')->get(), 'daya_tampung');
        $data_cluster2['jumlah_pembangkit'] = getMedValue(DB::table('tb_objek_pajak')->select('jumlah_pembangkit')->get(), 'jumlah_pembangkit');
        $data_cluster2['kapasitas_pemakaian'] = getMedValue(DB::table('tb_objek_pajak')->select('kapasitas_pemakaian')->get(), 'kapasitas_pemakaian');
        $data_cluster2['sumber_daya'] = getMedValue(DB::table('tb_objek_pajak')->select('sumber_daya')->get(), 'sumber_daya');
        $data_cluster2['jumlah_kamar'] = getMedValue(DB::table('tb_objek_pajak')->select('jumlah_kamar')->get(), 'jumlah_kamar');
        $data_cluster2['jumlah_meja'] = getMedValue(DB::table('tb_objek_pajak')->select('jumlah_meja')->get(), 'jumlah_meja');
        $data_cluster2['jumlah_sarana_layanan'] = getMedValue(DB::table('tb_objek_pajak')->select('jumlah_sarana_layanan')->get(), 'jumlah_sarana_layanan');
        $data_cluster2['jumlah_lantai'] = getMedValue(DB::table('tb_objek_pajak')->select('jumlah_lantai')->get(), 'jumlah_lantai');
        $data_cluster2['kebutuhan_keamanan_tambahan'] = getMedValue(DB::table('tb_objek_pajak')->select('kebutuhan_keamanan_tambahan')->get(), 'kebutuhan_keamanan_tambahan');
        $data_cluster2['potensi_kecelakaan'] = getMedValue(DB::table('tb_objek_pajak')->select('potensi_kecelakaan')->get(), 'potensi_kecelakaan');
        $data_cluster2['kebutuhan_tenaga_medis_darurat'] = getMedValue(DB::table('tb_objek_pajak')->select('kebutuhan_tenaga_medis_darurat')->get(), 'kebutuhan_tenaga_medis_darurat');

        
        //Cluster 3 (Nilai terendah)
        $data_cluster3 = array();
        $query = DB::table('tb_objek_pajak')
                    ->select(DB::raw('  min(luas_lahan) as luas_lahan, 
                                        min(daya_tampung) as daya_tampung, 
                                        min(jumlah_pembangkit) as jumlah_pembangkit,
                                        min(kapasitas_pemakaian) as kapasitas_pemakaian,
                                        min(sumber_daya) as sumber_daya,
                                        min(jumlah_kamar) as jumlah_kamar,
                                        min(jumlah_meja) as jumlah_meja,
                                        min(jumlah_sarana_layanan) as jumlah_sarana_layanan,
                                        min(jumlah_lantai) as jumlah_lantai,
                                        min(kebutuhan_keamanan_tambahan) as kebutuhan_keamanan_tambahan,
                                        min(potensi_kecelakaan) as potensi_kecelakaan,
                                        min(kebutuhan_tenaga_medis_darurat) as kebutuhan_tenaga_medis_darurat
                                        '))
                    ->first();
        $res = $query;
        $data_cluster3['luas_lahan'] = $res->luas_lahan;
        $data_cluster3['daya_tampung'] = $res->daya_tampung;
        $data_cluster3['jumlah_pembangkit'] = $res->jumlah_pembangkit;
        $data_cluster3['kapasitas_pemakaian'] = $res->kapasitas_pemakaian;
        $data_cluster3['sumber_daya'] = $res->sumber_daya;
        $data_cluster3['jumlah_kamar'] = $res->jumlah_kamar;
        $data_cluster3['jumlah_meja'] = $res->jumlah_meja;
        $data_cluster3['jumlah_sarana_layanan'] = $res->jumlah_sarana_layanan;
        $data_cluster3['jumlah_lantai'] = $res->jumlah_lantai;
        $data_cluster3['kebutuhan_keamanan_tambahan'] = $res->kebutuhan_keamanan_tambahan;
        $data_cluster3['potensi_kecelakaan'] = $res->potensi_kecelakaan;
        $data_cluster3['kebutuhan_tenaga_medis_darurat'] = $res->kebutuhan_tenaga_medis_darurat;

        // menentukan centroid secara random yaitu 6, 33
        $c1 = $data_cluster1;
        $c2 = $data_cluster2;
        $c3 = $data_cluster3;

        // perulangan Centroid
        $resultView .= "<table class='table table-striped'>
        <tr>
            <td>
            </td>";
        foreach ($c1 as $key => $value)
        {

            $resultView .= "<td>". $key."</td>";

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

        $resultView .= "</tr> </table> <br><br>";

        $nomor = 1;
        // perulangan untuk iterasi
        $iterasi_terakhir = false;
        while($iterasi_terakhir == false) //selama iterasi terakhir belum ditemukan
        {

        $resultView .= 'iterasi '.$noiterasi.'  :';
        //tampilan iterasi

        $resultView .= "<table class='table table-striped'>
                <tr>
                <td>
                no 
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

                    //cluster2
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
            // $kuadratc3 = (pow($var1_c3,2)) + (pow($var2_c3,2)) + (pow($var3_c3,2)) + (pow($var4_c3,2)) + (pow($var5_c3,2));

            //peng-akar-an C1
            $akar1 = sqrt($kuadratc1);

            //peg-akar-an C2
            $akar2 = sqrt($kuadratc2); 

            //peg-akar-an C2
            $akar3 = sqrt($kuadratc3);

            // tampilan c1 dan c2
            
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
                </td>";

            //minimum dan klaster

            if ($akar1 < $akar2 && $akar1 < $akar3)
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
            elseif ($akar2 < $akar3 && $akar2 < $akar1)
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

            else
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

            // else(die('Error'));
            // menampung hasil cluster dari 1 iterasi
            $temp_cluster[] = $cluster;
            // dd($temp_cluster);
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

        // tampilan centroid baru
        $resultView .= 'Centroid baru :';
        $resultView .= "<table class='table table-striped'>
        <tr>
            <td>
            </td>";
        foreach ($c1 as $key => $value)
        {

            if ( $key != 'no') 
            $resultView .= "<td>". $key."</td>";

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

        $resultView .= "</tr> </table> <br><br>";

        // $iterasi_terakhir = true;
            if ($noiterasi > 1)
            {
                if ($cluster_iterasi[$noiterasi] == $cluster_iterasi[$noiterasi -1]) // jika iterasi saat ini sama dengan iterasi sebelumnya
                {
                    $iterasi_terakhir = true; // tandai bahwa iterasinya menjadi iterasi terakhir
                }
            }
            // var_dump($cluster_iterasi[$noiterasi]);
            $noiterasi++; // naikan no iterasi
            $nomor=1;
        }
            // memasukan hasil ke database 
            $i = 0;
            $sql=Pajak::all();
            
            foreach($sql->toArray() as $row)
            {
                $Clustering = new Clustering;
                $Clustering->no_pajak = $row['no_pajak']; 
                $Clustering->cluster = $cluster_iterasi[$noiterasi -1][$i]; 
                $Clustering->save();
            // $sqlhasil="INSERT INTO tb_hasil (no, nis, cluster) VALUES (".$row['no'].", ".$row['nis'].", ".$cluster_iterasi[$noiterasi -1][$i].")";
            // $this->db->query($sqlhasil);
            $i++;
        }


        return $resultView;
    }
    
}
