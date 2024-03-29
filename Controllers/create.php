<?php 
require_once("models/profile.php");
require_once("models/posts.php");
require_once("models/admins.php");

  
$options = [ "profile", "edit", "create" ];

if(in_array($url_parts[4], $options)) {
  
  if(isset($_POST["send"])) {
    
    $model = new Profiles();
    
    $message = $model->{$url_parts[4]}($_POST);
  }
  
  
  if($url_parts[4] === "profile") {

    if(isset($url_parts[5])){

      $model = new Profiles();
      $data = $model->get($url_parts[5]);

      $model = new Post();
      $posts = $model->getPost($url_parts[5]);

      if(!isset($_SESSION["user_id"])){

        $model = new Admins();
        $admin = $model->get($url_parts[4]);

      }
      if(!isset($url_parts[5]) == $data) {
        header("HTTP/1.1 404 Not Found");
        die("404 - Pagina não existe");
      }
    }
  }
  
  if($url_parts[4] === "edit") {
    
    $model = new Profiles();
    $data = $model->getProfile($url_parts[4]);
    
  }

  require("views/".$url_parts[4].".php");

}

