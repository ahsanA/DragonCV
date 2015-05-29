<?php
error_reporting(0);

if (isset($_SESSION['isActive'])) {
    if ($_SESSION['isActive'] != 1) {
        $_SESSION['system'] = "notActivated";
        if ($_SESSION['system'] != "") {
            $link = $config['site_url'] . '/thankYou';
            header("Location:" . $link);
        }
    }
}

$nameErr = NULL;
$fNameErr = NULL;
$mNameErr = NULL;
$permanentAddressErr = NULL;
$genderErr = NULL;
$religionErr = NULL;
$bloodGroupErr = NULL;
$cellErr = NULL;
$carObjErr = NULL;
$ref1Err = NULL;
$ref2Err = NULL;

$personalInfo = new clsUserInfo();
$userId = $_SESSION['userId'];
$retVal = $personalInfo->GetSinglePerson($userId);

if (!isset($retVal['user_id'])) {
    $link = $config['site_url'] . '/personalInfo';
    header("Location:" . $link);
}

$addUser = new clsUser();

$addUser->set_name($retVal['name']);
$addUser->set_fatherName($retVal['father_name']);
$addUser->set_motherName($retVal['mother_name']);
$addUser->set_presentAddress($retVal['present_address']);
$addUser->set_permanentAddress($retVal['parmanent_address']);
$addUser->set_gender($retVal['gender']);
$addUser->set_maritalStatus($retVal['marital_status']);
$addUser->set_religion($retVal['religion']);
$addUser->set_bloodGroup($retVal['blood_group']);
$addUser->set_cell($retVal['cell']);
$addUser->set_carreerObj($retVal['cr_obj']);
$addUser->set_ref1($retVal['ref_1']);
$addUser->set_ref2($retVal['ref_2']);


$name = $addUser->get_name();
$fatherName = $addUser->get_fatherName();
$motherName = $addUser->get_motherName();
$presentAddress = $addUser->get_presentAddress();
$permanentAddress = $addUser->get_permanentAddress();
$gender = $addUser->get_gender();
$maritalStatus = $addUser->get_maritalStatus();
$religion = $addUser->get_religion();
$bloodGroup = $addUser->get_bloodGroup();
$cell = $addUser->get_cell();
$careerObj = $addUser->get_carreerObj();
$ref1 = $addUser->get_ref1();
$ref2 = $addUser->get_ref2();



