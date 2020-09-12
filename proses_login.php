<?php
session_start();
include "config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$op = $_GET['op'];
	
if($op=="in"){
    $cek = mysql_query("SELECT * FROM tbl_user WHERE USERNAME='$username' AND PASSWORD='$password'");
    if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
        $c = mysql_fetch_array($cek);
		$nama=$c['REALNAME'];
        $_SESSION['username'] = $c['USERNAME'];
        $_SESSION['level'] = $c['LEVEL'];
		if($c['LEVEL']=="SUPERADMIN"){
			echo "<script>alert('Selamat Datang $nama'); window.location='media.php?hal=home'</script>";
		}
		if($c['LEVEL']=="ADMIN"){
			echo "<script>alert('Selamat Datang $nama'); window.location='media.php?hal=home'</script>";
		}
		if($c['LEVEL']=="USER"){
			echo "<script>alert('Selamat Datang $nama'); window.location='media.php?hal=home'</script>";
		}
    }else{
         die("password salah <a href=\"javascript:history.back()\">kembali</a>");
    }
}else if($op=="out"){
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    header("location:index.php");
}
?>