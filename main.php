<?php
include_once 'config.inc';

if( isset($argv[1]) )
{
    $filename = filter_var($argv[1], FILTER_SANITIZE_SPECIAL_CHARS);
    if(!$filename)
    {
        echo "Please pass valid filename.";
        exit;
    }
     
}else 
{
    echo "Please pass log file name as parameter.";
    exit;
}

if( isset($argv[2]) )
{
    $pattern = filter_var($argv[2], FILTER_SANITIZE_SPECIAL_CHARS);
    if(!$pattern)
    {
        echo "Please pass valid filename.";
        exit;
    }
}else
{
    echo "Please pass Pattern as parameter.";
    exit;
}

$log_reader = new LogReader($filename, $pattern);
$emailer = new Emailer($email_recipent, $email_subject, $email_body);
$log_reader->attach($emailer);
$log_reader->read_pattern();
$log_reader->detach($emailer);