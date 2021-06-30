<?php

$targetDir = 'uploads/';
$targetFile = $targetDir.basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
      echo "Файлът е снимка - " . $check["mime"] . ".";
      $uploadOk = 1;
  } else {
      echo "Файлът не е снимка.";
      $uploadOk = 0;
  }
}

if(file_exists($targetFile)) {
  echo "За съжаление файлът съществува вече.";
  $uploadOk = 0;
}

if ($_FILES["avatar"]["size"] > 500000) {
  echo "За съжаление файлът е много голям.";
  $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "За съжаление само JPG, JPEG, PNG и GIF файлове са разрешени.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "За съжаление твоят файл не е качен.";
} else {
  if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
    echo "Файлът ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " беше качен.";
  } else {
    echo "За съжаление, изникна грешка при качване на файла.";
  }
}
?>

<a href="index.php">Списък с контакти</a>