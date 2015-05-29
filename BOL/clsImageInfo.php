<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsImageInfo
 *
 * @author tokaai
 *
 * 
 */
class clsImageInfo {
    public function InsertImage($userId, $path){
        $db = new db();
        $db->connect();
        $retVal = $db->insert('opencv_image', array($userId, $path), "user_id, image_path");
        return $retVal;
    }
    
    public function SelectImage($userId){
        $db = new db();
        $db->connect();
        $db->select('opencv_image', '*', "user_id=" . $userId);
        $retVal = $db->getResult();
        return $retVal;
    }

        public function DeleteImage($userId){
        $db = new db();
        $db->connect();
        $retVal = $db->delete('opencv_image', 'user_id='.$userId);
        return $retVal;
    }
}

?>
