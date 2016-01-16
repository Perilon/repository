<!DOCTYPE HTML>
<html>
<?php
// Flite Voice Synthesis Demo
require 'vendor/autoload.php';
require_once('php/geoplugin.class.php');
use Mailgun\Mailgun;

function clean_string($string) {
	$bad = array("content-type","bcc:","to:","cc:","href");
	return str_replace($bad,"",$string);
}
function unQuoteString($string) {
	$rstring = $string;
	if (substr($rstring, 0, 1) == "'") $rstring = substr($rstring, 1);
	$length = strlen($rstring) - 1;
	if (substr($rstring, $length) == "'") $rstring = substr($rstring, 0, $length);
	return $rstring;
}

	$user_name = '';
	$user_email = '';
	$user_voice = '';
	$user_sentence = '';
	$user_comments = '';
	
	if( isset($_POST['call_id']) ) {
			$user_name = unQuoteString( $_POST['name'] );
			$user_email = unQuoteString( $_POST['from'] );
			$user_voice = unQuoteString( $_POST['lang'] );
			$user_sentence = unQuoteString( $_POST['sentence'] );
			$user_comments = unQuoteString( $_POST['comment'] );
			
			$email_to = "suresh@hear2read.org";
			
			//Add language to email subject
			$user_language = '';
			switch ($user_voice) {
				case 'Hindi_Female_AXB.flitevox':
					$user_language = "Hindi";
					break;
				case 'Kannada_Female_SMJ.flitevox':
					$user_language = "Kannada";
					break;
				case 'Marathi_Female_SLP.flitevox':
					$user_language = "Marathi";
					break;
				case 'Tamil_Male_SKS.flitevox':
					$user_language = "Tamil";
				break;
				case 'Telugu_Female_KNR.flitevox':
					$user_language = "Telugu";
				case 'Gujarati_Female_AXB':
					$user_language = 'Gujarati';
				break;
			}

			$email_subject = "Flite " . $user_language . " Demo Comment: "; 
			$ip_address = $_SERVER['REMOTE_ADDR'];
//			$geoplugin = new geoPlugin();
//			locate the IP
//			$geoplugin->locate();

			$error_message = "";
			$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
			if(!preg_match($email_exp,$user_email)) {
				$error_message .= 'The Email Address you entered does not appear to be valid.<br />';//
			} else if(!filter_var($user_email,FILTER_VALIDATE_EMAIL)) {
				$error_message .='The Email Address you entered does not appear to be valid.<br />';
			}
			$string_exp = "/^[A-Za-z .'-]+$/";
			if(!preg_match($string_exp,$user_name)) {
				$error_message .= 'The First Name you entered does not appear to be valid.<br />';
			}
			if( $error_message == "") {
				
				$email_message .= "<p>From: ".clean_string($user_name)." (".clean_string($user_email).")</p>";
				$email_message .= "<p>IP Address: ".$ip_address."<br /><br /></p>";
//				$email_message .= "<pre>";
//				$email_message .= "    Geolocation results for {" . $geoplugin->ip . "}:
//					City: {" . $geoplugin->city . "}
//					Region: {" . $geoplugin->region . "}
//					Country Name: {" . $geoplugin->countryName . "}
//					Country Code: {" . $geoplugin->countryCode . "}";
//				$email_message .= "</pre>";
				$email_message .= "<p>Voice: ".clean_string(nl2br($user_voice))."</p><br />";
				$email_message .= "<p>Test Sentence: ".clean_string(nl2br($user_sentence))."</p><br />";
				$email_message .= "<p>Comments:</p><p>".clean_string(nl2br($user_comments))."</p>";

				// Instantiate the client
				$mgClient=new Mailgun('key-8ab8ad3cd5293bdb93c1b31ea8bb25cd');
				$domain="sandboxa915612f51ef4ecbb89f0ca2638e29ad.mailgun.org";
				// Send Message through mailgun
				$result=$mgClient->sendMessage("$domain",
									array(  'from'    => "postmaster@sandboxa915612f51ef4ecbb89f0ca2638e29ad.mailgun.org",
											'to'      => "<".$email_to.">",
											'subject' => $email_subject,
											'html'    => "<html>".$email_message."</html>"  ));
				if ($result) {
					$error_message .=  "Thank you for your comment.";
				} else {
					$error_message .= "<span style=\"color: red; text-align: center;\">An error has occured sending your message.</p><p>Please try contacting us directly at suresh[at]hear2read[dot]com.</span>";
				}
			}
		echo "<p style='margin-top:0;text-align:center;color:red;'>" . $error_message . "</p></html>";
		return;
	} else {
	?>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
	<!-- Head -->
	<?php // include  'users.php'; ?>
	<?php include 'head.php';?>
	<?php $this_page = "demo/app.php"; ?>
		<div class="container">
			<div style="margin-bottom:0;padding-top:.5em;overflow-y:auto;" class="project">
				<div style="width:18%;float:left">
					<!-- <p style="margin-top:0;color:#00548b;">Choose Voice: -->
					<h3 id='chosen-voice' style="float:left;display:none;">
						<button style='font-size:.75em;color:#00548f;' onclick='new_voice()'>Choose Voice</button>
					</h3>
				</div>
					<span id='choose-a-voice' style='float:left;'><h4 style="text-align:center;color:red;margin:0 4em 0 4em;">This Demo requires either Chrome or Firefox browser running on a Windows PC or 
						Android device or Mac. (Currently this Demo does not work on iPhones or iPads due to iOS limitations.)</h4>
					<h4>Choose a voice below</h4></span>
				<div id='language-icons'>
					<input type='image' alt='Hindi Female AXB' src='images/hindi-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('Hindi_Female_AXB.flitevox')">
					<input type='image' alt='Kannada Female SMJ' src='images/kannada-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('Kannada_Female_SMJ.flitevox')">
					<input type='image' alt='Marathi Female SLP' src='images/marathi-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('Marathi_Female_SLP.flitevox')">
					<input type='image' alt='Tamil Male SKS' src='images/tamil-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('Tamil_Male_SKS.flitevox')">
					<input type='image' alt='Telugu Female KNR' src='images/telugu-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('Telugu_Female_KNR.flitevox')">
					<input type='image' alt='Gujarati Female AXB' src='images/gujarati-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('Gujarati_Female_AXB')">
				</div>
				<div id='sentence-controls' style="float:left;display:none;">
					<div style='float:left;margin-right:1em;'>
						<h4>
							<span id='language' style='font-weight:900;margin-right:.3em;'></span>
						</h4>
					</div>
					<div style='float:left;margin-right:1em;'>
						<h4>Sentence # 							
							<input type='image' alt='number down' src='images/left-arrow.png' style="vertical-align:top;border:0;margin:0 0 0 .5em;font-size:.5em;" 
								onclick="prev_example()">
							<span id='sentence-number' style="width:3em;font-weight:900;border:1px solid #00548b;background-color:white;"></span>
							<input type='image' alt='number up' src='images/right-arrow.png' style="vertical-align:top;border:0;font-size:.5em;" 
								onclick="next_example()">
						</h4>
					</div>
					<div style='float:left;margin-right:2.5em;'>
						<h4>
						Pick from a list 
							<input type='image' alt='choose from list' src='images/choose-from-list.png' style="vertical-align:top;margin-left:.1em;font-size:3em;" 
								onclick="show_examples()">
						</h4>
					</div>
				<div style='float:left;'>
					<span id="request-buttons" style="display:none">
						<input type='image' alt='listen to sentence' onclick="play_tts()" src='images/listen.jpg' style="vertical-align:top;border:0;">
						<input type='image' alt='download wav file' onclick="download_tts()" src='images/download.jpg' style="vertical-align:top;border:0;">
						<br />
						<span id="audio-controls" style="display:none;">
							<audio id="player"></audio>
							<a id="downloader" href="" download="flite.wav" target="_blank" style="display:none;"></a>
						</span>
					</span>
				</div>
				</div>
				
				<div style="width:100%;float:left;">
					<div id='text-area' style="text-align:left;display:none;"></div>
							<textarea style="display:none;float:left;width:80%;margin-left:10%" oninput="text_entered()" maxlength="400" rows=2 cols=100 id="textarea" name="text"
								placeholder="Enter text (in the selected language) here."><?php echo $user_sentence;?></textarea>
					</span>
					<div id="comment-area" style="display:none;border:solid;border-width:.15em;border-color:#00548b;border-radius:15px;">
						<div>
							<!-- <h2 style="font-size:1.2em;margin-bottom:0;">Spoken Text Comment Form</h2> -->
							<h4 id="text-identifier" style="margin-left:1em;">Spoken Text:</h4>
							<div style="width:90%;border:solid;border-width:.1em;border-color:#00548b;border-radius:10px;height:3em;margin:0 2em 1em 2em;overflow-y:auto;">
								<p style="margin:.4em 0 0 .5em;font-size:1.1em;line-height:1.2em;" id="spoken-text">This should not be here!</p>
							</div>
							<textarea maxlength="1000" rows=20 cols=90 id="user-comments" name="comments" placeholder="Enter your comments." style="width:90%;height:14.5em;overflow-y:scroll;float:left;margin-left:2em;"><?php echo $user_comments;?></textarea>
							<br />
						</div>
						<div style='margin-bottom:.5em;'>
							<input type="text" name="UserName" id="user-name" style="width:10em;" placeholder="Enter Your Name" <?php echo "value ='$user_name'";?>>
							<input type="email" name="Email" id="e-mail" style="width:10em;" placeholder="Enter Email Address" <?php echo "value = '$user_email'";?>>
							<input type="submit" value="Send Comments" style='display:inline; width:10em;' onclick="send_comments()">
							<div id='send-errors'><?php echo "<p style='text-align:center;margin-top:0;color:red;'>".$error_message."</p>"?></div>
						</div>
					</div>
					<div id="example-area" style="display:none;border:solid;border-width:.1em;border-color:#00548b;border-radius:15px;height:18.5em;overflow-y:scroll;margin:0 2em 1em 2em;text-align:left;font-size:1.2em;line-height:1.2em;padding:.5em;">
					</div>
				</div>					
			</div>
		</div>
		<!-- Footer -->
		<?php include 'footer.php';?>
	</body>
</html>
<?php
	}
?>
