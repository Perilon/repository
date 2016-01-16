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
	<?php $this_page = "prompts/ingest.php";?>
		<div class="container">
			<?php echo $login; ?>
			<?php if(isset($_SESSION['username'])) {
				if(isset($_SESSION['rank']) && $_SESSION['rank']>2) {
					// Super User
					?>
					<header>
						<h1>Ingest Prompt files</h1>
					</header>
			<div class="contr">
				<h2 style="color: white;">
					You can select the file (.txt) and click Upload button, or 
						<a href="app.php"><button class="button-bar">Return to Main Page</button></a>
				</h2>
			</div>

            <div class="upload_form_cont">
                <form id="upload_form" enctype="multipart/form-data" method="post" action="upload.php">
                    <div>
                        <div><label for="image_file">Please select a text file</label></div>
                        <div><input type="file" name="image_file" id="image_file" onchange="fileSelected();" /></div>
					</div>
                    <div>
                        <input type="button" value="Upload" onclick="startUploading()" style="color: #00548b;"/>
					</div>
                    <div id="fileinfo">
                        <div id="filename"></div>
                        <div id="filesize"></div>
                        <div id="filetype"></div>
                        <div id="filedim"></div>
                    </div>
                    <div id="error">You should select valid .txt files only!</div>
                    <div id="error2">An error occurred while uploading the file</div>
                    <div id="abort">The upload has been canceled by the user or the browser dropped the connection</div>
                    <div id="warnsize">Your file is very big. We can't accept it. Please select more small file</div>
					<div id="extok">This file can be ingested</div>

                    <div id="progress_info">
                        <div id="progress"></div>
                        <div id="progress_percent">&nbsp;</div>
                        <div class="clear_both"></div>
                        <div>
                            <div id="speed">&nbsp;</div>
                            <div id="remaining">&nbsp;</div>
                            <div id="b_transfered">&nbsp;</div>
                            <div class="clear_both"></div>
                        </div>
                        <div id="upload_response"></div>
                    </div>
                </form>

            </div>
			
					<?php
				} else {
					//regular user (should not be here)
					echo "<h1>You don't belong here!</h1>";
				} 
			} ?>
		</div>
		<!-- Footer -->
		<?php include 'footer.php';?>
	</body>
</html>
