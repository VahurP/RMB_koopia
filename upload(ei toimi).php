<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = "uploads/"; 
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        echo "Fail on pilt - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Ei ole pilt";
        $uploadOk = 0;
    }

   
    if (file_exists($target_file)) {
        echo "Fail juba lisatud";
        $uploadOk = 0;
    }

    
    if ($_FILES["file"]["size"] > 2000000) {
        echo "Fail ei tohi ületada 2MB";
        $uploadOk = 0;
    }

    
    if (
        $imageFileType != "jpg" && $imageFileType != "png" &&
        $imageFileType != "jpeg" && $imageFileType != "gif"
    ) {
        echo "Ainult JPG, JPEG, PNG ja GIF failid on lubatud";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
