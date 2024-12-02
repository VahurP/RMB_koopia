<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = "uploads/";
    $original_name = basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

   
    $new_name = uniqid('img_', true) . '.' . $imageFileType;
    $target_file = $target_dir . $new_name;

    
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
           
            header("Location: comment.html?image=" . urlencode($new_name));
            exit;
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "The selected file is not an image.";
    }
}
?>
