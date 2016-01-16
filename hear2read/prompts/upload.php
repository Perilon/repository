<?php

function bytesToSize1024($bytes, $precision = 2) {
    $unit = array('B','KB','MB');
    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
}
// echo "<h2> In upload.php</h2>";
$sFileName = $_FILES['image_file']['name'];
$sFileType = $_FILES['image_file']['type'];
$sFileSize = bytesToSize1024($_FILES['image_file']['size'], 1);
if (!empty($_FILES['image_file'])) {
    $myFile = $_FILES['image_file'];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
       echo "<p>An error occurred. " . $myFile["error"] . "</p>";
       exit;
    }

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $sFileName);

    // don't overwrite an existing file
    // $i = 0;
    $parts = pathinfo($name);
	
	// Did the user ignore our warning and try to upload something other than a .txt file?
	if ($parts['extension'] != 'txt') {
		echo "<p>Wrong File Type (must be .txt).</p>";
		exit;
	}
	
    // while (file_exists(UPLOAD_DIR . $name)) {
        // $i++;
        // $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	// }
	$upload_dir = "Languages/prompts/";
	if (!is_dir($upload_dir)) {
		mkdir($upload_dir, 0766);
		chmod($upload_dir, 0777);		
	}
	$upload_dir = $upload_dir . strtolower($parts["filename"]) . "/";
	if (!is_dir($upload_dir)) {
		mkdir($upload_dir, 0766);
		chmod($upload_dir, 0777);		
		// echo "<p>Directory $upload_dir created.</p>";
	}

    // preserve file from temporary directory
	// echo "<p>Moving File ".$myFile["tmp_name"]." to ". $upload_dir . $name."<p>";
	if  (is_uploaded_file($myFile["tmp_name"]))
			// echo "<p>Uploaded file ".$myFile['tmp_name']." exists</P>";
    $success = move_uploaded_file($myFile["tmp_name"], $upload_dir . $name);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }

    // set proper permissions on the new file
    chmod($upload_dir . $name, 0666);

echo "<p>Your file: {$sFileName} has been successfully uploaded.</p>";
echo "<p>Type: {$sFileType} ";
echo " Size: {$sFileSize}</p>";
echo "<p>Writing Prompt Line Files.</p>";

$iii=0;
$encoding = "";
$input_file = $upload_dir . $name;
$input_fh = fopen($input_file, 'r');
if ( !$input_fh ) {
  echo 'fopen failed. reason: '. $php_errormsg;
}

// echo "<p>File " . $input_file . "Opened for reading</p>";
while (!feof($input_fh)) {
	++$iii;
	$one_line = fgets($input_fh);
//	echo "<p>one_line = $one_line<br />";
	if ($encoding == "") {
		$encoding = mb_detect_encoding($one_line);
		echo "<p> Encoding = $encoding</p>";
	}
	$temp = explode(" ", $one_line);
	$output_file = $temp[1];
//	echo "output_file = $output_file<br />";
	$temp = explode("\"", $one_line);
	$one_line = $temp[1];
//	echo "file data = $one_line</p>";
//	echo "<p>upload_dir = $upload_dir<br />output_file = $output_file</p>";
	$output_fh = fopen($upload_dir . $output_file, 'w');
	fwrite($output_fh, $one_line);
	fclose($output_fh);
	// chmod($upload_dir . $output_file, 0777);
}
fclose($input_fh);
echo "<p>$iii lines processed</p>";
}
?>
