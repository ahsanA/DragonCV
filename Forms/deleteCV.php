<?php

$userId = $_SESSION['userId'];

$deleteCV = new clsUserInfo();

$retVal = $deleteCV->DeleteCV($userId);

if ($retVal == 1) {
    session_destroy();
    $link = $config['site_url'];
    header("Location:" . $link);
}

 else {
    echo 'Problem Occured';
}
?>
