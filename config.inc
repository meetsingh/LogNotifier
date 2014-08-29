<?php
//autoloader
function __autoload( $className ) {
    require_once( dirname(__FILE__) ."/lib/". $className . ".php" );
}

//EMail Parameters
static $email_recipent = 'snghmeet@gmail.com';
static $email_subject = "Error Pattern Found";
static $email_body = "We found an error pattern in LOG, please take apropriate action ASAP.";