<?php
include 'users.php';
// are we uploading a wav file?
if (!empty($_FILES['prompt_wav'])) {
	$temp_file = $_FILES['prompt_wav']['tmp_name'];
	$user_dir = $_POST['user_dir'];
	$file_name =$user_dir.$_POST['file_name'].".wav";
	if( is_file($file_name) ) {
		error_log("uploadPrompt.php: erasing file ".$file_name, 0);
		unlink( $file_name );
	}
	rename($temp_file, $file_name);
	chmod( $file_name, 0777 );
 	error_log("uploadPrompt.php: wrote wav file ".$file_name,0);

} else {
	$call_id = $_POST['call_id'];
	$lang_dir = $_POST['lang_dir'];
	$user_dir = $_POST['user_dir'];																							// GET RID OF THIS
	$cur_index = $_POST['cur_index'];		
	$last_project_index = $_POST['last_index'];											//LastPrompt
//	echo "<p>call_id = ".$call_id."<br />lang_dir = ".
//						$lang_dir."<br />user_dir = ".
//						$user_dir."<br />cur_index = ".
//						$cur_index."<br />last_project_index =".
//						$last_project_index."</p>";
	// Get the index of the last line of the language prompts.  Should = the index of the last prompt file
	$file_list = scandir($lang_dir);
	$last_entry = $file_list[sizeof($file_list) - 1];
	// echo "<p>Last Entry = ".$last_entry."</p>";
	$last_file_index = substr($last_entry,sizeof($last_entry)-5, 4);
	$file_name = substr($last_entry,0,sizeof($last_entry)-5);
	$project_name = substr($file_name, 0, sizeof($file_name)-2);
	// echo "<p> Calculated file_name and last_file_index from file $last_entry<br />file name is $file_name<br />last_file_index is $last_file_index<br />project_name is $project_name</p>";
	// $last_entry = file name of the last prompt file
	// $last_file_index = index of the last prompt file
	// $file_name is the file name part of both the prompt and project files
	$cur_project_index = $cur_index;
	switch ($call_id) {
		case 'start':
	// echo "<p>code for call_id: start</p>";
			$sql = "SELECT `lastPrompt` FROM `usersdat` WHERE `name` = '".$username."'";
			$redb = $objUsers->sqlExecute($sql);
			if ($objUsers->affected_rows == 0 || $redb[0]['lastPrompt'] < 1) {
				//no project started we are just starting the project
				$last_project_index = 0;
				$cur_project_index = "0001";
			} else {
				$last_project_index = $redb[0]['lastPrompt'];
				(string)$cur_project_index = $last_project_index + 1;
				while (strlen($cur_project_index) < 4)$cur_project_index = "0".$cur_project_index;
			}
			break;
		case 'prev':
	// echo "<p>code for call_id: rewind</p>";
			//If cur_project_index > 1 decrement it
			(int)$cur_project_index = $_POST['cur_index'];
			if ($cur_project_index > 1) {
				$cur_project_index--;
				$cur_project_index = (string)$cur_project_index;
				while(strlen( $cur_project_index ) < 4) $cur_project_index = "0".$cur_project_index;
			}
			break;
		case 'recstop':
			if ($cur_project_index > $last_project_index) {
				// This recording might be for a previously recorded prompt.  Only update Last_project_index if we have just recorded a new prompt
				$last_project_index++;
				$sql = "UPDATE `usersdat` SET `lastPrompt`='".$last_project_index."'  WHERE `name` = '".$username."' AND `language` = '".ucfirst($project_name)."'";
				// echo "<p>$sql</p>";
				$redb = $objUsers->sqlExecute($sql);
				if ($objUsers->affected_rows == 0) {
					echo "PROBLEM";
					exit;
				}
			} 
			// save the recorded file (recorded file is now saved on the client))
			$tmp_index = (int)$cur_project_index;
		// echo "<p>cur_index = ".$cur_index."<br />last_file_index = ".$last_file_index."</p>";
			if ($tmp_index <= (int)$last_file_index) {
				$tmp_index++;
				$cur_project_index = (string)$tmp_index;
				while(strlen( $cur_project_index ) < 4) { 
					$cur_project_index = "0".$cur_project_index;
				}
			}
			break;
		// echo "<p>cur_project_index = ".$cur_project_index."<br />last_file_entry = ".$last_file_entry."</p>";
			break;
		case 'next':
//		echo "<p>next: cur_project_index = $cur_project_index</p>";
			$tmp_index = (int)$cur_project_index;
			if ( $tmp_index <= $last_project_index && $tmp_index < (int)$last_file_index ) {
		// echo "<p>cur_index = ".$cur_index."<br />last_file_index = ".$last_file_index."</p>";
				$tmp_index++;
				$cur_project_index = (string)$tmp_index;
				while(strlen( $cur_project_index ) < 4) $cur_project_index = "0".$cur_project_index;
			}
//		echo "<p>cur_project_index = ".$cur_project_index."<br />last_file_entry = ".$last_file_entry."</p>";
			break;
		case "playstop":
			break;
		case 'tolast':
			$tmp_index = $last_project_index + 1;
			$cur_project_index = (string)$tmp_index;
			while(strlen( $cur_project_index ) < 4) $cur_project_index = "0".$cur_project_index;
			break;
		case 'tonum':
			$cur_project_index = (string)$cur_project_index;
			while(strlen( $cur_project_index ) < 4) $cur_project_index = "0".$cur_project_index;
			break;
	}
//	 echo "<p>cur_project_index = ".$cur_project_index."</p>";
//	 echo "<p>last_project_index = ".$last_project_index."</p>";
	// dispaly proper prompt
//	echo "<p>".$lang_dir.$file_name.$cur_project_index."</p>";
	$lfp= fopen($lang_dir.$file_name.$cur_project_index, 'r');
	$prompt_line = fgets($lfp);
	// echo "<p>prompt line = $prompt_line</p>";
	fclose($lfp);
}
?>
<div id="sessiondisplay">
		<div class="session-control">
			<button id='session_start' class='session_stop_button' value='stop session' onclick='session_stop()' />
			<p id="session_control_txt" class="session_txt">End Session</p>
		</div>
	<div class="audiodiv" id="audio_div" style='height: 10em;'>
	</div>
	<div class="promptdiv">
		<h2><< Prompt# <?php echo $cur_project_index;?> >></h2>
		<p class="promptline" class="prompt"><?php echo $prompt_line; ?></p>
	</div>
	<div id="record_controls">
		<button id="record_btn" class="record_button" onclick="record_start()">
			<p id="record_button_txt" class="record_txt">Record</p>
		</button>
		<button id="rerec_btn"  class="rerec_button" 
			onclick="back_up('<?php echo $lang_dir;?>','<?php echo $user_dir;?>','<?php echo $cur_project_index;?>','<?php echo $last_project_index;?>')">
			<p id="rerec_button_txt" class="rerec_txt">Last Prompt</p
		</button>
