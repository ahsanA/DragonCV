<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsTechnicalInfo
 *
 * @author tokaai
 */
class clsTechnicalInfo {

    public function InsertTechInfo($userId, $skillName, $yearOfExp) {
        $db = new db();
        $db->connect();
        $retVal = $db->insert('opencv_technical_skill', array($userId, $skillName, $yearOfExp), "user_id, name, year_of_exp");
        return $retVal;
    }

    public function UpdateTechInfo($id, $skillName, $yearOfExp) {
        $db = new db();
        $db->connect();
        $retVal = $db->update('opencv_technical_skill', array('name' => $skillName, 'year_of_exp' => $yearOfExp), array('id=' . $id));
        return $retVal;
    }

    public function DeleteTechInfo($id) {
        $db = new db();
        $db->connect();
        $retVal = $db->delete('opencv_technical_skill', 'id=' . $id);
        return $retVal;
    }

    public function GetTechSkillHistory($userId) {
        $db = new db();
        $db->connect();
        $db->select('opencv_technical_skill', '*', "user_id=" . $userId);
        $retVal = $db->getResult();
        return $retVal;
    }

    public function GetSingleTechSkillId($userId, $name, $yearOfExp) {
        $db = new db();
        $db->connect();
        $where = "user_id=" . $userId . " AND " . "name='" . $name . "' AND " . "year_of_exp=" . $yearOfExp;
        $db->select('opencv_technical_skill', 'id', $where);
        $retVal = $db->getResult();
        return $retVal;
    }

    public function GetSingleTechSkillHistory($id) {
        $db = new db();
        $db->connect();
        $where = "id=" . $id;
        $db->select('opencv_technical_skill', '*', $where);
        $retVal = $db->getResult();
        return $retVal;
    }

    public function GetTotalYear($userId) {
        $db = new db();
        $db->connect();
        $where = "user_id=" . $userId;
        $db->select('opencv_technical_skill', 'year_of_exp', $where);
        $retVal = $db->getResult();
        $max = 0.00;
        if (isset($retVal[0]) || isset($retVal['year_of_exp'])) {
            foreach ($retVal as $exp) {
                if (isset($exp['year_of_exp'])) {
                    $max = $max + $exp['year_of_exp'];
                } else {
                    $max = $max + $exp;
                }
            }
        }

        return $max;
    }

}
