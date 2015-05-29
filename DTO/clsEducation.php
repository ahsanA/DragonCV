<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsEducation
 *
 * @author tokaai
 */
class clsEducation {
    //put your code here

    private $_id;
    private $_userId;
    private $_degree = null;
    private $_result;
    private $_institute = null;
    private $_passingYear;
    
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
    
    public function set_degree($value){
        $this->_degree = $value;
    }
    public function get_degree(){
        return $this->_degree;
    }
    
    public function set_result($value){
        $this->_result = $value;
    }
    public function get_result(){
        return $this->_result;
    }
    
    public function set_institute($value){
        $this->_institute = $value;
    }
    public function get_institute(){
        return $this->_institute;
    }
    
    public function set_passingYear($value){
        $this->_passingYear = $value;
    }
    public function get_passingYear(){
        return $this->_passingYear;
    }
}
