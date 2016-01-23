<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<?php
include "config.php";
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	$search = $_GET['search'];
	$latgps = $_GET['latinput'];
	$longps	= $_GET['loninput'];
}

if(isset($_GET['submitCari'])){
// jika tombol ditekan
if($search=='')
{
	$lat=-6.45644099494572;
	$lon=106.7141454702844;
}
else{
	$lat_search="SELECT ST_Y(geom) FROM desa_central WHERE id_desa=(SELECT id_desa FROM desa WHERE nama_desa LIKE '%$search')";
	$kueri=$lat_search;
	$lat=run_kueri($pg_conn_string, $kueri);
	$latpeta = $lat[0];

	$lon_search="SELECT ST_X(geom) FROM desa_central WHERE id_desa=(SELECT id_desa FROM desa WHERE nama_desa LIKE '%$search')";
	$kueri=$lon_search;
	$lon=run_kueri($pg_conn_string, $kueri);
	$lonpeta=$lon[0];
}
}

if(isset($_GET['submitgps'])){
	$latpeta = $latgps;
	$lonpeta = $longps;
}
?>
<html>
<head>
<title>Broiler FarmLoc</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/slider-selector.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/ol.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Dream Elite Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/ol.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
<script type="text/javascript"> 
       function hideLoading() { 
            document.getElementById('divLoading').style.display = "none"; 
			document.getElementById('divLoading2').style.display = "none";
			document.getElementById('divLoading3').style.display = "none"; 			
            document.getElementById('divFrameHolder').style.display = "block"; 
			document.getElementById('divFrameHolder2').style.display = "block";
			document.getElementById('divFrameHolder3').style.display = "block"; 
        }
		function showLoading() {
			document.getElementById('divLoading').style.display = "block"; 
			document.getElementById('divLoading2').style.display = "block";
			document.getElementById('divLoading3').style.display = "block";
			 document.getElementById('divFrameHolder').style.display = "none";
			 document.getElementById('divFrameHolder2').style.display = "none"; 
			 document.getElementById('divFrameHolder3').style.display = "none"; 
		}
    </script> 
<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("anls");
	var text = document.getElementById("tombol");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "<span style='color:white;'class='glyphicon glyphicon-chevron-down' aria-hidden='true'></span> Tampilkan form";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "<span style='color:white;'class='glyphicon glyphicon-chevron-up' aria-hidden='true'></span> Tutup form";
	}
}
$( "tombol" ).click(function() {
  $( "anls" ).slideUp( "slow", function() {
    // Animation complete.
  });
}); 
</script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi").change(function(){
    var id_prov = $("#propinsi").val();
    $.ajax({
        url: "ambilkota.php",
        data: "id_prov="+id_prov,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
});

