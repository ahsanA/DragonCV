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

$userId = requestParam(2);
$personObj = new clsUserInfo();

$email = $personObj->GetEmail($userId);
$person = $personObj->GetSinglePerson($userId);

$imageInfoObj = new clsImageInfo();
$img = $imageInfoObj->SelectImage($userId);
if (isset($img['id'])) {
    $presentImage = $img['image_path'];
}
?>

<script type="text/javascript" language="javascript">
    function PrintDivData(crtlid) {
        var ctrlcontent = document.getElementById(crtlid);
        var printscreen = window.open('', '', 'left=1,top=1,width=1,height=1,toolbar=0,scrollbars=0,status=0​');
        printscreen.document.write(ctrlcontent.innerHTML);
        printscreen.document.close();
        printscreen.focus();
        printscreen.print();
        printscreen.close();
    }
</script>


<div id="myCV" class="myCV">
    <div class="commonRow">
        <div class="headerContentAddress">
            <div id="dvHeaderContentName"  style="font-family: Arial; font-size: 11px;
                 font-weight: bold;"><?php echo $person['name']; ?>
            </div>
            <div id="dvHeaderContentSubAddress"  style="width: 130px; font-family: Tahoma;
                 font-size: 9px; text-align: justify;"><?php echo $person['present_address']; ?>
            </div>
            <div id="headerContentCell" style="width: 130px; font-family: Tahoma; font-size: 9px;">
                <div id="headerContentCellName" style="font-weight: bold; float: left;">
                    Cell:&nbsp;</div>
                <div id="dvHeaderContentCellNumber" >
                    <?php echo $person['cell']; ?>
                </div>
            </div>
            <div id="headerContentEmail" style="font-family: Tahoma; font-size: 9px;">
                <div id="headerContentEmailName" style="font-weight: bold; float: left;">
                    E-mail:&nbsp;</div>
                <div id="dvHeaderContentEmailContent"  style="float: left;">
                    <?php echo $email['email']; ?>
                </div>
            </div>
        </div>
        <div class="headerContentPic">
            <img id="prsnImg" src="<?php echo $presentImage; ?>" style="height: 100%; width: 100%;"/>
        </div>
    </div>
    <div class="commonRow commonRow1">
        <div id="CareerObjectiveName" style="font-family: Arial; font-size: 20px; font-weight: bold;">
            Career Objective:
        </div>
        <br />
        <div id="dvCareerObjectiveContent" style="font-family: Tahoma; font-size: 16px; text-align: justify;">
            <?php echo $person['cr_obj']; ?>
        </div>
    </div>
    <br />
    <br />
    <div class="commonRow commonRow3">
        <div id="TechnicalSkillsName" style="font-family: Arial; font-size: 20px; font-weight: bold;">
            Technical Skills :
        </div>
        <br />
        <div id="TechnicalSkillsContent" style="font-family: Tahoma; font-size: 16px; text-align: center;">
            <?php
        echo '<table id="tblTecnicalSkillInfo" style="text-align: center; font-family: Courier;  font-size: 15px;" >
        
        <tr style="background-color: #C4CEC7; border-color: #C4CEC7;">
            <td style="width: 300px;">
                Name
            </td>
            <td style="width: 300px;">
                Year of Experience
            </td>
        </tr>';
         
         $techSkillInfo = new clsTechnicalInfo();
         $retVal = $techSkillInfo->GetTechSkillHistory($userId);
                

                if(!isset ($retVal[0]) && isset ($retVal['name'])){
                    echo '<tr class = "trOddMember">';
                            echo '<td>'.$retVal['name'].'</td>';
                            echo '<td>'.$retVal['year_of_exp'].'</td>';       
                    echo '</tr>'; 
                }
                else if(isset ($retVal[0])){
                    $i=0;
                    foreach ($retVal as $rows) {
                        echo '<tr style = "line-height: 25px;"';
                            if ($i%2 ==0)   echo ' class = "trOddMember" ';                            
                        echo '>';                            
                            echo '<td>'.$rows['name'].'</td>';
                            echo '<td>'.$rows['year_of_exp'].'</td>';
                        echo '</tr>';   
                        $i++;
                    }
                }
                
    echo '</table>';
            ?>
        </div>
    </div>
    <br />
    <br />
    <div class="commonRow commonRow7">
        <div id="AcademicEducationName" style="font-family: Arial; font-size: 20px; font-weight: bold;">
            Academic Education :
        </div>
        <br />
        <div id="AcademicEducationContent" style="font-family: Tahoma; font-size: 16px; text-align: justify;">
            <?php
                $eduHistory = new clsEduInfo();
        
        echo '<table id="tblDisplayEduInfo" style="text-align: center; font-family: Courier; font-size: 15px;">
            
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
            
                
                $retVal = $eduHistory->GetEduHistory($userId);
                

                if(!isset ($retVal[0]) && isset ($retVal['degree'])){
                    echo '<tr class = "trOddMember">';
                            echo '<td>'.$retVal['degree'].'</td>';
                            echo '<td>'.$retVal['institute_name'].'</td>';
                            echo '<td>'.$retVal['passing_year'].'</td>';
                            echo '<td>'.$retVal['exam_result'].'</td>';
                   echo '</tr>'; 
                }
                else if(isset ($retVal[0])){
                    $i=0;
                    foreach ($retVal as $rows) {
                        echo '<tr style = "line-height: 25px;"';
                            if ($i%2 ==0)   echo ' class = "trOddMember" ';                            
                        echo '>';                            
                            echo '<td>'.$rows['degree'].'</td>';
                            echo '<td>'.$rows['institute_name'].'</td>';
                            echo '<td>'.$rows['passing_year'].'</td>';
                            echo '<td>'.$rows['exam_result'].'</td>';
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
    </div>
    <br />
    <br />
    <div class="commonRow commonRow9">
        <div id="PersonalDetailsName" style="font-family: Arial; font-size: 20px; font-weight: bold;">
            Personal Details :
        </div>
        <br />
        <div id="PersonalDetailsContent" style="font-family: Tahoma; font-size: 16px; text-align: left;">
            <table>
                <tr>
                    <td style="font-weight: bold;">
                        Name
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnName" ><?php echo $person['name']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">
                        Father’s Name
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnFatherName" ><?php echo $person['father_name']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">
                        Mother’s Name
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnMotherName" ><?php echo $person['mother_name']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold; width: 150px;">
                        Present Address
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnPresentAddress" ><?php echo $person['present_address']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold; width: 160px;">
                        Permanent Address
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnPermanentAddress" ><?php echo $person['parmanent_address']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">
                        Gender
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnGender" ><?php echo $person['gender']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold; width: 150px;">
                        Marital Status
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnMaritalStutus" ><?php echo $person['marital_status']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">
                        Religion
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnReligion" >
                            <?php 
                                if($person['religion'] == 1)
                                    echo 'Buddhist';
                                if($person['religion'] == 2)
                                    echo 'Christian';
                                if($person['religion'] == 3)
                                    echo 'Hindu';
                                if($person['religion'] == 4)
                                    echo "Muslim"; 
                            ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">
                        Blood Group
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnBloodGroup" ><?php echo $person['blood_group']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">
                        Contact Number
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <span id="spnCellNumber" ><?php echo $person['cell']; ?></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br />
    <br />
    <div class="commonRow">
        <div id="Reference" style="font-family: Arial; font-size: 20px; font-weight: bold;">
            Reference(s):</div>
        <br />
        <div id="dvReference1" style="float: left; width: 45%; height: auto; text-align: left;
             border-right: 1px solid blue;" ><?php echo $person['ref_1']; ?>
        </div>
        <div id="dvReference2" style="padding-left: 9.5%; float: left; width: 45%; height: auto;
             text-align: left;" ><?php echo $person['ref_2']; ?>
        </div>
    </div>
    <div class="commonRow">
        <div id="dvPrint" style="text-align: right;">
            <input id="Button1" type="button" name="Print" value="Print"  onclick="javascript:PrintDivData('myCV')"/>
        </div>
    </div>
</div>


<div id="dvDeleteCV" style="<?php 
                                if(isset($_SESSION['userId'])){
                                    if($userId == $_SESSION['userId'])
                                        echo 'display:block;';
                                    else echo 'display:none;';
                                }else echo 'display:none;';
                              ?> margin-top:-130px; color:Black; float:right; width:50px;" >
    <a href="<?php echo $config['site_url'] . '/deleteCV';?>" style="color:#2B3B58; font-size:10px;">Delete CV</a>
</div>