if (isset($_POST['submitted'])) {

    $addUser = new clsUser();

    $addUser->set_name($_POST['txtName']);
    $addUser->set_fatherName($_POST['txtFatherName']);
    $addUser->set_motherName($_POST['txtMotherName']);
    $addUser->set_presentAddress($_POST['txtPresentAddress']);
    $addUser->set_permanentAddress($_POST['txtPermanentAddress']);
    $addUser->set_gender($_POST['gender']);
    $addUser->set_maritalStatus($_POST['maritalStatus']);
    $addUser->set_religion($_POST['relegion']);
    $addUser->set_bloodGroup($_POST['bloodGroup']);
    $addUser->set_cell($_POST['txtPhone']);
    $addUser->set_carreerObj($_POST['txtCrObj']);
    $addUser->set_ref1($_POST['txtRef1']);
    $addUser->set_ref2($_POST['txtRef2']);

    $isvalid = TRUE;

    if ($addUser->get_name() == "") {
        $nameErr = "Please Enter Your Name";
        $isvalid = FALSE;
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $addUser->get_name())) {
        $nameErr = "Please Enter Characters ONLY";
        $isvalid = FALSE;
    }
    if ($addUser->get_fatherName() == "") {
        $fNameErr = "Please Enter Your Father's Name";
        $isvalid = FALSE;
    }
    if ($addUser->get_motherName() == "") {
        $mNameErr = "Please Enter Your Mother's Name";
        $isvalid = FALSE;
    }

    if ($addUser->get_permanentAddress() == "") {
        $permanentAddressErr = "Please Enter Your Permanent Address";
        $isvalid = FALSE;
    }

    if ($addUser->get_gender() == "") {
        $genderErr = "Please Select Your Gender";
        $isvalid = FALSE;
    }

    if ($addUser->get_religion() == "0") {
        $religionErr = "Please Select Your Religion";
        $isvalid = FALSE;
    }

    if ($addUser->get_bloodGroup() == "null") {
        $bloodGroupErr = "Please Select Your Blood Group";
        $isvalid = FALSE;
    }

    if ($addUser->get_cell() == "") {
        $cellErr = "Please Enter Your Phone";
        $isvalid = FALSE;
    }

    if ($addUser->get_carreerObj() == "") {
        $carObjErr = "Please Write your Career Objective";
        $isvalid = FALSE;
    }

    if ($addUser->get_ref1() == "") {
        $ref1Err = "Refference Required";
        $isvalid = FALSE;
    }

    if ($addUser->get_ref2() == "") {
        $ref2Err = "Refference Required";
        $isvalid = FALSE;
    }

    if ($isvalid) {
        //echo '<pre>';
        //print_r($addUser);
        //echo '</pre>';
        //die();
        $userId = $_SESSION['userId'];
        $name = $addUser->get_name();
        $fatherName = $addUser->get_fatherName();
        $motherName = $addUser->get_motherName();
        $presentAddress = $addUser->get_presentAddress();
        $permanentAddress = $addUser->get_permanentAddress();
        $gender = $addUser->get_gender();
        $maritalStatus = $addUser->get_maritalStatus();
        $religion = $addUser->get_religion();
        $bloodGroup = $addUser->get_bloodGroup();
        $cell = $addUser->get_cell();
        $careerObj = $addUser->get_carreerObj();
        $ref1 = $addUser->get_ref1();
        $ref2 = $addUser->get_ref2();

        $updatePersonalInfo = new clsUserInfo();

        $retVal = $updatePersonalInfo->UpdatePersonalInfo($userId, $name, $fatherName, $motherName, $presentAddress, $permanentAddress, $gender, $maritalStatus, $religion, $bloodGroup, $cell, $careerObj, $ref1, $ref2);

        if ($retVal == 1) {
            $link = $config['site_url'] . '/Edit/personalInfo';
            header("Location:" . $link);
        } elseif ($retVal == 0) {
            echo 'Failure';
        }
    } else if (!$isvalid) {
        $name = $addUser->get_name();
        $fatherName = $addUser->get_fatherName();
        $motherName = $addUser->get_motherName();
        $presentAddress = $addUser->get_presentAddress();
        $permanentAddress = $addUser->get_permanentAddress();
        $gender = $addUser->get_gender();
        $maritalStatus = $addUser->get_maritalStatus();
        $religion = $addUser->get_religion();
        $bloodGroup = $addUser->get_bloodGroup();
        $cell = $addUser->get_cell();
        $careerObj = $addUser->get_carreerObj();
        $ref1 = $addUser->get_ref1();
        $ref2 = $addUser->get_ref2();
    }
}
?>