</script>
<script type="text/javascript" src="js/move-top.js"></script>
       <script type="text/javascript" src="js/easing.js"></script>
	   <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Populasi Ternak Ayam Ras Broiler Tahun 2014'
        },
        subtitle: {
            text: 'Sumber: Dinas Peternakan dan Perikanan'
        },
        xAxis: {
            categories: [
                'Parung',
                'Gunung Sindur',
                'Pamijahan',
                'Parungpanjang',
                'Cariu',
                'Tajurhalang',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Populasi (ekor)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">Populasi: </td>' +
                '<td style="padding:0"><b>{point.y:0f} ekor</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            <!-- name: 'Tokyo', -->
            data: [1045903, 2827416, 3609081, 1528653, 1009083, 1028674]

        }]
    });
});
		</script>
		<script type="text/javascript">
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#luas').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Luas Wilayah Tiap Desa<br />(dalam ha)'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y:.1f} ha</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Luas',
                data: [
                    ['Iwul',   478.97],
                    ['Jabon Mekar',  304.09],
                    {
                        name: 'Parung',
                        y: 270.55,
                        sliced: true,
                        selected: true
                    },
                    ['Pamagersari',    201.02],
                    ['Warujaya',     240.18],
                    ['Waru',   366.02],
					['Cogreg',   437.19],
					['Bojong Indah',   138.71],
					['Bojong Sempu',   137.61]
                ]
            }]
        });
    });

});
		</script>
		<script type="text/javascript">
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#luassuai').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Luas Wilayah Sesuai Tiap Desa<br />(dalam ha)'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y:.1f} ha</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Luas',
				<?php
					$jlh_row="SELECT count(*) FROM persenluas AS p, desa AS d WHERE skor>3 AND p.id_desa=d.id_desa";
					$kueri=$jlh_row;
					$jlhrow=run_kueri($pg_conn_string, $kueri);	
					
					$slc_kode="SELECT d.nama_desa, p.luas FROM persenluas AS p, desa AS d WHERE skor>3 AND p.id_desa=d.id_desa ORDER BY p.luas";
					$kueri=$slc_kode;
					$conn=pg_pconnect($pg_conn_string);
					$hasil=pg_query($conn, $kueri);
					
					$hasilrekom= pg_fetch_all($hasil);
				?>
                data: [
                    ['Iwul',   192.09],
                    ['Jabon Mekar',  45.61],
                    ['Pamagersari',    41.89],
                    ['Warujaya',     36.86],
					['Parung', 28.59],
                    ['Waru',   102.91],
					['Cogreg',   116.239],
					['Bojong Indah',   15.74],
					['Bojong Sempu',   28.26]
                ]
            }]
        });
    });

});
		</script>
		<script type="text/javascript">
			window.smoothScroll = function(target) {
			var scrollContainer = target;
			do { //find scroll container
				scrollContainer = scrollContainer.parentNode;
				if (!scrollContainer) return;
				scrollContainer.scrollTop += 1;
			} while (scrollContainer.scrollTop == 0);
			
			var targetY = 0;
			do { //find the top of target relatively to the container
				if (target == scrollContainer) break;
				targetY += target.offsetTop;
			} while (target = target.offsetParent);
			
			scroll = function(c, a, b, i) {
				i++; if (i > 30) return;
				c.scrollTop = a + (b - a) / 30 * i;
				setTimeout(function(){ scroll(c, a, b, i); }, 20);
			}
			// start scrolling
			scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
		}
		</script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
		<script type="text/javascript">
		$(document).ready(function() {
				/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
				*/
		$().UItoTop({ easingType: 'easeOutQuart' });
});
</script>
<!--<script src="http://malsup.github.com/jquery.form.js"></script> 
    <script> 
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
            $('#kirimLatlon').ajaxForm(function() { 
                alert("Lokasi berhasil dikirim!"); 
            }); 
        }); 
    </script> -->
