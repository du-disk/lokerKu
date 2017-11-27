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
	
		<div class="container">  
        
        <div class="col s12 m6">
            <h4 class="header">Dashboard</h4>
          </div>        
	    	<div class="col s12 top10">
	    		<?php 
	    			$select=mysql_query("SELECT * FROM users u LEFT JOIN kelas k ON u.kd_kelas=k.kd_kelas WHERE u.kd_kelas='$_SESSION[kelas_d]'");
	    			$tampil=mysql_fetch_array($select);
	    		?>
	    		<div class="small-box blue-grey darken-1 animated zoomIn">
               <h5 style="padding: 10px;">Welcome To Loker <strong><?=$tampil['kelas'];?></strong></h5>
           	</div>
	    	</div>

      	<div class="col s12 m12 l6">
         	<div class="small-box pink darken-1 animated zoomIn">
                <div class="icon">
                  <i class="material-icons">vpn_key</i>
                </div>
                <a href="loker.php" class="small-box-footer">Loker</a>
           	</div>
      	</div>

      	<div class="col s12 m12 l6">
         	<div class="small-box light-green accent-4 animated zoomIn">
                <div class="icon">
                  <i class="material-icons">help</i>
                </div>
                <a href="about.php" class="small-box-footer">About</a>
           	</div>
      	</div>


      	<div class="col s12 m12 l6">
         	<div class="small-box cyan animated zoomIn">
                <div class="icon">
                  <i class="material-icons">help</i>
                </div>
                <a href="help.php" class="small-box-footer">Help</a>
           	</div>
      	</div>
      	
      	<div class="col s12 m12 l6">
         	<div class="small-box orange darken-1 animated zoomIn">
                <div class="icon">
                  <i class="material-icons">settings</i>
                </div>
                <a href="setting1.php" class="small-box-footer ">Pengaturan</a>
           	</div>
      	</div>

   	</div> <!--  Container  -->

	</div> <!-- row -->            
	
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