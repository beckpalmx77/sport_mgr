<?php

function GetIconPNG($file_name)

{
    $ext = strtolower(substr($file_name,-3));


    switch ($ext) {
        case "doc":
            $img = "images/icon_png/doc.png";
            break;
        case "ocx":
            $img = "images/icon_png/doc.png";
            break;
        case "pdf":
            $img = "images/icon_png/pdf.png";
            break;
        case "xls":
            $img = "images/icon_png/xls.png";
            break;
        case "lsx":
            $img = "images/icon_png/xls.png";
            break;
        case "png":
            $img = "images/icon_png/png.png";
            break;
        case "jpg":
            $img = "images/icon_png/jpg.png";
            break;
        default:
            $img = "images/icon_png/file.png";
            break;
    }

    return $img;

}

?>