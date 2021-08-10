<html>
<head>
	<title>Laporan Data Pajak</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Data Pajak</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
        <th class="font-weight-bold">No Wajib Pajak</th>
        <th class="font-weight-bold">Tanggal Transaksi</th>   
        <th class="font-weight-bold">ALAMAT PAJAK</th>
        <th class="font-weight-bold">KECAMATAN</th>
        <th class="font-weight-bold">NAMA PENANGGUNG JAWAB</th>
        <th class="font-weight-bold">NO. TELEPON</th>
        <th class="font-weight-bold">TARIF</th>
			</tr>
		</thead>
		<tbody>
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

</body>
</html>