<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsUser
 *
 * @author tokaai
 */
class clsUser {
    //put your code here

    private $_userId;
    private $_email = null;
    private $_screenName = null;
    private $_password = null;
    private $_salt = null;
    private $_isActive = null;
    private $_name = null;
    private $_fatherName = null;
    private $_motherName = null;
    private $_presentAddr = null;
    private $_permanentAddr = null;
    private $_gender = null;
    private $_maritalStatus = null;
    private $_religion;
    private $_bloodGroup = null;
    private $_cell = null;
    private $_ref1 = null;
    private $_ref2 = null;
    private $_carreerObj = null;
    
    
    public function get_isActive(){
        return $this->_isActive;
    }
    
    public function set_isActive($value){
        $this->_isActive = $value;
    }

    public function set_userId($value){
        $this->_userId = $value;
    }
    public function get_userId(){
        return $this->_userId;
    }
    
    public function set_email($value){
        $this->_email = $value;
    }
    public function get_email(){
        return $this->_email;
    }
    
    public function set_screenName($value){
        $this->_screenName = $value;
    }
    public function get_screenName(){
        return $this->_screenName;
    }
    
    public function set_password($value){
        $this->_password = $value;
    }
    public function get_password(){
        return $this->_password;
    }
    
    public function set_salt($value){
        $this->_salt = $value;
    }
    public function get_salt(){
        return $this->_salt;
    }
    
    public function set_name($value){
        $this->_name = $value;
    }
    public function get_name(){
        return $this->_name;
    }
    
    public function set_fatherName($value){
        $this->_fatherName = $value;
    }
    public function get_fatherName(){
        return $this->_fatherName;
    }
        
    public function set_motherName($value){
        $this->_motherName = $value;
    }
    public function get_motherName(){
        return $this->_motherName;
    }
    
    public function set_presentAddress($value){
        $this->_presentAddr = $value;
    }
    public function get_presentAddress(){
        return $this->_presentAddr;
    }
    
    public function set_permanentAddress($value){
        $this->_permanentAddr = $value;
    }
    public function get_permanentAddress(){
        return $this->_permanentAddr;
    }
    
    public function set_gender($value){
        $this->_gender = $value;
    }
    public function get_gender(){
        return $this->_gender;
    }
    
    public function set_maritalStatus($value){
        $this->_maritalStatus = $value;
    }
    public function get_maritalStatus(){
        return $this->_maritalStatus;
    }
    
    public function set_cell($value){
        $this->_cell = $value;
    }
    public function get_cell(){
        return $this->_cell;
    }
    
    public function set_religion($value){
        $this->_religion = $value;
    }
    public function get_religion(){
        return $this->_religion;
    }
    
    public function set_bloodGroup($value){
        $this->_bloodGroup = $value;
    }
    public function get_bloodGroup(){
        return $this->_bloodGroup;
    } 
        
    public function set_ref1($value){
        $this->_ref1 = $value;
    }
    public function get_ref1(){
        return $this->_ref1;
    }
    
    public function set_ref2($value){
        $this->_ref2 = $value;
    }
    public function get_ref2(){
        return $this->_ref2;
    }
    
    public function set_carreerObj($value){
        $this->_carreerObj = $value;
    }
    public function get_carreerObj(){
        return $this->_carreerObj;
    }
    
}
