<?php 
include_once "config.php";

function konekdb($pg_conn_string){
	//Konek ke db broiler di Postgre
	$db_broiler = pg_connect($pg_conn_string);
	return $db_broiler;
}

function klosdb($db_broiler){
	//tutup koneksi ke db broiler  di Postgre
	pg_close($db_broiler);
}

function run_kueri($pg_conn_string, $kueri){
	$db_broiler=konekdb($pg_conn_string);
	/* echo "Kueri: ".$kueri."<br/>"; */
	$result = pg_query($db_broiler, $kueri);
	$hasil=array();
	if (!$result){ 	  
		klosdb($db_broiler);
		return null;
	}else{
		while ($row = pg_fetch_row($result))
			array_push($hasil, $row);
	}  
	klosdb($db_broiler);
	return $hasil[0];
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   $lat = $_POST['lat']; 
   $lng = $_POST['lng']; 
 
}

        
	//isi tabel tmp_latlon
	$isi_tbl="INSERT INTO tmp_latlon(lon, lat) VALUES($lng, $lat)";
    $kueri= $isi_tbl;
	$output_isi = run_kueri($pg_conn_string, $kueri);
	
	//buat geom
	$buat_tbl="UPDATE tmp_latlon SET geom = ST_SetSRID(ST_MakePoint($lng,$lat),4326);";
    $kueri= $buat_tbl;
	$output_buat = run_kueri($pg_conn_string, $kueri);
?> 