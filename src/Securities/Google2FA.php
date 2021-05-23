<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */
namespace PlaygroundStudio\BlackBridge\Securities;

use Exception;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FA\Google2FA as PragmaRXGoogle2FA;
use PlaygroundStudio\BlackBridge\Element;

class Google2FA extends Element
{
    /** @var PragmaRXGoogle2FA */
    private $engine;

    /** @var string  */
    private $secretKey = "";

    /**
     * Google2FA constructor.
     */
    public function __construct()
    {
        $this->engine = new PragmaRXGoogle2FA();
    }

    /**
     * @param $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @throws Exception
     */
    public function generateSecretKey(): string
    {
        try {
            $this->secretKey = $this->engine->generateSecretKey();
        } catch (IncompatibleWithGoogleAuthenticatorException $e) {
            throw new Exception($e->getMessage());
        } catch (InvalidCharactersException $e) {
            throw new Exception($e->getMessage());
        } catch (SecretKeyTooShortException $e) {
            throw new Exception($e->getMessage());
        }

        return $this->secretKey;
    }

    /**
     * @param $name
     * @param $email
     * @return string
     * @noinspection PhpUnused
     */
    public function getGeneratedLink($name, $email): string
    {
        return $this->engine->getQRCodeUrl(
            $name,
            $email,
            $this->secretKey
        );
    }

    /**
     * @throws Exception
     */
    public function verifyKey($key)
    {
        try {
            $result = $this->engine->verifyKey($this->secretKey, $key);
        } catch (IncompatibleWithGoogleAuthenticatorException $e) {
            throw new Exception($e->getMessage());
        } catch (InvalidCharactersException $e) {
            throw new Exception($e->getMessage());
        } catch (SecretKeyTooShortException $e) {
            throw new Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * @return PragmaRXGoogle2FA
     */
    public function getEnginePragmaRX(): PragmaRXGoogle2FA
    {
        return $this->engine;
    }
}