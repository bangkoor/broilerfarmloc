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

echo "$warningDB";

if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			
			$sett 	= $_POST['groupSett'];
			$river 	= $_POST['groupRiv'];
			$jln 	= $_POST['groupJln'];
			$elec 	= $_POST['groupElec'];
			$ptg 	= $_POST['groupPtg'];
			$bjr 	= $_POST['groupBjr'];
			$lsr 	= $_POST['groupLsr'];
			$gmp 	= $_POST['groupGmp'];
			$bkr 	= $_POST['groupBkr'];
			$slope 	= $_POST['groupSlope'];
			$lus 	= $_POST['groupLus'];
			$id_p	= $_POST['propinsi'];
			$kabkot = $_POST['kota'];
		}
	if(isset($_POST['submitAnalisis'])){
	// jika tombol ditekan
	if($sett == '' OR $river == '' OR $jln == '' OR $elec == '' OR $ptg == '' OR $bjr == '' OR $lsr == '' OR $gmp == '' OR $bkr == '' OR $slope == '' OR $lus == '' OR $id_p == '00' OR $kabkot ==''){
		$peringatan= "Data belum lengkap!";
	}
	else{
		//deklarasi source xml BMKG
		$urlA = "http://data.bmkg.go.id/propinsi_";
		$urlB = $id_p;
		$urlC = "_1.xml";
		$urlGab = "$urlA$urlB$urlC";
		$sUrl = file_get_contents($urlGab, False);
		$xml = simplexml_load_string($sUrl);
		
		if($lus == 1){
			$hasilAnalisis = "sangat tidak sesuai";
		} ELSE {
		//hitung EKO
		$eko = ($sett*0.75)+($river*0.25);
		//hitung EKI
		$eki = ($jln*0.27)+($elec*0.73);
		//hitung BCN
		$bcn = ($ptg*0.12)+($bjr*0.35)+($lsr*0.21)+($gmp*0.19)+($bkr*0.13);
		//hitung KAL
		for ($i=0; $i<sizeof($xml->Isi->Row); $i++) {
			$row = $xml->Isi->Row[$i];
			if($row->Kota == $kabkot) {
				$tempMin = $row->SuhuMin;
				$tempMax = $row->SuhuMax;
				$humMin = $row->KelembapanMin;
				$humMax = $row->KelembapanMax;
			}
			}
		//rata-rata
		$tempR = ($tempMin+$tempMax)/2;
		$humR = ($humMin+$humMax)/2;
		//tentukan skor temp
		if($tempR > 30){
			$temp = 1;
		} ELSE if($tempR >= 25 AND $tempR <= 30){
			$temp = 3;
		} ELSE 
		$temp = 5;
		
		//tentukan skor humi
		if($humR > 80){
			$humi = 1;
		} ELSE if($humR >= 70 AND $humR <= 80){
			$humi = 3;
		} ELSE 
		$humi = 5;

		$kal = ($slope*0.1)+($lus*0.33)+($temp*0.32)+($humi*0.25);
		
		//hitung semua
		$all = $eko*0.34 + $eki*0.14 + $bcn*0.12 + $kal*0.40;
		
		if($all >= 1 AND $all < 2){
			$hasilAnalisis = "sangat tidak sesuai";
		} ELSE if($all >= 2 AND $all < 3){
			$hasilAnalisis = "tidak sesuai";
			} ELSE if($all >= 3 AND $all < 4){
				$hasilAnalisis = "agak sesuai";
			} ELSE if($all >= 4 AND $all < 5){
				$hasilAnalisis = "sesuai";
			} ELSE $hasilAnalisis = "sangat sesuai";
		}
		echo "<br />";
		echo "<div align='center'>";
		echo "<h4>Lokasi anda:</h4>";
		if($hasilAnalisis=='sangat tidak sesuai' OR $hasilAnalisis=='tidak sesuai'){
		echo "<span class='label label-danger' style='font-size:20px;text-transform:uppercase'>$hasilAnalisis</span>";
		} else if($hasilAnalisis=='agak sesuai'){
		echo "<span class='label label-warning' style='font-size:20px;text-transform:uppercase'>$hasilAnalisis</span>";
		} else{
		echo "<span class='label label-success' style='font-size:20px;text-transform:uppercase'>$hasilAnalisis</span>";
		}
		echo "<br /><br />";
		echo "Tingkat kesesuaian:<br />";
		$persen = ($all/5)*100;
		echo "<h4>".round($persen)."%</h4>";
		echo "<table width='100%'><tr>";
		echo "<td width='15%' align='right' style='padding:2px;vertical-align:top'><span class='label label-danger'>0%</span></td><td width='70%'style='padding:5px;vertical-align:middle'>";
		echo "<div class='progress progress-striped active'>";
		echo "<div class='progress-bar' style='width: $persen%'></div>";
		echo "</div>";
		echo "</td><td width='15%' style='padding:2px;vertical-align:top'><span class='label label-success' style='padding:5px;'>100%</span></td></tr></table>";
		for ($i=0; $i<sizeof($xml->Isi->Row); $i++) {
			$row = $xml->Isi->Row[$i];
			if($row->Kota == $kabkot) {
				echo "Cuaca hari ini di <b>" . strtoupper($row->Kota) . "</b><br/>";
				echo "<img src='http://www.bmkg.go.id/ImagesStatus/" . $row->Cuaca . ".gif' alt='" . $row->Cuaca . "'><br/>";
			echo "Cuaca : " . $row->Cuaca . "<br/>";
				echo "Suhu : " . $row->SuhuMin . " - ".$row->SuhuMax . " &deg;C<br/>";
				echo "Kelembapan : " . $row->KelembapanMin . " - " . $row->KelembapanMax . " %<br/>";
			echo "Kecepatan Angin : " . $row->KecepatanAngin . " (km/jam)<br/>";
			echo "Arah Angin : " . $row->ArahAngin . "<br/>";
				break;
			}
		}
		echo "<br /><p><i>Sumber: BMKG</i></p>";
		echo "</div>";
		}
		echo "<h4 style='font-color:red;'>$peringatan</h3>";
		}
?>
</div>
</body>
</html>