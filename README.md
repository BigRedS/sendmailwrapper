# Sendmailwrapper

A wrapper round sendmail, probably for PHP. 

# Installation

This is laid out for packaging by Debosh. If you're not using that, read on!

First, copy the contents of the  `ubin` directory into `/usr/bin`, which will 
give you

    /usr/bin/sendmailwrapper  
    /usr/bin/sendmailwrapper-stats  
    /usr/bin/sendmailwrapper-test

Then configure PHP to use `/usr/bin/sendmailwrapper` as its `sendmail_path`; the
file at `etc/php5/conf.d/sendmailwrapper.ini` should be useful here, but the 
config is just

    sendmail_path = "/usr/bin/sendmailwrapper -t -i"

And then all messages sent by PHP will be logged to

    /var/log/sendmailwrapper/sendmailwrapper.json.log
    /var/log/sendmailwrapper/sendmailwrapper.log

The former's a series of JSON-encoded lines (sorry) and the latter's more for 
human consumption.

`/usr/bin/sendmailwrapper-stats` can parse the json.log and offer you some 
statistics, and `/usr/bin/sendmailwrapper-test` can be used to test the 
configuration; see each of their `--help` outputs for more info there.

# Configuration

Sendmailwrapper checks three properties of the message:

* the working directory of the process submitting the message
* the name of the script submitting the message (from the PHP headers)
* the recipient address of the message
* the full path to the script ('combination')

For each of these it first checks for the presence of a whitelist; if one 
exists, then processing continues only if the property is listed. If there is
no whitelist, it consults a blacklist, and continues unless the property is on
the list.

If processing stops (because an element was absent from a whitelist or present 
on a blacklist) the script exits 2, causing PHP's `mail()` to return false.

If the message is allowed to continue, a header is added to the message, called
`X-Sendmailwrapper-id` and created as a long string based on the PHP filename 
(from the PHP headers) and the working directory; the intention here is to 
provide an easy way to identify messages all sent from the same source.
