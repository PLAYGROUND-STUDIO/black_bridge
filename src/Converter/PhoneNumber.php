<?php
namespace PlaygroundStudio\BlackBridge\Converter;

use Exception;

class PhoneNumber
{
    private $phoneNumber = "";
    private $type = 0;

    public function __construct($phoneNumber = null)
    {
        if($phoneNumber) {
            if(!$this->import($phoneNumber)) {
                $this->throwSourcePhoneNumberIsInvalid();
            }
        }
    }

    public function import($phoneNumber)
    {
        if(\preg_match('/^0{1}\d{9}$/i', $phoneNumber)) {
            // เป็นเบอร์โทรภายในประเทศแบบ Local Format
            $this->phoneNumber = $phoneNumber;
            $this->type = 1;
            return true;
        } else if(\preg_match('/^\d{11}$/i', $phoneNumber)) {
            // เป็นเบอร์โทรแบบ International Format
            $this->phoneNumber = $phoneNumber;
            $this->type = 2;
            return true;
        } else if(\preg_match('/^[+]\d{11}$/i', $phoneNumber)) {
            // เป็นเบอร์โทรแบบ International Format
            $this->phoneNumber = $phoneNumber;
            $this->type = 3;
            return true;
        } else {
            return false;
        }
    }

    public function getInternationalFormatPhoneNumber()
    {
        if($this->type == 1) {
            return '66' . \substr($this->phoneNumber, 1);
        } else if($this->type == 2) {
            return $this->phoneNumber;
        } else if($this->type == 3) {
            return \substr($this->phoneNumber, 1);
        } else {
            $this->throwSourcePhoneNumberIsInvalid();
        }
    }

    private function throwSourcePhoneNumberIsInvalid() {
        throw new Exception('Source phone number is invalid', 9001);
    }
}
