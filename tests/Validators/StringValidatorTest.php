<?php
namespace Tests\Validators;

use PlaygroundStudio\BlackBridge\Validators\StringValidator;
use PHPUnit\Framework\TestCase;

class StringValidatorTest extends TestCase
{
    public function testIsDateISO8601()
    {
        $this->assertFalse( StringValidator::isDateISO8601('2021'), "A" );
        $this->assertFalse( StringValidator::isDateISO8601('2021-05'), "B" );
        $this->assertFalse( StringValidator::isDateISO8601('2021-05-20'), "C" );
        $this->assertFalse( StringValidator::isDateISO8601('2021-05-20T08'), "D" );
        $this->assertFalse( StringValidator::isDateISO8601('2021-05-20T08:30'), "E" );
        $this->assertFalse( StringValidator::isDateISO8601('2021-05-20T08:30:00'), "F" );
        $this->assertTrue( StringValidator::isDateISO8601('2021-05-20T08:30:00+0000'), "G" );
    }

    public function testIsDateMySQL()
    {
        $this->assertFalse( StringValidator::isDateMySQL('2021'), "A" );
        $this->assertFalse( StringValidator::isDateMySQL('2021-05'), "B" );
        $this->assertTrue( StringValidator::isDateMySQL('2021-05-20'), "C" );
        $this->assertFalse( StringValidator::isDateMySQL('2021-05-20T08'), "D" );
        $this->assertFalse( StringValidator::isDateMySQL('2021-05-20T08:30'), "E" );
        $this->assertTrue( StringValidator::isDateMySQL('2021-05-20T08:30:00'), "F" );
        $this->assertTrue( StringValidator::isDateMySQL('2021-05-20T08:30:00+0000'), "G" );
    }
}