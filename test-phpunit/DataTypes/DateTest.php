<?php
/** @noinspection PhpIllegalPsrClassPathInspection */
/** @noinspection PhpParamsInspection */

use Nahid\QArray\Exceptions\ConditionNotAllowedException;
use Nahid\QArray\Exceptions\InvalidNodeException;
use PlaygroundStudio\BlackBridge\DataTypes\Date;
use PlaygroundStudio\BlackBridge\ValidatorExceptions\StringValidatorException;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /*============================*
     * setDate                    *
     *============================*/

    /**
     * @throws InvalidNodeException
     * @throws ConditionNotAllowedException
     * @throws StringValidatorException
     */
    public function testSetDate()
    {
        $date = new Date();
        $date->setDate('2021-05-20');
        $this->assertEquals('20 พ.ค. 2564', $date->exportThaiDateShortType1(), "B");
    }

    public function testSetDateWithWrongInput()
    {
        $this->expectException(StringValidatorException::class);
        $date = new Date();
        $date->setDate('THIS IS WRONG');
    }

    /*============================*
     * thaiDay                    *
     *============================*/

    /**
     * @throws InvalidNodeException
     * @throws ConditionNotAllowedException
     */
    public function testThaiDayForName()
    {
        $date = new Date('2021-05-20');
        $this->expectOutputString('พฤหัสบดี');
        print $date->thaiDay();
    }

    /**
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     */
    public function testThaiDayForNameAbbr()
    {
        $date = new Date();
        $this->expectOutputString('พ.');
        print $date->thaiDay('3', true);
    }

    /*============================*
     * thaiMonth                  *
     *============================*/

    /**
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     */
    public function testThaiMonthFromVar()
    {
        $date = new Date('2021-05-20');
        $this->expectOutputString('พฤษภาคม');
        print $date->thaiMonth();
    }

    /**
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     */
    public function testThaiMonthFromRaw()
    {
        $date = new Date();
        $this->expectOutputString('ธันวาคม');
        print $date->thaiMonth(12);
    }

    /*============================*
     * yearBE                     *
     *============================*/

    public function testYearBEFromVar()
    {
        $date = new Date('2021-05-20');
        $this->expectOutputString(2564);
        print $date->yearBE();
    }

    public function testYearBEFromRaw()
    {
        $date = new Date();
        $this->expectOutputString(2564);
        print $date->yearBE('2021');
    }

    public function testYearBEWithNonInput()
    {
        $date = new Date();
        $this->assertIsInt($date->yearBE());
    }

}