</head>
<body onload="initialize()">
<!-- header -->
 <div class="banner">
		<div class="header">
		<div class="container">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" class="img-responsive" alt="" /></a>
			</div>
				<div class="hader-left">
				<h1><a href="index.php">Broiler FarmLoc Master</a></h1>
				<h6><a href="index.php">v1.0</a></h6>
				</div>
				<div class="head-nav">
					<span class="menu"> </span>
						<ul class="cl-effect-3">
							<li><a href="index.php">Beranda</a></li>
							<li><a href="about.html">Tentang</a></li>
							<li class="active"><a href="location.php">Analisis</a></li>
							<li><a href="contact.php">Beri Feedback</a></li>
								<div class="clearfix"> </div>
						</ul>
				</div>
			<div class="clearfix"> </div>
						<!-- script-for-nav -->
					<script>
						$( "span.menu" ).click(function() {
						  $( ".head-nav ul" ).slideToggle(300, function() {
							// Animation complete.
						  });
						});
					</script>
				<!-- script-for-nav --> 	
				</div>				
			</div> 
		<div class="container">
				<!-- portfolio -->
	<?php
		if($latpeta==null and $lonpeta==null){
			echo "<div style='margin-top:10px;' class='alert alert-dismissible alert-success'>
				  <button type='button' class='close' data-dismiss='alert'>×</button>
				  <h4>Petunjuk</h4>
				  <p style='color:white;'>Untuk menentukan lokasi, silakan cari lokasi anda berdasarkan nama desa, klik tombol <strong>GO!</strong>, lalu pindahkan marker/penanda (<img src='images/chick-icon.png' width='12' />) sesuai lokasi yang anda inginkan. Lalu klik tombol <strong>Dapatkan informasi</strong>, sistem akan memberikan informasi kesesuaian lokasi berdasarkan data di database. Anda juga dapat menggunakan GPS handphone anda dengan mengklik tombol <br /><strong>DETEKSI LOKASI DENGAN GPS!</strong>, lalu klik <strong>REFRESH</strong></p>
				</div>";
		} else {
			echo "";
		}
	?>
	<form id="searchbox" method="GET" action="location.php">
				<!-- <img src="images/logo-mit.png" width="65" style="padding-left:5px" /> -->
				<!-- <input id="search" name="search" type="text" style="text-transform:lowercase;" placeholder="Cari nama desa/kelurahan"> -->
				<select name="search" id="search" placeholder="Cari nama desa/kelurahan">
					<option value="" selected="selected">Pilih desa di Kec Parung</option>
					<option value="iwul">Iwul</option>
					<option value="jabonmekar">Jabonmekar</option>
					<option value="pamagersari">Pamagersari</option>
					<option value="warujaya">Warujaya</option>
					<option value="parung">Parung</option>
					<option value="waru">Waru</option>
					<option value="cogreg">Cogreg</option>
					<option value="bojongindah">Bojong Indah</option>
					<option value="bojongsempu">Bojong Sempu</option>
				</select>
				<input id="submit" name="submitCari" type="submit" value="GO!">
			</form>
	<div class="well well-sm">
	<table width="100%">
	<tbody>
	<tr>
	<td colspan="3">
	<a class="btn btn-primary btn-lg btn-block" id="ceklok" onclick="showlocation()"><span style="color:white;"class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Deteksi lokasi dengan GPS!</a></td></tr>
	<script type="text/javascript">
	function success(position) {
	  var s = document.querySelector('#status');
	  
	  if (s.className == 'success') {
		// not sure why we're hitting this twice in FF, I think it's to do with a cached result coming back    
		return;
	  }
	  s.innerHTML = "found you!";
	  s.className = 'success';
	  }
	function showlocation() {
	// One-shot position request.
	navigator.geolocation.getCurrentPosition(callback);
	}
	function callback(position) {
	   document.getElementById('latitude').innerHTML = position.coords.latitude;
	   document.getElementById('longitude').innerHTML = position.coords.longitude;
	}
	function error(msg) {
	  var s = document.querySelector('#status');
	  s.innerHTML = typeof msg == 'string' ? msg : "failed";
	  s.className = 'fail';
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(success, error);
	} else {
	  error('not supported');
	}

	  // console.log(arguments);
	}
	</script>
	<script>
	$(document).ready(function(){
	$("#submitgps").mouseover(function(){
		var lat = $('#latitude').html();
		var lon = $('#longitude').html();
		$("#latinput").val(lat);
		$("#loninput").val(lon);
		});
	});
	</script>
	<tr><td colspan="3"><span id="status"></span></td></tr>
	<tr><td style="text-align:left;"width="40%">
	<form id="gps" method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
	Latitude: <br/><span style="color:black;text-decoration:bold;" id="latitude" name="latgps"></td>
	<td style="text-align:left;text-decoration:bold;" width="40%">
    Longitude: <br/><span style="color:black;" id="longitude" name="longps"></td>
	<td style="text-align:left;" width="20%">
	<input id="submitgps" type="submit" name="submitgps" value="REFRESH" class="btn btn-info"/></td>
	<input type="hidden" id="latinput" name="latinput" />
	<input type="hidden" id="loninput" name="loninput" />
	</form></tr>
	</tbody></table>
	</div>
	<!--<div align="left" class="well well-sm">
	<p style="margin-left:10px;padding:1px;">Tampilkan layer kesesuaian <input type="checkbox" id="layer_01" onclick="toggleLayers(0);"/>
	Tampilkan batas wilayah <input type="checkbox" id="layer_02" onclick="toggleLayers(1);"/></p>
	</div>-->
     <div id="dvMap" style="width: 85%; height: 463px;margin-top:0px;margin-left: auto; margin-right: auto"></div>
			<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	<?php
		if($latpeta==null and $lonpeta==null){
			$lati = -6.43598;
			$long = 106.71561;
		} else {
			$lati = $latpeta;
			$long = $lonpeta;
		}
	?>
	var lat = "<?php echo $lati; ?>";
	var lon = "<?php echo $long; ?>";
	
	var map;
    var markers = [
        {
            "title": 'Hai! Aku Chika! Pindahkan aku',
            "lat": lat,
            "lng": lon,
            "description": 'Lokasi anda'
        }
		
    ];
    function initialize() 	{
        var mapOptions = {
            center: new google.maps.LatLng("<?php echo $lati; ?>", "<?php echo $long; ?>"),
            zoom: 2,
            mapTypeId: google.maps.MapTypeId.SATELLITE
        };
		var src = 'http://files.bangkoor.com/batas_desa4.kml';
		var flagIcon_front = new google.maps.MarkerImage("images/chick-icon.png");
			flagIcon_front.size = new google.maps.Size(45, 45);
			flagIcon_front.anchor = new google.maps.Point(14, 45);
		var flagIcon_shadow = new google.maps.MarkerImage("http://googlemaps.googlermania.com/img/marker_shadow.png");
			flagIcon_shadow.size = new google.maps.Size(35, 35);
			flagIcon_shadow.anchor = new google.maps.Point(0, 35);
        var infoWindow = new google.maps.InfoWindow();
        var latlngbounds = new google.maps.LatLngBounds();
        var geocoder = geocoder = new google.maps.Geocoder();
		var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
		/* loadKmlLayer(src, map);
		function loadKmlLayer(src, map) {
		  var kmlLayer = new google.maps.KmlLayer(src, {
			suppressInfoWindows: true,
			preserveViewport: true,
			map: map
		  });
		} */
        for (var i = 0; i < markers.length; i++) {
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
				icon: flagIcon_front,
				shadow: flagIcon_shadow,
                map: map,
                title: data.title,
                draggable: true,
                animation: google.maps.Animation.DROP
            });
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent(data.description);
                    infoWindow.open(map, marker);
                });
                google.maps.event.addListener(marker, "dragend", function (e) {
                    /* var lat, lng, address;
                    geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            lat = marker.getPosition().lat();
                            lng = marker.getPosition().lng();
                            address = results[0].formatted_address;
                            <!-- alert("Latitude: " + lat + "\nLongitude: " + lng + "\nAddress: " + address); -->
                        }
                    window.open('latlon.php?lat=' + lat + '&lng=' + lng, '_blank');
					
					}); */
					document.getElementById("latbox").value = this.getPosition().lat();
					document.getElementById("lngbox").value = this.getPosition().lng();
                });
            })(marker, data);
            latlngbounds.extend(marker.position);
        }
        var bounds = new google.maps.LatLngBounds();
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
		var layers=[];
		layers[0] = new  google.maps.KmlLayer('http://files.bangkoor.com/batas_desa4.kml',
		{preserveViewport: false});

		layers[1] = new google.maps.KmlLayer('http://wrf1.geology.um.maine.edu/bipush/kml/plot_5938.kmz',
		{preserveViewport: true});
		for (var i = 0; i < layers.length; i++) {
        layers[i].setMap(null);
      }
  }
	function toggleLayers(i)
	{

	  if(layers[i].getMap()==null) {
		 layers[i].setMap(map);
	  }
	  else {
		 layers[i].setMap(null);
	  }
	  document.getElementById('status').innerHTML += "toggleLayers("+i+") [setMap("+layers[i].getMap()+"] returns status: "+layers[i].getStatus()+"<br>";
	}
