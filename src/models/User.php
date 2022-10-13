<?php

namespace Stondark\Instagramtest\models;

use Error;
use PDO;
use PDOException;
use Stondark\Instagramtest\libs\Database;
use Stondark\Instagramtest\libs\Model;

class User extends Model{

    private int $id;
    private array $post;
    private string $profile;

    public function __construct(
        private string $username, 
        private string $password
        )
    {
        parent::__construct();
        $this->post = [];
        $this->profile = "";

    }

    public function save(){
        try{
            if($this->exist($this->username)){
                return false;
            } else{    
                $hash = $this->getHashedPassword($this->password);
                $query = $this->prepare("INSERT INTO users(username, password, profile )
                                        VALUES(:username, :password, :profile)");
                $query->execute([
                    "username" => $this->username,
                    "password" => $hash,
                    "profile" => $this->profile
                ]);
                return true;
            }

        }catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    private function getHashedPassword(string $password){ 
        return password_hash($password, PASSWORD_DEFAULT, ["cost" => 10]); // Cost = complejidad 
    }

    public static function exist(string $username){
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT username FROM users WHERE username = :username");
            $query->execute([
                "username" => $username 
            ]);
            return $query->rowCount() >= 1 ? true : false;
        } catch(PDOException $e){
            return false;
        }


    }

    public function comparePassword(string $password): bool{
        return password_verify($password, $this->password);
    }

    public static function getUser(string $username): User{
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT * FROM users WHERE username = :username");
            $query->execute([
                "username" => $username
            ]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $user = new User($data["username"], $data["password"]);
            $user->setID($data["user_id"]); 
            $user->setProfile($data["profile"]);
            
            return $user;
        } catch(PDOException $e){
            error_log($e->getMessage());
            return NULL;
        }
    }

    public function getID(){
        return $this->id;
    }

    public function setID($value){
        $this->id = $value;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($value){
        $this->username = $value;
    }
    public function getProfile(){
        return $this->profile;
    }

    public function setProfile($value){
        $this->profile = $value;
    }
    public function getPosts(){
        return $this->post;
    }

    public function setPosts($value){
        $this->post = $value;
    }

}