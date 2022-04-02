<?php
namespace PlaygroundStudio\BlackBridge\Validator;

class Validator
{
    public static function isMobilePhoneNumber($mobilePhoneNumberToTest)
    {
        $pattern = "/^(\d{10})$/i";
        return \preg_match($pattern, $mobilePhoneNumberToTest);
    }
}
