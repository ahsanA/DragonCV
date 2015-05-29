<?php
//require_once 'config/config.php';
//require_once 'config/clean-url.php';
//require_once 'DTO/clsEducation.php';
//require_once 'BOL/clsEduInfo.php';
echo '<link rel="stylesheet" type="text/css" href="' . $config['site_url'] . '/contents/site.css" />';

$id = requestParam(3);
$eduInfo = new clsEduInfo();
$retVal = $eduInfo->GetSingleEduHistory($id);

if (isset($_POST['edit'])) {
    $eduInfo = new clsEduInfo();

    $userId = $_SESSION['userId'];
    $degree = $_POST['degree'];
    $insName = $_POST['insName'];
    $passYear = $_POST['passYear'];
    $result = $_POST['result'];

    ob_clean();

    $idObj = $eduInfo->GetSingleEduId($userId, $degree, $passYear);

    if (isset($idObj['id'])) {
        $retVal = $eduInfo->UpdateEduInfo($id, $degree, $insName, $passYear, $result);

        if ($retVal == 1) {
            $link = $config['site_url'].'/Edit/eduInfo';
            header("Location:".$link);
        } else {
            echo 'Are You Forgot to do something horrible????';
        }
    }
    else{
        echo 'GO TO Hell';
        die();
    }
}
?>

<script type="text/javascript" language="javascript" src="<?php echo $config['site_url'] . '/Scripts/education.js'; ?>"></script>
<div id="dvCVCommon" style="<?php
if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    echo 'display:block;';
} else {
    echo 'display:none;';
}
?>" >
<form action = "#" method="POST" onsubmit="return ValidateEducationInfo()">
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
                    <option <?php if ($retVal['degree'] == 1) echo 'selected="true"'; ?> value="1">SSC</option>
                    <option <?php if ($retVal['degree'] == 2) echo 'selected="true"'; ?> value="2">HSC</option>
                    <option <?php if ($retVal['degree'] == 3) echo 'selected="true"'; ?> value="3">BSCSE</option>
                    <option <?php if ($retVal['degree'] == 4) echo 'selected="true"'; ?> value="4">BSEEE</option>
                    <option <?php if ($retVal['degree'] == 5) echo 'selected="true"'; ?> value="5">BBA</option>
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
                <input type="text" value="<?php echo $retVal['institute_name']; ?>" id="txtInstituteName" name="insName" style="width: 300px;" />
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
                <input type="text" value="<?php echo $retVal['passing_year']; ?>" id="txtPassingYear" name="passYear" style="width: 100px;" />
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
                <input type="text" id="txtResult" value="<?php echo $retVal['exam_result']; ?>" name="result" style="width: 100px;" />
                <br />
                <span id="spnResultErr" class="errMsg"></span>
            </td>
        </tr>        
        <tr style="text-align: right;">
            <td colspan="3">                
                <input type="submit" name="edit" id="btnAddMore" value="Edit"/>                
            </td>
        </tr>
    </table>
</form>
</div>
