<?php
/**
 * Created by PhpStorm.
 * User: napad
 * Date: 21/6/2560
 * Time: 22:20
 */

namespace Playground;


class DateFormat
{
    private $format_string;

    public function __construct($format_string)
    {
        $this->format_string = $format_string;
    }

    /**
     * @return DateFormat
     */
    public static function ThaiShort()
    {
        $objMe = new DateFormat("ThaiShort");
        return $objMe;
    }

    /**
     * @return DateFormat
     */
    public static function ThaiFull()
    {
        $objMe = new DateFormat("ThaiFull");
        return $objMe;
    }

    public function __toString()
    {
        return $this->format_string;
    }
}