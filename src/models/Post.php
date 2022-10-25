<?php 

namespace Stondark\Instagramtest\models;

use Stondark\Instagramtest\libs\Model;

use PDO;
use PDOException;

class Post extends Model{

    private int $id;
    private array $likes;
    private User $user; 

    protected function __construct(private String $title)
    {
        parent::__construct();
        $this->likes = [];
    }

    public function getId():string{
        return $this->id;
    }

    public function setId(string $id){
        $this->id = $id;
    }
    
    public function getTitle():string{
        return $this->title;
    }

    public function getLikes():string{
        return count($this->likes);
    }

    public function fetchLikes(){
        $items = [];
        try {
            $query = $this->prepare("SELECT * FROM likes WHERE post_id = :post_id");
            $query->execute(["post_id" => $this->id]);
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Like($p["post_id"], $p['user_id']);
                $item->setId($p['id']);
               
                array_push($items, $item);
            }
            print_r($items);
            $this->likes = $items;

        } catch (PDOException $e) {
            //throw $th;
        }
    }

    protected function addLike(User $user){
        $like = new Like($this->id, $user->getId());
        $like->save();
        array_push($this->likes, $like);
    }

    public function setUser(User $user){
        $this->user = $user;
    }

}