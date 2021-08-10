<html>
<head>
	<title>Laporan Data K-Means Pajak</title>
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
		<h5>Laporan Data K-Means Pajak</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
        <th class="font-weight-bold">No Wajib Pajak</th>
        <th class="font-weight-bold">CLUSTER</th>   
        <th class="font-weight-bold">KETERANGAN</th>
			</tr>
		</thead>
		<tbody>
    @foreach($cluster as $p)
      <tr>
        <td>{{$p->pajak->no_pajak}}</td>
        <td>{{$p->cluster}}</td>
        <td>{{$p->keterangan}}</td>
      </tr>
    @endforeach
		</tbody>
	</table>

</body>
</html>