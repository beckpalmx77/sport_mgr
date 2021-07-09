<?php

include('includes/config.php');

//Receive form information passed by Ajax
//① Common form field information
//② Uploaded file information
//echo "post";
//print_r($_POST);
//exit;
//echo "file:";
//print_r($_FILES);

if($_FILES['fileUpload']['error']>0){
    exit('The attachment has an error');
}

//Attachment upload logic
//A. Attachment storage directory and name
$dir = "./videos/";
$file_dir = "videos/";
//Attachment suffix
$ext = substr($_FILES['fileUpload']['name'],strrpos($_FILES['fileUpload']['name'],"."));
$name = date("YmdHis").'-'.mt_rand(1000,9999).$ext;
$dir_name = $dir.$name;

//B. move_uploaded_file() Move the attachment from "temporary path name" to "real path name"
if(move_uploaded_file($_FILES['fileUpload']['tmp_name'],$dir_name)){

    $video_id = $_POST['video_id'];
    $filedoc_desc = $_POST['filedoc_desc'];
    $link = $_POST['link'];
    $type_image = $_POST['type_image'];

    $filename = $file_dir.$name;

    $sql = "INSERT INTO  tblvideo(video_id,file_name,filedoc_desc,type_image,link) VALUES(:video_id,:file_name,:filedoc_desc,:type_image,:link)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':video_id', $video_id, PDO::PARAM_STR);
    $query->bindParam(':file_name', $filename, PDO::PARAM_STR);
    $query->bindParam(':filedoc_desc', $filedoc_desc, PDO::PARAM_STR);
    $query->bindParam(':link', $link, PDO::PARAM_STR);
    $query->bindParam(':type_image', $type_image, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "บันทึกข้อมูลเรียบร้อย ";
    } else {
        echo "ไม่สามารถทึกข้อมูลได้ กรุณาตรวจสอบ";
    }
}else{
    echo "ไม่สามารถ Upload Video ได้ กรุณาตรวจสอบ";
}



