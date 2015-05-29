<?php
if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    if (isset($_SESSION['isActive'])) {
        if ($_SESSION['isActive'] != 1) {
            $_SESSION['system'] = "notActivated";
            if ($_SESSION['system'] != "") {
                $link = $config['site_url'] . '/thankYou';
                header("Location:" . $link);
            }
        }
    }
}
?>


<script type="text/javascript" language="javascript" src="../Scripts/Common.js"></script>
<script type="text/javascript" language="javascript" src="../Scripts/techSkills.js"></script>
<div id="dvTecnicalSkillinfoConteiner" style="<?php
if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    echo 'display:block;';
} else {
    echo 'display:none;';
}
?>" >
         <?php
         echo '<table id="tblTecnicalSkillInfo" style="text-align: center; font-family: Courier;  font-size: 15px;" >
        <tr style="background-color: #7F908F; font-family: Tahoma; font-size: 30px;">
            <td colspan="2">
                Your Technical Skill Information
            </td>
        </tr>
        <tr style="background-color: #C4CEC7; border-color: #C4CEC7;">
            <td style="width: 300px;">
                Name
            </td>
            <td style="width: 300px;">
                Year of Experience
            </td>
        </tr>';

         $techSkillInfo = new clsTechnicalInfo();
         $retVal = $techSkillInfo->GetTechSkillHistory($_SESSION['userId']);


         if (!isset($retVal[0]) && isset($retVal['name'])) {
             echo '<tr class = "trOddMember">';
             echo '<td>' . $retVal['name'] . '</td>';
             echo '<td>' . $retVal['year_of_exp'] . '</td>';
             echo '<td>' . '<a href = "' . $config['site_url'] . '/Edit/editTechSkillInfo/' . $retVal['id'] . '"  style="background-color:#C4CEC7; color:black; border:0px;">Edit</a>' . '</td>';
             echo '<td>' . '<a href = "' . $config['site_url'] . '/Edit/deleteTechSkill/' . $retVal['id'] . '"  style="background-color:#C4CEC7; color:black; border:0px;">Delete</a>' . '</td>';
             echo '</tr>';
         } else if (isset($retVal[0])) {
             $i = 0;
             foreach ($retVal as $rows) {
                 echo '<tr style = "line-height: 25px;"';
                 if ($i % 2 == 0)
                     echo ' class = "trOddMember" ';
                 echo '>';
                 echo '<td>' . $rows['name'] . '</td>';
                 echo '<td>' . $rows['year_of_exp'] . '</td>';
                 echo '<td>' . '<a href = "' . $config['site_url'] . '/Edit/editTechSkillInfo/' . $rows['id'] . '"  style="background-color:#C4CEC7; color:black; border:0px;">Edit</a>' . '</td>';
                 echo '<td>' . '<a href = "' . $config['site_url'] . '/Edit/deleteTechSkill/' . $rows['id'] . '"  style="background-color:#C4CEC7; color:black; border:0px;">Delete</a>' . '</td>';
                 echo '</tr>';
                 $i++;
             }
         }

         echo '</table>';
         ?>
    <div style="height: 50px;">
    </div>
    <form action = "#" method="POST" onsubmit="return InputTechnicalSkillInfo();">
        <table id="tblInputTechnicalSkillInfo" style="text-align: center; background-color: #C4CEC7;">
            <tr style="background-color: #7F908F; font-family: Tahoma; font-size: 30px;">
                <td colspan="3">
                    Technical Information
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    Name of Skill
                </td>
                <td>
                    *
                </td>
                <td style="text-align: left;">
                    <input type="text" id="txtSkillName" style="width: 300px;" />
                    <br />
                    <span id="spnNameErr" class="errorCol" style="width:300px;"></span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    Year of Experience
                </td>
                <td>
                    *
                </td>
                <td style="text-align: left;">
                    <input type="text" id="txtYearofExperience" style="width: 300px;" />
                    <br />
                    <span id="spnYearOfExpErr" class="errorCol" style="width:300px;"></span>
                </td>
            </tr>
            <tr style="text-align: right;">
                <td colspan="3">
                    <input type="submit" name="addMore" id="btnAddMore" value="Add"/>
                    <input type="submit" name="nextStep" id="btnSave" value="Next Step ->" onclick="goToNext();"/>   
                </td>
            </tr>
        </table>
    </form>
</div>