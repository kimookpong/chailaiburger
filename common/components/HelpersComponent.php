<?php

namespace common\components;

use Yii;
use yii\base\Component;

class HelpersComponent extends Component
{
    public function welcome()
    {
        return "Welcome to MyComponent";
    }

    public function getDate($datetime)
    {
        $strMonthTH = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthEN = array("", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

        $strYear    = date("Y", $datetime) + 543;
        $strMonth   = date("n", $datetime);
        $strMonthS  = $strMonthTH[$strMonth];
        $strDay     = date("d", $datetime);

        return "$strDay $strMonthS $strYear";
    }

    public function getDateTime($datetime)
    {
        $strMonthTH = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthEN = array("", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

        $strYear    = date("Y", $datetime) + 543;
        $strMonth   = date("n", $datetime);
        $strMonthS  = $strMonthTH[$strMonth];
        $strDay     = date("d", $datetime);

        $strTime    = date("H:i", $datetime);


        return "$strDay $strMonthS $strYear $strTime";
    }
}
