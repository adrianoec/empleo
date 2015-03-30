<?php ///////////////UPLOADER-PHP.PHP////////////////////////////////// 
foreach ($_FILES['archivo']['tmp_name'] as $key => $tmp_name) {
    $file_name = $key . $_FILES['archivo']['name'][$key];
    $file_size = $_FILES['archivo']['size'][$key];
    $file_tmp = $_FILES['archivo']['tmp_name'][$key];
    $file_type = $_FILES['archivo']['type'][$key];
    move_uploaded_file($file_tmp, "imagenes/" . time() . $file_name);
}
?>