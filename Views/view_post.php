<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Post - <?php echo $data[0]["title"];?></title>
    <link rel="stylesheet" type="text/css" href="/PF/Project/css/home.css">
    <link rel="stylesheet" type="text/css" href="/PF/Project/css/post.css">
    <script src="/PF/Project/js/scripts.js"></script>
  </head>
  <body>
    <header>
        <div class="menu"> 
            <div class="logo-wrapper"> 
                <a href="<?php echo ROOT;?>">
                    <img src="/PF/Project/img/logo1.png" alt="logo">
                </a>
            </div>
            <nav>
            <?php
                if(!isset($_SESSION["user_id"]) && !isset($_SESSION["admin_id"])) {
                  echo '
                    <a href="'. ROOT .'access/register">Criar Conta</a>
                    <a href="'. ROOT .'access/login">Login</a>
                  ';
                }
                else {
                  foreach ($data as $post) {
                    if(isset($_SESSION["user_id"]) && $post["user_id"] === $_SESSION["user_id"]) {

                        echo '<a href="'.ROOT.'posts/edit_post/'.$post["post_id"].'">Editar Post</a>';                          
            ?>
            <button type="button" name="delete" id="deleteB" value="<?php echo $data[0]["post_id"];?>">Apagar Post</button>
            <?php
                      }
                  } 
                  if(!isset($_SESSION["admin_id"])) {

                    echo '<a href="'.ROOT.'create/profile/'.$datas[0]["user_id"].'">Perfil</a>';
                  }
                    
                  echo '<a href="'.ROOT.'access/logout">Logout</a>';
                }
            ?>
            </nav>
        </div>
    </header>
    <main class="post-wrapper">
      <div class="post-wleft">
        <h1><?php echo $data[0]["title"];?></h1>
        <img src="/PF/Project/post_uploads/<?php echo $data[0]["image"];?>" alt="img">
      </div>
      <div class="post-wright">
        <div class="post-wsright">
          <img src="/PF/Project/uploads/<?php echo $data[0]["picture"];?>" alt="img">
          <h2><a href="<?php echo ROOT.'create/profile/'.$data[0]["user_id"].'';?>"><?php echo ucfirst($data[0]["username"]);?></a></h2>
        </div>
        <p class="description"><?php echo $data[0]["description"];?></p>
        <div>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>">
              <div>
                <label>
                  Comentario
                  <input type="text" name="message" required>
                </label>
              </div>
              <div>
                <input type="hidden" name="post_id" value="<?php echo $data[0]["post_id"];?>">
                <button type="submit" name="send" class="form-button">Publicar</button>
              </div>
          </form>
          <?php 
            foreach ($comments as $comment) {
              echo ' 
                  <div id="comment-info" data-comment_id="'.$comment["comment_id"].'">
                    <div class="comment-wrapper">
                      <div class="comment-username"><a href="'.ROOT.'create/profile/'.$comment["user_id"].'">'.ucfirst($comment["username"]).'</a></div>
                      <div>'.strftime("%e %b %Y - %H:%M", strtotime($comment["post_date"])).'</div>
                    </div>
                    <p id="text">'.$comment["message"].'</p>
                  </div>
              '; 
                    
              if(isset($_SESSION["user_id"]) && $comment["user_id"] === $_SESSION["user_id"]){
                echo '
                  <div class="comment-button-wrapper">
                    <textarea id="newcomment"></textarea>
                    <button type="button" name="edit" id="editButton">Editar</button>
                    <button type="button" name="delete" id="deleteComment">Apagar</button>
                  </div>
                ';
              }                         
            } 
          ?>
        </div>
      </div>
      <input type="hidden" name="post_id" value="<?php echo $data[0]["post_id"];?>">
    </main>
  </body>
</html>

