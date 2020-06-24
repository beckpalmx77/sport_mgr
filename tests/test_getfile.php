<?php
$dir = "https://www.nrru.ac.th/assets/images/homebanner/";

// Open a directory, and read its contents
if (is_dir($dir)){
    if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
            echo "filename:" . $file . "<br>";
        }
        closedir($dh);
    }
} else {
    echo "Not do it" ;
}



$name = $_FILES["file"]["name"];
$ext = end((explode(".", $name))); # extra () to prevent notice

echo $ext;



$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);

$response = file_get_contents($dir, false, stream_context_create($arrContextOptions));

echo $response;

?> 