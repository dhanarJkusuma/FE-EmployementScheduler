<?php
  include "configure_role.php";

  $HOST = (($SSL) ? "https://" : "http://") . $_SERVER['SERVER_NAME'];
  $HOSTNAME = str_replace($HOST, "", $BASE_URL);
  $PATH = str_replace($HOSTNAME,"",$_SERVER['REQUEST_URI']);
  $rules = Configuration::rules();


  if(array_key_exists($PATH, $rules)){
    $roles = $rules[$PATH];
    if(!in_array($_SESSION['status'], $roles)){
      require_once("pages/403.php");
      die();
    }
  }
  foreach ($rules as $key => $value){
    if(strpos($key, "*") !== false){
      if(strpos($key, "*") == strlen($key)-1){
        $zkey = str_replace("*","", $key);
        if(strpos($PATH, $zkey) !== false){
          $roles = $rules[$key];
          if(!in_array($_SESSION['status'], $roles)){
            require_once("pages/403.php");
            die();
          }
        }
      }
    }
  }

?>
