<?php

namespace Stondark\Instagramtest\models;

use PDOException;
use Stondark\Instagramtest\libs\Model;

class Like extends Model{

    private int $id;

    public function __construct(private int $post_id, private int $user_id){
        parent::__construct(); 
    }

    public function save(){
        try {
            $query = $this->prepare("INSERT INTO likes (post_id, user_id) VALUES(:post_id, :user_id)");
            $query->execute([
                "post_id" => $this->post_id,
                "user_id" => $this->user_id
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
            //throw $th;
        }
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getPostId(){
        return $this->postId;
    }

    public function setUserId(int $id){
        $this->id = $id;
    }

    public function getUserId(): int{
        return $this->user_id;
    }


}