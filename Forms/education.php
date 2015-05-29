<?php
error_reporting(0);

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
<script type="text/javascript" language="javascript" src="../Scripts/education.js"></script>
<div id="dvEducationalContents" style="<?php
if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    echo 'display:block;';
} else {
    echo 'display:none;';
}
?>" >
    <div id="dvDisplayEduInfo">
        <?php
        //require_once 'BOL/clsEduInfo.php';
        //require_once 'config/config.php';
        $eduHistory = new clsEduInfo();

        echo '<table id="tblDisplayEduInfo" style="text-align: center; font-family: Courier; font-size: 15px;">
            <tr style="background-color: #7F908F; font-family: Tahoma; font-size: 30px;">
                <td colspan="4">
                    Your Educational Information
                </td>
            </tr>
            <tr style="background-color: #C4CEC7; border-color: #7F908F;">
                <td style="width: 100px;">
                    Degree
                </td>
                <td style="width: 300px;">
                    Institute Name
                </td>
                <td style="width: 100px;">
                    Passing Year
                </td>
                <td style="width: 100px;">
                    Result
                </td>
            </tr>';



        $retVal = $eduHistory->GetEduHistory($_SESSION['userId']);


        if (!isset($retVal[0]) && isset($retVal['degree'])) {
            echo '<tr class = "trOddMember">';
            echo '<td>' . $retVal['degree'] . '</td>';
            echo '<td>' . $retVal['institute_name'] . '</td>';
            echo '<td>' . $retVal['passing_year'] . '</td>';
            echo '<td>' . $retVal['exam_result'] . '</td>';
            echo '<td>' . '<a href = "' . $config['site_url'] . '/Edit/editEduinfo/' . $retVal['id'] . '"  style="background-color:#C4CEC7; color:black; border:0px;">Edit</a>' . '</td>';
            echo '<td>' . '<a href = "' . $config['site_url'] . '/Edit/deleteEducation/' . $retVal['id'] . '"  style="background-color:#C4CEC7; color:black; border:0px;">Delete</a>' . '</td>';
            echo '</tr>';
        } else if (isset($retVal[0])) {
            $i = 0;
            foreach ($retVal as $rows) {
                echo '<tr style = "line-height: 25px;"';
                if ($i % 2 == 0)
                    echo ' class = "trOddMember" ';
                echo '>';
                echo '<td>' . $rows['degree'] . '</td>';
                echo '<td>' . $rows['institute_name'] . '</td>';
                echo '<td>' . $rows['passing_year'] . '</td>';
                echo '<td>' . $rows['exam_result'] . '</td>';
                echo '<td>' . '<a href = "' . $config['site_url'] . '/Edit/editEduinfo/' . $rows['id'] . '"  style="background-color:#C4CEC7; color:black; border:0px;">Edit</a>' . '</td>';
                echo '<td>' . '<a href = "' . $config['site_url'] . '/Edit/deleteEducation/' . $rows['id'] . '"  style="background-color:#C4CEC7; color:black; border:0px;">Delete</a>' . '</td>';
                echo '</tr>';
                $i++;
            }
        }

        //echo '<pre>';
        //print_r($retVal);
        //echo '</pre>';

        echo '</table>';
        ?>
    </div>
    <div style="height: 50px;">
    </div>
    <form action = "#" method="POST" onsubmit="return InputEducation()">
        <table id="tblInputEduInfo" style="text-align: center; background-color: #C4CEC7;">
            <tr style="background-color: #7F908F; font-family: Tahoma; font-size: 30px;">
                <td colspan="3">
                    Educational Information
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    Degree
                </td>
                <td>
                    *
                </td>
                <td style="text-align: left;">
                    <select id="sltDegree" name="degree">
                        <option value="0">Select One</option>
                        <option value="1">SSC</option>
                        <option value="2">HSC</option>
                        <option value="3">BSCSE</option>
                        <option value="4">BSEEE</option>
                        <option value="5">BBA</option>
                    </select>
                    <br />
                    <span id="spnDegreeErr" class="errMsg"></span>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    Institute Name
                </td>
                <td>
                    *
                </td>
                <td style="text-align: left;">                    
                    <input type="text" id="txtInstituteName" style="width: 300px;" />
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    Passing Year
                </td>
                <td>
                    *
                </td>
                <td style="text-align: left;">                    
                    <input type="text" id="txtPassingYear" style="width: 100px;" />
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    Result
                </td>
                <td>
                    *
                </td>
                <td style="text-align: left;">                    
                    <input type="text" id="txtResult" style="width: 100px;" />
                    <br />
                    <span id="spnResultErr" class="errMsg"></span>
                </td>
            </tr>        
            <tr style="text-align: right;">
                <td colspan="3">
                    <!--asp:Button ID="btnAddMore" runat="server" Text="Add" OnClick="btnAddMore_Click" OnClientClick=" return InputEducation()" /-->
                    <!--asp:Button ID="btnSave" runat="server" Text="Next Step ->" OnClick="btnSave_Click" /-->
                    <input type="submit" name="addMore" id="btnAddMore" value="Add"/>
                    <input type="submit" name="nextStep" id="btnSave" value="Next Step ->" onclick="goToNext();"/>                  
                </td>
            </tr>
        </table>
    </form>
</div>