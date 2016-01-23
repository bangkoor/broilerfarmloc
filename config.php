<?

//Koneksi ke Postgre
$db_host="localhost";
$db_port="5433";
$db_name="broiler_farmloc";
$db_user="postgres";
$db_password="p4tri0t45";
$pg_conn_string="host=".$db_host." port=".$db_port." dbname=".$db_name." user=".$db_user." password=".$db_password;

if(!$pg_conn_string){
	$warningDB = "Koneksi database gagal";
} ELSE {
	$warningDB = NULL;
}

//path bin Postgis
$PostGIS_BIN="C:/Program Files/PostgreSQL/9.1/bin";



?>
