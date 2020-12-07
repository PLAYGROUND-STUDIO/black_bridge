<?php
echo "TEST<br><br><br><br>";

require '../vendor/autoload.php';
require '../src/PhpExtends/ThaiDateTime.php';
require '../src/PhpExtends/ThaiDateTimeFormat.php';

use \PlaygroundStudio\PhpExtends\ThaiDateTime;
use \PlaygroundStudio\PhpExtends\ThaiDateTimeFormat;

$date = new ThaiDateTime();
echo $date->format(ThaiDateTimeFormat::DATETIME_NORMAL());
