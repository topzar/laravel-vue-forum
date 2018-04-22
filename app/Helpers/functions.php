<?php

use Jenssegers\Date\Date;

function getDiffTimeFromNow($timestamp)
{
    //echo Date::parse('2018-04-21 23:08:05')->diffForHumans(Date::now());
    Date::setLocale('zh-CN');

    return Date::parse($timestamp)->diffForHumans(Date::now());
}