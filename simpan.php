<?php

require "config/main.php";
$type = trim($_POST['type']);
$cmd = trim($_POST['cmd']);

switch ($type) {
	//DATA User
	case 'data_user':
		if ($cmd=="tambah") {
			$isUserExist = "SELECT * FROM pengguna WHERE email='$_POST[email]'";
			$isUserExistCmd = mysqli_query($conn, $isUserExist);
			if(mysqli_num_rows($isUserExistCmd) > 0){
				echo "<script>alert('Gagal menambahkan pengguna, email sudah ada.'); window.location = 'tambah.php?tambah=data_user'</script>";
				die();
			}
			if($_POST['password'] == $_POST['password_confirmation']){
				$password = password_hash($_POST[password], PASSWORD_BCRYPT);
				mysqli_query($conn, "INSERT INTO pengguna(email, nama, password, no_telp, status)
				VALUES('$_POST[email]',
						'$_POST[nama]',
						'$password',
						'$_POST[no_telp]',
						'$_POST[role]')");
			}else{
				echo "<script>alert('Gagal menambahkan pengguna, password tidak sama.'); window.location = 'tambah.php?tambah=data_user'</script>";
				die();
			}

		}
		elseif($cmd=="edit") {
			$isUserExist = "SELECT * FROM pengguna WHERE email='$_POST[email]' and id<>'$_POST[id]'";
			$isUserExistCmd = mysqli_query($conn, $isUserExist);
			if(mysqli_num_rows($isUserExistCmd) > 0){
				echo "<script>alert('Gagal menambahkan pengguna, pengguna dengan email ". $_POST[email] ." sudah ada.'); window.location = 'tambah.php?tambah=data_user'</script>";
				die();
			}
			$res = mysqli_query($conn, "SELECT * FROM pengguna WHERE id='$_POST[id]'");
			$user = mysqli_fetch_object($res);
			$query_update =
				"UPDATE pengguna SET
					email='$_POST[email]',
					nama='$_POST[nama]',
					no_telp='$_POST[no_telp]',
					status='$_POST[role]'";


				if($_POST['password'] == $_POST['password_confirmation']){
					if($user->password != $_POST['password']){
						$password = password_hash($_POST['password'],
							PASSWORD_BCRYPT);
						$query_update .= " ,password='$password'";
					}
				}else{
					echo "<script>alert('Gagal menambahkan pengguna, password tidak sama.'); window.location = 'edit.php?edit=data_user&id=". $_POST['id'] ."'</script>";
					die();
				}



			$query_update .= " WHERE id='$_POST[id]'";
			mysqli_query($conn, $query_update);
		}
		else {
			die(); //jika bukan tambah atau edit, lalu apa ? die aja lah :p
		}
		header('Location:index.php?page=data_user');
	break;
//DATA PELANGGAN
	case 'data_pelanggan':
		if ($cmd=="tambah") {
			$isDataExist = "SELECT * FROM pelanggan WHERE email='$_POST[email]'";
			$isDataExistCmd = mysqli_query($conn, $isDataExist);
			if(mysqli_num_rows($isDataExistCmd) > 0){
				echo "<script>alert('Gagal menambahkan pelanggan, pelanggan dengan email ". $_POST[email] ." sudah ada.'); window.location = 'tambah.php?tambah=data_pelanggan'</script>";
				die();
			}
			mysqli_query($conn, "INSERT INTO pelanggan(nama, email, alamat, website, no_telp)
			VALUES('$_POST[nama]',
					'$_POST[email]',
					'$_POST[alamat]',
					'$_POST[website]',
					'$_POST[no_telp]')");
		}
		elseif($cmd=="edit") {
			$isDataExist = "SELECT * FROM pelanggan WHERE email='$_POST[email]' and id<>'$_POST[id]'";
			$isDataExistCmd = mysqli_query($conn, $isDataExist);
			if(mysqli_num_rows($isDataExistCmd) > 0){
				echo "<script>alert('Gagal menambahkan pelanggan, pelanggan dengan email ". $_POST[email] ." sudah ada.'); window.location = 'tambah.php?tambah=data_pelanggan'</script>";
				die();
			}
			$query_update =
				"UPDATE pelanggan SET
					nama='$_POST[nama]',
					email='$_POST[email]',
					alamat='$_POST[alamat]',
					website='$_POST[website]',
					no_telp='$_POST[no_telp]'
					 WHERE id='$_POST[id]'";

			mysqli_query($conn, $query_update);
		}
		else {
			die(); //jika bukan tambah atau edit, lalu apa ? die aja lah :p
		}
		header('Location:index.php?page=data_pelanggan');
	break;
//DATA PIC
	case 'data_pic':
		if ($cmd=="tambah") {
			$isDataExist = "SELECT * FROM pic WHERE email='$_POST[email]'";
			$isDataExistCmd = mysqli_query($conn, $isDataExist);
			if(mysqli_num_rows($isDataExistCmd) > 0){
				echo "<script>alert('Gagal menambahkan data pic, pic dengan email ". $_POST[email] ." sudah ada.'); window.location = 'tambah.php?tambah=data_pelanggan'</script>";
				die();
			}
			mysqli_query($conn, "INSERT INTO pic(pelanggan_id, nama, email,no_telp)
			VALUES('$_POST[pelanggan]',
					'$_POST[nama]',
					'$_POST[email]',
					'$_POST[no_telp]')");
		}
		elseif($cmd=="edit") {
			$isDataExist = "SELECT * FROM pic WHERE email='$_POST[email]' and id<>'$_POST[id]'";
			$isDataExistCmd = mysqli_query($conn, $isDataExist);
			if(mysqli_num_rows($isDataExistCmd) > 0){
				echo "<script>alert('Gagal menambahkan data pic, pic dengan email ". $_POST[email] ." sudah ada.'); window.location = 'tambah.php?tambah=data_pelanggan'</script>";
				die();
			}
			$query_update =
				"UPDATE pic SET
					pelanggan_id='$_POST[pelanggan]',
					nama='$_POST[nama]',
					email='$_POST[email]',
					no_telp='$_POST[no_telp]'
					 WHERE id='$_POST[id]'";

			mysqli_query($conn, $query_update);
		}
		else {
			die(); //jika bukan tambah atau edit, lalu apa ? die aja lah :p
		}
		header('Location:index.php?page=data_pic');
	break;
//DATA TIPE AGENDA
	case 'data_tipe_agenda':
		if ($cmd=="tambah") {
			mysqli_query($conn, "INSERT INTO agenda_tipe(nama, warna)
			VALUES('$_POST[nama]',
					'$_POST[warna]')");
		}
		elseif($cmd=="edit") {
			$query_update =
				"UPDATE agenda_tipe SET
					nama='$_POST[nama]',
					warna='$_POST[warna]'
					 WHERE id='$_POST[id]'";

			mysqli_query($conn, $query_update);
		}
		else {
			die(); //jika bukan tambah atau edit, lalu apa ? die aja lah :p
		}
		header('Location:index.php?page=data_tipe_agenda');
	break;

	default:
		require_once("pages/404.php");
		break;
}

 ?>
