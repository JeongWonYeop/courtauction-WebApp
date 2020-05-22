<?php

//Snoopy.class.php를 불러옵니다
$x=array("2017","9858");
require($_SERVER['DOCUMENT_ROOT'].'/Snoopy-2.0.0.tar.gz/Snoopy.class.php');

 

//스누피를 생성해줍시다

$snoopy = new Snoopy;


$o="";

$snoopy->fetch("http://www.landfuture.co.kr/workdir/upcate/kyg/kyg_srch.php?s_year=".$x[0]."&s_sa_num=".$x[1]);
//스누피의 fetch함수로 제 웹페이지를 긁어볼까요? :)
$result=$snoopy->results;
$addressrex="/\"address\" \>\n								(.*)					/"; 
$min_moneyrex="/\"min\"\>\n										(.*)\<\/span\>\<br\>/";
$eva_moneyrex="/\"eva\"\>(.*)\<\/span\>\<br\>/";
$building_rex="/\"area_txt\"\>\n\[건물 (.*)\] \[토지 ((-)?\d{1,3}(,\d{3})*(\.\d+)?)평\]					/";
$land_rex="/\"area_txt\"\>\n\[건물 ((-)?\d{1,3}(,\d{3})*(\.\d+)?)평\] \[토지 (.*)\]/";
$purpose_rex="/color:#00459C;'\>\n					(.*)/";
$date_year_rex="/color:#545454;'\>(.*).05.22/";
$date_month_rex="/color:#545454;'\>2020.(.*).22/";
$date_day_rex="/color:#545454;'\>2020.05.(.*)/";
$image_rex="/img src=\"(.*)\"/";//[1][6]
preg_match_all($addressrex,iconv("euc-kr","utf-8",$result), $text);
$address = $text[1][0];
preg_match_all($min_moneyrex,iconv("euc-kr","utf-8",$result), $text);
$min_money = $text[1][0];
preg_match_all($eva_moneyrex,iconv("euc-kr","utf-8",$result), $text);
$eva_money = $text[1][0];
preg_match_all($building_rex,iconv("euc-kr","utf-8",$result), $text);	

$building_size = $text[1][0];
preg_match_all($land_rex,iconv("euc-kr","utf-8",$result), $text);

$land_size=$text[5][0];
preg_match_all($purpose_rex,iconv("euc-kr","utf-8",$result), $text);
$purpose = $text[1][0];
preg_match_all($date_year_rex,iconv("euc-kr","utf-8",$result), $text);
$date_year = $text[1][0];
preg_match_all($date_month_rex,iconv("euc-kr","utf-8",$result), $text);
$date_month = $text[1][0];
preg_match_all($date_day_rex,iconv("euc-kr","utf-8",$result), $text);
$date_day = $text[1][0];
preg_match_all($image_rex,iconv("euc-kr","utf-8",$result), $text);
$image_url = $text[1][6];

print_r($address);
print_r($min_money);
print_r($eva_money);
print_r($building_size);
print_r($land_size);
print_r($purpose);
print_r($date_year);
print_r($date_month);
print_r($date_day);
print_r($image_url);
$convsnoopy =iconv("euc-kr","utf-8",$result); 
print_r($convsnoopy);
 /*
$num = sizeof($text[0]);
//이제 결과를 보면...?
for($i = 0 ; $i < $num ; $i=$i+1){
	$j = $i+1;
	echo $j.$text[0][$i];
}
*/
?>