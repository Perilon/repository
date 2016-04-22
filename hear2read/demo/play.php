<?php
// define a cleanup function in order to erase our temp filesize
function cleanup($filename) {
	unlink($filename);
}

//	error_log('play.php: Got Here');
	if ($_GET['voice']) {
		$voice = $_GET['voice'];
		if ($_GET['text']) {
			$text = $_GET['text'];
		}
	}
	if ( isset($voice) && isset($text) ) {
		// create the input text file 
		$filename = tempnam("/tmp",'flite.TMP');
		$oFilename = $filename . ".wav";
		$filename =  $filename . ".txt";
		$file = fopen($filename, 'w');
		fwrite($file, $text);
		fwrite($file, '\n');
		fclose ($file);
		chmod($filename, 0777);
		
		// call flite
		$voice_path = '/var/www/html/demo-test/voices/'.$voice;
		$program = "/usr/local/bin/flite -voice $voice_path -f $filename -o $oFilename";
//		$return = $status = '';
		error_log("play.php: command = ".'"'.$program.'"');
		exec ($program);
//		error_log("play.php: Flite return = $return, status = $status");
		
		//send wav file to client
		header("Content-type: audio/wav");
		header("Content-Disposition: attachment; filename=flite.wav");
		header("Content-length: " . filesize($oFilename));
		readfile("$oFilename");
//		register_shutdown_function('cleanup', $filename);
//		register_shutdown_function('cleanup', $oFilename);
	} else {
		httperror();
	}
?>