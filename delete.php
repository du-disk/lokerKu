<?php
	include"inc/koneksi.php";
	session_start();
	if(isset($_POST['delete'])){
		$pass=md5($_POST['password']);
		$cek2=mysql_query("SELECT * FROM lokers WHERE no_loker='$_SESSION[nl]' && password='$pass'");
		$cek3=mysql_num_rows($cek2);
		if($cek3==1){
			$hasil=mysql_fetch_array($cek2);
			if(is_file("dokumen/".$hasil['file'])){
				unlink("dokumen/".$hasil['file']);
			}
			$del=mysql_query("DELETE FROM isi_loker WHERE kd_isi='$_POST[id]'");
			if($del){
				echo"<script>alert('Data Berhasil Di Delete!');window.location.assign('loker.php');</script>";
			}
		}else{
			echo"<script>alert('Password Yang anda masukan Salah!!');window.location.assign('loker.php');</script>";
		}
	}
?>