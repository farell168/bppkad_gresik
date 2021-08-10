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
  <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
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
          <li class="nav-item has-treeview">
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
          <li class="nav-item has-treeview    menu-open">
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
            <h1 class="m-0 text-dark">  Cetak Laporan</h1>
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
        <div class="container-fluid">
        <div class="row">
        <div class="col-12">
           <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Silahkan Pilih Jenis Laporan Yang Akan diunduh
            </div>
            <a href="{{ route('laporan_pajak') }}" class="btn btn-primary">Laporan Data Pajak</a>
            <a href="{{ route('laporan_kmeans_pajak') }}" button type="button" class="btn btn-info">Laporan Pajak Setelah Perhitungan</a>
           </div>
        </div>
    </div>
<?php
// dd($pajak);
?>
    @if(isset($pajak))
    <hr>
    <div class="container-fluid">
        <div class="row">
          <div class="col-8">
            <h3>Preview Laporan Data Pajak</h3>
          </div>
          <div class="col-4">
            <button onclick="generatePdf()" class="btn btn-primary btn-block mt-2">Download as PDF</button>
          </div>
        <div class="col-md-12 mt-4" id="laporan">
        <center>
          <h5>Laporan Data Pajak</h4>
        </center>

        <page_header>
        <table class='table table-bordered' id="tabel">

        <thead style="display:table-header-group;">
            <tr id="idTablaDatos">
              <td class="font-weight-bold">No Wajib Pajak</td>
              <td class="font-weight-bold">Tanggal Transaksi</td>   
              <td class="font-weight-bold">ALAMAT PAJAK</td>
              <td class="font-weight-bold">KECAMATAN</td>
              <td class="font-weight-bold">NAMA PENANGGUNG JAWAB</td>
              <td class="font-weight-bold">NO. TELEPON</td>
              <td class="font-weight-bold">TARIF</td>
            </tr>
  </thead>
          <tbody id="byPassMe">
          @foreach($pajak as $p)
            <tr>
              <td>{{$p->no_pajak}}</td>
              <td>{{$p->tanggal_bayar}}</td>
              <td>{{$p->alamat_pajak}}</td>                        
              <td>{{$p->kecamatan}}</td>
              <td>{{$p->nama_pemilik}}</td>        
              <td>{{$p->no_tlpn}}</td>
              <td>{{$p->tarif}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
           </div>
        </div>
    </div>
    @endif

    @if(isset($cluster))
    <hr>
    <div class="container-fluid">
        <div class="row">
          <div class="col-8">
            <h3>Preview Laporan K-Means Pajak</h3>
          </div>
          <div class="col-4">
            <button onclick="generatePdf()" class="btn btn-primary btn-block mt-2">Download as PDF</button>
          </div>
        <div class="col-md-12 mt-4" id="laporan">
        <center>
          <h5>Laporan Data K-Means Pajak</h4>
        </center>

        <page_header>
        <table class='table table-bordered' id="tabel">

        <thead style="display:table-header-group;">
            <tr id="idTablaDatos">
              <th class="font-weight-bold">No Wajib Pajak</th>
              <th class="font-weight-bold">CLUSTER</th>   
              <th class="font-weight-bold">KETERANGAN</th>
            </tr>
  </thead>
          <tbody id="byPassMe">
          @foreach($cluster as $p)
      <tr>
        <td>{{$p->pajak->no_pajak}}</td>
        <td>{{$p->cluster}}</td>
        <td>{{$p->keterangan}}</td>
      </tr>
    @endforeach
          </tbody>
        </table>
           </div>
        </div>
    </div>
    @endif

       


    


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
<script>
      function generatePdf() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("laporan");
        var opt = {
          margin:       0.5,
          filename:     'myfile.pdf',
          html2canvas:  { scale: 4 },
          jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
        };
        // Choose the element and save the PDF for our user.
        html2pdf(element, opt);
      }
    </script>
</body>
</html>
