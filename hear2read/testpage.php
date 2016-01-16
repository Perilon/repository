<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<!-- Head -->
	<?php include 'head.php';?>
	<?php $this_page = "testpage.php";?>
		<!-- Pictures -->
		<div id="features-wrapper">
				<section id="features" class="container">
					<div style="width:25%;float:left;">
						<img src="images/header-pic02.jpg" alt="Preschool blind child with a big happy smile." />
						<header>
							<h3 class="labeltext">Hopes and Dreams</h3>
						</header>	
					</div>
					<div style="width:25%;float:left;">
						<img src="images/header-pic03.jpg" alt="Primary school bilnd child unable to read a book." />
						<header>
							<h3 class="labeltext">Challenge</h3>
						</header>
					</div>
					<div style="width:25%;float:left;">
						<a href="solution.php"><img src="images/header-pic04.jpg" 
							alt="Student at NAB Delhi reading a book using Smartphone and Text To Speech software." /></a>
						<header>
							<a href="solution.php"><h3 class="labeltext">Solution</h3></a>
						</header>
					</div>
					<div style="width:25%;float:left;">
						<img src="images/header-pic3.png" alt="Visually challenged Kartik Sawhne (now a sophomore at Stanford Uiversity) 
						                                       receiving 2009 National Child Award for exceptional achievements in Delhi." />
						<header>
							<h3 class="labeltext">Dreams Come True</h3>
						</header>
					</div>
				</section>
			</div>
		<!-- Call To Action -->
		<div id="features-wrapper2">
				<section id="features" class="container">

					<div id="features">
						<br />
						<h2><a style="color: red;" href="join.php">Join us</a> to Increase Literacy among the 60 Million Visually Impaired in India</h2> 
						<div>
							<ul class="un_numbered">
								<li>Same quality of education for the visually impaired as for people with sight</li>
								<li>Open doors to all professional employment and business opportunities</li>
								<li>Empower people with visual impairment to become productive members of society</li>
							</ul>
					
						</div>
					</div>
				</section>
			</div>
		<!-- Features -->
		<div id="features-wrapper3">
				<section id="features" class="container">
					<div class="row" id="lists">
						<div class="6u">
							<!-- Feature -->
								<section>
									<header>
										<h3 style="color:red;">Challenges</h3>
									</header>
									<div>
										<ul>
											<li>People with visual impairment (VI) use braille to develop language skills, especially in early childhood.</li>
											<li>The visully impaired need to be able read digital information (email, documents, websites, e-books etc.) in the same manner 
											as others, and not be limited to reading only printed material.</li>
										</ul>
									</div>
								</section>
						</div>
						<div class="6u">
							<!-- Feature -->
								<section>
									<header>
										<h3 style="color:red;">Solution</h3>
									</header>
									<div>
										<ul>
											<li>Almost all digital information is read by people with sight, without printing it first. Text to Speech 
											software allows the VI population to do the same.</li>
											<li>Enable Reading by Listening using Text to Speech software for Indian Languages on low cost Smart 
											Phones and Tablets.</li>
										</ul>
									</div>
								</section>
								
						</div>
					</div>
				</section>		
			</div>
		<!-- Footer -->
			<div id="footer-wrapper">
				<div id="footer" class="container">
					<div class="row">
						<!-- <div class="2u"></div> -->
						<div class="6u">
							<header>
								<h2 style="color:red;">Reach out to us. <strong></strong></h2>
								<p>We would love to hear from you.  If you have any questions or comments, or 
								if you wish to join Hear2Read, fill out the form below.
								</p>
							</header>
							<div>
								<form method="post" action="<?php echo $this_page;?>">
									<div class="row 50%">
										<div class="6u">
											<input name="name" placeholder="Name" type="text" required />
										</div>
										<div class="6u">
											<input name="email" placeholder="Email" type="email" required/>
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<input name="subject" placeholder="Subject" type="text" required/>
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<textarea name="message" placeholder="Message" required></textarea>
										</div>
									</div>
									<div class="row 50%">
										<div class="6u">
										    <input style="width: 20%;" id="sendmail" name="sendmail" type="image" src="images/icon-email.png" alt="Send Message">
										</div>
									</div>
								</form>
