<?php
session_start();

require_once 'config/clean-url.php';
require_once 'config/config.php';
require_once 'config/manus.php';
require_once 'DTO/clsEducation.php';
require_once 'BOL/clsEduInfo.php';
require_once 'BOL/clsUserInfo.php';
require_once 'DTO/clsUser.php';
require_once 'BOL/clsTechnicalInfo.php';
require_once 'DTO/clsImage.php';
require_once 'BOL/clsImageInfo.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dragon CV</title>

        <link rel="stylesheet" type="text/css" href="../contents/myCV.css" />
        <link rel="stylesheet" type="text/css" href="../contents/site.css" />
        <link rel="stylesheet" type="text/css" href="../contents/personalinfo.css" />



        <script type="text/javascript" language="javascript">
            function InitializePageSize() {
                var myHeight = 0;
                if (typeof (window.innerWidth) == 'number') {
                    //Non-IE
                    if (document.getElementById("dvMainContainer").offsetHeight > window.innerHeight) {
                        myHeight = document.getElementById("dvMainContainer").offsetHeight + (100 + 40);
                    }
                    else {
                        myHeight = window.innerHeight;
                    }
                }
                else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
                    //IE 6+ in 'standards compliant mode'
                    myHeight = document.documentElement.clientHeight;
                }
                else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
                    //IE 4 compatible
                    myHeight = document.body.clientHeight;
                }
                document.getElementById('dvVewPort').style.minHeight = myHeight + 'px';
                document.getElementById('dvContent').style.minHeight = (myHeight - (100 + 40)) + 'px';
                document.getElementById('dvManuPort').style.minHeight = (myHeight - (100 + 40)) + 'px';
            }
        </script>
    </head>
    <body onload="InitializePageSize()">
    <center>
        <div id="dvVewPort" style="width: 100%;">
            <div class="pageHeader">
                <div id="dvSiteNamePanel" style="margin-left: 20px; margin-top: 15px; font-family: Verdana; font-size: 25px; color: white; float: left;">
                    Dragon Career World
                </div>
                <div id="dvLoginPanel" class="loginPanel">
                    <?php
                    if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
                        ?>                          
                        welcome <a href="<?php
                    require_once 'config/config.php';
                    echo $config['site_url'] . '/summary/' . $_SESSION['userId']
                        ?>" > <?php echo $_SESSION['screenName']; ?></a> | <a href="<?php echo $config['site_url'] . '/signOut' ?>" > Sign Out</a> 
                                   <?php
                               } else {
                                   ?>
                        <a href="<?php
                               require 'config/config.php';
                               echo $config['site_url'] . '/signInSignUp';
                                   ?>" > Sign In</a>
                           <?php
                       }
                       ?>
                </div>
            </div>

            <div id="dvContent">
                <div id="dvMainContainer" style="width: 80%; float: left; min-height:300px;">
                    <?php
					//print_r(requestParam)
                    switch (requestParam(1)) {

                        case "":
                            require 'Forms/welcome.php';
                            break;
                        
                        case "deleteCV":
                            require 'Forms/deleteCV.php';
                            break;

                        case "AddTechnicalSkill":
                            $techSkillInfo = new clsTechnicalInfo();

                            $name1 = requestParam(2);
                            $yearOfExp1 = requestParam(3);

                            $order = array("%20");
                            $replace = ' ';

                            $userId = $_SESSION['userId'];
                            $name = str_replace($order, $replace, $name1);
                            $yearOfExp = str_replace($order, $replace, $yearOfExp1);

                            ob_clean();

                            $id = $techSkillInfo->GetSingleTechSkillId($userId, $name, $yearOfExp);

                            if (!isset($id['id'])) {
                                $retVal = $techSkillInfo->InsertTechInfo($userId, $name, $yearOfExp);

                                if ($retVal == 1) {
                                    $id = $techSkillInfo->GetSingleTechSkillId($userId, $name, $yearOfExp);

                                    $responce = $id['id'] . '#' . $userId . '#';
                                    echo $responce;
                                } else {
                                    echo '';
                                }
                            }
                            else
                                echo '';



                            die();


                            break;
                        case "AddEducation":

                            $eduInfo = new clsEduInfo();

                            $userId = $_SESSION['userId'];
                            $degree1 = requestParam(2);
                            $insName1 = requestParam(3);
                            $passYear = requestParam(4);
                            $result = requestParam(5);

                            $order = array("%20");
                            $replace = ' ';
                            $degree = str_replace($order, $replace, $degree1);
                            $insName = str_replace($order, $replace, $insName1);

                            ob_clean();

                            $id = $eduInfo->GetSingleEduId($userId, $degree, $passYear);

                            if (!isset($id['id'])) {
                                $retVal = $eduInfo->InsertEduInfo($userId, $degree, $insName, $passYear, $result);

                                if ($retVal == 1) {
                                    $id = $eduInfo->GetSingleEduId($userId, $degree, $passYear);

                                    $responce = $id['id'] . '#' . $userId . '#';
                                    echo $responce;
                                } else {
                                    echo '';
                                }
                            }
                            else
                                echo '';



                            die();
                            break;

                        case "Edit":
                            switch (requestParam(2)) {
                                case "personalInfo":
                                    require 'Forms/editPersonalInfo.php';
                                    break;
                                case "image":
                                    require 'Forms/addImage.php';
                                    break;
                                case "eduInfo":
                                    require 'Forms/education.php';
                                    break;
                                case "editEduinfo":
                                    require 'Forms/editEduInfo.php';
                                    break;
                                case "editTechSkillInfo":
                                    require 'Forms/editTechnicalSkill.php';
                                    break;
                                case "deleteTechSkill":
                                    $techSkillInfo = new clsTechnicalInfo();
                                    $id = requestParam(3);
                                    //echo $id;
                                    $userId = requestParam(4);
                                    $retVal = $techSkillInfo->DeleteTechInfo($id);
                                    //echo $retVal;
                                    //die();
                                    if ($retVal == 1) {
                                        $link = $config['site_url'] . '/Edit/techInfo';
                                        header("Location:" . $link);
                                    }
                                    break;
                                case "deleteEducation":
                                    $eduObj = new clsEduInfo();
                                    $id = requestParam(3);
                                    $userId = requestParam(4);
                                    $retVal = $eduObj->DeleteEduInfo($id);

                                    if ($retVal == 1) {
                                        $link = $config['site_url'] . '/Edit/eduInfo';
                                        header("Location:" . $link);
                                    }
                                    break;
                                case "techInfo":
                                    require 'Forms/techSkill.php';
                                    break;
                                default :
                                    require 'Forms/fileNotFound.php';
                                    break;
                            }
                            break;

                        case "signOut":
                            require 'Forms/signOut.php';
                            $link = $config['site_url'];
                            header("Location:" . $link);
                            break;

                        case "personalInfo":
                            require 'Forms/personalInfo.php';
                            break;

                        case "rout":
                            require 'Forms/router.php';
                            break;

                        case "signIn":

                            $getUser = new clsUserInfo();
                            $user = new clsUser();

                            $email = requestParam(2);
                            $pass = requestParam(3);


                            ob_clean();
                            $user = $getUser->SelectUserForLogIn($email);

                            if ($user->get_password() == crypt($pass, $user->get_salt())) {
                                echo 1;
                                $_SESSION['userId'] = $user->get_userId();
                                $_SESSION['screenName'] = $user->get_screenName();
                                $_SESSION['isActive'] = $user->get_isActive();
                            } else {
                                echo 0;
                            }
                            die();
                            break;
                        case "active":


                            $id = requestParam(2);


                            $activeUser = new clsUserInfo();

                            $retVal = $activeUser->ActivateUser($id);

                            if ($retVal == 1) {
                                $_SESSION['system'] = "userActivated";
                                if ($_SESSION['system'] != "") {
                                    $link = $config['site_url'] . '/thankYou';
                                    header("Location:" . $link);
                                }
                            }
                            break;

                        case "signUp":
                            require_once 'BOL/clsUserInfo.php';
                            require_once 'config/config.php';
                            require_once 'DTO/clsMail.php';

                            $insertUser = new clsUserInfo();

                            $email = requestParam(2);
                            $userPass = requestParam(3);
                            $salt = uniqid(mt_rand(), true);
                            $pass = crypt($userPass, $salt);
                            $scrName = requestParam(4);

                            ob_clean();
                            $retVal = $insertUser->InsertNewUser($email, $salt, $pass, $scrName);

                            if ($retVal == 1) {
                                require_once 'DTO/clsUser.php';

                                $getUser = new clsUserInfo();
                                $user = new clsUser();

                                $user = $getUser->SelectUserForLogIn($email);
                                $activation_link = $config['site_url'] . '/active/' . $user->get_userId();
                                //mail

                                $link = $config['site_url'] . '/contents/AhsanA.jpg';
                                $message = '
                                                                <html>
                                                                    <head>
                                                                            <title>Thank You!!!</title>
                                                                    </head>

                                                                    <body style= "margin:0; padding:0;">
                                                                            <center>
                                                                                    <div style="width: 100%; height: auto;">
                                                                                            <div style="background-color: #2B3B58; width: 100%; height: 100px;">
                                                                                                    <div style="margin-left: 20px; margin-top: 15px; font-family: Verdana; font-size: 25px; color: white; float: left;">
                                                                                                                    Dragon CV
                                                                                                    </div>
                                                                                            </div>
                                                                                            <div style="width: 100%; height: 400px;">
                                                                                                    <div style="width: 70%; height: 300px; float: left; text-align:left;">
                                                                                                            <p style="font-family: Verdana; font-size: 35px; color: black; margin:0;" > Thank You!!!</p>
                                                                                                            <p style="font-family: Verdana; font-size: 25px; color: black; margin:0;" > 
                                                                                                                    For joining with <a style="font-family: Comic Sans MS; color: black; text-decoration: none; cursor: pointer;" href="http://www.dtagonagent.com" target="_blank">dragonagent.com</a>
                                                                                                            </p>
                                                                                                            <br />
                                                                                                            <br />
                                                                                                            <br />
                                                                                                            <br />
                                                                                                            <br />
                                                                                                            <p style="font-family: Verdana; font-size: 30px; color: black; margin:0;" > 
                                                                                                                    Last Thing to Complete Registration:
                                                                                                            </p>
                                                                                                            <p style="font-family: Verdana; font-size: 20px; color: black; margin:0;" > 
                                                                                                                    Click the link below to activate your accaunt.
                                                                                                            </p>
                                                                                                            <div style="width:auto; height:auto;">
                                                                                                                    <a href="' . $activation_link . '" style="font-family: Verdana; font-size: 20px; color: black; margin:0;">' . $activation_link . '</a>
                                                                                                            </div>
                                                                                                    </div>
                                                                                                    <div style="width: 30%; height: 400px; float: left;">
                                                                                                            <img width="100%" height="100%" src="' . $link . '" alt="Dragon Agent" />
                                                                                                    </div>
                                                                                            </div>

                                                                                            <div style="height: 40px; width: 100%; padding-top: 10px; background-color: #2B3B58; color: white;">
                                                                                &copy;2012&nbsp;<a href="http:\\www.dragonagent.com" style="color:white;" target="_blank">Dragon Agent</a>, All right reserved
                                                                            </div>

                                                                                    </div>
                                                                            </center>
                                                                        </body>
                                                                    </html>
                                                                ';
                                $subject = 'Accaunt Activation Mail';
                                $headerSubject = 'Accaunt Activation';
                                new clsMail($email, $subject, $message, $headerSubject);
                                $retVal = $activation_link . "#" . $user->get_screenName() . "#" . $user->get_email() . "#";
                                echo $retVal;
                            } else {
                                echo "";
                            }
                            die();
                            break;
                        case "thankYou":
                            require 'Forms/thankYou.php';
                            $_SESSION['system'] = requestParam(2);
                            if ($_SESSION['system'] != "") {
                                $link = $config['site_url'] . '/thankYou';
                                header("Location:" . $link);
                            }

                            break;
                        case "ViewAllCVs":
                            require 'Forms/viewAllCVs.php';

                            break;

                        case "CreateNewCV":
                        case "signInSignUp":
                            require 'Forms/signInSignUp.php';
                            break;

                        case "summary":
                            require 'Forms/summery.php';
                            break;

                        default:
                            require 'Forms/fileNotFound.php';
                            break;
                    }
                    ?>
                </div>
                <div id="dvManuPort" style="width: 20%; float: left;" class="manuPanel">
                    <div style="height: 150px;">
                    </div>
                    <div id="dvManu" class="dvManu">
                        <ul>
                            <?php
                            if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
                                foreach ($menu['logedIn'] as $key => $value) {
                                    ?>
                                    <li><a href="<?php echo $value; ?>"> <?php echo $key; ?></a></li>
                                    <?php
                                }
                            } else {
                                foreach ($menu['anonymous'] as $key => $value) {
                                    ?>
                                    <li><a href="<?php echo $value; ?>"> <?php echo $key; ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>            
            </div>

            <div class="pageFooter">
                &copy;2012&nbsp;<a href="http:\\www.dragonagent.com" target="_blank">Dragon Agent</a>, All right reserved
            </div>
        </div>
    </center>
</body>
</html>
