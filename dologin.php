<?php
require "config/main.php";

$email 	= $_POST['tEmail'];
$pwd   	= $_POST['tPwd'];

//mencari user berdasar email
$hasil  = mysqli_query($conn, "SELECT * FROM pengguna WHERE email='$email'");
//mysql_num_rows digunakan untu1k melihat jumlah baris
$hitung = mysqli_num_rows($hasil);
//data user ditampung pada variable user dalam bentuk object
$user = mysqli_fetch_object($hasil);

if ($hitung > 0){
	//jika user dengan email yang telah diloginkan sama.

	//diverify password berdasar password yang dia masukkan dengan password yang ada di database
	if(!password_verify($pwd, $user->password)){
		//jika password tidak terverifikasi
		echo "<script>alert('Login Gagal, Password salah.'); window.location = 'login.php'</script>";
		die();
	}

	//jika password terverifikasi maka user akan disimpan dalam session
	session_start();
	$_SESSION['email'] = $user->email;
	$_SESSION['nama'] = $user->nama;
	$_SESSION['status'] = $user->status;
	$_SESSION['no_telp'] = $user->no_telp;
	
	//print_r($user);
	header('Location:index.php');
}else{
   echo "<script>alert('Login Gagal, User tidak ditemukan.'); window.location = 'login.php'</script>";
}
?>