</script>
<div align="center" id="latlong">
	<form id="kirimLatlon" method="POST" action="indexloc.php" target="tampilSuai">
    <p>Latitude: <input size="20" type="text" id="latbox" name="lat" value='<?php echo $lati;?>'></p>
    <p>Longitude: <input size="20" type="text" id="lngbox" name="lng" value='<?php echo $long;?>'></p>
	<input type="hidden" name="periksagps" value="<?php
	if($latgps==null and $longps==null){
		echo "nggakpake";
	}else{echo "pakegps";}
	?>"></input>
	<input type="submit" name="submit" class="btn btn-primary" value="DAPATKAN INFORMASI" onclick="showLoading()"/>
	</form>
  </div>
<div class="panel panel-success">
  <div class="panel-heading">
    <h3 style="color:white;" class="panel-title">Informasi</h3>
  </div>
  <div class="panel-body">
	<form id="form1" runat="server"> 
    <div id="divLoading"> 
        <img src="images/chicken2.gif" alt="" width="40%"/> 
    </div>
	<div id="divFrameHolder" style="display:none"> 
	<iframe class="indexloc" name="tampilSuai" src="indexloc.php" scrolling="yes" onload="hideLoading()" ></iframe></div></form><br />
	<button class="btn btn-primary btn-xs" type="button" onclick="smoothScroll(document.getElementById('second'))">Isi manual dengan form</button>
	<ul style="float:center;" class="nav nav-tabs">
	  <li class="active"><a href="#luas-wilayah" data-toggle="tab" aria-expanded="true">Luas per desa</a></li>
	  <li class=""><a href="#luas-suai" data-toggle="tab" aria-expanded="true">Luas sesuai</a></li>
	  <li class=""><a href="#peta-suai" data-toggle="tab" aria-expanded="true">Peta</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade active in" id="luas-wilayah">
		<div id="luas" style="min-width: 260px; height: 400px; max-width: 600px; margin: 0 auto"></div>
		</div>
		<div class="tab-pane fade" id="luas-suai">
		<div id="luassuai" style="min-width: 260px; height: 400px; max-width: 600px; margin: 0 auto"></div>
		</div>
		<div class="tab-pane fade" id="peta-suai">
			<iframe src="peta-suai.html" width="100%" height="500px"></iframe>
		</div>
	</div>
  </div>
