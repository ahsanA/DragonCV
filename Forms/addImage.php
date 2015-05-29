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

$imgObj = new clsImage();


$imageInfoObj = new clsImageInfo();
$userId = $_SESSION['userId'];
$retVal = $imageInfoObj->SelectImage($userId);
if (isset($retVal['id'])) {
    $presentImage = $retVal['image_path'];
}

if (isset($_POST['xsubmit'])) {
    $image = $_FILES['image']['name'];

    if ($image) {
        $filename = stripslashes($_FILES['image']['name']);
        $extension = $imgObj->getExtension($filename);
        $extension = strtolower($extension);

        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png")
                && ($extension != "gif") && ($extension != "JPG") && ($extension != "JPEG")
                && ($extension != "PNG") && ($extension != "GIF")) {
            echo '<h3>Unknown extension!</h3>';
        } else {
            $imageName = time() . '.' . $extension;
            //$imagePath = $config['site_url'].'/tmpImage/'.$imageName;
            $imagePath = 'tmpImage/' . $imageName;

            $copied = copy($_FILES['image']['tmp_name'], $imagePath);

            if ($copied) {
                require 'DTO/SimpleImage.php';
                $image = new SimpleImage();

                $tempImgPath = 'tmpImage/' . $imageName;
                $image->load($tempImgPath);

                $image->resize(132, 160);


                $FinalImagePath = 'tmpImage/' . $imageName;
                $image->save($FinalImagePath);
                $previewImage = $config['site_url'] . '/' . $FinalImagePath;
            }
        }
    }
}

if ($_POST['save']) {

    $previewImage = $_POST['newImage'];
    $extension = $imgObj->getExtension($previewImage);
    $imageName = time() . '.' . $extension;
    $FinalImagePath = 'Images/' . $imageName;

    $copied = copy($previewImage, $FinalImagePath);

    $newImage = $config['site_url'] . '/Images/' . $imageName;
    if ($copied) {
        $imageInfoObj = new clsImageInfo();
        $userId = $_SESSION['userId'];

        $retVal = $imageInfoObj->SelectImage($userId);
        if (isset($retVal['id'])) {
            $url = $retVal['image_path'];
            $order = array($config['site_url'].'/');
            $replace = '';
            $path = str_replace($order, $replace, $url);
                        
            @unlink($path);
            $retVal = $imageInfoObj->DeleteImage($userId);
        }

        $success = $imageInfoObj->InsertImage($userId, $newImage);

        if ($success) {
            $presentImage = $newImage;
        }
    }
}

//$presentImage = $config['site_url'] . '/Images/Image0462.jpg';
//$newImage = $config['site_url'] . '/Images/Image0462.jpg';
//<img id="prsnImg" src="<?php echo $presentImage; 
?>

<div style="height: 260px; width: 304px; margin-top: 100px; border:1px solid red;">
    <div style="height: 20px; width: 132px; margin-right: 10px; margin-top: 20px; float: right; font-size: 20px; font-weight: bold; text-align: left;">
        Preview:
    </div>
    <form name="imgUpload" action="#" method="post" enctype="multipart/form-data">
        <div style="height: 160px; width: 132px; margin-left: 10px; margin-top: 60px; float: left; border: 1px solid green;">
            <img id="newImg" style="height: 100%; width: 100%;" src="<?php echo $presentImage; ?>" />
        </div>
        <div style="height: 160px; width: 132px; margin-right: 10px; margin-top: 20px; float: right; border: 1px solid green;">
            <img id="newImg" style="height: 100%; width: 100%;" src="<?php echo $previewImage; ?>" />
            <input type="text" hidden="true" value="<?php echo $previewImage; ?>" name="newImage" />

        </div>
        <div style="margin-right: 10px; margin-top: 10px; float: right;">
            <input type="submit" name="save" value="Save" />
        </div>
    </form>
</div>

<div style="height: 50px; width: 304px; margin-top: 50px; border: 1px solid green;">
    <form name="imgUpload" action="#" method="post" enctype="multipart/form-data">
        <div style="text-align: left;" >
            <input type="file" name="image" id="image" />
        </div>
        <div style="text-align: right;" >
            <input type="submit" name="xsubmit" value="Upload" />
        </div>
    </form>
</div>   

<div class = "dvManu" style="width:230px; float:right; margin-right:50px; text-align: center; border:1px solid #B7C2D3;; background-color:#B7C2D3;">
    <ul>
        <li style="margin: 0; padding: 0;"><a style="color:#2B3B58; font-size:25px;" href="<?php echo $config['site_url'] . '/summary/' . $_SESSION['userId']; ?>"> View Own CV </a></li>
    </ul>
</div>