<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Gerir Perfis</title>
    <link rel="stylesheet" type="text/css" href="/PF/Project/css/home.css">
  </head>
  <body>
    <div id="wrapper">
        <header>
            <div class="menu"> 
                <div class="logo-wrapper"> 
                    <a href="<?php echo ROOT;?>">
                        <img src="/PF/Project/img/logo1.png" alt="logo">
                    </a>
                </div>
                <nav>
                    <?php
                    if(!isset($_SESSION["admin_id"])) {
                        echo '
                        <a href="'. ROOT .'admin/admin_register">Criar Conta</a>
                        <a href="'. ROOT .'admin/admin_login">Login</a>
                        ';
                    }
                    else {
                    
                        echo '<a href="'.ROOT.'admin/admin_home/'.$admin[0]["admin_id"].'">Home</a> ';

                        echo '<a href="'.ROOT.'admin/manage_profiles">Gerir Perfis</a> ';

                        echo '<a href="'.ROOT.'admin/manage_posts">Gerir Posts</a> ';
                        
                        echo '<a href="'.ROOT.'admin/admin_logout">Logout</a>';
                    }
                    ?>
                </nav>
            </div>
        </header>
        <main>
            <div>
                <ul>
                    <?php
                        foreach($profiles as $profile) {
                            echo '
                                <li>Id '.$profile["profile_id"].'</li>
                                <li>Descrição '.$profile["description"].'</li>
                                <li>Url '.$profile["url"].'</li>
                                <li>Url <img src="/PF/Project/uploads/'.$profile["picture"].'" alt="Imagem de perfil"></li>
                            ';

                        }
                    ?>
                </ul>
                    
            </div>
        
        
            
        </main>
        <!-- <footer>
            <div class="footer">
                <ul>
                    <li>©2019 <a href="https://www.flag.pt/">Flag</a></li>
                    <li><a href="">Sobre</a></li>
                    <li><a href="">Declaração de Privacidade</a></li>
                    <li><a href="">Termos de Serviço</a></li>
                </ul>
            </div>
        </footer> -->
    </div>
    
  </body>
</html>