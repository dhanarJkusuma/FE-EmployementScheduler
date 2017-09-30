<?php
class Configuration{
  public static function rules(){
    return array(
      "/?page=data_user" => ['sa','admin'],
      "/edit.php?edit=data_user*" => ['sa'],
      "/hapus.php?hapus=data_user*" => ['sa'],
      "/?page=data_pelanggan" => ['sa','admin'],
      "/edit.php?edit=data_pelanggan*" => ['sa','admin'],
      "/hapus.php?hapus=data_pelanggan*" => ['sa','admin'],
      "/?page=data_pic" => ['sa','admin','se'],
      "/edit.php?edit=data_pic*" => ['sa','admin'],
      "/hapus.php?hapus=data_pic*" => ['sa', 'admin'],
      "/?page=data_tipe_agenda" => ['sa', 'admin'],
      "/edit.php?edit=data_tipe_agenda*" => ['sa', 'admin'],
      "/hapus.php?hapus=data_tipe_agenda*" => ['sa', 'admin']
    );
  }
}
?>
