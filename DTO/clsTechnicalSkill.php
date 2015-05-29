<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsTechnicalSkill
 *
 * @author tokaai
 */
class clsTechnicalSkill {
    
    private $_id;
    private $_userId;
    private $_name = null;
    private $_yrExp;
    
    public function set_id($value){
        $this->_id = $value;
    }
    public function get_id(){
        return $this->_id;
    }
    
    public function set_userId($value){
        $this->_userId = $value;
    }
    public function get_userId(){
        return $this->_userId;
    }
    
    public function set_name($value){
        $this->_name = $value;
    }
    public function get_name(){
        return $this->_name;
    }
    
    public function set_password($value){
        $this->_yrExp = $value;
    }
    public function get_password(){
        return $this->_yrExp;
    }
}
