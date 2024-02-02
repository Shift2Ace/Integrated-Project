<?php

    ini_set('display_errors',1);
    error_reporting(-1);

    session_start();

    if (!isset($_SESSION['login_status'])){
        header("Location: routes.php");
    }else{
        if (!$_SESSION['login_status']){
            header("Location: routes.php");
        }
    }

    $icon_name = '';
    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $userID = $_SESSION['user_id'];
    $sql = "CALL get_icon($userID);";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        #set to session (role and login status)
        $icon_name=$row["result"];
        
    }

    $target_dir = "icon/"; // Specify the directory where the file will be placed

    
    $pattern = "$icon_name*";
    foreach (glob($target_dir . $pattern) as $file) {
        // Delete the file
        unlink($file);
    }
    
    $allowed = array("jpg", "jpeg"); // Specify the allowed file extensions

    // Check if the user has selected a file to upload
    if(isset($_FILES["fileToUpload"])) {
        // Get the file name, size, type, and temporary location
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileSize = $_FILES["fileToUpload"]["size"];
        $fileType = $_FILES["fileToUpload"]["type"];
        $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];
 
        // Get the file extension in lower case
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check if the file extension is allowed
        if(in_array($fileExt, $allowed)) {
            // Check if the file size is less than 10MB
            if($fileSize < 10485760) {
                // Check if the file is an actual image
                $check = getimagesize($fileTmpName);
                if($check !== false) {
                    // Generate the new file name based on the user id and the file extension
                    $newFileName = $icon_name . "." . $fileExt;
                    // Generate the target file path based on the directory and the new file name
                    $target_file = $target_dir . $newFileName;
                    // Move the file from the temporary location to the target location

                    if(move_uploaded_file($fileTmpName, $target_file)) {
                        // The file has been uploaded successfully
                        $console = "The file " . htmlspecialchars($fileName) . " has been uploaded as " . htmlspecialchars($newFileName) . ".";
                        echo "<script>console.log('Console: ". $console. "');</script>";
                        header("Location: account.php");
                    } else {
                        // There was an error while moving the file
                        $console = "Sorry, there was an error while uploading your file.";
                        echo "<script>alert('Console: ". $console. "');</script>";
                        echo "<script>window.location = 'edit_icon.php';</script>";
                    }
                } else {
                    // The file is not an image
                    $console = "Sorry, the file is not an image.";
                    echo "<script>alert('Console: ". $console. "');</script>";
                    echo "<script>window.location = 'edit_icon.php';</script>";
                }
            } else {
                // The file is too large
                $console = "Sorry, the file is too large.";
                echo "<script>alert('Console: ". $console. "');</script>";
                echo "<script>window.location = 'edit_icon.php';</script>";
            }
        } else {
            // The file extension is not allowed
            $console = "Sorry, only JPG and JPEG files are allowed.";
            echo "<script>alert('Console: ". $console. "');</script>";
            echo "<script>window.location = 'edit_icon.php';</script>";
        }
    } else {
        // The user has not selected a file to upload
        $console = "Please select a file to upload.";
        echo "<script>alert('Console: ". $console. "');</script>";
        echo "<script>window.location = 'edit_icon.php';</script>";
    }
?>