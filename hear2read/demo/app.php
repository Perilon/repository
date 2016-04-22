<!DOCTYPE HTML>
<html>
<?php
// Flite Voice Synthesis Demo
require '../vendor/autoload.php';
require_once('php/geoplugin.class.php');
use Mailgun\Mailgun;

function clean_string($string) {
	$bad = array("content-type","bcc:","to:","cc:","href");
	return str_replace($bad,"",$string);
}
function unQuoteString($rstring) {
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

//			$email_to = "suresh@hear2read.org";
			$email_to = "suresh@bazaj.org";
//			$email_to = "twhite94301@gmail.com";
			
			//Add language to email subject
			$user_language = '';
			switch ($user_voice) {
//				case 'Hindi_Female_AXB.flitevox':
				case 'indic_axb_hi':
					$user_language = "Hindi";
					break;
//				case 'Kannada_Female_SMJ.flitevox':
				case 'indic_smj_kn':
					$user_language = "Kannada";
					break;
//				case 'Marathi_Female_SLP.flitevox':
				case 'indic_slp_mr':
					$user_language = "Marathi";
					break;
				case 'indic_sxv_ta':
					$user_language = "Tamil";
					break;
//				case 'Telugu_Female_KNR.flitevox':
				case 'indic_knr_te':
					$user_language = "Telugu";
					break;
//				case 'Gujarati_Female_AXB':
				case 'indic_axb_gu.':
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
				$error_message .= '<span id="email-error">The Email Address you entered does not appear to be valid.</span><br />';
			} else if(!filter_var($user_email,FILTER_VALIDATE_EMAIL)) {
				$error_message .= '<span id="email-error">The Email Address you entered does not appear to be valid.</span><br />';
			}
			$string_exp = "/^[A-Za-z .'-]+$/";
			if(!preg_match($string_exp,$user_name)) {
				$error_message .= '<span id="name-error">The Name you entered does not appear to be valid.</span><br />';
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
				$email_message .= "<p>Voice: ".clean_string(nl2br($user_voice))."<br />";
				$email_message .= "Test Sentence ".clean_string(nl2br($user_sentence))."<br />";
				$email_message .= "Comments:</p><p>".clean_string(nl2br($user_comments))."</p>";

				// Instantiate the client
				$mgClient=new Mailgun('key-8ab8ad3cd5293bdb93c1b31ea8bb25cd');
				$domain="sandboxa915612f51ef4ecbb89f0ca2638e29ad.mailgun.org";
				// Send Message through mailgun
				$result=$mgClient->sendMessage("$domain",
									array(  'from'    => "Hear2Read Demo <postmaster@sandboxa915612f51ef4ecbb89f0ca2638e29ad.mailgun.org>",
											'to'      => "<".$email_to.">",
											'cc'	  => "<".$user_email.">",
											'subject' => $email_subject,
											'html'    => "<html>".$email_message."</html>"  ));
				if ($result) {
					$error_message .=  "Thank you for your comment.<br /><br /><span style='color:#00548b;'>
						Choose a new sentence to review, or, click on Listen to add comments to this sentence.</span>";
				} else {
					$error_message .= "<span style=\"color: red; text-align: center;\">An error has occured sending your message.</p><p>Please try contacting us directly at suresh[at]hear2read[dot]com.</span>";
				}
			}
		echo "<p style='margin-top:0;text-align:center;color:red;'>" . $error_message . "</p>";
		echo "</html>";
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
			  <div id='app-container'>
				<div style="margin-right:.5em;float:left">
					<h3 id='chosen-voice' style="float:left;display:none;">
						<button style='font-size:.75em;color:#de5841;vertical-align:top;' onclick='new_voice()'>Change language</button>
					</h3>
				</div>
					<h4 style="text-align:center;width:90%;color:red;margin:0 4em 0 4em;float:left;" id='choose-a-voice'>This Demo works with Chrome, Firefox, Safari and Edge running on Windows PC, Mac or Android devices.<br /><span style='font-weight:100;'>(Currently it does not work with Internet Explorer (IE) and iOS devices (iPhone or iPad)</span></h4>
				<div id='language-icons'>
					<br /><br />
					<input type='image' alt='Gujarati Female AXB' src='images/gujarati-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('indic_axb_gu')">
					<input type='image' alt='Kannada Female SMJ' src='images/kannada-button.png' style="border:none;margin:2% 2% 2% 2%;
						vertical-align:top;" 
						onclick="new_language('indic_smj_kn')">
					<input type='image' alt='Marathi Female SLP' src='images/marathi-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('indic_slp_mr')">
					<input type='image' alt='Tamil Female SXV' src='images/tamil-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('indic_sxv_ta')">
					<input type='image' alt='Telugu Female KNR' src='images/telugu-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('indic_knr_te')">
					<input type='image' alt='Hindi Female AXB' src='images/hindi-button.png' style="border:none;margin:2% 2% 2% 2%;vertical-align:top;" 
						onclick="new_language('indic_axb_hi')">
				</div>
				<div style='float:left;margin-right:1em;'>
					<h4 id='language' style='font-weight:900;margin-right:.3em;'></h4>
				</div>
				<span id='sentence-controls' style="display:none;">
					<div style='float:left;margin-right:1em;'>
						<h4>Sentence # 							
							<input type='image' alt='number down' src='images/left-arrow.png' style="vertical-align:top;border:0;margin:0 0 0 .5em;font-size:.5em;" 
								onclick="prev_example()">
							<span id='sentence-number' style="width:3em;font-weight:900;border:1px solid #00548b;background-color:white;"></span>
							<input type='image' alt='number up' src='images/right-arrow.png' style="vertical-align:top;border:0;font-size:.5em;" 
								onclick="next_example()">
						</h4>
					</div>
					<div style='float:left;margin-right:.25em;'>
						<h4>
						Pick sentence 
							<input type='image' alt='choose from list' src='images/choose-from-list.png' style="vertical-align:top;margin-left:.1em;font-size:3em;" 
								onclick="show_examples()">
						</h4>
					</div>
				</span>
				<div style='float:left;'>
					<span id="request-buttons" style="display:none">
						<input type='image' alt='listen to sentence' onclick="play_tts()" src='images/listen.jpg' 
							style="border:0;margin:-.5em 0 1.2em 0;">
<!--						<input type='image' alt='download wav file' onclick="download_tts()" src='images/download.jpg' 
								style="vertical-align:top;border:0;">
						<br /> -->
					</span>
					<span id="audio-controls" style="display:none;color:#00548b;">
						<audio controls autoplay id="player" style='margin: 0.3em 0 0 0;'></audio>
						<a id="downloader" href="" download="flite.wav" style="display:none;"></a>
						<select id="play-rate" onchange="change_rate()" style="vertical-align:.7em;height:2.4em;color:white;background:#373737;border-radius:.4em;font-size:.75em">
							<option value=".90">Speed</option>
							<option value=".70">-20%</option>
							<option value=".80">-10%</option>
							<option selected value=".90">Normal</option>
							<option value="1">+10%</option>
							<option value="1.1">+20%</option>
						</select>
						<!--	<input type="submit" value="Send Comments" id='send-comments' 
								style='display:inline;border-radius:.75em;vertical-align:top;width:10em;
									color:#de5841;font-weight:900;margin-right:.5em;' 
								onclick="send_comments()">  -->
							<button id='send-comments' style='display:inline;font-size:1.1em;color:#de5841;vertical-align:.4em;margin-right:.5em;' 
							onclick='send_comments()'>
							Send Comments</button>
							or 
						<!--	<input type='submit' value='select' 
								style='display:inline;border-radius:.75em;vertical-align:top;width:10em;
									color:#de5841;font-weight:900;margin:0 .5em 0 .5em;' 
								onclick="skip_comments()"> -->
							<button style='display:inline;font-size:1.1em;color:#de5841;vertical-align:.4em;margin-right:.5em;' 
							onclick='skip_comments()'>
							Select</button>
							another sentence without commenting.
					</span>
				</div>
				</span>
				
				<div style="width:100%;float:left;">
					<div id='text-area' style="text-align:left;display:none;"></div>
							<textarea style="display:none;float:left;width:80%;margin-left:10%" oninput="text_entered()" maxlength="400" rows=2 cols=100 id="textarea" name="text"
								placeholder="Enter text (in the selected language) here."><?php echo $user_sentence;?></textarea>
					<div id="comment-area" style="display:none;border:solid;border-width:.15em;border-color:#00548b;border-radius:15px;height:24.2em;">
						<div>
							<h4 id="text-identifier" style="margin-left:1em;">Spoken Text:</h4>
							<div style="width:90%;border:solid;border-width:.1em;border-color:#00548b;border-radius:10px;height:3em;
							margin:0 2em 0 2em;overflow-y:auto;">
								<p style="margin:.4em 0 0 .5em;font-size:1.1em;line-height:1.2em;" id="spoken-text">This should not be here!</p>
							</div>
							<div id='show-comments' style='display:none'>
								<div id='comment-errors' style='width:100%;height:1.2em;float:left;'></div>
								<div style='width:90%;float:left;margin-left:2em;'>
									<div style='width:15%;font-size:1.2em;text-align:center;float:left;color:#00548b;margin-top:.25em;'>Word in question</div>
									<div style='width:69%;font-size:1.2em;text-align:center;float:left;color:#00548b;margin-top:.25em;'>Explanation of  pronunciation problem</div>
								</div>
								<div style='width:90%;height:15.2em;overflow-y:auto;float:left;margin:0 .2em 0 2em;'>
									<span id='comments'></span>
<!--									<input type='button' id='comment-next' onclick='add_comment()' value='Next comment'
										style='float:right;border-radius:.75em;margin:0 0 .5em 0;font-weight:900;color:#de5841;'> -->
									<button id='comment-next' style='float:right;margin:0 0 .5em 0;font-size:1.1em;color:#de5841;
										vertical-align:.4em;margin-right:.5em;' 
										onclick='add_comment()'>
									Next Comment</button>

								</div>
							</div>
						</div>
						<div id='send-errors' style='width:100%;float:left;'>
							<?php echo "<p style='text-align:center;margin-top:0;color:red;'></p>"?>
						</div>
					</div>
					<div id="example-area" style="display:none;border:solid;border-width:.1em;border-color:#00548b;border-radius:.75em;height:18.5em;overflow-y:scroll;text-align:left;font-size:1.2em;line-height:1.2em;padding:.5em;">
					</div>
				</div>
			  </div>
			  <div id='user-info' style='margin-bottom:.5em;margin-top:5em;display:none'>
				<h2>We need your Name and E-mail Address</h2>
				<p style='margin:0 10em 1em 10em;color:#00548b;'>We are asking for this 
				information in order to contact you if we have questions about your comments.  
				Your Name and E-mail is not kept after you leave the Demo Page.
				</p>
				<input type="text" name="UserName" id="user-name" onclick="name_click()" style="width:10em;" placeholder="Enter Your Name" 
					<?php echo "value ='$user_name'";?>>						
				<input type="email" name="Email" id="e-mail" onclick="email_click()" style="width:10em;" placeholder="Enter Email Address" 
					<?php echo "value = '$user_email'";?>>						
<!--				<input type="submit" value="Submit" style='display:inline;border-radius:.75em;width:10em;color:#de5841;font-weight:900;' onclick="save_user_info()"> -->
					<button style='display:inline;font-size:1.1em;color:#de5841;margin-right:.5em;' onclick='save_user_info()'>
					Submit</button>
					<button style='display:inline;font-size:1.1em;color:#de5841;' onclick='no_user_info()'>
					Cancel</button>
				<div id='user-errors'></div> 
			  </div>
			</div>
		</div>
		<!-- Footer -->
		<?php include '../footer.php';?>
	</body>
</html>
<?php
	}
?>
