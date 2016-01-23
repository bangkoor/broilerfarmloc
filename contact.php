<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Mohon isikan nama Anda!'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	// require a name from user
	if(trim($_POST['instansi']) === '') {
		$instansiError =  'Mohon isikan profesi/instansi Anda!'; 
		$hasError = true;
	} else {
		$instansi = trim($_POST['instansi']);
	}
	
	// require a name from user
	if(trim($_POST['nohp']) === '') {
		$nohpError =  'Mohon isikan nomor kontak Anda!'; 
		$hasError = true;
	} else {
		$nohp = trim($_POST['nohp']);
	}
	
		
	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'Mohon isikan pesan Anda!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
		
		$emailTo = 'rifishere@gmail.com';
		$subject = 'Submitted message from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "<html><head><link href='http://files.bangkoor.com/broiler/css/bootstrap.min.css' rel='stylesheet' type='text/css' media='all'></head><body><table class='table table-striped table-hover' border='0'><tbody><tr><td>Nama:</td><td>$name</td></tr><tr><td>Instansi:</td><td>$instansi</td></tr><tr><td>No Hp:</td><td>$nohp</td></tr><tr><td>Komentar:</td><td>$comments</td></tr></tbody></table></body></html>";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

		mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>
<!DOCTYPE HTML>
<head>
<title>Broiler FarmLoc</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Dream Elite Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="js/move-top.js"></script>
       <script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
       <script type="text/javascript" src="js/easing.js"></script>
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
</head>
<body>
<!-- header -->
 <div class="banner1">
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
							<li><a href="location.php">Analisis</a></li>
							<li class="active"><a href="contact.php">Beri Feedback</a></li>
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
			</div>
<!-- header -->
<!---->
	<div class="container">
				<div class="contact">
				<div class="contact-in">
				<h3>Berikan Masukan</h3>
				<div class="alert alert-dismissible alert-info">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  <p>Aplikasi ini masih butuh banyak penyempurnaan di segala sisi. Untuk itu, pendapat dan masukan dari Anda sebagai pengguna sangat diperlukan untuk peningkatan kualitas aplikasi ini. Silakan sampaikan pendapat dan masukan Anda melalui form berikut.</p>
				</div>
				<div class=" col-md-9 contact-left">
				<?php if(isset($emailSent) && $emailSent == true) { ?>
                <div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button><p><strong>Terima kasih!</strong> Pesan anda berhasil dikirim.</p><br /><a href="contact.php" class="btn btn-warning">Kirim lagi</a><a href="index.php" class="btn btn-warning">Ke Beranda</a></div>
				<?php } else { ?>
					<?php if(isset($hasError) || isset($captchaError) ) { ?>
                        <div class="alert alert-dismissible alert-warning"><strong>Kesalahan pengisian!</strong></div>
                    <?php } ?>
					<form action="contact.php" method="post" id="contactform">
						 <span>Nama*</span>
						 <label style="display:none;" class="screen-reader-text">Nama</label>
							   <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField" placeholder="Nama" />
							<?php if($nameError != '') { ?>
								<br /><span class="label label-danger"><?php echo $nameError;?></span> 
							<?php } ?><br />
						<span>Profesi/instansi*</span>
						<label style="display:none;" class="screen-reader-text">Profesi/Instansi</label>
							   <input type="text" name="instansi" id="instansi" value="<?php if(isset($_POST['instansi'])) echo $_POST['instansi'];?>" class="txt requiredField" placeholder="Instansi/profesi" />
							<?php if($instansiError != '') { ?>
								<br /><span class="label label-danger"><?php echo $instansiError;?></span> 
							<?php } ?><br />
						 <span>Kontak (No hp/WA)*</label>
						 <label style="display:none;" class="screen-reader-text">Nomor Kontak</label>
							   <input type="text" name="nohp" id="nohp" value="<?php if(isset($_POST['nohp']))  echo $_POST['nohp'];?>" class="txt requiredField" placeholder="No hp" />
							<?php if($nohpError != '') { ?>
								<br /><span class="label label-danger"><?php echo $nohpError;?></span>
							<?php } ?><br />
						<span>Isi pesan</span>
						<label style="display:none;" class="screen-reader-text">Isi Pesan</label>
						<textarea name="comments" id="commentsText" class="txtarea requiredField" placeholder="Pesan"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<br /><span class="label label-danger"><?php echo $commentError;?></span> 
							<?php } ?>
						<button name="submit" type="submit" class="btn btn-primary">Kirim pesan</button>
							<input type="hidden" name="submitted" id="submitted" value="true" />

					</form>
					</div>
					<?php } ?>
					  <div class="clearfix"></div>
				 </div>
      		</div>
		    </div>
<!--<script type="text/javascript">
	$(document).ready(function() {
		$('form#contactform').submit(function() {
			$('form#contactform .error').remove();
			var hasError = false;
			$('.requiredField').each(function() {
				if($.trim($(this).val()) == '') {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<p class="error">Anda lupa memasukkan '+labelText+' Anda</p>');
					$(this).addClass('inputError');
					hasError = true;
				} else if($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test($.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">Sorry! You\'ve entered an invalid '+labelText+'.</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$('form#contactform').slideUp("fast", function() {				   
						$(this).before('<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button><p><strong>Terima kasih!</strong> Pesan anda berhasil dikirim.</p><br /><a href="contact.php" class="btn btn-warning">Kirim lagi</a><a href="index.php" class="btn btn-warning">Ke Beranda</a></div>');
					});
				});
			}
			
			return false;	
		});
	});
</script>-->

	<!---->
<!-- footer -->
	<div class="footer-bottom">
		<div class="container">
			<p>Copyrights © 2015 Arif K Wijayanto, MIT-NRM IPB<br /></p>
		</div>
	</div>
<!-- footer -->
</body>
</html>
