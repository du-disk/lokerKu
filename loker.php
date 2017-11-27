<?php 
	include"inc/koneksi.php";
	session_start();
	if(isset($_SESSION['login_admin'])){
		header("location:admin/media.php");
	}else if(isset($_SESSION['kunci_loker'])){
		echo"<script>alert('Anda Sudah Ada Di dalam Loker, Jika Ingin keluar Mohon Logout Terlebih Dahulu!!!');window.location.assign('inloker.php?nl=$_SESSION[kunci_loker]');</script>";
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
						<h4 class="header">Loker</h4>
					</div>
					<div class="col s12 m6">
						<nav style="background-color: transparent; box-shadow: none; text-align: right;">
						    <div class="nav-wrapper">
						      <div class="col s12">
						        <a href="index.php" class="breadcrumb">Home</a>
						        <a href="#!" class="breadcrumb"><b>Loker</b></a>
						      </div>
						    </div>
						</nav>
					</div>
				</div>
				<div class="col s12 m6 l6 offset-l3">
				<div class="card animated zoomIn">
					<div class="card-heading"><img src="dist/img/login.png"/></div>
					<div class="card-content">
						<div class="row">
						 	<form action="" method="POST">
						 		<div class="input-field col s12">
								    <select name="no_loker">
								      <option value="" disabled selected>Choose your Loker</option>
								       <!-- While Select -->
									    <?php
									    	$pilih=mysql_query("SELECT no_loker FROM lokers where kd_kelas='$_SESSION[kelas_d]'");
									    	while($tampil_l=mysql_fetch_array($pilih)){
									    ?>
								      		<option value="<?=$tampil_l['no_loker'];?>">Loker <?=$tampil_l['no_loker'];?></option>
								    	<?php
								  		}
								  		?>
								    </select>
							    	<label>Pilih No Loker</label>
							  	</div>
						        <div class="input-field col s12">  
							        <input id="password" type="password" name="password" class="validate">
									<label for="password">Kunci Loker</label>
						        </div>
					        	<div class="input-field col s12">
					        		<button class="waves-effect waves-light btn pink btn-large btn-block" type="submit" name="masuk">Masuk</button>
					        	</div>
					    	</form>
							<!-- Proses Masuk Loker -->
							<?php
								if(isset($_POST['masuk'])){
									$pass=block(md5($_POST['password']));
									$no_loker=block($_POST['no_loker']);
									$masuk=mysql_query("SELECT * FROM lokers WHERE password='$pass' && no_loker='$no_loker'");
									$cek=mysql_num_rows($masuk);
									if($cek==1){
										$show=mysql_fetch_array($masuk);
										$_SESSION['kunci_loker']=sha1(md5($show['no_loker']));
										$_SESSION['nl']=$show['no_loker'];
										$_SESSION['user']=$show['pemilik'];
										$_SESSION['kd']=$show['kd_isi'];
										echo"<script>window.location.assign('inloker.php?nl=$_SESSION[kunci_loker]');</script>";
									}else{
										echo"<script>alert('Maaf Kunci yang ada masukan salah.');</script>";
									}
								}
							?>
				    	</div>	
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="dist/js/jquery.js"></script>
	<script type="text/javascript" src="dist/js/materialize.min.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
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