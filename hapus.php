<?php
if (isset($_GET['hapus'])) {
	require "config/main.php";
	switch ($_GET['hapus']) {
		case 'data_user':
			mysql_query("DELETE FROM user1 WHERE id=".$_GET['id']);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'data_pelanggan':
			mysqli_query($conn, "DELETE FROM pelanggan WHERE id=".$_GET['id']);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'data_pembelian':
			mysql_query("DELETE FROM user WHERE id=".$_GET['id']);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'data_teknisi':
			mysqli_query($conn, "DELETE FROM pengguna WHERE id=".$_GET['id']);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'spk':
			mysqli_query($conn, "DELETE FROM teknisi WHERE id=".$_GET[id]);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'admin':
			mysql_query("DELETE FROM admin WHERE id=".$_GET[id]);
			header('Location:index.php?page='.$_GET['hapus']);
			break;

		default:
			require_once("pages/404.php");
			break;
	}
}
else {
	require_once("pages/home.php");
}

 ?>
