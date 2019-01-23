<?php
	$after = "index.html"; 
	$oops = "contactus.html";
if(isset($_POST['email'])) {
	
	// EDIT THE 2 LINES BELOW AS REQUIRED
	$email_to = "brigitte@marshallandmarshallshops.com";
	$email_subject = "Website Enquiry - {$_POST['name']}";
	
	
	function died($error) {
		// your error code can go here
		echo "We are very sorry, but there were error(s) found with the form you submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['name']) ||
		!isset($_POST['telno']) ||
		!isset($_POST['email']) ||
		!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form you submitted.');		
	}
	
	$name = $_POST['name']; // required
	$tel = $_POST['telno']; // required
	$email_from = $_POST['email']; // required
	$comm = $_POST['comments']; // required
	
	$error_message = "";
	$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
  if(!eregi($email_exp,$email_from)) {
  	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
	$string_exp = "^[a-z .'-]+$";
  if(!eregi($string_exp,$name)) {
  	$error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Form details below.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Name:\n ".clean_string($name)."\n\n";
	$email_message .= "Telephone:\n ".clean_string($tel)."\n\n";
	$email_message .= "Email:\n ".clean_string($email_from)."\n\n";
	$email_message .= "Comments:\n ".clean_string($comm)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();

    if (@mail($email_to, $email_subject, $email_message, $headers)) {
        echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=$after\">"; 
    } else {
        echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=$oops\">";
    }
}
?>
