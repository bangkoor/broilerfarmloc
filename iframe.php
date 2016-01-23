<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   $satu = $_POST['satu']; 
   $dua = $_POST['dua']; 
}

	$hasil = $satu + $dua;
	echo "$hasil";

?>