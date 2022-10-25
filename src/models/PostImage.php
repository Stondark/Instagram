<?php


namespace Stondark\Instagramtest\models;

use Stondark\Instagramtest\libs\Database;
use PDO;
use PDOException;

class PostImage extends Post{

    public function __construct(private string $title, private string $image){
        
        parent::__construct($title);
    }

    public function getImage(){
        return $this->image;
    }

    public static function getFeed(){
        $items = [];
        try {
            $db = new Database();
            $query = $db->connect()->prepare("SELECT * FROM posts");
            $query->execute();
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PostImage($p["title"], $p["media"]);
                $item->setId($p["post_id"]);
                $item->fetchLikes();
                $user = User::getUserById($p["user_id"]);
                $item->setUser($user);
                array_push($items, $item);
            }

            return $items;

        } catch (PDOException $e) {
            error_log($e);
        }
    }
    

}