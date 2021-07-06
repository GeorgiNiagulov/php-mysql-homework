<?php
$targetDir = 'uploads/';
$targetFile = $targetDir.basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "Файлът е снимка - " . $check["mime"] . ".".'<br/>';
        $uploadOk = 1;
      } else {
        $error['notFile'] = "Файлът не е снимка.".'<br/>';
        $uploadOk = 0;
      }
    }

  if ($_FILES["avatar"]["size"] > 50000000) {
    $error['bigFile'] = "За съжаление файлът е много голям.".'<br/>';
    $uploadOk = 0;
  }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" && !empty($avatar)) {
    $error['fileType'] = "За съжаление само JPG, JPEG, PNG и GIF файлове са разрешени.".'<br/>';
    $uploadOk = 0;
  }

  if ($uploadOk == 0) {
    $error['upload'] = "За съжаление твоят файл не е качен.";
  } else {
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
      $avatar = $targetFile;
    } else {
      $avatar = $contact['avatar'];
    }
  }





