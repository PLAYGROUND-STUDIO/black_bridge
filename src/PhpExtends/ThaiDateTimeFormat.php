<?php

namespace PlaygroundStudio\BlackBridge\PhpExtends;

use MyCLabs\Enum\Enum;

/**
 * @method static self DATETIME_LONGEST()
 * @method static self DATETIME_LONG()
 * @method static self DATETIME_NORMAL()
 *
 * @method static self DATE_LONGEST()
 * @method static self DATE_NORMAL()
 * @method static self DATE_SHORT()
 * @method static self DATE_SHORTEST()
 *
 * @method static self TIME_LONGEST()
 * @method static self TIME_LONG()
 * @method static self TIME_NORMAL()
 *
 */
class ThaiDateTimeFormat extends Enum
{
    private const DATETIME_LONGEST = 'วันl-TH ที่ j เดือนF-TH พ.ศ.Y-TH เวลา G นาฬิกา i นาที s วินาที';
    private const DATETIME_LONG = 'วันที่ j F-TH พ.ศ.Y-TH เวลา H:i น.';
    private const DATETIME_NORMAL = 'j F-TH พ.ศ.Y-TH เวลา H:i น.';
    private const DATE_LONGEST = 'วันl-TH ที่ j เดือนF-TH พ.ศ.Y-TH';
    private const DATE_NORMAL = 'วันที่ j F-TH พ.ศ.Y-TH';
    private const DATE_SHORT = 'j M-TH Y-TH';
    private const DATE_SHORTEST = 'j M-TH y-TH';
    private const TIME_LONGEST = 'เวลา G นาฬิกา i นาที s วินาที';
    private const TIME_LONG = 'เวลา H:i:s น.';
    private const TIME_NORMAL = 'H:i น.';
}