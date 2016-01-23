<?php
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
?>