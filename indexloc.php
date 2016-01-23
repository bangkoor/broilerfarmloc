<html>
<head>
<title>Broiler FarmLoc</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/slider-selector.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<body>
<div class="bannerloc">
<?php
include_once "config.php";
include_once "db.php";

echo "$warningDB";

if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			
			$lat = $_POST['lat']; 
			$lng = $_POST['lng'];
			$periksagps = $_POST['periksagps'];
		}

if($lat == '' && $lng == ''){
		$peringatan= "Data belum diisi!";
	}
	else{
		//cek kesesuaian
		$cek_suai="SELECT b.nama_desa, b.luas, a.kesesuaian FROM kesesuaian AS a, desa AS b WHERE(ST_Within(ST_SetSRID(ST_MakePoint($lng,$lat),4326), a.geom)) AND a.id_desa=b.id_desa";
		$kueri= $cek_suai;
		$output_suai = run_kueri($pg_conn_string, $kueri);
		$suai=$output_suai;
		
		$kesesuaian = $suai[2];
		
		//hitung
		$hitung_suai="SELECT COUNT(*) FROM kesesuaian AS a, desa AS b WHERE(ST_Within(ST_SetSRID(ST_MakePoint($lng,$lat),4326), a.geom)) AND a.id_desa=b.id_desa";
		$kueri= $hitung_suai;
		$output_suai = run_kueri($pg_conn_string, $kueri);
		$jlhsuai=$output_suai;
		
		$jlhbaris = $jlhsuai[0];
		
		//cek pemukiman
		$cek_mukim="SELECT gid FROM pemukiman WHERE(ST_Within(ST_SetSRID(ST_MakePoint($lng,$lat),4326), geom))";
		$kueri= $cek_mukim;
		$output_mukim = run_kueri($pg_conn_string, $kueri);
		$mukim=$output_mukim;
		if($mukim[0] == 1) {
			$periksa_mukim="<li style='text-align:left;'>Lokasi berada di area pemukiman atau zona aktivitas manusia</li>";
		} ELSE { 
		$cek_mukim2="SELECT ST_distance(ST_SetSRID(ST_MakePoint($lng,$lat),4326)::geography, geom) AS jarak FROM pemukiman";
		$kueri= $cek_mukim2;
		$output_mukim2 = run_kueri($pg_conn_string, $kueri);
		$mukim2=$output_mukim2;
		if($mukim2[0] < 100) {
			$periksa_mukim="<li style='text-align:left;'>Lokasi terlalu dekat dengan pemukiman<br />(jarak ke pemukiman terdekat = ".round($mukim2[0])." m).<br /> <strong>Rekomendasi: jarak > 100 m</strong></li>";
		} ELSE {
			$periksa_mukim=NULL;
		}
		}
		
		//cek perairan
		$cek_air="SELECT gid FROM perairan WHERE(ST_Within(ST_SetSRID(ST_MakePoint($lng,$lat),4326), geom))";
		$kueri= $cek_air;
		$output_air = run_kueri($pg_conn_string, $kueri);
		$air=$output_air;
		if($air[0]==1){
			$periksa_air="<li style='text-align:left;'>Lokasi terlalu dekat dengan sungai atau tubuh air<br />(jarak ke sungai/danau < 100 m).<br /><strong>Rekomendasi: jarak > 100 m</strong></li>";
		} ELSE {
			$periksa_air=NULL;
		}
		
		//cek jalan
		$cek_jln="SELECT gridcode FROM jalan WHERE(ST_Within(ST_SetSRID(ST_MakePoint($lng,$lat),4326), geom))";
		$kueri= $cek_jln;
		$output_jln = run_kueri($pg_conn_string, $kueri);
		$jln=$output_jln;
		if($jln[0]==1){
			$periksa_jln="<li style='text-align:left;'>Lokasi terlalu jauh dari akses jalan<br />(jarak ke akses jalan > 250 m).<br /><strong>Rekomendasi: jarak < 250 m</strong></li>";
		} ELSE {
			$periksa_jln=NULL;
		}
		
		//cek listrik
		/* $cek_listrik="SELECT gridcode FROM listrik WHERE(ST_Within(ST_SetSRID(ST_MakePoint($lng,$lat),4326), geom))";
		$kueri= $cek_listrik;
		$output_listrik = run_kueri($pg_conn_string, $kueri);
		$listrik=$output_listrik;
		if($listrik[0]==1){
			$periksa_listrik="<li style='text-align:left;'>Lokasi terlalu jauh dari jaringan listrik<br />(jarak ke jaringan listrik > 200 m).<br /><strong>Rekomendasi: jarak < 200 m</strong></li>";
		} ELSE {
			$periksa_listrik=NULL;
		} */
		
		//cek bencana
		$cek_bcn="SELECT gridcode FROM bencana WHERE(ST_Within(ST_SetSRID(ST_MakePoint($lng,$lat),4326), geom))";
		$kueri= $cek_bcn;
		$output_bcn = run_kueri($pg_conn_string, $kueri);
		$bcn=$output_bcn;
		if($bcn[0]==2){
			$periksa_bcn="<li style='text-align:left;'>Lokasi berada pada daerah rawan bencana</li>";
		} ELSE {
			$periksa_bcn=NULL;
		}
		
		if($jlhbaris == 0){
			echo "<h4>Data tidak tersedia!</h4>";
			echo "<strong>Lokasi anda di luar Parung?<br />Silakan klik tombol isi manual dengan form</strong>";
		}
			else{
			echo			"<table class='table table-striped table-hover'>";
			echo			"<thead>";
			echo			"<tr>";
			echo			"<th>Desa</th>";
			echo			"<th>Luas desa</th>";
			echo			"<th>Kesesuaian lokasi</th>";
			echo			"</tr>";
			echo			"</thead>";
			echo			"<tbody>";
			echo			"<tr>";
			echo			"<td><font style='text-transform:capitalize'>$suai[0]</font></td>";
			echo			"<td>$suai[1] ha</td>";
			if($kesesuaian=='sangat tidak sesuai' OR $kesesuaian=='tidak sesuai'){
			echo			"<td style='vertical-align: middle;'><span class='label label-danger' style='text-transform:uppercase'>$kesesuaian</span></td>";
			} else if($kesesuaian=='agak sesuai'){
			echo 			"<td style='vertical-align: middle;'><span class='label label-warning' style='text-transform:uppercase'>$kesesuaian</span></td>";
			} else{
			echo 			"<td style='vertical-align: middle;'><span class='label label-success' style='text-transform:uppercase'>$kesesuaian</span></td>";
			}
			echo			"</tbody>";
			echo			"</table>";
			if($kesesuaian=='sangat tidak sesuai' OR $kesesuaian=='tidak sesuai'){
			echo 	"<div class='well-alasan well-sm'><p align='left'><strong>Kemungkinan penyebab ketidaksesuaian lokasi:</strong><br />";
			echo	"<ul>";
			echo	"$periksa_mukim";
			echo	"$periksa_air";
			echo	"$periksa_jln";
			/* echo	"$periksa_listrik"; */
			echo	"$periksa_bcn";
			echo	"</ul>";
			echo	"</p></div>";
			} else { echo " "; }
			}
		}
		echo "<h4>$peringatan</h4>";
		if($periksagps=='pakegps'){
				echo "<div align='center'><i>Perhatian: Hasil deteksi lokasi dengan GPS mungkin saja tidak akurat. Akurasi lokasi sangat tergantung pada perangkat smartphone anda</i></div>";
			}
?>
</div>
</body>
</html>