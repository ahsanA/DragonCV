<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsImage
 *
 * @author tokaai
 */
class clsImage {

    //put your code here

    private $_id;
    private $_userId;
    private $_path = null;

    public function set_id($value) {
        $this->_id = $value;
    }

    public function get_id() {
        return $this->_id;
    }

    public function set_userId($value) {
        $this->_userId = $value;
    }

    public function get_userId() {
        return $this->_userId;
    }    

    public function set_path($value) {
        $this->_path = $value;
    }

    public function get_path() {
        return $this->_path;
    }

    public function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

}
