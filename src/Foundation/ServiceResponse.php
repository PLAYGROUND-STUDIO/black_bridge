<?php
namespace PlaygroundStudio\BlackBridge\Foundation;

class ServiceResponse
{
    public $isSuccessful = false;
    public $message = "ServiceResponse object is make but it's blank.";
    public $data = [];

    public static function make($isSuccessful, $messgae, $data = []) {
        $object = new ServiceResponse();
        $object->isSuccessful = $isSuccessful;
        $object->message = $messgae;
        $object->data = $data;
        return $object;
    }

    public static function makeSuccessful($data = []) {
        return ServiceResponse::make(true, 'Everything is OK.', $data);
    }

    public static function makeException($message, $data = []) {
        return ServiceResponse::make(false, $message, $data);
    }

}