</div>
<div class="panel panel-success">
  <div class="panel-heading">
    <h3 style="color:white;" class="panel-title">Rekomendasi Lokasi</h3>
  </div>
  <div class="panel-body">
    <h4>Cari desa sesuai berdasarkan kapasitas farm</h4>
    <div class="form-group">
	<p style="margin:3px;">Saya ingin membangun peternakan broiler, beri saya rekomendasi lokasi berdasarkan:</p>
	<!--<h4 style="margin-bottom:20px;" class="great">Kapasitas produksi (dalam ekor)</h4><br />-->
	<form method="POST" action="indexrekom.php" target="tampilRekom">		
             <table style="border:0;width:100%;">
				<!--<tr>
					<td align="center" valign="middle" style="padding:10px;">
					<img src="images/ayam.png" width="30px" />
					</td>
					<td align="center" valign="bottom"style="padding:10px;">
						<input id="slider3" type="range" min="0" max="50000" step="500" onchange="kapasitas.value=value" /><br />
					</td>
					<td align="center" valign="middle"style="padding:10px;">
					<img src="images/ayam.png" width="50px" />
					</td>
				</tr>-->
				<tr>
					<td colspan="3" align="center" valign="middle">
					Kapasitas: <input type="text" value="" placeholder="misal: 10000" style="text-align:center;font-size:20px;background:#F5F2FC;padding:2px;border: 2px solid;border-radius: 5px;width:25%;float:center;margin-bottom:10px;" name="kapasitas" /> Ekor<br />
					</td>
				</tr>
			 </table>
			 <input type="submit" name="submitRekom" class="btn btn-primary" value="SUBMIT" onclick="showLoading()"/>
            </form>
            <form runat="server"> 
			<div id="divLoading3"> 
				<img src="images/chicken2.gif" alt="" width="40%"/> 
			</div>
			<div id="divFrameHolder3" style="display:none"> 
			<iframe src="indexrekom.php" class="indexrekom" name="tampilRekom" scrolling="yes" onload="hideLoading()" ></iframe>
			</div>
			</form>
	</div>
