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
</head>
<body>
	
	<?php include "inc/header.php";?>

	<div class="row">
		<?php
			$select=mysql_query("SELECT * FROM lokers WHERE no_loker='$_SESSION[nl]'");
			$tampil=mysql_fetch_array($select);
		?>
		<div class="col s12">
			<div class="container">
				<div class="row">
					<div class="col s12 m6">
						<h4 class="header">Dashboard</h4>
					</div>
					<div class="col s12 top10">
			    		<div class="small-box blue-grey darken-1 animated zoomIn">
		               	<h5 style="padding: 10px;">Selamat Datang Pengguna No Loker <?=$tampil['no_loker'];?></h5>
		           		</div>
	    			</div>

	    			<div class="col s12 m12 l4">
			         	<div class="small-box pink animated zoomIn">
			                <div class="icon">
			                  <i class="material-icons">storage</i>
			                </div>
			                <a href="data_loker.php" class="small-box-footer">Data Loker</a>
			           	</div>
			      	</div>
			      	
			      	<div class="col s12 m12 l4">
			         	<div class="small-box teal animated zoomIn">
			         	<p class="center">Pemilik Loker</p>
			                <div class="icon center" style="padding: 13px;">
			                  <i class="material-icons">account_circle</i><br>
			                </div>
			                <a class="small-box-footer"><?=$_SESSION['user'];?></a>
			           	</div>
			      	</div>

			      	<div class="col s12 m12 l4">
			         	<div class="small-box orange animated zoomIn">
			                <div class="icon">
			                  <i class="material-icons">settings</i>
			                </div>
			                <a href="setting1.php" class="small-box-footer">Pengaturan</a>
			           	</div>
			      	</div>

				</div>
			</div>
		</div>
	</div>

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
	<script type="text/javascript">
		$(document).ready(function(){
		    $('select').material_select();
		});
	</script>
		<script type="text/javascript">
	
	  $(".button-collapse").sideNav();
	  $(".dropdown-button").dropdown();
	</script>

	<script type="text/javascript">
	 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  	});
	function triggerFormModal(url, selector="#konfirmasi") {
   
    $(".modal-content").load(url+" "+selector,function(response,status){
       
     
    });
    $(".modal-trigger").trigger("click");
   		
   		
	}

 		$(".modal-custom").on("click",function () {
 		
            var url = $(this).attr("href");
            triggerFormModal(url);
            return false;
        });
	</script>
</body>
</html>
<?php
}else{
	header("location:loker.php");
}
?>