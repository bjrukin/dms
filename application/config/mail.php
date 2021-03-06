<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Mail User Agent
| -------------------------------------------------------------------
| The "user agent".
|
| Prototype:
|
|  $config['mail']['useragent'] = 'User Agent';
|
*/

$config['mail']['useragent'] = 'CGDMS';

/*
| -------------------------------------------------------------------
|  Mail Protocol
| -------------------------------------------------------------------
| The mail sending protocol
|
| Prototype:
|
|  $config['mail']['protocol'] = mail, sendmail, or smtp	Default: mail
|
*/

$config['mail']['protocol'] = 'smtp';

/*
| -------------------------------------------------------------------
|  Mail mailpath
| -------------------------------------------------------------------
| The server path to Sendmail
|
| Prototype:
|
|  $config['mail']['mailpath'] = Server Path to Sendmail. Default: '/usr/sbin/sendmail'
|
*/

$config['mail']['mailpath'] = '/usr/sbin/sendmail';

/*
| -------------------------------------------------------------------
|  Mail SMTP Host
| -------------------------------------------------------------------
| The server path to Sendmail
|
| Prototype:
|
|  $config['mail']['smtp_host'] = SMTP Server Address / Hostname. Default Blank
|
*/

$config['mail']['smtp_host'] = 'mail.cg.holding';


/*
| -------------------------------------------------------------------
|  Mail SMTP User
| -------------------------------------------------------------------
| SMTP Username
|
| Prototype:
|
|  $config['mail']['smtp_user'] = SMTP Username (if any). Default Blank
|
*/

$config['mail']['smtp_user'] = '';

/*
| -------------------------------------------------------------------
|  Mail SMTP Password
| -------------------------------------------------------------------
| SMTP Password
|
| Prototype:
|
|  $config['mail']['smtp_pass'] = SMTP Password (if any). Default Blank
|
*/

$config['mail']['smtp_pass'] = '';

/*
| -------------------------------------------------------------------
|  Mail SMTP Port
| -------------------------------------------------------------------
| SMTP Port
|
| Prototype:
|
|  $config['mail']['smtp_port'] = '25' SMTP Port (if anyy) .Default Port : 25
|
*/

$config['mail']['smtp_port'] = '465';

/*
| -------------------------------------------------------------------
|  Mail SMTP Timeout
| -------------------------------------------------------------------
| SMTP Timeout (in seconds).
|
| Prototype:
|
|  $config['mail']['smtp_timeout'] = '5' SMTP Timeout (in seconds). Default 5 Seconds
|
*/

$config['mail']['smtp_timeout'] = '5';

/*
| -------------------------------------------------------------------
|  Mail SMTP Keep Alive
| -------------------------------------------------------------------
| Enable persistent SMTP connections.
|
| Prototype:
|
|  $config['mail']['smtp_keepalive'] = TRUE or FALSE (boolean). Default FALSE
|
*/

$config['mail']['smtp_keepalive'] = FALSE;

/*
| -------------------------------------------------------------------
|  Mail SMTP Crypto
| -------------------------------------------------------------------
| SMTP Encryption
|
| Prototype:
|
|  $config['mail']['smtp_crypto'] = tls | ssl. Default Blank
|
*/

$config['mail']['smtp_crypto'] = '';

/*
| -------------------------------------------------------------------
|  Mail Wordwrap
| -------------------------------------------------------------------
| Enable word-wrap.
|
| Prototype:
|
|  $config['mail']['smtp_crypto'] = TRUE or FALSE (boolean). Default TRUE
|
*/

$config['mail']['wordwrap'] = TRUE;

/*
| -------------------------------------------------------------------
|  Mail Wrapchars
| -------------------------------------------------------------------
| Character count to wrap at.
|
| Prototype:
|
|  $config['mail']['wrapchars'] = Character count to wrap at. Default 76 characters
|
*/

$config['mail']['wrapchars'] = 76;

/*
| -------------------------------------------------------------------
|  Mail Mailtype
| -------------------------------------------------------------------
| Type of mail. If you send HTML email you must send it as a complete web page. 
| Make sure you don???t have any relative links or relative image 
| paths otherwise they will not work.
|
| Prototype:
|
|  $config['mail']['mailtype'] = text | html. Default text
|
*/

$config['mail']['mailtype'] = 'html';

/*
| -------------------------------------------------------------------
|  Mail Charset
| -------------------------------------------------------------------
| Character set (utf-8, iso-8859-1, etc.).
|
| Prototype:
|
|  $config['mail']['mailtype'] = Character set (utf-8, iso-8859-1, etc.) Default $config['charset']
|
*/

$config['mail']['charset'] = 'utf-8';

/*
| -------------------------------------------------------------------
|  Mail Validate
| -------------------------------------------------------------------
| Whether to validate the email address.
|
| Prototype:
|
|  $config['mail']['validate'] = TRUE or FALSE (boolean). Default FALSE
|
*/

$config['mail']['validate'] = FALSE;


/*
| -------------------------------------------------------------------
|  Mail Priority
| -------------------------------------------------------------------
| Email Priority. 1 = highest. 5 = lowest. 3 = normal.
|
| Prototype:
|
|  $config['mail']['priority'] = 1|2|3. Default 3
|
*/

$config['mail']['priority'] = 3;

/*
| -------------------------------------------------------------------
|  Mail crlf
| -------------------------------------------------------------------
| Newline character. (Use "\r\n" to comply with RFC 822).
|
| Prototype:
|
|  $config['mail']['priority'] = "\r\n" or "\n" or "\r" Default: \n
|
*/

$config['mail']['crlf'] = '\n';

/*
| -------------------------------------------------------------------
|  Mail Newline
| -------------------------------------------------------------------
| Newline character. (Use "\r\n" to comply with RFC 822).
|
| Prototype:
|
|  $config['mail']['priority'] = "\r\n" or "\n" or "\r" Default: \n
|
*/

$config['mail']['newline'] = "\r\n";

/*
| -------------------------------------------------------------------
|  Mail BCC Batch Mode
| -------------------------------------------------------------------
| Enable BCC Batch Mode.
|
| Prototype:
|
|  $config['mail']['bcc_batch_mode'] = TRUE or FALSE (boolean). Default FALSE
|
*/

$config['mail']['bcc_batch_mode'] = FALSE;

/*
| -------------------------------------------------------------------
|  Mail BCC Batch Size
| -------------------------------------------------------------------
| Number of emails in each BCC batch.
|
| Prototype:
|
|  $config['mail']['bcc_batch_mode'] = Number. Default: 200
|
*/

$config['mail']['bcc_batch_mode'] = 200;

/*
| -------------------------------------------------------------------
|  Mail BCC Batch Size
| -------------------------------------------------------------------
| Enable notify message from server
|
| Prototype:
|
|  $config['mail']['dsn'] =  TRUE or FALSE (boolean). Default FALSE
|
*/

$config['mail']['dsn'] = FALSE;
