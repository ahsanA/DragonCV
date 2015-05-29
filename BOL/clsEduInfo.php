<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsEduInfo
 *
 * @author tokaai
 */
require_once 'DAL/db.class.php';
require_once 'DTO/clsEducation.php';

class clsEduInfo {

    public function InsertEduInfo($userId, $degree, $insName, $passYear, $result) {
        $db = new db();
        $db->connect();
        $retVal = $db->insert('opencv_education', array($userId, $degree, $result, $insName, $passYear), "user_id, degree, exam_result, institute_name, passing_year");
        return $retVal;
    }

    public function UpdateEduInfo($id, $degree, $insName, $passYear, $result) {
        $db = new db();
        $db->connect();
        $retVal = $db->update('opencv_education', array('degree' => $degree, 'exam_result' => $result, 'institute_name' => $insName, 'passing_year' => $passYear), array('id=' . $id));
        return $retVal;
    }

    public function DeleteEduInfo($id) {
        $db = new db();
        $db->connect();
        $retVal = $db->delete('opencv_education', 'id=' . $id);
        return $retVal;
    }

    public function GetEduHistory($userId) {
        $db = new db();
        $db->connect();
        $db->select('opencv_education', '*', "user_id=" . $userId);
        $retVal = $db->getResult();
        return $retVal;
    }

    public function GetSingleEduId($userId, $degree, $passYear) {
        $db = new db();
        $db->connect();
        $where = "user_id=" . $userId . " AND " . "degree='" . $degree . "' AND " . "passing_year=" . $passYear;
        $db->select('opencv_education', 'id', $where);
        $retVal = $db->getResult();
        return $retVal;
    }

    public function GetSingleEduHistory($id) {
        $db = new db();
        $db->connect();
        $where = "id=" . $id;
        $db->select('opencv_education', '*', $where);
        $retVal = $db->getResult();
        return $retVal;
    }

    public function GetHighestEduInfo($userId) {
        $db = new db();
        $db->connect();
        $where = "user_id=" . $userId;
        $db->select('opencv_education', 'degree', $where);
        $retVal = $db->getResult();
        $max = 0;
        foreach ($retVal as $degree) {
            if (isset($degree['degree'])) {
                if ($degree['degree'] > $max) {
                    $max = $degree['degree'];
                }
            } else {
                $max = $degree;
            }
        }

        return $max;
    }

}
