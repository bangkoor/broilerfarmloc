<?php

include 'config.php';
	error_reporting (E_ALL ^ E_NOTICE);
	$post = (!empty($_POST)) ? true : false;

if($post)
	{
		include 'functions.php';
		$name = stripslashes($_POST['name']);
		$instansi = stripslashes($_POST['instansi']);
		$kontak2 = stripslashes($_POST['kontak2']);
		$email = trim($_POST['email']);
		$pesan = stripslashes($_POST['userMsg']);

		$error = '';

// Check name
if(!$name)
	{
		$error .= 'Mohon maaf. Namanya jangan lupa <br />';
	}
// Check email
if(!$email)
	{
		$error .= 'Mohon maaf. Email harus diisi yah <br />';
	}
if($email && !ValidateEmail($email))
	{
		$error .= 'Aduh! Emailnya masih salah tuh<br />';
	}
// Check kontak
if(!$kontak2)
	{
		$error .= 'Mohon maaf. Kontak harus diisi yah<br />';
	}
$subject = 'Feedback baru!';
$headers = "From: ".$email."\r\n" .
$headers2 = "From: Arif & Mega Wedding<arifmegawedding@bangkoor.com>";
$headers2 .= "MIME-Version: 1.0" . "\r\n";
$headers2 .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$isi .= "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta name='viewport' content='width=device-width' />
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<style>
/* -------------------------------------
		GLOBAL
------------------------------------- */
* {
	margin: 0;
	padding: 0;
	font-family: 'Pacifico', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
	font-size: 100%;
	line-height: 1.6;
}

img {
	max-width: 100%;
}

body {
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust: none;
	width: 100%!important;
	height: 100%;
}


/* -------------------------------------
		ELEMENTS
------------------------------------- */
a {
	color: #348eda;
}

.btn-primary {
	text-decoration: none;
	color: #FFF;
	background-color: #348eda;
	border: solid #348eda;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}

.btn-secondary {
	text-decoration: none;
	color: #FFF;
	background-color: #aaa;
	border: solid #aaa;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}

.last {
	margin-bottom: 0;
}

.first {
	margin-top: 0;
}

.padding {
	padding: 10px 0;
}


/* -------------------------------------
		BODY
------------------------------------- */
table.body-wrap {
	width: 100%;
	padding: 20px;
}

table.body-wrap .container {
	border: 1px solid #f0f0f0;
}


/* -------------------------------------
		FOOTER
------------------------------------- */
table.footer-wrap {
	width: 100%;	
	clear: both!important;
}

.footer-wrap .container p {
	font-size: 12px;
	color: #666;
	
}

table.footer-wrap a {
	color: #999;
}


/* -------------------------------------
		TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
	font-family: 'Pacifico', Helvetica, Arial, 'Lucida Grande', sans-serif;
	line-height: 1.1;
	margin-bottom: 10px;
	color: #000;
	margin: 40px 0 10px;
	line-height: 1.2;
	font-weight: 200;
}

h1 {
	font-size: 36px;
}
h2 {
	font-size: 28px;
}
h3 {
	font-size: 22px;
}

p, ul, ol {
	margin-bottom: 10px;
	font-weight: normal;
	font-size: 14px;
}

ul li, ol li {
	margin-left: 5px;
	list-style-position: inside;
}

/* ---------------------------------------------------
		RESPONSIVENESS
		Nuke it from orbit. It's the only way to be sure.
------------------------------------------------------ */

/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display: block!important;
	max-width: 80%!important;
	margin: 0 auto!important; /* makes it centered */
	clear: both!important;
}

/* Set the padding on the td rather than the div for Outlook compatibility */
.body-wrap .container {
	padding: 20px;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	max-width: 800px;
	margin: 0 auto;
	display: block;
}

/* Let's make sure tables in the content area are 100% wide */
.content table {
	width: 100%;
}

</style>
</head>

<body style='background:#fce4e9;'>

<!-- body -->
<table class='body-wrap'>
	<tr>
		<td></td>
		<td class='container' style='background:#FFFFFF;width:75%;'>

			<!-- content -->
			<div class='content'>
			<table>
				<tr>
					<td align='center'>
						<h2>Hai ".$name."! <br />Terima kasih sudah konfirmasi. Kami tunggu kehadirannya</h2>
						<h3>- Mega & Arif -</h3><br />
						<div align='center'>
						<img src='http://wedding.bangkoor.com/images/save-the-date.jpg' width='60%' /></div><br />
						

					</td>
				</tr>
			</table>
			</div>
			<!-- /content -->
			
		</td>
		<td></td>
	</tr>
</table>
<!-- /body -->

<!-- footer -->
<table class='footer-wrap'>
	<tr>
		<td></td>
		<td class='container'>
			
			<!-- content -->
			<div class='content'>
				<table>
					<tr>
						<td align='center'>
							<!-- <img src='http://localhost:9090/broiler/images/logo-mit.png' width='200' /> -->
						</td>
					</tr>
				</table>
			</div>
			<!-- /content -->
			
		</td>
		<td></td>
	</tr>
</table>
<!-- /footer -->

</body>
</html>
"; 
if(!$error)
	{
		$mail = mail(WEBMASTER_EMAIL, $subject, 
     		"Nama: ".$name."\r\n"
    		/* ."Email: ".$email."\r\n" */
			."Kontak: ".$kontak2."\r\n"
			."Hadir pada: ".$hadirPada."\r\n"
			."Jumlah rombongan: ".$jlhRombongan."\r\n",
			$headers);
		$mail2 = mail($email, "Save the date!",
			$isi,
			$headers2);
if($mail)
	{
		echo 'OK';
	}
}
else
	{
		echo '<div class="notification_error">'.$error.'</div>';
	}
}
?>