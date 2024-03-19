<?php
    $filePath = "../icon/" . $_GET['img'];
    if (file_exists($filePath.".jpg")){ 
        header('Content-Type: image/jpg');
        readfile("../icon/" . $_GET['img'].".jpg");
    }else if (file_exists($filePath.".jpeg")){
        header('Content-Type: image/jpeg');
        readfile($filePath.".jpeg");
    }else if (file_exists($filePath.".png")){
        header('Content-Type: image/png');
        readfile($filePath.".png");
    }else{
        header('Content-Type: image/jpg');
        readfile("image/default_icon.jpeg");
    }
  
?>