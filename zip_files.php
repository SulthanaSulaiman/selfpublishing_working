<?php
require 'connection.php';
require 'config.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];
  $id = encryptor('decrypt', $id);
//$zip = new ZipArchive();

$zip = new ZipArchive();

/*$filename=$id."_".time().".zip";
$zipFileName = getcwd() . "/uploads/proj_".$filename;*/
$zipFileName = getcwd() . "/uploads/proj_".$id.".zip";
$filename="proj_".$id.".zip";

if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
  $response = array('success' => false);
  echo json_encode($response);
  exit;
}

$allowedFileTypes = array(
  'image/jpeg',
  'image/png',
  'application/msword',
  'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
  'application/pdf',
  'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
  'application/zip',
  'application/x-zip-compressed',
  'application/x-7z-compressed',
  'application/x-rar-compressed',
  'text/plain',
  'application/xml',
  'application/vnd.ms-powerpoint',
  'application/vnd.openxmlformats-officedocument.presentationml.presentation'
);

$totalFileSize = 0;
if (!empty($_FILES['files']['name'])) {
  $fileCount = count($_FILES['files']['name']);
  for ($i = 0; $i < $fileCount; $i++) {
    $tmpFilePath = $_FILES['files']['tmp_name'][$i];
    if ($tmpFilePath !== '') {
      $fileName = $_FILES['files']['name'][$i];
      $fileType = $_FILES['files']['type'][$i];
      $fileSize = $_FILES['files']['size'][$i];

      if (in_array($fileType, $allowedFileTypes) && $totalFileSize + $fileSize <= 500 * 1024 * 1024) {
        $totalFileSize += $fileSize;
        $zip->addFile($tmpFilePath, $fileName);
        /*$sql="insert into files(file_name,file_size,purchase_id)
        values('$filename','$totalFileSize','$id')";
        mysqli_query($conn,$sql);*/
        $sql1="update services set fileName='$filename' where id='$id'";
        mysqli_query($conn,$sql1);
      } else {
        $response = array('success' => false);
        echo json_encode($response);
        exit;
      }
    }
  }
}
}
$zip->close();

$response = array('success' => true);
echo json_encode($response);
?>
