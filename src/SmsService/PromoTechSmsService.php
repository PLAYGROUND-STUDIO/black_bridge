<?php
namespace PlaygroundStudio\BlackBridge\SmsService;

use Exception;
use GuzzleHttp\Client;
use PlaygroundStudio\BlackBridge\Converter\PhoneNumber;
use PlaygroundStudio\BlackBridge\Exception\PhoneNumberIsInvalidException;
use PlaygroundStudio\BlackBridge\Foundation\ServiceResponse;
use PlaygroundStudio\BlackBridge\Validator\Validator;

class PromoTechSmsService implements SmsService
{
    private $client     = null;
    private $senderName = "SMS";
    private $errors     = [];

    public function __construct($username, $password)
    {
        $token = \base64_encode($username.':'.$password);
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://api.promotech.co.th',
            'headers' => [
                'Content-type'      => 'application/json',
                'Accept'            => 'application/json',
                'Authorization'     => 'Basic '.$token
            ]
        ]);
    }

    public function sendSingleMessage($phoneNumber, $message)
    {
        if(Validator::isMobilePhoneNumber($phoneNumber)) {
            try {
                $number = new PhoneNumber($phoneNumber);
                $internalPhoneNumber = $number->getInternationalFormatPhoneNumber();

                $res = $this->client->request('POST', '/sms/1/text/single', [
                    'json' => [
                        'from' => $this->getSenderName(),
                        'to' => $internalPhoneNumber,
                        'text' => $message
                    ]
                ]);
                $data = [
                    'to' => $internalPhoneNumber
                ];
                return true;
            } catch(Exception $e) {
                $this->errors[] = $e->getMessage();
            }
        } else {
            $this->errors[] = 'Mobile phone number is invalid format.';
        }
        return false;
    }

    public function setSenderName($senderName) {
        $this->senderName = $senderName;
    }

    public function getSenderName() {
        return $this->senderName;
    }

    public function getLastErrorMessage()
    {
        if( count($this->errors) > 0 ) {
            return $this->errors[0];
        } else {
            return '';
        }
    }

    public function getQuotaBalance()
    {
        return 0;
    }

}
