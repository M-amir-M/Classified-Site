<?php

return array(
    "driver" => "smtp",
    "host" => "smtp.mailgun.org",
    "port" => 587,
    "from" => array(
        "address" => "from@example.com",
        "name" => "Example"
    ),
    "username" => "postmaster@mg.unisaleman.com",
    "password" => "5365c993bfcbfd11e1db0b7d890373f2",
    "sendmail" => "/usr/sbin/sendmail -bs",
    "pretend" => false
);