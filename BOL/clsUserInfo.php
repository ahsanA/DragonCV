<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BOL/clsUserInfo
 *
 * @author tokaai
 */
require_once 'DAL/db.class.php';
require_once 'DTO/clsUser.php';

class clsUserInfo {

    //put your code here

    public function InsertNewUser($email, $salt, $pass, $scrName) {
        $db = new db();
        $db->connect();
        $retVal = $db->insert('opencv_users', array($email, $salt, $pass, $scrName, 0), "email, salt, pass, screen_name, activated");

        return $retVal;
    }

    public function InsertPersonalInfo($userId, $name, $fatherName, $motherName, $presentAddress, $permanentAddress, $gender, $maritalStatus, $religion, $bloodGroup, $cell, $careerObj, $ref1, $ref2) {
        $db = new db();
        $db->connect();
        $retVal = $db->insert('opencv_user_info', array($userId, $name, $fatherName, $motherName, $presentAddress, $permanentAddress, $gender, $maritalStatus, $religion, $bloodGroup, $cell, $careerObj, $ref1, $ref2), "user_id, name, father_name, mother_name, present_address, parmanent_address, gender, marital_status, religion, blood_group, cell, cr_obj, ref_1, ref_2");

        return $retVal;
    }
    
    public function UpdatePersonalInfo($userId, $name, $fatherName, $motherName, $presentAddress, $permanentAddress, $gender, $maritalStatus, $religion, $bloodGroup, $cell, $careerObj, $ref1, $ref2){
        $db = new db();
        $db->connect();
        $retVal = $db->update('opencv_user_info', array('name'=>$name, 'father_name'=>$fatherName, 'mother_name'=>$motherName, 'present_address'=>$presentAddress, 'parmanent_address'=>$permanentAddress, 'gender'=>$gender, 'marital_status'=>$maritalStatus, 'religion'=>$religion, 'blood_group'=>$bloodGroup, 'cell'=>$cell, 'cr_obj'=>$careerObj, 'ref_1'=>$ref1, 'ref_2'=>$ref2), array('user_id=' . $userId));
        return $retVal;
    }

        public function GetSinglePerson($userId){
        $db = new db();
        $db->connect();
        $where = "user_id=" . $userId;
        $db->select('opencv_user_info', '*', $where);
        $retVal = $db->getResult();
        
        return $retVal;
    }
    
    public function GetEmail($userId){
        $db = new db();
        $db->connect();
        $where = "user_id=" . $userId;
        $db->select('opencv_users', 'email', $where);
        $retVal = $db->getResult();
        
        return $retVal;
    }

    public function ActivateUser($id){
        $db = new db();
        $db->connect();
       
        $retVal = $db->update('opencv_users', array('activated' => 1), array('user_id=' . $id));
        
        return $retVal;
    }
    
    public function GetAllUser(){
        $db = new db();
        $db->connect();
        $db->select('opencv_user_info', 'user_id, name');
        $retVal = $db->getResult();        
        return $retVal;
    }

    public function SelectUserForLogIn($email) {
        $db = new db();
        $user = new clsUser;
        $db->connect();

        $db->select('opencv_users', '*', "email='" . $email . "'");

        $retVal = $db->getResult();

        $user->set_userId($retVal["user_id"]);
        $user->set_email($retVal["email"]);
        $user->set_salt($retVal["salt"]);
        $user->set_password($retVal["pass"]);
        $user->set_screenName($retVal["screen_name"]);
        $user->set_isActive($retVal["activated"]);

        return $user;
    }
    
    public function DeleteCV($userId){
        $db = new db();
        $db->connect();
        $retVal = $db->delete('opencv_users', 'user_id='.$userId);
        return $retVal;
    }

}
