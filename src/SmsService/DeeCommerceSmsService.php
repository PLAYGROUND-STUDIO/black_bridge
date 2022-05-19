<?php
namespace PlaygroundStudio\BlackBridge\SmsService;

use Exception;
use GuzzleHttp\Client;
use PlaygroundStudio\BlackBridge\Converter\PhoneNumber;
use PlaygroundStudio\BlackBridge\Exception\PhoneNumberIsInvalidException;
use PlaygroundStudio\BlackBridge\Foundation\ServiceResponse;
use PlaygroundStudio\BlackBridge\Validator\Validator;

class DeeCommerceSmsService implements SmsService
{
    private $client     = null;
    private $senderName = "SMS";
    private $errors     = [];

    private $accountId  = '';
    private $secretKey  = '';
    private $type       = '';

    private $quotaBalance = 0;

    /**
     * Undocumented function
     *
     * @param [type] $accountId
     * @param [type] $secretKey
     * @param [type] $type eg. OTP, NOTI, MKT
     */
    public function __construct($accountId, $secretKey, $type = 'MKT')
    {
        $this->accountId    = $accountId;
        $this->secretKey   = $secretKey;
        $this->type         = $type;

        $this->client = new Client([
            'base_uri' => 'https://smsapi.deecommerce.co.th:4300',
            'headers' => [
                'Content-type'      => 'application/json',
                'Accept'            => 'application/json'
            ]
        ]);
    }

    public function sendSingleMessage($phoneNumber, $message)
    {
        if(Validator::isMobilePhoneNumber($phoneNumber)) {
            try {
                $number = new PhoneNumber($phoneNumber);
                $internalPhoneNumber = $number->getInternationalFormatPhoneNumber();

                $response = $this->client->request('POST', '/service/SMSWebService', [
                    'body' => json_encode([
                        'accountId' => $this->accountId,
                        'secretKey' => $this->secretKey,
                        'type'      => $this->type,
                        'to'        => $internalPhoneNumber,
                        'sender'    => $this->getSenderName(),
                        'msg'       => $message
                    ])
                ]);
                $objResponse = json_decode($response->getBody());
                if($objResponse->error == 0) {
                    return true;
                } else {
                    $this->errors[] = $objResponse->msg;
                    return false;
                }
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
        $response = $this->client->request('POST', '/service/creditbalance', [
            'body' => json_encode([
                'accountId' => $this->accountId,
                'secretKey' => $this->secretKey
            ])
        ]);
        $objResponse = json_decode($response->getBody());
        if($objResponse->msg == 'OK') {
            return $objResponse->result->amount;
        } else {
            $this->errors[] = $objResponse->msg;
        }

        return false;
    }
}