<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;
echo "<p>$_POST</p>";
print_r($_POST);
echo "<p>$_REQUEST</p>";
print_r($_REQUEST);
  if($_POST['sendmail'] || $_POST['sendmail_x']) {
echo"<p>Got Here</p>";
    $email_to = "twhite94301@gmail.com";
    $email_subject = "Contact Us: "; 
    $ip_address = $_SERVER['REMOTE_ADDR'];

    function died($error) {
        // error code 
        echo "<p>";
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        echo "</p>";
        die();
    }
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['message'])) {
        died('<p>We are sorry, but there appears that you have not filled out all fields in the form.</p>');       
    }
    $email_name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $email_subject .= $_POST['subject']; // required
    $message = $_POST['message']; // required
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  /* if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  } */
  
  if(!filter_var($email_from,FILTER_VALIDATE_EMAIL)) {
  	$error_message .='The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$email_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
    $email_message .= "<p>Name: ".clean_string($email_name)."</p>";
    $email_message .= "<p>Email: ".clean_string($email_from)."</p>";
    $email_message .= "<p>IP Address: ".$ip_address."<br /></p>";
    $email_message .= "<p>Message: </p><p>".clean_string(nl2br($message))."</p>";
// Instantiate the client
	$mgClient=new Mailgun('key-8ab8ad3cd5293bdb93c1b31ea8bb25cd');
	$domain="sandboxa915612f51ef4ecbb89f0ca2638e29ad.mailgun.org";
// Send Message through mailgun
	$result=$mgClient->sendMessage("$domain",
									array(  'from'    => "$email_name <$email_from>",
											'to'      => "<".$email_to.">",
											'subject' => $email_subject,
											'html'    => "<html>".$email_message."</html>"  ));
	if ($result) echo "<p>Thank you for your note.  We will get in touch with you soon.</p>";
}
?>
							</div>
						</div>
						<div class="6u">
							<header>
								<h2 style="color: red;">Donate</h2>
							</header>
							<div>
								<p> Hear2Read is an initiative of <a href="http://icaonline.org/hear2read" target="_blank">Indians for Collective Action</a> (ICA).  
								ICA is a registered 501(c)(3) nonprofit, nonpartisan organization (Tax ID: 23-7027461).  All contributions are used for 
								charitable purposes and are tax-deductible to the full extent of the law.</p>
								<p>Please click or touch the button below to go to the ICA site.  Once there, select Hear2Read in the 
								Project drop-down Menu.</p>
							</div>
							<div id="center">
								<a href="http://icaonline.org/donate" target="_blank">
									<img src="images/btn_donate_SM.gif" style="width: 20%;" alt="Donate"></a>
							</div>
						</div>
					</div>
				</div>
				<div id="copyright" class="container">
					<ul style="font-size: .75em; list-style: none; text-align: center; margin-left: 0; line-height: 1.4em;">
						<li>All Contents Copyright &copy; 2014 - 2015 Hear2Read.  All rights reserved.</li>
						<li>Hear2Read is a trademark of Suresh Bazaj.</li>
						<?php if ($this_page == 'solution.php')
							echo '<li>Apple&#174;, Bookshare&#174;, and Google&#174; are registered trademarks of
							Apple, Inc., Beneficent Technology, Inc., and Google, Inc., respectively.  Android is a trademark of Google, Inc. Other trademarks 
							and registered trademarks are the property of their respective owners.</li>';
						?>
						<li>Design: Timothy White (template by <a href="http://html5up.net">HTML5 UP</a>)</li>
					</ul>
				</div>
			</div>	</body>
</html>
