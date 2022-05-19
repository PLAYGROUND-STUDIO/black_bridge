<?php
namespace PlaygroundStudio\BlackBridge\Validator;

class Validator
{
    public static function isMobilePhoneNumber($mobilePhoneNumberToTest)
    {
        return (
            \preg_match("/^(\d{10})$/i", $mobilePhoneNumberToTest) ||
            \preg_match("/^66(\d{9})$/i", $mobilePhoneNumberToTest)
        );
    }
}
