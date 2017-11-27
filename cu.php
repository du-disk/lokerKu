<?php 
	include"inc/koneksi.php";
	session_start();
	if(isset($_SESSION['login_admin'])){
		header("location:admin/media.php");
	}
	else if(isset($_SESSION['nl'])){
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
	<!-- DataTables -->
  	<link rel="stylesheet" href="dist/plugin/datatables/dataTables.bootstrap.css">
  	<script type="text/javascript" src="dist/js/jquery.js"></script>
	<script type="text/javascript" src="dist/js/materialize.min.js"></script>
	<style type="text/css">
		ul:not(.browser-default) {
		    visibility: hidden;
		}
		.card-panel{
			padding: 20px!important;
			margin: 60px 0px 0px;
		}
	</style>
</head>
<body>
	<?php 
		include"inc/header.php";

		if(isset($_GET['idcu'])){
			$select=mysql_query("SELECT * FROM isi_loker WHERE kd_isi='$_GET[idcu]'");
			$tampil=mysql_fetch_array($select);
	?>
		<div class="row">
			<div class="col m4 offset-m4 s12 card-panel">
				<h5>Edit Data</h5>
				<form action="" method="POST" enctype="multipart/form-data" >
				    <div class="row">
				       <div class="file-field input-field">
					      <div class="btn">
					        <span>Change File</span>
					        <input type="file"  name="image" >
					      </div>
					      <div class="file-path-wrapper">
					        <input value="<?=$tampil['file'];?>" class="file-path validate" type="text" placeholder="Silahakan pilih file">
					      </div>
					    </div>
				    </div>
			      <div class="row">
			        <div class="input-field col s12">
			          <textarea id="textarea1" name="description" class="materialize-textarea"><?=$tampil['description'];?></textarea>
			          <label for="textarea1" name="description">Description</label>
			        </div>
			      </div>
			      <small><i>*Masukan Description untuk keterangan file</i></small>
				    <button class="btn validate right" name="edit"><i class="fa fa-send"></i> Edit</button>
				</form>
				<?php
					if(isset($_POST['edit'])){
						$description=$_POST['description'];
						$file =$_FILES['image']['name'];
							  $tmp = $_FILES['image']['tmp_name'];
							  $path = "dokumen/".$file;
							  if(move_uploaded_file($tmp, $path)){ 
								$sql =mysql_query("SELECT * FROM isi_loker WHERE kd_isi = '$_GET[idcu]'");
								$hasil = mysql_fetch_array($sql);
									if(is_file("dokumen/".$hasil['file'])) {
									  unlink("dokumen/".$hasil['file']);
									}
								}
								if(empty($_FILES['image']['name'])){
									$edit=mysql_query("UPDATE isi_loker SET description='$description' WHERE kd_isi='$_GET[idcu]'");
								}else{
									$edit=mysql_query("UPDATE isi_loker SET file='$file',description='$description' WHERE kd_isi='$_GET[idcu]'");
								}
								if($edit){	
									echo"<script>window.location.assign('data_loker.php');</script>";
								}else{
									echo"gagal";
								}
					}
				?>
			</div>
		</div>
	<?php
	}else{
	?>	
		<div class="row">
			<div class="col m4 offset-m4 s12 card-panel">
				<h5>Tambah Data</h5>
				<form action="" method="POST" enctype="multipart/form-data">
				    <div class="row">
				       <div class="file-field input-field">
					      <div class="btn">
					        <span>Select File</span>
					        <input type="file" name="image">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text" placeholder="Silahakan pilih file">
					      </div>
					    </div>
				    </div>
			      <div class="row">
			        <div class="input-field col s12">
			          <textarea id="textarea1" class="materialize-textarea" name="description"></textarea>
			          <label for="textarea1" name="description">Description</label>
			        </div>
			      </div>
			      <small><i>*Masukan Description untuk keterangan file</i></small>
				    <button class="btn validate right" name="tambah"><i class="fa fa-send"></i> Tambah</button>
				</form>
				<?php
					if(isset($_POST['tambah'])){
						$description=$_POST['description'];
						$file = $_FILES['image']['name'];
						$nl=$_SESSION['nl'];
						$insert=mysql_query("INSERT INTO isi_loker(no_loker,file,description) VALUES ('$nl','$file','$description')");
						if($insert){
							if(isset($_FILES['image'])){
							  $file_name = $_FILES['image']['name'];
							  $file_tmp =$_FILES['image']['tmp_name'];

								move_uploaded_file($file_tmp,"dokumen/".$file_name);
							}
							echo"<script>alert('Data Berhasil Di Tambahkan');window.location.assign('data_loker.php');</script>";
						}else{
							echo"Gagal";
						}
					}
				?>
			</div>
		</div>
	<?php
	}
	?>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript">
		  $('.modal').modal();
		  $(".button-collapse").sideNav();
		  $(".dropdown-button").dropdown();
	</script>
</body>
</html>
<?php
}else{
	header("location:index.php");
}
?>	