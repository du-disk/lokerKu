<?php 
	include"inc/koneksi.php";
	session_start();
	if(isset($_SESSION['login_admin'])){
		header("location:admin/media.php");
	}else if(isset($_SESSION['kunci_loker'])){
		echo"<script>alert('Anda Sudah Ada Di dalam Loker, Jika Ingin keluar Mohon Logout Terlebih Dahulu!!!');window.location.assign('loker.php?nl=$_SESSION[kunci_loker]');</script>";
	}
	else if(isset($_SESSION['login'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>LokerKu</title>
	<!--Import Google Icon Font-->
   <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="icon" type="img/png" href="dist/img/mini-login.png">
   <!--Let browser know website is optimized for mobile-->
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <!--Import materialize.min.css-->
   <link type="text/css" rel="stylesheet" href="dist/css/materialize.min.css"  media="screen,projection"/>
   <!-- Import materialize.scss -->
   <link type="text/css" rel="scss" href="dist/sass/materialize.scss"  media="screen,projection"/>
   <!-- Plugin animate CSS -->
	<link rel="stylesheet" type="text/css" href="dist/css/animate.css" media="screen,projection"/>
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="dist/css/style.css" media="screen,projection"/>
</head>
<body>
	
	<?php include "inc/header.php";?>
	<div class="row">	
		<div class="col s12">
			<div class="container">
				<div class="row">
					<div class="col s12 m6">
						<h4 class="header">Help</h4>
					</div>
					<div class="col s12 m6">
						<nav style="background-color: transparent; box-shadow: none; text-align: right;">
						    <div class="nav-wrapper">
						      <div class="col s12">
						        <a href="index.php" class="breadcrumb">Home</a>
						        <a href="#!" class="breadcrumb"><b>Help</b></a>
						      </div>
						    </div>
						</nav>
					</div>
				</div>
				<?php
					$select=mysql_query("SELECT * FROM help");
					while($var=mysql_fetch_array($select)){
				?>
				<div class="card large animated zoomIn">
					<div class="card-image">
						<img src="dist/img/user-profile-bg.jpg">
						<span class="card-title"><?=$var['judul'];?></span>
					</div>
					<div class="card-content"><?=$var['isi'];?></div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="dist/js/jquery.js"></script>
	<script type="text/javascript" src="dist/js/materialize.min.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
		    $('.modal').modal();
		    $('select').material_select();
		});
	</script>
</body>
</html>
<?php
}else{
	header("location:login_user/login.php");
}
?>