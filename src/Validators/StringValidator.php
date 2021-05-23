<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */
namespace PlaygroundStudio\BlackBridge\Validators;

use DateTime;
use PlaygroundStudio\BlackBridge\Element;

/**
 * Class StringValidator
 * @package Pgdev\Cell\Validators
 */
class StringValidator extends Element
{
    /**
     * ตรวจสอบข้่อมูล String ว่าอยู่ในรูปแบบ ISO 8601 หรือเปล่า
     * @param string $dateString
     * @return bool
     */
    public static function isDateISO8601(string $dateString): bool
    {
        if (!is_string($dateString)) return false;

        $dateTime = DateTime::createFromFormat(DateTime::ISO8601, $dateString);

        if ($dateTime) {
            return $dateTime->format(DateTime::ISO8601) === $dateString;
        }

        return false;
    }

    /**
     * ตรวจสอบข้่อมูล String ว่าอยู่ในรูปแบบ MySQL หรือเปล่า
     * @param string $dateString
     * @return bool
     */
    public static function isDateMySQL(string $dateString): bool
    {
        if(preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})(Z|([+\-])\d{2}(:?\d{2})?)$/', $dateString, $parts))
        {
            return true;
        } else if(preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})$/', $dateString, $parts)) {
            return true;
        } else if(preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $dateString, $parts)) {
            return true;
        }

        return false;
    }

}