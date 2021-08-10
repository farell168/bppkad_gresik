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
          <li class="nav-item">
            <a href="{{ route('daftaruser') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Data User
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview  menu-open">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Pajak</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>  -->
          </div><!-- /.col -->
        </div><!-- .row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- --> 
    <!-- /.content-header -->



    <!-- Main content -->
        <!-- Main content -->
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('view_add_pajak') }}" class="btn btn-primary">Tambah Data Pajak</a>
                <!-- <a href="" button type="buttons" class="btn btn-success">Import Exel</a> -->
                <!-- <form action="{{ route('import_pajak') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="file">Pilih File Excel</label>
                <input type="file" class="form-control" id="file" name="file">
                <button type="submit" class="btn btn-outline-info">Import</button>
                </form> -->
              </div>
              <!-- /.card-header -->
              <div class="row mx-auto" style="width:95%">
                 <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tableDatatable">
                        <thead>
                        <tr>
                    <th>No Wajib Pajak</th>
                    <th>Tanggal Transaksi</th>   
                    <th>ALAMAT PAJAK</th>
                    <th>KECAMATAN</th>
                    <th>NAMA PENANGGUNG JAWAB</th>
                    <!-- <th>ALAMAT PENANGGUNG JAWAB</th>
                    <th>NO. TELEPON</th> -->
                    <th>LUAS LAHAN</th>
                    <th>DAYA TAMPUNG</th>
                    <th>JUMLAH PEMbANGKIT</th>
                    <th>KAPASITAS PEMAKAIAN</th>
                    <th>SUMBER DAYA</th>
                    <th>JUMLAH KAMAR</th>
                    <th>JUMLAH MEJA</th>
                    <th>JUMLAH SARANA LAYANAN</th>
                    <th>JUMLAH LANTAI</th>
                    <th>KEBUTUHAN keamanan TAMBAHAN</th>
                    <th>POTENSI KERUGIAN / TERJADI KORBAN</th>
                    <th>KEBUTUHAN TENAGA MEDIS DARURAT</th>
                    <th>TARIF</th>
                    <th>TERAKHIR DIUPDATE</th>
                    <th width="10%" scope="col" colspan="2" >Option</th>
                  </tr>
                    @foreach($pajak as $p)
                      <tr>
                        <td>{{$p->no_pajak}}</td>
                        <td>{{$p->tanggal_bayar}}</td>
                        <td>{{$p->alamat_pajak}}</td>                        
                        <td>{{$p->kecamatan}}</td>
                        <td>{{$p->nama_pemilik}}</td>
                        <!-- <td>{{$p->alamat_pemilik}}</td>
                        <td>{{$p->no_tlpn}}</td> -->
                        <td>{{$p->luas_lahan*1000}}</td>
                        <td>{{$p->daya_tampung*100}}</td>
                        <td>{{$p->jumlah_pembangkit}}</td>
                        <td>{{$p->kapasitas_pemakaian*1000}}</td>
                        <td>{{(($p->sumber_daya == 1) ? 'Tidak Ada' : ($p->sumber_daya == 2)) ? 'PLN' : 'Bantuan Swasta'}}</td>
                        <td>{{$p->jumlah_kamar}}</td>
                        <td>{{$p->jumlah_meja}}</td>
                        <td>{{$p->jumlah_sarana_layanan}}</td>
                        <td>{{$p->jumlah_lantai}}</td>
                        <td>
                          @php
                          if($p->kebutuhan_keamanan_tambahan == 5) echo 'Sangat Tinggi'; 
                          elseif($p->kebutuhan_keamanan_tambahan == 4) echo 'Tinggi';
                          elseif($p->kebutuhan_keamanan_tambahan == 3) echo 'Sedang';
                          elseif($p->kebutuhan_keamanan_tambahan == 2) echo 'Rendah';
                          else echo 'Sangat Rendah';
                          @endphp
                        </td>
                        <td>
                          @php
                          if($p->potensi_kecelakaan == 5) echo 'Sangat Tinggi'; 
                          elseif($p->potensi_kecelakaan == 4) echo 'Tinggi';
                          elseif($p->potensi_kecelakaan == 3) echo 'Sedang';
                          elseif($p->potensi_kecelakaan == 2) echo 'Rendah';
                          else echo 'Sangat Rendah';
                          @endphp
                        </td>
                        <td>
                          @php
                          if($p->kebutuhan_tenaga_medis_darurat == 5) echo 'Sangat Tinggi'; 
                          elseif($p->kebutuhan_tenaga_medis_darurat == 4) echo 'Tinggi';
                          elseif($p->kebutuhan_tenaga_medis_darurat == 3) echo 'Sedang';
                          elseif($p->kebutuhan_tenaga_medis_darurat == 2) echo 'Rendah';
                          else echo 'Sangat Rendah';
                          @endphp
                        </td>
                        <td>{{$p->tarif}}</td>
                        <td>{{date_format(date_create($p->updated_at), 'd F Y, h:i:s')}}</td>
                        <td>
                            <a href="{{ route('view_edit_pajak',$p->id) }}" class="btn btn-outline-primary bentuk edit"><i class='far fa-edit'></i></a>
                        </td>
                        <td>
                            <a href="{{ route('delete_pajak',$p->id) }}" class="btn btn-outline-danger bentuk"><i class='fas fa-eraser'></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>
                  <div class="d-flex mt-4 flex-wrap">
                    <nav class="ml-auto">
                    {!! ($numRecords > 0) ? $pajak->links() : '' !!}
                    </nav>
                  </div>
              </div>
        </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


    


  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
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
</body>
</html>
