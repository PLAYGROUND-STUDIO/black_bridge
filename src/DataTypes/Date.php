<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */
namespace PlaygroundStudio\BlackBridge\DataTypes;

use Nahid\JsonQ\Jsonq;
use Nahid\QArray\Exceptions\ConditionNotAllowedException;
use Nahid\QArray\Exceptions\InvalidNodeException;
use PlaygroundStudio\BlackBridge\Element;
use PlaygroundStudio\BlackBridge\Loaders\CellDataLoader;
use PlaygroundStudio\BlackBridge\ValidatorExceptions\StringValidatorException;
use PlaygroundStudio\BlackBridge\Validators\StringValidator;

/**
 * Class Date
 * @package Pgdev\Cell\DataTypes
 */
class Date extends Element
{
    /**
     * @var Jsonq ฐานข้อมูล JSON ที่โหลดจากไฟล์
     */
    private $dataDefault;

    /**
     * @var integer เวลาที่บันทึกเพื่อใช้ในการคำนวณอื่นๆต่อไป เก็บในรูปแบบ Timestamp
     */
    private $timestamp;

    /**
     * Date constructor.
     * @param string|null $dateTime
     * @throws StringValidatorException
     */
    public function __construct(string $dateTime = NULL)
    {
        if(isset($dateTime)) $this->setDate($dateTime);
        $this->dataDefault = CellDataLoader::loadJsonQuery();
    }

    /**
     * กำหนดค่าวันเวลาให้ Object
     * @param string $dateTime
     * @throws StringValidatorException
     */
    public function setDate(string $dateTime)
    {
        if(StringValidator::isDateMySQL($dateTime))
        {
            $this->timestamp = strtotime($dateTime);
        } else {
            throw new StringValidatorException();
        }
    }

    /**
     * ชื่อวันในสัปดาห์เป็นภาษาไทย
     * @param int $dayIndex
     * @param false $isAbbr
     * @return mixed
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     */
    public function thaiDay(int $dayIndex = null, bool $isAbbr = false): string
    {
        $data = clone $this->dataDefault;
        $dayIndex = $dayIndex ?? date('N', $this->timestamp);
        $day = $data->from('days')->where('id', '=', $dayIndex)->first();
        return $isAbbr ? $day->name_abbr : $day->name;
    }

    /**
     * ชื่อเดือนเป็นภาษาไทย
     * @param int $monthIndex
     * @param false $isAbbr
     * @return string
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     */
    public function thaiMonth(int $monthIndex = null, bool $isAbbr = false): string
    {
        $data = clone $this->dataDefault;
        $monthIndex = $monthIndex ?? date('n', $this->timestamp);
        $month = $data->from('months')->where('id', '=', $monthIndex)->first();
        return $isAbbr ? $month->name_abbr : $month->name;
    }

    /**
     * เลขปีพุทธศักราช
     * @param null $yearAD
     * @return int
     */
    public function yearBE($yearAD = null): int
    {
        $yearAD = $yearAD ?? date('Y', $this->timestamp);
        return $yearAD + 543;
    }

    /**
     * ส่งออกข้อความเป็นวันที่แบบสั้น (ประเภทที่ 1)
     * @return string
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     */
    public function exportThaiDateShortType1(): string
    {
        $format = sprintf("j %s %d", $this->thaiMonth(null, true), $this->yearBE());
        return date($format, $this->timestamp);
    }

    /**
     * ส่งออกข้อความเป็นวันที่แบบปกติ (ประเภทที่ 1)
     * @return string
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     * @noinspection PhpUnused
     */
    public function exportThaiDateNormalType1(): string
    {
        $format = sprintf("j %s %d", $this->thaiMonth(), $this->yearBE());
        return date($format, $this->timestamp);
    }

    /**
     * ส่งออกข้อความเป็นวันที่แบบยาว (ประเภทที่ 1)
     * @return string
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     * @noinspection PhpUnused
     */
    public function exportThaiDateLongType1(): string
    {
        $format = sprintf("วันที่ j %s พ.ศ.%d", $this->thaiMonth(), $this->yearBE());
        return date($format, $this->timestamp);
    }

    /**
     * ส่งออกข้อความเป็นวันที่แบบยาว (ประเภทที่ 2)
     * @return string
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     * @noinspection PhpUnused
     */
    public function exportThaiDateLongType2(): string
    {
        $format = sprintf("วัน%s ที่ j %s พ.ศ.%d", $this->thaiDay(), $this->thaiMonth(), $this->yearBE());
        return date($format, $this->timestamp);
    }
}