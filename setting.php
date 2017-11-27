<?php 
	include"inc/koneksi.php";
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>LokerKu</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel="icon" type="img/png" href="img/mini-login.png">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<?php include "inc/header.php"; ?>
	<?php
		if(isset($_SESSION['kunci_loker'])){
	?>
	<div class="row">
		<div class="col m10 offset-m1 s12">
  		 	<ul class="collapsible" data-collapsible="accordion">
		    <li>
		      	<div class="collapsible-header collapsible-header-costum">Settings <i class="fa fa-cogs"></i></div>
		      		<div class="box">
			      		<div class="row">
			      			<h5 class="center">Ganti Password</h5>
			      			<?php
			      				$select=mysql_query("SELECT * FROM lokers WHERE no_loker='$_SESSION[nl]'");
			      				$tampil=mysql_fetch_array($select);
			      			?>
			      			<div class="col m4 offset-m4 s12 ">
				      			<div class="card-panel">
				      				<h5>Loker <?=$tampil['no_loker'];?></h5>
				      				<ul class="collapsible" data-collapsible="accordion">
									    <li>
									      	<div class="collapsible-header black-text waves-effect waves-light btn">Ganti Password</div>
									      		<div class="collapsible-body">
										      		<div class="row">
										      			<form action="" method="POST">
										      				<input type="hidden" name="kelas" value="<?=$tampil['kd_kelas'];?>">
										      				<input type="hidden" name="no_loker" value="<?=$tampil['no_loker'];?>">
										      				<label>Password Lama</label>
										      				<input type="password" name="old">
										      				<label>Password Baru</label>
										      				<input type="password" name="new" required="">
										      				<label>Confirm Password</label>
										      				<input type="password" name="confirm" required="">
										      				<button type="submit" name="simpan" class="btn">Simpan</button>
										      			</form>
											    	</div>
									      		</div>
									    </li>
								 	</ul>
				      			</div>
				      		</div>
				    	</div>
				    	<?php
				      		if(isset($_POST['simpan'])){
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
				      						echo"<script>alert('Anda Telah Berhasil Mengedit Password Loker ');window.location.assign('setting.php');</script>";
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
		    	</li>
		 	</ul>
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
		<div class="container">
			<div class="box">
				<div class="box-header">Kelas <?=$tampil['kelas'];?></div>
				<div class="box-body">
					<form action="" method="POST">
						<input type="hidden" name="kelas" value="<?=$tampil['kd_kelas'];?>">
						<label>Password Lama</label>
						<input type="password" name="old">
						<label>Password Baru</label>
						<input type="password" name="new" required="">
						<label>Confirm Password</label>
						<input type="password" name="confirm" required="">
						<button type="submit" name="simpan" class="btn">Simpan</button>
					</form>
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
      						echo"<script>alert('Anda Telah Berhasil Mengedit Password Kelas Anda. ');window.location.assign('setting.php');</script>";
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
	
  	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
<?php
}else{
	header("location:login_user/login.php");
}
?>