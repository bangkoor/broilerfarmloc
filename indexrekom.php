<html>
<head>
<title>Broiler FarmLoc</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<body>
<div align="center" class="col-sm-12">
<?php
include_once "config.php";
include_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$kapasitas = $_POST['kapasitas'];
			$luasan = $kapasitas/40000;
		}

if($kapasitas == ''){
		$peringatan= "Data belum diisi!";
	}
	else{
		
		$jlh_row="SELECT count(*) FROM kesesuaian AS p, desa AS d WHERE skor>=3 AND p.luas >'$luasan' AND p.id_desa=d.id_desa LIMIT 3";
		$kueri=$jlh_row;
		$jlhrow=run_kueri($pg_conn_string, $kueri);
		
		if($jlhrow[0]>3){
			$jlhbaris=3;
		}
		else{
			$jlhbaris=$jlhrow[0];
		}
		
		$slc_kode="SELECT d.nama_desa, p.kesesuaian, p.luas FROM kesesuaian AS p, desa AS d WHERE skor>3 AND p.luas >'$luasan' AND p.id_desa=d.id_desa ORDER BY p.luas LIMIT 5";
		$kueri=$slc_kode;
		$conn=pg_pconnect($pg_conn_string);
		$hasil=pg_query($conn, $kueri);
		
		$hasilrekom= pg_fetch_all($hasil);
		
		echo			"<p style='font-size:16;'>Rekomendasi lokasi untuk farm berkapasitas &ge; $kapasitas ekor</p>";
		echo			"<table class='table table-striped table-hover'>";
		echo			"<thead>";
		echo			"<tr>";
		echo			"<th>No</th>";
		echo			"<th>Nama Desa</th>";
		echo			"<th>Kesesuaian</th>";
		echo			"<th>Luas sesuai (ha)</th>";
		echo			"</tr>";
		echo			"</thead>";
		echo			"<tbody>";
		
		for ($row = 0; $row < $jlhbaris; $row++)
		{
			$rows=$row+1;
			if($rows==1){
			echo		"<tr class='info'>";
			}else{
			echo		"<tr>";
			}
			echo		"<td>$rows</td>";
			foreach($hasilrekom[$row] as $key => $value)
				{
					echo 		"<td>".$value."</td>";
				}
			echo		"</tr>";
		}
		echo			"</tbody>";
		echo			"</table>";
		echo 			"<div align='center'><i>Catatan: Perhitungan berdasarkan asumsi 1 ha lahan untuk kapasitas 40,000 ekor</i></div>";
		}
	echo "<h4>$peringatan</h4>";
?>
</div>
</body>
</html>