<script type="text/javascript" language="javascript" src="../Scripts/personalInfo.js"></script>
<div id="dvCVCommon" style="<?php
if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    echo 'display:block;';
} else {
    echo 'display:none;';
}
?>" >
    <div id="header" class="main">
        <p style="font-size: 30px;">
            Personal Information
        </p>
    </div>
    <div id="container" class="main">
        <h2>
            You Must Fill All The * Marked Field.</h2>
        <form name="pInfo" action = "#" method="POST" onsubmit="return fieldValidate()">
            <div id="table" class="tbl">
                <div class="row">
                    <div class="leftCol">
                        Name :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">                    
                        <input type="text" id="txtName" name="txtName" value="<?php echo $name; ?>" style="width: 225px;"/>
                    </div>
                    <div id="dvNameErrCOl" class="errorCol" >
                        <?php echo $nameErr; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="leftCol">
                        Father's Name :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">                    
                        <input type="text" id="txtFatherName" name="txtFatherName" value="<?php echo $fatherName; ?>" style="width: 225px;"/>
                    </div>
                    <div id="dvFatherNameErrCOl" class="errorCol" >
                        <?php echo $fNameErr; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="leftCol">
                        Mother's Name :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">                    
                        <input type="text" id="txtMotherName" name="txtMotherName" value="<?php echo $motherName; ?>" style="width: 225px;"/>
                    </div>
                    <div id="dvMotherNameErrCOl" class="errorCol" >
                        <?php echo $mNameErr; ?>
                    </div>
                </div>
                <div class="row row1">
                    <div class="leftCol">
                        Present Address :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        &nbsp;
                    </div>
                    <div class="rightCol">
                        <textarea id="txtPresentAddress" name="txtPresentAddress"  rows="4" cols="26" style="resize: none;"><?php echo $presentAddress; ?></textarea>
                    </div>
                </div>
                <div class="row row1">
                    <div class="leftCol">
                        Permanent Address :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">
                        <textarea id="txtPermanentAddress" name="txtPermanentAddress"  rows="4" cols="26" style="resize: none;"><?php echo $permanentAddress; ?></textarea>
                    </div>
                    <div id="dvPermanentAddressErrCOl" class="errorCol" >
                        <?php echo $permanentAddressErr; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="leftCol">
                        Gender :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">
                        <input type="radio" <?php if ($gender == "Male") echo 'checked="checked"'; ?> name="gender" value="Male"  />Male
                        <br />
                        <input type="radio"  <?php if ($gender == "Female") echo 'checked="checked"'; ?>  name="gender" value="Female" />Female
                    </div>
                    <div id="dvGenderErrCol" class="errorCol" >
                        <?php echo $genderErr; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="leftCol">
                        Marital Status :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        &nbsp;
                    </div>
                    <div class="rightCol">
                        <input type="radio" <?php if ($maritalStatus == "Married") echo 'checked="checked"'; ?> name="maritalStatus" value="Married" />
                        Married
                        <br />
                        <input type="radio" <?php if ($maritalStatus == "Single") echo 'checked="checked"'; ?> name="maritalStatus" value="Single" />
                        Single
                    </div>
                </div>
                <div class="row">
                    <div class="leftCol">
                        Religion :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">
                        <select id="relegion" name="relegion" >
                            <option value="0">--Select--</option>
                            <option <?php if ($religion == 1) echo 'selected="true"'; ?> value="1">Buddhist</option>
                            <option <?php if ($religion == 2) echo 'selected="true"'; ?> value="2">Christian</option>
                            <option <?php if ($religion == 3) echo 'selected="true"'; ?> value="3">Hindu</option>
                            <option <?php if ($religion == 4) echo 'selected="true"'; ?> value="4">Muslim</option>
                        </select>
                    </div>
                    <div id="dvReligionErrCol" class="errorCol" >
                        <?php echo $religionErr; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="leftCol">
                        Blood Group :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">
                        <select id="bloodGroup" name="bloodGroup" >
                            <option value="null">--Select--</option>
                            <option <?php if ($bloodGroup == "A+") echo 'selected="true"'; ?> value="A+">A+</option>
                            <option <?php if ($bloodGroup == "A-") echo 'selected="true"'; ?> value="A-">A-</option>
                            <option <?php if ($bloodGroup == "AB+") echo 'selected="true"'; ?> value="AB+">AB+</option>
                            <option <?php if ($bloodGroup == "AB-") echo 'selected="true"'; ?> value="AB-">AB-</option>
                            <option <?php if ($bloodGroup == "B+") echo 'selected="true"'; ?> value="B+">B+</option>
                            <option <?php if ($bloodGroup == "B-") echo 'selected="true"'; ?> value="B-">B-</option>
                            <option <?php if ($bloodGroup == "O+") echo 'selected="true"'; ?> value="O+">O+</option>
                            <option <?php if ($bloodGroup == "O-") echo 'selected="true"'; ?> value="O-">O-</option>
                        </select>
                    </div>
                    <div id="dvBldGrpErrCol" class="errorCol" >
                        <?php echo $bloodGroupErr; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="leftCol">
                        Phone Number :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">                    
                        <input type="tel" id="txtPhone" name="txtPhone" value="<?php echo $cell; ?>" style="width: 225px;"/>
                    </div>
                    <div id="dvPhnErrCol" class="errorCol" >
                        <?php echo $cellErr; ?>
                    </div>
                </div>
                <div class="row row1">
                    <div class="leftCol">
                        Career Objective :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">
                        <textarea id="txtCrObj" name="txtCrObj" rows="4" cols="26" style="resize: none;"><?php echo $careerObj; ?></textarea>
                    </div>
                    <div id="dvCrObjErrCol" class="errorCol" >
                        <?php echo $carObjErr; ?>
                    </div>
                </div>
                <div class="row row2">
                    <div class="leftCol">
                        Reference 1 :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">
                        <textarea id="txtRef1" name="txtRef1" rows="6" cols="26" style="resize: none;"><?php echo $ref1; ?></textarea>
                    </div>
                    <div id="dvRef1ErrCol" class="errorCol" >
                        <?php echo $ref1Err; ?>
                    </div>
                </div>
                <div class="row row2">
                    <div class="leftCol">
                        Reference 2 :&nbsp;&nbsp;
                    </div>
                    <div class="midCol">
                        *
                    </div>
                    <div class="rightCol">
                        <textarea id="txtRef2" name="txtRef2" rows="6" cols="26" style="resize: none;"><?php echo $ref2; ?></textarea>
                    </div>
                    <div id="dvRef2ErrCol" class="errorCol" >
                        <?php echo $ref2Err; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="leftCol">
                        &nbsp;
                    </div>
                    <div class="midCol">
                        &nbsp;
                    </div>
                    <div class="rightCol row2">                    
                        <input type="submit" id="btnCVCommon" name="submitted" title="Edit" value="Edit" /> 
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