</div>
</div>
<div class="panel panel-success">
  <div class="panel-heading">
    <h3 style="color:white;" class="panel-title">Statistik Peternakan</h3>
  </div>
  <div class="panel-body">
  <ul style="float:center;" class="nav nav-tabs">
  <li class="active"><a href="#populasi" data-toggle="tab" aria-expanded="true">Populasi</a></li>
  <li class=""><a href="#peternakan" data-toggle="tab" aria-expanded="true">Peternakan Rakyat</a></li>
  <li class=""><a href="#rpu" data-toggle="tab" aria-expanded="true">RPU di Bogor</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="populasi">
	<div id="container" style="min-width: 260px; height: 400px; margin: 0 auto"></div>
  </div>
  <div class="tab-pane fade" id="peternakan">
  <p><strong>Usaha Peternakan Rakyat Perorangan di Kec. Parung</strong><br /><i>*berdasarkan data peternakan 2014, Disnakkan Kab Bogor</i></p>
    <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Lokasi</th>
      <th>Nama Pemilik Perorangan</th>
      <th>Kapasitas Produksi (ekor)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Cogreg</td>
      <td>Hendra Wijaya</td>
      <td>12,000</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Cogreg</td>
      <td>Kwa Lan Moy</td>
      <td>9,000</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Cogreg</td>
      <td>Salim Wijaya</td>
      <td>5,000</td>
    </tr>
    <tr>
      <td>4</td>
      <td>Cogreg</td>
      <td>Kwa Ceng Cwi/Eko</td>
      <td>9,000</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Waru</td>
      <td>Gracia Subyakto</td>
      <td>4,000</td>
    </tr>
  </tbody>
</table> 
  </div>
  <div class="tab-pane fade" id="rpu">
  <p><strong>Rumah Potong Unggas (RPU) swasta di Kab Bogor</strong><br /><i>*berdasarkan data peternakan 2014, Disnakkan Kab Bogor</i></p>
    <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Perusahaan</th>
      <th>Alamat</th>
      <th>Kapasitas Pemotongan / hari</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>PT Sierad Produce, Tbk</td>
      <td>Desa Jabon Mekar, Kec Parung</td>
      <td>80,000</td>
    </tr>
    <tr>
      <td>2</td>
      <td>PT Star Food/ UD Putra Mandiri</td>
      <td>Desa Karang Asem, Kec Citeureup</td>
      <td>20,000</td>
    </tr>
    <tr>
      <td>3</td>
      <td>PT Asia Afrika Poultry</td>
      <td>Desa Pabuaran, Kec Gunung Sindur</td>
      <td>40,000</td>
    </tr>
    <tr>
      <td>4</td>
      <td>PT Ciomas Adi Satwa</td>
      <td>Desa Jampang, Kec Kemang</td>
      <td>20,000</td>
    </tr>
    <tr>
      <td>5</td>
      <td>PT Maseng Satwa</td>
      <td>Desa Claseng, Kec Cijeruk</td>
      <td>10,000</td>
    </tr>
  </tbody>
</table><br />
	<p><strong>Rumah Potong Unggas (RPU) pemerintah di Kab Bogor</strong><br /><i>*berdasarkan data peternakan 2014, Disnakkan Kab Bogor</i></p>
	<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama RPU</th>
      <th>Alamat</th>
      <th>Kapasitas Pemotongan / hari</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>RPU Cibinong</td>
      <td>Kelurahan Cibinong, Kec Cibinong</td>
      <td>6,000</td>
    </tr>
    <tr>
      <td>2</td>
      <td>RPU Ciseeng</td>
      <td>Kec Ciseeng</td>
      <td>1,500</td>
    </tr>
  </tbody>
</table> 
  </div>
