<?php
// Include the file in which are set the object of the classes for Login, Register, Recover-data, and User-page
// include('users/index.php');


?>
<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<!-- Head -->
	<?php include  'users.php'; ?>
	<?php include 'head.php';?>
	<?php $this_page = "prompts/app.php";?>
	
		<div class="container">
			<div class="project">
		<?php echo $login; ?>
			<?php if(isset($_SESSION['username'])) {
				if(isset($_SESSION['rank']) && $_SESSION['rank']>2) {
					// echo "<header style='margin-top: 2em;'><h1>Hello " .$username. ".</h1></header>";
					?>
					<div class="center" style="text-align: center; width: 100%; margin-bottom: 4em;">
						<header><h3>Supper User Commands</h3></header><br /><br />
						<div style="width: 10%; float:left;"><p> </p></div>
						<div style="width: 20%; float:left;"><a href="ingest.php"><button class="button-bar">Ingest File</button></a></div>
						<div style="width: 20%; float:left;"><a href="manageuser.php"><button class="button-bar">Manage Users</button></a></div>
						<div style="width: 20%; float:left;"><a href="manageproject.php"><button class="button-bar">Manager Projects</button></a></div>
						<div style="width: 20%; float:left;"><a href="cleanfile.php"><button class="button-bar">Clean Prompt File</button></a></div>
						<div style="width: 10%; float:left;"><p> </p></div>
						<br />
					</div>
					<?php
				} else {
					?>
					<header style='margin-top: 1em;'><h1 style='margin-bottom: 0em;'>Welcome <?php echo $username;?>.</h1></header> 
					<div id="project" class="center">
					<p> </p>
					<?php
					// echo "<p>".print_r($_POST)."</p>";
					if ($lang_id = $_POST['language']) {
						$sql="SELECT `language` FROM `usersdat` WHERE `name` ='".$username."'";
						// echo "<p>$sql</p>";
						$redb = $objUsers->sqlExecute($sql);
						if ($objUsers->affected_rows == 0) {
							$sql = "INSERT INTO `usersdat` (`language`, `name`) VALUES ('". $lang_id ."', '". $username ."')";
							// echo "<p>$sql</p>";
							$redb = $objUsers->sqlExecute($sql);
							if ($objUsers->affected_rows == 0) echo "<p>DATABASE error.";		
						} else {
							$sql = "UPDATE `usersdat` SET `language`='".$lang_id."', `lastPrompt`=0 WHERE `name` = '".$username."'";
							// echo "<p>$sql</p>";
							$redb = $objUsers->sqlExecute($sql);
						}
					}
					// Look to see if user has specified a language and a file for his prompt files.  These are stored in the D/B
					$sql = "SELECT `language` FROM `usersdat` WHERE `name` = '".$username."'";
					// echo "<p>Getting language.<br />".$sql."</p>";
					$redb=$objUsers->sqlExecute($sql);
					// echo "<p>redb =".print_r($redb)."</p>";
					if ($objUsers->affected_rows == 0 || $redb[0]['language'] == "") {
						?>
						<h2>Thank you for helping.  To get started a little bit of information is required.</h2>
						<form id='get_started_form'  method='post' action='app.php'>
							<div style="text-align:left;">
							<p name="lang_id">Select your desired language.</p>
								<select name="language" id='language' style="width:15em;">
									<option value="Hindi">Hindi</option>
									<option value="Marathi">Marathi</option>
									<option value="Tamil">Tamil</option>
									<option value="Gujarati">Gujarati</option>
									<option value="Kannada">Kannada</option>
									<option value="Bengali">Bengali</option>
									<option value="Assamese">Assamese</option>
									<option value="Telugu">Telugu</option>
									<option value="Malayalam">Malayalam</option>
									<option value="Punjabi">Punjabi</option>
									<option value="English">English</option>
								</select>
							</div>
							<div style="text-align:left;";>
							<input type="submit" name="submit" value="submit" style="margin:1em 0 1em 0;" />
							<br />
							<br />
						</form> 
						<?php
					} else {
						$language = strtolower($redb[0]['language']);
					?>
				<?php
				// Has this user started a project? (User is identified by $username)
				$user_has_projects = $unstarted_projects = false;
				
				if (is_dir($lang_dir="Languages/prompts/".$language."/")) {
					if (! is_dir($user_dir="Languages/projects/".$language."/")) {
						mkdir($user_dir, 0777);
					}
					if(! is_dir($user_dir=$user_dir.$username."/")) {
						mkdir($user_dir, 0777);
						// echo "<p>made user directory: ".$user_dir."</p>";
					}
					// echo "<p>Lang_dir = ".$lang_dir." User_dir = ".$user_dir."</p>";
					$sql = "SELECT `lastPrompt` FROM `usersdat` WHERE `name` = '".$username."'";
					$redb = $objUsers->sqlExecute($sql);
					// echo "<p>$sql</p>";
					if ($objUsers->affected_rows == 0 || $redb[0]['lastPrompt'] < 1)
						$unstarted_projects = true;
					else
						$user_has_projects = true;
					
//					$user_projects = $new_projects = null;
//					$prompt_list = scandir($user_dir);
//					$num_prompts = 0;
//					$match_str = $language."_[0-9][0-9][0-9][0-9]";
//					// echo "<p>match_str= ".$match_str." list size is ".sizeof($prompt_list)."</p>";
//					for ($i = 2; $i < sizeof($prompt_list); ++$i) {
//						$fn = pathinfo($prompt_list[$i]);
//						if ( fnmatch( $match_str, $fn['filename'])) {
//							$num_prompts++;
//						}
//					}
//					// echo "<p>num_prompts = ".$num_prompts."</p>";
//					if ($num_prompts > 0) {
//						$user_has_projects = true;
//					} else {
//						$unstarted_projects = true;
//					}
					
				} else {
					echo "<h2>The Language prompt file does not exist yet.  Please try again later.</h2>";
				}
				?>
				<!-- <form id='Project_form'  method='post' action='project.php'> -->
					<div id=mediaerrormsg></div> 
					<div id="projectselect">
						<div style="width: 20%; float: left"><p> </p></div>
						<?php	
						if ($unstarted_projects) {
							// Display the Start New Project button
							?>
							<div style="width: 20%; float:left;">
								<input id ="newprojbutton" type="button" value="Start Your Project"
									onclick="startProject('<?php echo $lang_dir;?>','<?php echo $user_dir;?>',false)" style="width: 100%; color: #00548b;" />
							<!--action="newproj.php-->
								<div style="width: 100%;" id="starterror"><p>Not Yet Written!</p></div>
								<div id="newprojects"></div>
							</div>
							<?php
						} else {
							?>
							<div style="width: 20%; float: left"><p> </p></div>
							<?php
						}
						?>
						<div style='width: 20%; float:left;'> <p> </p></div>
						<?php
						if ($user_has_projects) {
							?>
							<div style="width: 20%; float:left;">
								<input id ="existprojbutton" type="button" value="Continue Your Project" 
									onclick="startProject('<?php echo $lang_dir;?>','<?php echo $user_dir;?>',true)" style="width: 100%; color: #00548b;" />
								<div "style="width: 100%;" id="conterror"><p>Not Yet Written!</p></div>
							</div>
							<?php
						} else {
							?>
							<div style="width: 20%; float: left"><p> </p></div>
							<?php					
						}	
						?>
							<div style="width: 20%; float: left"><p> </p></div>

					</div>
					<div style="height: 1em;"><p> </p></div>
					<div id="start_project" style="width: 100%";>
						<p>start_project code here!</p>
					</div>
				<!-- <form>  -->
			</div>
				</div>
				<?php
					}
				}
			} else {
				?>
				<h1 onclick="objLogare.adLog_form()">Please login</h1>
			<?php
			} ?>
			</div>
		</div>
		<!-- Footer -->
		<?php include 'footer.php';?>
	</body>
</html>
