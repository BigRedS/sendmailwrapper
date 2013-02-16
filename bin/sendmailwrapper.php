<?php

$to = "test@localhost";
$subject = "testing";
$body = "This is just a test";

print "sendmail_path: " . ini_get('sendmail_path')."\n";

print "Sending mail from cwd: " . mail($to, $subject, $body)."\n\n";

$headers = "x-php-script: example.net/badthings.php for 1.2.3.4\r\n";

print "Setting PHP script to example.net/badthings.php\n";
print "Sending mail from cwd: ". mail($to, $subject, $body, $headers). "\n\n";

$headers = "x-php-script: example.net/goodthings.php for 1.2.3.4\r\n";

print "Setting PHP script to example.net/goodthings.php\n";
print "Sending mail from cwd: ". mail($to, $subject, $body, $headers). "\n\n";

print "cding to /tmp\n";
chdir('/tmp');

print "sending mail with no x-php-script header: ".mail($to, $subject, $body)."\n\n";
