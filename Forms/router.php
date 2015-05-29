<?php
require 'config/config.php';

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


<div id="dvCVCommon" style="<?php
if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    echo 'display:block;';
} else {
    echo 'display:none;';
}
?>" >            

    <div id="dvCreateCvContainer" style="padding-top:50px; height:200px; width:50%; float:left;">

        <div style="padding-top:25px; height:75px; width:350px; background-color:#465A7D; font-family:Tahoma; font-size:25px; border:1px solid #465A7D; ">
            <a href= "<?php echo $config['site_url'] . '/personalInfo' ?>" style= "text-decoration:none; color:#BACEF9" >Create your own CV</a>                            
        </div> 

    </div> 

</div>