</div>
</div>
</div>
<div class="panel panel-success">
	<div class="panel-heading">
		<div id="second">
		<h3 style="color:white;" class="panel-title">Lokasi Anda bukan di Kecamatan Parung?</h3>
		</div>
	</div>
	<div class="panel-body">
	<p>Hitung kesesuaian lokasi Anda dengan mengisi form berikut:</p>
	<a id="tombol" class="btn btn-warning btn-lg btn-block" href="javascript:toggle();"><span style="color:white;"class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> Tampilkan form</a><br /><br />
	<form id="anls" style="display: none" method="POST" action="indexanalisis.php" target="tampilAnalisis">
  <fieldset>
		<table class="table table-striped table-hover ">
			<tbody>
				<tr class="success">
					<td>
					Lokasi
					</td>
				</tr>
				<tr>
					<td style="text-align:left";>
						Pilih Provinsi :
						<select name="propinsi" id="propinsi">
							<option>--Pilih Provinsi--</option>
							<option value="01">ACEH</option>
							<option value="02">SUMATERA UTARA</option>
							<option value="03">SUMATERA BARAT</option>
							<option value="06">RIAU</option>
							<option value="04">JAMBI</option>
							<option value="08">SUMATERA SELATAN</option>
							<option value="05">BENGKULU</option>
							<option value="10">LAMPUNG</option>
							<option value="09">KEP. BANGKA BELITUNG</option>
							<option value="07">KEP. RIAU</option>
							<option value="13">JAWA BARAT</option>
							<option value="14">JAWA TENGAH</option>
							<option value="11">BANTEN</option>
							<option value="16">JAWA TIMUR</option>
							<option value="15">YOGYAKARTA</option>
							<option value="17">BALI</option>
							<option value="18">NUSA TENGGARA BARAT</option>
							<option value="19">NUSA TENGGARA TIMUR</option>
							<option value="20">KALIMANTAN BARAT</option>
							<option value="21">KALIMANTAN TENGAH</option>
							<option value="22">KALIMANTAN SELATAN</option>
							<option value="23">KALIMANTAN TIMUR</option>
							<option value="23">KALIMANTAN UTARA</option>
							<option value="25">SULAWESI UTARA</option>
							<option value="26">SULAWESI TENGAH</option>
							<option value="28">SULAWESI SELATAN</option>
							<option value="27">SULAWESI TENGGARA</option>
							<option value="24">GORONTALO</option>
							<option value="29">SULAWESI BARAT</option>
							<option value="30">MALUKU</option>
							<option value="31">MALUKU UTARA</option>
							<option value="33">PAPUA</option>
						</select><br /><br />
						Kabupaten/kota:
						<select name="kota" id="kota">
						<option>--Pilih Kabupaten/Kota--</option>
						</select>
					</td>
				</tr>
				<tr class="info">
					<td>Aspek ekologi dan dampak lingkungan</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupSett">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Jarak ke pemukiman terdekat</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupSett" id="optionsRadios1" value="1">
								< 50 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupSett" id="optionsRadios2" value="2">
								50 - 100 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupSett" id="optionsRadios2" value="3">
								100 - 150 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupSett" id="optionsRadios2" value="4">
								150 - 200 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupSett" id="optionsRadios2" value="5">
								> 200 m
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupRiv">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Jarak ke sungai/danau terdekat</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupRiv" id="optionsRadios1" value="1">
								< 50 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupRiv" id="optionsRadios2" value="2">
								50 - 100 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupRiv" id="optionsRadios2" value="3">
								100 - 150 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupRiv" id="optionsRadios2" value="4">
								150 - 200 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupRiv" id="optionsRadios2" value="5">
								> 200 m
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr class="danger">
					<td>Aspek ekonomi & infrastruktur</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupJln">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Jarak ke akses jalan terdekat</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupJln" id="optionsRadios1" value="5">
								< 50 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupJln" id="optionsRadios2" value="4">
								50 - 100 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupJln" id="optionsRadios2" value="3">
								100 - 150 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupJln" id="optionsRadios2" value="2">
								150 - 200 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupJln" id="optionsRadios2" value="1">
								> 200 m
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupElec">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Jarak ke jaringan listrik terdekat</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupElec" id="optionsRadios1" value="5">
								< 50 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupElec" id="optionsRadios2" value="4">
								50 - 100 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupElec" id="optionsRadios2" value="3">
								100 - 150 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupElec" id="optionsRadios2" value="2">
								150 - 200 m
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupElec" id="optionsRadios2" value="1">
								> 200 m
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr class="warning">
					<td>Aspek kerawanan bencana alam</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupPtg">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Kerawanan bencana puting beliung</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupPtg" id="optionsRadios1" value="1">
								Tinggi
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupPtg" id="optionsRadios2" value="3">
								Sedang
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupPtg" id="optionsRadios2" value="5">
								Rendah
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupBjr">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Kerawanan bencana banjir</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupBjr" id="optionsRadios1" value="1">
								Tinggi
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupBjr" id="optionsRadios2" value="3">
								Sedang
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupBjr" id="optionsRadios2" value="5">
								Rendah
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupLsr">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Kerawanan bencana tanah longsor</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupLsr" id="optionsRadios1" value="1">
								Tinggi
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupLsr" id="optionsRadios2" value="3">
								Sedang
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupLsr" id="optionsRadios2" value="5">
								Rendah
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupGmp">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Kerawanan bencana gempa bumi</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupGmp" id="optionsRadios1" value="1">
								Tinggi
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupGmp" id="optionsRadios2" value="3">
								Sedang
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupGmp" id="optionsRadios2" value="5">
								Rendah
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupBkr">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Kerawanan bencana kebakaran</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupBkr" id="optionsRadios1" value="1">
								Tinggi
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupBkr" id="optionsRadios2" value="3">
								Sedang
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupBkr" id="optionsRadios2" value="5">
								Rendah
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr class="success">
					<td>Aspek kondisi alam</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupSlope">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Kemiringan lahan</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupSlope" id="optionsRadios1" value="5">
								Datar
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupSlope" id="optionsRadios2" value="4">
								Landai
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupSlope" id="optionsRadios2" value="3">
								Agak curam
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupSlope" id="optionsRadios2" value="2">
								Curam
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupSlope" id="optionsRadios2" value="1">
								Sangat curam
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td style="text-align:left;">
						<fieldset id="groupLus">
						<div class="form-group">
						  <label class="col-lg-2 control-label">Tipe penggunaan lahan</label>
						  <div class="col-lg-10">
							<div class="radio">
							  <label>
								<input type="radio" name="groupLus" id="optionsRadios1" value="1">
								Pemukiman atau area industri
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupLus" id="optionsRadios2" value="2">
								Sawah
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupLus" id="optionsRadios2" value="3">
								Perkebunan
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupLus" id="optionsRadios2" value="4">
								Tegalan atau ladang
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="groupLus" id="optionsRadios2" value="5">
								Semak Belukar
							  </label>
							</div>
						  </div>
						</div>
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
  </fieldset>
  <input type="submit" name="submitAnalisis" class="btn btn-primary" value="HITUNG" onclick="showLoading()"/>
</form>

	<form runat="server"> 
    <div id="divLoading2"> 
        <img src="images/chicken2.gif" alt="" width="40%"/> 
    </div>
	<div id="divFrameHolder2" style="display:none"> 
	<iframe src="indexanalisis.php" class="indexanalisis" name="tampilAnalisis" scrolling="yes" onload="hideLoading()" ></iframe>
	</div>
	</form>
</div>
</div>
</div>
	<!--//End-Gallery-->
   <!-- portfolio -->
<div class="col-md-3 inte">
				
				<div class="social">
					
				</div>
			</div>
				<div class="clearfix"></div>
			</div>
<!-- header -->
<!-- duis -->
		<div class="duis">
		
		</div>
<!-- duis -->		
<!-- anean -->	
	
<!-- anean -->
	<div class="anean-bottom">
		
	</div>
<!-- footer -->
	<div class="footer">
		<div class="container">		
			
		</div>
	</div>
	<!-- footer -->
<!-- footer -->
	<div class="footer-bottom">
		<div class="container">
			<p>Copyrights © 2015 Arif K Wijayanto, MIT-NRM IPB<br /></p>
		</div>
	</div>
<!-- footer -->
<script type="text/javascript" src="petasuai.js"></script>
</body>
</html>