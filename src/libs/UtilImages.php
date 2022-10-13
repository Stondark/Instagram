<?php

namespace Stondark\Instagramtest\libs;

class UtilImages{

    public static function StoreImage(array $photo):string{

        $target_dir = "public/img/photos";
        $extarr = explode(".", $photo["name"]);
        $filename = $extarr[count($extarr) -2]; 
        $ext = $extarr[count($extarr) - 1];
        $hash = md5(date("Ymdgi") . $filename) . "." . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = 1;
        $check = getimagesize($photo["tmp_name"]);

        $check !== false ? $uploadOk = 1 : $uploadOk = 0;

        if($uploadOk == 0){
            return "";
        } else{
            if(move_uploaded_file($photo["tmp_name"], $target_file)){
                return $hash;
            } else {
                return "";
            }
        }

    }
}
