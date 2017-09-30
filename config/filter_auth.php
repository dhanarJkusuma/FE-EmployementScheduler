<?php
  include "configure_auth.php";

  session_start();
  $HOST = (($SSL) ? "https://" : "http://") . $_SERVER['SERVER_NAME'];
  $HOSTNAME = str_replace($HOST, "", $BASE_URL);
  $PATH = str_replace($HOSTNAME,"",$_SERVER['REQUEST_URI']);
  $routes = Authentication::protectedRoutes();

  if(in_array($PATH, $routes)){
    if(!isset($_SESSION['status'])){
      require_once("pages/401.php");
      die();
    }
  }
  foreach ($routes as $key => $value){
    if(strpos($key, "*") !== false){
      if(strpos($key, "*") == strlen($key)-1){
        $zkey = str_replace("*","", $key);
        if(strpos($PATH, $zkey) !== false){
          require_once("pages/401.php");
          die();
        }
      }
    }
  }

?>
