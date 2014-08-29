Log Notifier
=========

This is a small utility that can be used as a cron job to monitor a log file and notify user by emails if specific pattern found in files.

Requirements
============

* Make sure that PHP version is >= 5.3
* Make sure that php-mail(SMTP) is configured in php.ini

Execution & Configuration
----
* Extract the contents of the archive to a folder(say C:\LogNotifier)
* Configure the Email subject, recipient and body in config.inc
* Open command prompt and run the command:
cd C:\LogNotifier
php main.php <LOG FILE NAME> <PATTERN>
Example: 
    main.php testlog.log MEET

* Execute test cases:
cd C:\LogNotifier\tests
phpunit LogReaderTest.php
