<?php 
 if(isset($_SESSION["user_id"])){
   require_once("models/profile.php"); 
   $model = new Profiles();
   $data = $model->getProfile($url_parts[3]);
 
  }
    
  require_once("views/home.php");


?>