<?php
include "config.php";
include "db.php";
$propinsi = $_GET['id_prov'];
$kueri="SELECT nama_kabkot FROM kabkot WHERE id_prov='".$propinsi."'";
$conn=pg_pconnect($pg_conn_string);
$hasil_kabkot=pg_query($conn, $kueri);
$count=0;
$numrows=pg_num_rows($hasil_kabkot);
while($count < $numrows){
$p=pg_fetch_object($hasil_kabkot,$count);
foreach($p as $nama){
	echo "<option value='$nama'>$nama</option>";
}
$count++;
}
?>
