<?php
echo '<link rel="stylesheet" type="text/css" href="' . $config['site_url'] . '/contents/site.css" />';

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

$id = requestParam(3);
$techSkillInfo = new clsTechnicalInfo();
$retVal = $techSkillInfo->GetSingleTechSkillHistory($id);

if (isset($_POST['edit'])) {
    $techSkillInfo = new clsTechnicalInfo();

    $userId = $_SESSION['userId'];
    $name = $_POST['txtSkillName'];
    $yearOfExp = $_POST['txtYearofExperience'];

    ob_clean();


    $retVal = $techSkillInfo->UpdateTechInfo($id, $name, $yearOfExp);

    if ($retVal == 1) {
        $link = $config['site_url'] . '/Edit/techInfo';
        header("Location:" . $link);
    } else {
        echo 'Are You Forgot to do something horrible????';
    }
}
?>

<script type="text/javascript" language="javascript" src="<?php echo $config['site_url'] . '/Scripts/techSkills.js'; ?>"></script>
<div id="dvCVCommon" style="<?php
if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    echo 'display:block;';
} else {
    echo 'display:none;';
}
?>" >

<form action = "#" method="POST" onsubmit="return validateInput();">
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
                <input type="text" id="txtSkillName" name="txtSkillName" value="<?php echo $retVal['name']; ?>" style="width: 300px;" />
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
                <input type="text" id="txtYearofExperience" name="txtYearofExperience" value="<?php echo $retVal['year_of_exp']; ?>" style="width: 300px;" />
                <br />
                <span id="spnYearOfExpErr" class="errorCol" style="width:300px;"></span>
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