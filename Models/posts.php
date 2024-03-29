<?php
require_once("base.php");

class Post extends Base {
    public function getPostId($post_id) {
        $query = $this->db->prepare("
            SELECT p.post_id, p.title, p.image, p.description, p.created_at, u.user_id, u.username, pf.picture
            FROM posts AS p
            INNER JOIN users AS u USING(user_id)
            INNER JOIN profiles AS pf USING(user_id)
            WHERE p.post_id = ?
        ");

        $query->execute([
            $post_id
          ]);
  
        $posts = $query->fetchAll( PDO::FETCH_ASSOC );
        return $posts;

    }

    public function getPost($user_id) {
        $query = $this->db->prepare("
            SELECT p.post_id, p.title, p.image, p.description, p.created_at, u.user_id, u.username, s.picture
            FROM posts AS p
            INNER JOIN users AS u USING(user_id)
            INNER JOIN profiles AS s USING(user_id)
            WHERE p.user_id = ? 
        ");

        $query->execute([
            $user_id
          ]);
  
        $posts = $query->fetchAll( PDO::FETCH_ASSOC );
        return $posts;

    }
    public function postList() {
        $query = $this->db->prepare("
            SELECT p.post_id, p.title, p.image, p.description, p.created_at, u.user_id, u.username, s.picture
            FROM posts AS p
            INNER JOIN users AS u USING(user_id)
            INNER JOIN profiles AS s USING(user_id)
            ORDER BY p.created_at DESC  
        ");

        $query->execute();
  
        $posts = $query->fetchAll( PDO::FETCH_ASSOC );
        return $posts;

    }

    public function createPost($data) {
        $allowed_types = [
            "jpg" => "image/jpeg",
            "png" => "image/png"
        ];

        if(
            !empty($data["title"]) &&
            isset($_SESSION["user_id"]) &&
            isset($_FILES["image"]) &&
            $_FILES["image"]["size"] > 0 &&
            $_FILES["image"]["error"] === 0 &&
            in_array($_FILES["image"]["type"], $allowed_types)
            
        ){
            $file_extension = array_search($_FILES["image"]["type"],$allowed_types);
            $filename = date("YmdHis") ."_". mt_rand(100000, 999999).".".$file_extension;

            $query = $this->db->prepare("
                INSERT INTO posts (title, image, description, user_id)
                VALUES (?, '".$filename."', ?, ?)
            ");

            $query->execute([
                ucfirst($data["title"]),
                ucfirst($data["description"]),
                $_SESSION["user_id"]
            ]);

            move_uploaded_file($_FILES["image"]["tmp_name"], "post_uploads/".$filename);
            $post_id = $this->db->lastInsertId();
            header("Location: " .ROOT."posts/view_post/".$post_id);

            return "ok";

        }
        else {
            return "Preencha os campos";
        }
    }

    public function editPost($data) {
        $allowed_types = [
            "jpg" => "image/jpeg",
            "png" => "image/png"
        ];

        if(
            !empty($data["title"]) &&
            isset($_SESSION["user_id"]) &&
            isset($_FILES["image"]) &&
            $_FILES["image"]["size"] > 0 &&
            $_FILES["image"]["error"] === 0 &&
            in_array($_FILES["image"]["type"], $allowed_types)
            
        ){
            $file_extension = array_search($_FILES["image"]["type"],$allowed_types);
            $filename = date("YmdHis") ."_". mt_rand(100000, 999999).".".$file_extension;

            $query = $this->db->prepare("
                UPDATE posts 
                SET title = ?, description = ?, image = '".$filename."'
                WHERE post_id = ?
                    AND user_id = ?
            ");

            $query->execute([
                ucfirst($data["title"]),
                ucfirst($data["description"]),
                $data["post_id"],
                $_SESSION["user_id"]
            ]);

            move_uploaded_file($_FILES["image"]["tmp_name"], "post_uploads/".$filename);
            header("Location: " .ROOT. "posts/view_post/".$data["post_id"]."");
            return "ok";

        }
        else {
            return "Preencha os campos";
        }
    }

    public function deletePost($post_id) {

        $query = $this->db->prepare("
            DELETE FROM posts
            WHERE post_id = ?
                AND user_id = ?
        ");

        $result = $query->execute([
            $post_id,
            $_SESSION["user_id"]
        ]);

        if($result) {
            return json_encode([
                "status" => "Ok",
                "message" => "Processo concluido com sucesso"
            ]);
            
        }
        else{
            return json_encode([
                "status" => "Error",
                "message" => "Ocorreu um erro a apagar o post"
            ]);

        }
    }
 }

?>