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
	<script type="text/javascript" src="dist/plugin/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="dist/plugin/datatables/dataTables.bootstrap.js"></script>
	<script type="text/javascript">
	  $(function () {
	    $('#table').dataTable({
	      "bPaginate": true,
	      "bLengthChange": true,
	      "bFilter": true,
	      "bSort": false,
	      "bInfo": true,
	      "bAutoWidth": true
	    });
	  });
	</script>
</head>
<body>
	<?php include"inc/header.php";?>
	
	<div class="container">
		<div class="row">
			<div class="col s12 top20">
				<div class="row head">
	      			<div class="col s12 m6">
	        			<h4>Loker <?=$_SESSION['nl'];?></h4>
	      			</div>
	 			</div>
	 			<div class="box">
			       	<div class="box-body">
			      		<div class="fixed-action-btn horizontal click-to-toggle">
				    	<a href="cu.php" class="btn-floating btn-large waves-effect waves-light blue modal-custom">
				      		<i class="material-icons prefix">create</i>
				      	</a>
				    	</div> 
			        </div>
			      	<div class="responsive-table">
		            	<table id="table" class="striped">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th>Deskripsi</th>
									<th>File</th>
									<th>Tanggal Buat</th>
									<th>Terakhir Update</th>
									<th class="text-center" data-field="engine">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
									$nl=$_SESSION['nl'];
									$pilih=mysql_query("SELECT * FROM isi_loker WHERE no_loker='$nl'");
									while($tampil=mysql_fetch_array($pilih)){
								?>
								<tr>
									<td><?=$no?></td>
									<td><?=$tampil['description'];?></td>
									<td><?=$tampil['file'];?></td>
									<td><?=$tampil['tanggal_masuk'];?></td>
									<td><?=$tampil['tanggal_update'];?></td>
									<td class="center">
										<a href="dokumen/<?=$tampil['file'];?>" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons prefix">file_download</i></a>

										<a href="cu.php?idcu=<?=$tampil['kd_isi'];?>" class="btn-floating btn-large blue waves-effect waves-light modal-custom"><i class="material-icons prefix">edit</i></a>

										<a onclick="return confirm('Are You Sure ?');" href="?del=<?=$tampil['kd_isi'];?>" class="btn-floating btn-large red waves-effect waves-light"><i class="material-icons">delete</i></a>
										
									</td>
								</tr>
								<?php
									$no++;
									}
								?>
							</tbody>
						</table>
			    	</div> <!-- Penutup Responsive Table -->
		      	</div> <!-- Penutup Box -->
			</div> <!-- Penutup Col s12 -->
		</div> <!-- Penutup Row -->
	</div> <!-- Penutup Container -->
	<?php
		if(isset($_GET['del'])){
			$cek2=mysql_query("SELECT * FROM isi_loker WHERE no_loker='$_SESSION[nl]'");
			$cek3=mysql_num_rows($cek2);
			if($cek3==1){
				$hasil=mysql_fetch_array($cek2);
				if(is_file("dokumen/".$hasil['file'])){
					unlink("dokumen/".$hasil['file']);
				}
				$del=mysql_query("DELETE FROM isi_loker WHERE kd_isi='$_GET[del]'");
				if($del){
					echo"<script>window.location.assign('data_loker.php');</script>";
				}else{
					echo"gagal";
				}
			}
		}
	?>
</body>
</html>
<?php
}else{
	header("location:loker.php");
}
?>