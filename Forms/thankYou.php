<?php
$system = $_SESSION['system'];
$_SESSION['system'] = "";

if ($system == "system"){
    echo '<div style="text-align: left;">
    <p style="font-family: sans-serif; font-size: 40px; margin-top: 0; padding: 0;">Congratulation!!!</p>
    <p style="font-family: sans-serif; font-size: 35px; margin-top: 40px; padding: 0;">
        You are the newest member of <b>Dragon Agent</b> Family
    </p>
    
    <p style="font-family: sans-serif; font-size: 30px; margin-top: 50px; padding: 0;">
        One More step ahead to complete your registration...
    </p>
    <p style="font-family: sans-serif; font-size: 30px; margin-top: 10px; margin-left: 80px; padding: 0;">
        Please Visit Your <b>Email Address</b> to activate your new Dragon Agent account 
    </p>
</div>';
}

elseif($system == "userActivated"){
    echo '<div style="text-align: left;">
    <p style="font-family: sans-serif; font-size: 40px; margin-top: 0; padding: 0;">Welcome BaCk!!!</p>
    <p style="font-family: sans-serif; font-size: 35px; margin-top: 40px; padding: 0;">
        Your Accaunt Has Been Activated
    </p>
    
    <p style="font-family: sans-serif; font-size: 30px; margin-top: 50px; padding: 0;">
        Enjoy Your Journey With US.....
    </p>    
</div>';
    $_SESSION['isActive'] = 1;
}

elseif($system == "notActivated"){
    echo '<div style="text-align: left;">
    <p style="font-family: sans-serif; font-size: 40px; margin-top: 0; padding: 0;">Dear User!!!</p>
    <p style="font-family: sans-serif; font-size: 35px; margin-top: 40px; padding: 0;">
        Your Accaunt Has <b>NOT</b> Been Activated
    </p>
    
    <p style="font-family: sans-serif; font-size: 30px; margin-top: 50px; padding: 0;">
        Please Avtivate Your Accaunt First.
    </p>    
</div>';
}
else{
    echo '<p style="font-size: 20px; "><b>BAD GUY:</b></p> You Are Not Suppos To Be HERE';
}

?>