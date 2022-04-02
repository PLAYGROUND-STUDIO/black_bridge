<?php
namespace PlaygroundStudio\BlackBridge\SmsService;

Interface SmsService
{
    /**
     * Undocumented function
     *
     * @param string $phoneNumber
     * @param string $message
     * @return bool
     */
    public function sendSingleMessage($phoneNumber, $message);

    /**
     * Undocumented function
     *
     * @param [type] $senderName
     * @return void
     */
    public function setSenderName($senderName);

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getSenderName();

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getLastErrorMessage();

    /**
     * Undocumented function
     *
     * @return int
     */
    public function getQuotaBalance();
}
