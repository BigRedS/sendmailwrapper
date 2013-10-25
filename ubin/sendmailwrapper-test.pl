#! /usr/bin/perl

use strict;

use constant sendmailwrapperBinary => $ENV{'SENDMAILWRAPPER_BINARY'} || "/usr/bin/sendmailwrapper";
use constant sendmailwrapperDotPhp => $ENV{'SENDMAILWRAPPERDOTPHP'}  || "/usr/lib/sendmailwrapper/sendmailwrapper.php";
use constant php => "/usr/bin/php5 --php-ini /etc/php5/conf.d/sendmailwrapper.ini";

print "PHP: ".php."\n";

$ENV{'SENDMAILWRAPPER_TO'}      = 'test@localhost';
$ENV{'SENDMAILWRAPPER_SUBJECT'} = 'Testing';
$ENV{'SENDMAILWRAPPER_BODY'}    = 'This is just a test\n';
$ENV{'SENDMAILWRAPPER_HEADER'} = 'x-php-script: example.net/badthings.php for 1.2.3.4';
$ENV{'SENDMAILWRAPPER_CDDIR'}   = '/tmp';
$ENV{'SENDMAILWRAPPER_BINARY'}  = sendmailwrapperBinary;

my $script = php." ".sendmailwrapperDotPhp;

system($script);



