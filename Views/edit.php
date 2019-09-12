<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Editar Perfil </title>
  </head>
  <body>
    <?php 
      if(!empty($message)){
        echo "<p>" .$message. "</p>";
      }
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>">
      <div>
        <label>
          Descrição
          <input type="text" name="description" required><?php echo $data[0]["description"];?> 
        </label>
      </div>
      <div>
        <label>
          Url
          <input type="text" name="url" required><?php echo $data[0]["url"];?> 
        </label>
      </div>
      <!-- <div>
            <label>
                Imagem
                <input type="file" name="picture" accept="image/*" required>
            </label>
        </div> -->
        
        <input type="hidden" name="profile_id" value="<?php echo $data[0]["profile_id"];?>">
        <button type="submit" name="send">Editar</button>
      </div>
    </form>

    <nav> 
      <a href="<?php echo ROOT;?>">Voltar</a>
    </nav>
  </body>
</html>