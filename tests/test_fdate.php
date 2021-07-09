<?php
function DateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}



$strDate = "2008-08-14 13:42:44";

$mydate=getdate(date("U"));

$mydates =  "$mydate[year] $mydate[mon] $mydate[mday] ";

echo date("Y-m-d") . "<br>";

$cur_date1  = (substr(date("Y-m-d"),8,2)) . "-" . (substr(date("Y-m-d"),5,2)) . "-" . (substr(date("Y-m-d"),0,4) + 543) ;

echo $cur_date1 ;

//echo $mydate[year] . "-" . $mydate[mon] . "-" . $mydate[mday] ;

//echo "ThaiCreate.Com Time now : ".DateThai($strDate);

?>
