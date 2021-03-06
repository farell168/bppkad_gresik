<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Dashboard Admin BPPKAD GRESIK</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed" >
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{Auth::user()->name}}&nbsp;
          <!-- <i class="far fa-user-circle"></i> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-2 px-1">
            <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger btn-block">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <span class="brand-text font-weight-light">BPPKAD GRESIK</span>
    </a>

    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item   ">
            <a href="{{ route('daftaruser') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Data User
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('daftarpajak') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Data Pajak
                <!-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('hasil') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Penggolongan Pajak
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('grafik') }}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Grafik Pemasukan Pajak
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('laporan') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Cetak Laporan
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Pajak</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Isikan Data Berikut</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('update_pajak', $pajak->id) }}" method="POST">
                @csrf
                <div class="card-body">
                @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something it's wrong:
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">??</span>
                            </button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                  <input type="hidden" name="id" value="{{$pajak->id}}">
                  <div class="form-group">
                    <label for="exampleInputEmail1">No Wajib Pajak</label>
                    <input readonly value="{{$pajak->no_pajak}}" required type="text" name="no_pajak" class="form-control" placeholder="Masukkan Nomor Wajib Pajak">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Transaksi</label>
                    <input value="{{$pajak->tanggal_bayar}}" required type="date" name="tanggal_bayar" class="form-control"  placeholder="Isikan Tanggal Transaksi">
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Objek Pajak</label>
                    <input value="{{$pajak->alamat_pajak}}" required type="text" name="alamat_pajak" class="form-control"  placeholder="Masukkan Alamat Objek Pajak">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kecamatan</label>
                    <input value="{{$pajak->kecamatan}}" required type="text" name="kecamatan" class="form-control"  placeholder="Masukkan Kecamatan Objek Pajak">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama PENANGGUNG JAWAB</label>
                    <input value="{{$pajak->nama_pemilik}}" required type="text" name="nama_pemilik" class="form-control"  placeholder="Masukkan Nama Penanggung Jawab">
                  </div>
                  <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Penanggung Jawab</label>
                    <input value="{{$pajak->alamat_pemilik}}" required type="text" name="alamat_pemilik" class="form-control"  placeholder="Masukkan Alamat Penanggung Jawab">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nomer Telepon</label>
                    <input value="{{$pajak->no_tlpn}}" required type="text" name="no_tlpn" class="form-control"  placeholder="Masukkan Nomer Telepon">
                  </div> -->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Luas Lahan</label>
                    <input value="{{$pajak->luas_lahan*1000}}" required type="number" min="1" name="luas_lahan" class="form-control"  placeholder="Masukkan Luas Lahan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Daya Tampung dan OKUPANSI PENGUNJUNG</label>
                    <input value="{{$pajak->daya_tampung*100}}" required type="number" min="0" name="daya_tampung" class="form-control"  placeholder="Masukkan Jumlah Daya Tampung">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah PEMBANGKIT</label>
                    <input value="{{$pajak->jumlah_pembangkit}}" required type="number" min="0" name="jumlah_pembangkit" class="form-control"  placeholder="Masukkan Jumlah Pembangkit Yang Digunakan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kapasitas Pemakaian</label>
                    <input value="{{$pajak->kapasitas_pemakaian*1000}}" required type="number" min="0" name="kapasitas_pemakaian" class="form-control"  placeholder="Masukkan Kapasitas Pemakaian Listrik">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sumber Daya KELISTRIKAN</label>
                    <select required name="sumber_daya" id="sumber_daya" class="form-control">
                      <option {{($pajak->sumber_daya == '3')?'selected':''}} value="3">Gardu Induk PLN</option>
                      <option {{($pajak->sumber_daya == '2')?'selected':''}} value="2">Bantuan Swasta</option>
                      <option {{($pajak->sumber_daya == '1')?'selected':''}} value="1">Tidak Ada</option>
                    </select>  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Kamar</label>
                    <input value="{{$pajak->jumlah_kamar}}" required type="text" name="jumlah_kamar" class="form-control"  placeholder="Masukkan Jumlah Kamar">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Meja</label>
                    <input value="{{$pajak->jumlah_meja}}" required type="text" name="jumlah_meja" class="form-control"  placeholder="Masukkan Jumlah Meja">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Sarana/Layanan</label>
                    <input value="{{$pajak->jumlah_sarana_layanan}}" required type="number" min="0" name="jumlah_sarana_layanan" class="form-control"  placeholder="Masukkan Sarana / Layanan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Lantai</label>
                    <input value="{{$pajak->jumlah_lantai}}" required type="number" min="0" name="jumlah_lantai" class="form-control"  placeholder="Masukkan Jumlah Lantai">
                  </div>
                  <div class="form-group">
                    <label for="kebutuhan_keamanan_tambahan">Kebutuhan Keamanan Tambahan</label>
                    <select required name="kebutuhan_keamanan_tambahan" id="kebutuhan_keamanan_tambahan" class="form-control">
                      <option {{($pajak->kebutuhan_keamanan_tambahan == '5')?'selected':''}} value="5">Sangat Tinggi</option>
                      <option {{($pajak->kebutuhan_keamanan_tambahan == '4')?'selected':''}} value="4">Tinggi</option>
                      <option {{($pajak->kebutuhan_keamanan_tambahan == '3')?'selected':''}} value="3">Sedang</option>
                      <option {{($pajak->kebutuhan_keamanan_tambahan == '2')?'selected':''}} value="2">Rendah</option>
                      <option {{($pajak->kebutuhan_keamanan_tambahan == '1')?'selected':''}} value="1">Sangat Rendah</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="potensi_kecelakaan">Potensi Terjadi KERUGIAN / Korban Jiwa</label>
                    <select required name="potensi_kecelakaan" id="potensi_kecelakaan" class="form-control">
                      <option {{($pajak->potensi_kecelakaan == '5')?'selected':''}} value="5">Sangat Tinggi</option>
                      <option {{($pajak->potensi_kecelakaan == '4')?'selected':''}} value="4">Tinggi</option>
                      <option {{($pajak->potensi_kecelakaan == '3')?'selected':''}} value="3">Sedang</option>
                      <option {{($pajak->potensi_kecelakaan == '2')?'selected':''}} value="2">Rendah</option>
                      <option {{($pajak->potensi_kecelakaan == '1')?'selected':''}} value="1">Sangat Rendah</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="kebutuhan_tenaga_medis_darurat">Kebutuhan Tenaga Medis Darurat</label>
                    <select required name="kebutuhan_tenaga_medis_darurat" id="kebutuhan_tenaga_medis_darurat" class="form-control">
                      <option {{($pajak->kebutuhan_tenaga_medis_darurat == '5')?'selected':''}} value="5">Sangat Tinggi</option>
                      <option {{($pajak->kebutuhan_tenaga_medis_darurat == '4')?'selected':''}} value="4">Tinggi</option>
                      <option {{($pajak->kebutuhan_tenaga_medis_darurat == '3')?'selected':''}} value="3">Sedang</option>
                      <option {{($pajak->kebutuhan_tenaga_medis_darurat == '2')?'selected':''}} value="2">Rendah</option>
                      <option {{($pajak->kebutuhan_tenaga_medis_darurat == '1')?'selected':''}} value="1">Sangat Rendah</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">TARIF</label>
                    <input value="{{$pajak->tarif}}" required type="number" min="1" name="tarif" class="form-control"  placeholder="Masukkan Tarif">
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            


  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
