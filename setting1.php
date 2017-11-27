<?php 
	include"inc/koneksi.php";
	session_start();
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
	<?php
		if(isset($_SESSION['kunci_loker'])){
	?>
	<div class="row">	
		<?php
			$select=mysql_query("SELECT * FROM lokers WHERE no_loker='$_SESSION[nl]'");
			$tampil=mysql_fetch_array($select);
		?>
		<div class="col s12">
			<div class="container">
				<div class="row">
					<div class="col s12 m6">
						<h4 class="header">Pengaturan</h4>
					</div>
					<div class="col s12 m6">
						<nav style="background-color: transparent; box-shadow: none; text-align: right;">
						    <div class="nav-wrapper">
						      <div class="col s12">
						        <a href="index.php" class="breadcrumb">Home</a>
						        <a href="#!" class="breadcrumb"><b>Pengaturan</b></a>
						      </div>
						    </div>
						</nav>
					</div>
				</div>
				<div class="col s12 m6 l6 offset-l3">
					<div class="card animated zoomIn">
						<div class="card-heading">Loker <?=$tampil['no_loker'];?></div>
						<div class="card-content">
							<div class="row">
								<form action="" method="POST">
			    					<input type="hidden" name="no_loker" value="<?=$tampil['no_loker'];?>">
			    					<input type="hidden" name="kelas" value="<?=$_SESSION['kelas_d'];?>">
									<div class="input-field col s12">
							          <input id="old" type="password" name="old" class="validate">
							          <label for="old" class="active">Password Lama</label>
							        </div>
							        <div class="input-field col s12">
							          <input id="new" type="password" name="new" class="validate" required="">
							          <label for="new" class="active">Password Baru</label>
							        </div>
							        <div class="input-field col s12">
							          <input id="confirm" type="password" name="confirm" class="validate">
							          <label for="confirm" class="active" required>Confirm Password</label>
							        </div>
							        <div class="input-field col s12">
										<button type="submit" name="simpan_u" class="btn pink btn-large btn-block ">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php
		      		if(isset($_POST['simpan_u'])){
		      			$pass=block(md5($_POST['old']));
		      			$cek=mysql_query("SELECT * FROM lokers WHERE password='$pass' && kd_kelas='$_POST[kelas]'");
		      			$cek1=mysql_num_rows($cek);
		      			if($cek1){
		      				$new=block(md5($_POST['new']));
		      				$confirm=block(md5($_POST['confirm']));
		      				if($new==$confirm){
		      					$r=mysql_fetch_array($cek);
		      					$update=mysql_query("UPDATE lokers set password='$confirm' WHERE kd_kelas='$_POST[kelas]' && no_loker='$_POST[no_loker]'");
		      					if($update){
		      						echo"<script>alert('Anda Telah Berhasil Mengedit Password Loker ');window.location.assign('inloker.php');</script>";
		      					}
		      				}else{
		      					echo"<script>alert('Password Baru Anda Tidak Cocok');</script>";
		      				}
		      			}else{
		      				echo"<script>alert('Password Yang Anda Masukan Tidak Benar');</script>";
		      			}
		      		}
		      	?>
			</div>
		</div>
	</div>
	<?php
	}
	else if(isset($_SESSION['login'])){
	?>
	<div class="row">
		<?php
			$select=mysql_query("SELECT * FROM users u JOIN kelas k ON u.kd_kelas=k.kd_kelas WHERE u.kd_kelas='$_SESSION[kelas_d]'");
			$tampil=mysql_fetch_array($select);
		?>	
		<div class="col s12">
			<div class="container">
				<div class="row">
					<div class="col s12 m6">
						<h4 class="header">Pengaturan</h4>
					</div>
					<div class="col s12 m6">
						<nav style="background-color: transparent; box-shadow: none; text-align: right;">
						    <div class="nav-wrapper">
						      <div class="col s12">
						        <a href="index.php" class="breadcrumb">Home</a>
						        <a href="#!" class="breadcrumb"><b>Pengaturan</b></a>
						      </div>
						    </div>
						</nav>
					</div>
				</div>
				<div class="col s12 m6 l6 offset-l3">
					<div class="card animated zoomIn">
						<div class="card-heading">Kelas <?=$tampil['kelas'];?></div>
						<div class="card-content">
							<div class="row">
								<form action="" method="POST">
									<input type="hidden" name="kelas" value="<?=$tampil['kd_kelas'];?>">
									<div class="input-field col s12">
							          <input id="old" type="password" name="old" class="validate">
							          <label for="old">Password Lama</label>
							        </div>
							        <div class="input-field col s12">
							          <input id="new" type="password" name="new" class="validate">
							          <label for="new">Password Baru</label>
							        </div>
							        <div class="input-field col s12">
							          <input id="confirm" type="password" name="confirm" class="validate">
							          <label for="confirm">Confirm Password</label>
							        </div>
							        <div class="input-field col s12">
										<button type="submit" name="simpan" class="btn pink btn-large btn-block ">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php
		      		if(isset($_POST['simpan'])){
		      			$pass=block(md5($_POST['old']));
		      			$cek=mysql_query("SELECT * FROM users WHERE password='$pass' && kd_kelas='$_POST[kelas]'");
		      			$cek1=mysql_num_rows($cek);
		      			if($cek1==1){
		      				$new=block(md5($_POST['new']));
		      				$confirm=block(md5($_POST['confirm']));
		      				if($new==$confirm){
		      					$r=mysql_fetch_array($cek);
		      					$update=mysql_query("UPDATE users set password='$confirm' WHERE kd_kelas='$_POST[kelas]'");
		      					if($update){
		      						echo"<script>alert('Anda Telah Berhasil Mengedit Password Kelas Anda. ');window.location.assign('setting1.php');</script>";
		      					}
		      				}else{
		      					echo"<script>alert('Password Baru Anda Tidak Cocok');</script>";
		      				}
		      			}else{
		      				echo"<script>alert('Password Yang Anda Masukan Tidak Benar');</script>";
		      			}
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