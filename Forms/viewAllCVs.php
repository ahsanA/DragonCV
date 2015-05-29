<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$search = 0;
$degre = array('All', 'SSC', 'HSC', 'BSCSE', 'BSEEE', 'BBA');



if (isset($_POST['search'])) {
    $search = $_POST['degree'];
}

echo '
    <div style="margin-top:25px; height: 50px; width: 500px; border: 1px solid red;">
    <form name="viewAllCV" action="#" method="post">
        <span>Classify Your Result:</span>
        <select id="sltDegree" name="degree">';
for ($i = 0; $i < 6; $i++) {
    if ($i == $search) {
        echo '<option selected="true" value="' . $i . '">' . $degre[$i] . '</option>';
    } else {
        echo '<option value="' . $i . '">' . $degre[$i] . '</option>';
    }
}
echo '</select>
        <span><input type="submit" value="Search" name="search" /></span>
    </form>
</div>
    ';



echo '
    <table id="tblCVDisplay" style="text-align: center; font-family: Courier; font-size: 15px;"
            runat="server">
            <tr style="background-color: #7F908F; font-family: Tahoma; font-size: 30px;">
                <td colspan="3">
                    View CVs
                </td>
            </tr>
            <tr style="background-color: #C4CEC7; border-color: #C4CEC7;">
                <td style="width: 200px;">
                    Name
                </td>
                <td style="width: 100px;">
                    Highest Degree
                </td>
                <td style="width: 100px;">
                    Year of Experience
                </td>
            </tr>';
$personObj = new clsUserInfo();
$education = new clsEduInfo();
$techSkill = new clsTechnicalInfo();

$allPerson = $personObj->GetAllUser();
$i = 0;
foreach ($allPerson as $singlePerson) {

    $degree = $education->GetHighestEduInfo($singlePerson['user_id']);

    $exp = $techSkill->GetTotalYear($singlePerson['user_id']);

    if ($search != 0 && $search == $degree) {

        echo '<tr style = "line-height: 25px;"';
        if ($i % 2 == 0)
            echo ' class = "trOddMember" ';
        echo '>';

        echo '<td>' . $singlePerson['name'] . '</td>';

        if ($degree == 1)
            echo '<td>' . 'SSC' . '</td>';
        else if ($degree == 2)
            echo '<td>' . 'HSC' . '</td>';
        else if ($degree == 3)
            echo '<td>' . 'BSCSE' . '</td>';
        else if ($degree == 4)
            echo '<td>' . 'BSEEE' . '</td>';
        else if ($degree == 5)
            echo '<td>' . 'BBA' . '</td>';
        else {
            echo '<td>' . '---' . '</td>';
        }

        if (isset($exp)) {
            echo '<td>' . $exp . '</td>';
        } else {
            echo '<td>' . '---' . '</td>';
        }
        echo '<td>' . '<a href =" ' . $config['site_url'] . '/summary/' . $singlePerson['user_id'] . ' " style= "background-color:#C4CEC7; color:black;">View Details</a>' . '</td>';
        echo '</tr>';
        
        $i++;
    }
    else if($search == 0){
        echo '<tr style = "line-height: 25px;"';
        if ($i % 2 == 0)
            echo ' class = "trOddMember" ';
        echo '>';

        echo '<td>' . $singlePerson['name'] . '</td>';

        if ($degree == 1)
            echo '<td>' . 'SSC' . '</td>';
        else if ($degree == 2)
            echo '<td>' . 'HSC' . '</td>';
        else if ($degree == 3)
            echo '<td>' . 'BSCSE' . '</td>';
        else if ($degree == 4)
            echo '<td>' . 'BSEEE' . '</td>';
        else if ($degree == 5)
            echo '<td>' . 'BBA' . '</td>';
        else {
            echo '<td>' . '---' . '</td>';
        }

        if (isset($exp)) {
            echo '<td>' . $exp . '</td>';
        } else {
            echo '<td>' . '---' . '</td>';
        }
        echo '<td>' . '<a href =" ' . $config['site_url'] . '/summary/' . $singlePerson['user_id'] . ' " style= "background-color:#C4CEC7; color:black;">View Details</a>' . '</td>';
        echo '</tr>';
        
        $i++;
    }    
}

echo '</table>';
?>