<!--		<button id="play_btn"   class="play_button" value="Play" 
			onclick="play_it('<?php // echo $lang_dir;?>','<?php // echo $user_dir;?>','<?php // echo $cur_project_index;?>','<?php // echo $last_project_index;?>')">
			<p id="play_button_txt" class="play_txt">Play</p>
		</button>
-->		<button id="stop_btn" class="stop_button" 
			onclick="stop_it('<?php echo $lang_dir;?>','<?php echo $user_dir;?>','<?php echo $cur_project_index;?>','<?php echo $last_project_index;?>')">
			<p id="stop_button_txt" class="stop_txt">Stop</p>
		</button>
		<button id="cont_btn" class="cont_button" 
			onclick="cont_it('<?php echo $lang_dir;?>','<?php echo $user_dir;?>','<?php echo $cur_project_index;?>','<?php echo $last_project_index;?>')">
			<p id="cont_button_txt" class="cont_txt">Continue</p>
		</button>	
	</div>
	<h2 id="progress_msg" class='progress_message'></h2>
	<div id="jump_ctrl">
	  <?php if ($last_project_index > 2) { ?>
		<div id="jump_to">
				<span class="jump_prompt">Re-record Prompt # 
					<input id="p_num" type="number" name="prompt_num"value="<?php echo $last_project_index; ?>" 
						min="1" max="<?php echo $last_project_index +1; ?>">
					<button id="toum_btn" class="jump_prompt" 
						onclick="to_prompt_nbr('<?php echo $lang_dir;?>','<?php echo $user_dir;?>','<?php echo $cur_project_index;?>','<?php echo $last_project_index;?>')"> Go </button>
						&nbsp; or &nbsp;
					<button id="tolast_btn" class="jump_prompt"
						onclick="to_last('<?php echo $lang_dir;?>','<?php echo $user_dir;?>','<?php echo $cur_project_index;?>','<?php echo $last_project_index;?>')">
						Resume</button>
						recording from where you left off.
				</span>
		</div>
	  <?php } ?>
	</div>
</div>