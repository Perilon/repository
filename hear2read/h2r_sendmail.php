<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();
require 'vendor/autoload.php';
require_once('php/geoplugin.class.php');
use Mailgun\Mailgun;

  if($_POST['sendmail'] || $_POST['sendmail_x']) {
    $email_to = "suresh@hear2read.org";
    $email_subject = "Hear2Read Enquiry: "; 
    $ip_address = $_SERVER['REMOTE_ADDR'];
	$geoplugin = new geoPlugin();
	//locate the IP
	$geoplugin->locate();
	
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
    if(!preg_match($email_exp,$email_from)) {
    	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
	}
  
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
	$file = 'stats/gotcha_log';
	$gotcha_entry = date("Y-m-d H:i:s") . "GOTCHA ";
	if ($securimage->check($_POST['captcha_code']) == false) {
		// the code was incorrect
		echo "The security code entered was incorrect.<br /><br />";
		echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
		$gotcha_entry .= "Failed  " . "; IP: " . $geoplugin->ip . "; city: " . $geoplugin->city . "; country: " . $geoplugin->countryName . "\n";
		file_put_contents($file, $gotcha_entry, FILE_APPEND | LOCK_EX);
		exit;
	}
	$gotcha_entry .= "Success " . "; IP: " . $geoplugin->ip . "; city: " . $geoplugin->city . "; country: " . $geoplugin->countryName . "\n";
	file_put_contents($file, $gotcha_entry, FILE_APPEND | LOCK_EX);
	
    $email_message .= "<p>Name: ".clean_string($email_name)."</p>";
    $email_message .= "<p>Email: ".clean_string($email_from)."</p>";
    $email_message .= "<p>IP Address: ".$ip_address."<br /></p>";
    $email_message .= "<pre>";
    $email_message .= "    Geolocation results for {" . $geoplugin->ip . "}:
              City: {" . $geoplugin->city . "}
              Region: {" . $geoplugin->region . "}
              Country Name: {" . $geoplugin->countryName . "}
              Country Code: {" . $geoplugin->countryCode . "}";
    $email_message .= "</pre>";
    $email_message .= "<p>Message: </p><p>".clean_string(nl2br($message))."</p>";

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
		echo "<p>Thank you for your note.  We will get in touch with you soon.</p>";
	}
	else {
		echo "<p style=\"color: red; text-align: center;\">An error has occured sending your message.</p><p>Please try contacting us directly at suresh[at]hear2read[dot]com.</p>";
  	}
  }
?>