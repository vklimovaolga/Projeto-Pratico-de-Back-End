<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Efectuar Login</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
  </head>
  <body>
  <?php 
    if(isset($status) && $status === false){
      echo "<p>Preencha todos os campos correctamente</p>";
    }
  ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>">
    <div>
      <label>
        Username
        <input type="text" name="username" required>
      </label>
    </div>
    <div>
      <label>
        Password
        <input type="password" name="password" required>
      </label>
    </div>
    <div>
      <button type="submit" name="send">Login</button>
    </div>
    </form>
  </body>
</html>