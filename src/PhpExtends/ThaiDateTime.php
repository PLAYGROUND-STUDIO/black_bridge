<?php

namespace PlaygroundStudio\PhpExtends;

class ThaiDateTime extends DateTime
{
    public function __construct($datetime = 'now', DateTimeZone $timezone = NULL)
    {
        parent::__construct($datetime, $timezone);
    }
}