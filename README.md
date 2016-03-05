Sendmailwrapper is a script which is called by PHP as if it were 
`sendmailwrapper`, inspects the mail it is sent and either goes on to actually 
send the mail (via sendmailwrapper) to to discard it, logging some information 
about the mail.

Decisions are made based on the working directory in which the script is called 
(which, generally, is the DocumentRoot of the site) and on the content of the 
`X-PHP-Originating-Script` header which is present by default from about PHP 5.3
onwards.


/etc/sendmailwrapper/directoryblacklist contains a list of paths; if the path 
of the working directory begins with any element in this list, the mail is not 
sent. It has one entry by default: `/tmp`

/etc/sendmailwrapper/scriptblacklist contains a list of strings; if the 
X-PHP-Originating-Script header's content matches this, then the mail is not 
sent. It has one entry by default: `eval\(\)'d code`


The two blacklists are matched in a Perl regex, but the directory one is
anchored to the beginning of the path; you'll need to escape-out any characters
special to Perl regexes.



There is also a tool called `sendmailwrapper-stats`, which can parse the logs 
and give hopefully-useful information about them. It's got a fairly 
comprehensive --help, try `sendmailwrapper-stats --help`.

Finally, there's a munin plugin, which is created by calling 
sendmailwrapper-stats with the (undocumented) option of --munin-create-plugin; 
the postinstall script creates this.
