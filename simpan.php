<?php

require "config/main.php";
$type = trim($_POST['type']);
$cmd = trim($_POST['cmd']);

switch ($type) {
	//DATA User
	case 'data_user':
		if ($cmd=="tambah") {
			if($_POST['password'] == $_POST['password_confirmation']){
				$password = password_hash($_POST[password], PASSWORD_BCRYPT);
				mysqli_query($conn, "INSERT INTO pengguna(email, nama, password, no_telp, status)
				VALUES('$_POST[email]',
						'$_POST[nama]',
						'$password',
						'$_POST[no_telp]',
						'$_POST[role]')");
			}else{
				echo "<script>alert('Gagal menambahkan teknisi, password tidak sama.'); window.location = 'tambah.php?tambah=data_user'</script>";
				die();
			}

		}
		elseif($cmd=="edit") {
			$res = mysqli_query($conn, "SELECT * FROM pengguna WHERE id='$_POST[id]'");
			$user = mysqli_fetch_object($res);
			$query_update =
				"UPDATE pengguna SET
					email='$_POST[email]',
					nama='$_POST[nama]',
					no_telp='$_POST[no_telp]',
					status='$_POST[role]'";

			if($user->password != $_POST['password']){
				if($_POST['password'] == $_POST['password_confirmation']){
					$password = password_hash($_POST['password'],
						PASSWORD_BCRYPT);
					$query_update .= " ,password='$password'";
				}else{
					echo "<script>alert('Gagal menambahkan teknisi, password tidak sama.'); window.location = 'edit.php?edit=data_user&id=". $_POST['id'] ."'</script>";
					die();
				}

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
			mysqli_query($conn, "INSERT INTO pelanggan(nama, email, alamat, website, no_telp)
			VALUES('$_POST[nama]',
					'$_POST[email]',
					'$_POST[alamat]',
					'$_POST[website]',
					'$_POST[no_telp]')");
		}
		elseif($cmd=="edit") {
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
			mysqli_query($conn, "INSERT INTO pic(pelanggan_id, nama, email,no_telp)
			VALUES('$_POST[pelanggan]',
					'$_POST[nama]',
					'$_POST[email]',
					'$_POST[no_telp]')");
		}
		elseif($cmd=="edit") {
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


//DATA ADMIN
	case 'admin':
		if ($cmd=="tambah") {
			mysql_query("INSERT INTO admin(nama,username,password)
			VALUES('$_POST[nama]',
			'$_POST[username]',
			'$_POST[password]')");
		}
		elseif($cmd=="edit") {
			mysql_query("UPDATE admin SET nama='$_POST[nama]',
				username='$_POST[username]',
				password='$_POST[password]'
				WHERE id=".$_POST[id]);

		}
		else {
			die(); //jika bukan tambah atau edit, lalu apa ? die aja lah :p
		}
		header('Location:index.php?page=admin');
		break;

	default:
		require_once("pages/404.php");
		break;
}

 ?>
