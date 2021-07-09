<?php

//Receive form information passed by Ajax
//① Common form field information
//② Uploaded file information
//echo "post";
//print_r($_POST);
//exit;
//echo "file:";
//print_r($_FILES);

if($_FILES['touxiang']['error']>0){
    exit('The attachment has an error');
}

//Attachment upload logic
//A. Attachment storage directory and name
$dir = "./videos/";
//Attachment suffix
$ext = substr($_FILES['touxiang']['name'],strrpos($_FILES['touxiang']['name'],"."));
$name = date("YmdHis").'-'.mt_rand(1000,9999).$ext;
$dir_name = $dir.$name;

//B. move_uploaded_file() Move the attachment from "temporary path name" to "real path name"
if(move_uploaded_file($_FILES['touxiang']['tmp_name'],$dir_name)){
    echo "success";
}else{
    echo "fail";
}