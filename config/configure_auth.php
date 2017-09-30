<?php
class Authentication{
  public static function protectedRoutes(){
    return array(
      "/index.php",
      "/?page=data_user",
      "/edit.php?edit=data_user*",
      "/hapus.php?hapus=data_user*",
      "/?page=data_pelanggan",
      "/edit.php?edit=data_pelanggan*",
      "/hapus.php?hapus=data_pelanggan*",
      "/?page=data_pic",
      "/edit.php?edit=data_pic*",
      "/hapus.php?hapus=data_pic*",
      "/?page=data_tipe_agenda",
      "/edit.php?edit=data_tipe_agenda*",
      "/hapus.php?hapus=data_tipe_agenda*",
      "/logout.php"
    );
  }
}
?>
