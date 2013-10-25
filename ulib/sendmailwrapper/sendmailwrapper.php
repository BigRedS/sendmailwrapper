<?php
$to      = getenv("SENDMAILWRAPPER_TO");
$subject = getenv("SENDMAILWRAPPER_SUBJECT");
$body    = getenv("SENDMAILWRAPPER_BODY");
$headers = getenv("SENDMAILWRAPPER_HEADER")."\r\n";

print "sendmail_path: " . ini_get('sendmail_path')."\n";
print "cwd:           " . getcwd(). "\n";
print "to:            $to\n";
print "subject:       $subject\n";
print "header:        ".getenv("SENDMAILWRAPPER_HEADER")."\n";

print "Sending mail from cwd with no x-php-script header (should succeed):\n  ";
print wordify(mail($to,$subject,$body));

print "Sending mail from cwd with 'bad' x-php-script header (should fail):\n  ";
print wordify(mail($to,$subject,$body,$headers));

print "Sending mail from /tmp (should fail):\n  ";
chdir('/tmp');
print wordify(mail($to,$subject,$body));

function wordify($retval){
	return ($retval > 0) ? " Succeeded\n" : " Failed\n";
}
