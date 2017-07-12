<?php
$upload_folder = './uploads/';

$path      = './uploads/';
$filename  = "aboc.jpg";
$imgData = str_replace(' ','+',$_POST['afile']);
$imgData =  substr($imgData,strpos($imgData,",")+1);
$imgData = base64_decode($imgData);
// Path where the image is going to be saved
$filePath = $path.$filename;
//echo $filePath;
// Write $imgData into the image file
$file = fopen($filePath, 'w');
fwrite($file, $imgData);
fclose($file);
//echo $_REQUEST['username'];
//die();
//unlink($file);
$json = json_encode(array(
  'username' => $_REQUEST['username'],
  'date' => $_REQUEST['date'],
));

/*
$json = json_encode(array(
  'name' => $fileName,
  'type' => $fileType,
  'dataUrl' => $dataUrl,
  'username' => $_REQUEST['username'],
  'accountnum' => $_REQUEST['accountnum']
));
*/
echo $json;
?>