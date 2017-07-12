<?php
$upload_folder = './uploads/';
if( isset($_POST['submit']) )
{
	//Get the uploaded file information
	$name_of_uploaded_file =  basename($_FILES['uploaded_file']['name']);
	//echo $name_of_uploaded_file;
	//get the file extension of the file
	$type_of_uploaded_file = substr($name_of_uploaded_file,strrpos($name_of_uploaded_file, '.') + 1);
	
	$size_of_uploaded_file = $_FILES["uploaded_file"]["size"]/1024;
		//copy the temp. uploaded file to uploads folder
		$path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;
		//echo $path_of_uploaded_file;
		$tmp_path = $_FILES["uploaded_file"]["tmp_name"];
		
		if(is_uploaded_file($tmp_path))
		{
		    if(!copy($tmp_path,$path_of_uploaded_file))
		    {
		    	$errors .= '\n error while copying the uploaded file';
		    }
		}
		
	//echo $name_of_uploaded_file;
	$filename  = $name_of_uploaded_file;
	$path      = './uploads/';
	//echo $_POST['name'];
	//die();
	//$filename  = "aboc.jpg";
	//$path      = 'uploads/';
	$file      = $path.$filename;
	//echo $file;
	$file_size = filesize($file);
	//echo $file_size;
	//die();
	$handle    = fopen($file, "r");
	$content   = fread($handle, $file_size);
	fclose($handle);

	$content = chunk_split(base64_encode($content));
	$uid     = md5(uniqid(time()));
	$name    = basename($file);

	$eol     = PHP_EOL;
	$subject = "AI-Mate - ";
	$subject .= $_POST['name'];
	$subject .= " DOB : ";
	$subject .= $_POST['date'];
	$message1 = "Hello Doctor,\n";
	$message1 .= "\n";
	$message1 .= "I am ";
	$message1 .= $_POST['name'];
	$message1 .= ". My DOB is : ";
	$message1 .= $_POST['date'];
	$message1 .= ".\n";
	$message1 .= "\n";
	$message1 .= "My Weight is : ";
	$message1 .= $_POST['weight'];
	$message1 .= ".\n";
	$message1 .= "\n";
	$message1 .= "I am feeling : ";
	$message1 .= $_POST['feeling'];
	$message1 .= ".\n";
	$message1 .= "\n";
	$message1 .= "PFA my selfie for your reference.\n";
	$message1 .= "\n";
	$message1 .= "Regards,\n";
	$message1 .= $_POST['name'];
	$message1 .= "\n";
	$message = nl2br($message1);


	$from_name = "AI Mate";
	$from_mail = "aimate@aimate.com";
	$replyto   = "mail@example.com";
	$mailto    = $_POST['email'];
	$header    = "From: " . $from_name . " <" . $from_mail . ">\n";
	$header .= "Reply-To: " . $replyto . "\n";
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";
	$emessage = "--" . $uid . "\n";
	$emessage .= "Content-type:text/html; charset=iso-8859-1\n";
	$emessage .= "Content-Transfer-Encoding: 7bit\n\n";
	$emessage .= $message . "\n\n";
	$emessage .= "--" . $uid . "\n";
	$emessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\n"; // use different content types here
	$emessage .= "Content-Transfer-Encoding: base64\n";
	$emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
	$emessage .= $content . "\n\n";
	$emessage .= "--" . $uid . "--";
	mail($mailto, $subject, $emessage, $header);
	unlink($file);
	header('Location: index.html');
}
?>