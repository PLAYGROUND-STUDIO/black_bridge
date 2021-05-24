<?php
namespace Tests\Securities;

use Exception;
use PHPUnit\Framework\TestCase;
use PlaygroundStudio\BlackBridge\Securities\Google2FA;
use PragmaRX\Google2FA\Google2FA as PragmaRXGoogle2FA;

class Google2FATest extends TestCase
{
    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @throws Exception
     */
    public function testGenerateSecretKey()
    {
        $google2fa = new Google2FA();
        $secretKey = $google2fa->generateSecretKey();
        $this->assertIsString($secretKey);
    }

    /**
     * @throws Exception
     */
    public function testSetAndGetSecretKey()
    {
        $google2fa = new Google2FA();
        $google2fa->setSecretKey('ABCDEFGHIJKLMNOP');
        $this->assertEquals('ABCDEFGHIJKLMNOP', $google2fa->getSecretKey());
    }

    /**
     * @throws Exception
     */
    public function testGetGeneratedLink()
    {
        $google2fa = new Google2FA();
        $google2fa->setSecretKey('ABCDEFGHIJKLMNOP');
        $generatedLink = $google2fa->getGeneratedLink('TEST', 'admin@test.com');
        $expected = "otpauth://totp/TEST:admin%40test.com?secret=ABCDEFGHIJKLMNOP&issuer=TEST&algorithm=SHA1&digits=6&period=30";
        $this->assertEquals($expected, $generatedLink);
    }

    /**
     * @throws Exception
     * @noinspection PhpRedundantVariableDocTypeInspection
     */
    public function testVerifyKey()
    {
        $google2fa = new Google2FA();
        $google2fa->generateSecretKey();

        /** @var PragmaRXGoogle2FA $engine */
        $engine = $google2fa->getEnginePragmaRX();
        $currentOtp = $engine->getCurrentOtp($google2fa->getSecretKey());

        // Test fot True
        $verifyResult = $google2fa->verifyKey($currentOtp);
        $this->assertTrue($verifyResult, "A");

        // Test for False
        $verifyResult = $google2fa->verifyKey("000000");
        $this->assertFalse($verifyResult, "B");
    }

}