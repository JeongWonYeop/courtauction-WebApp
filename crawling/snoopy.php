<?php

//Snoopy.class.php를 불러옵니다
$x=array("2017","1101");
require($_SERVER['DOCUMENT_ROOT'].'/Snoopy-2.0.0.tar.gz/Snoopy.class.php');

 

//스누피를 생성해줍시다

$snoopy = new Snoopy;


$o="";

$snoopy->fetch("http://www.landfuture.co.kr/workdir/upcate/kyg/kyg_srch.php?s_year=".$x[0]."&s_sa_num=".$x[1]);
//스누피의 fetch함수로 제 웹페이지를 긁어볼까요? :)
$result=$snoopy->results;
//$addressrex="/\"address\" \>\n								(.*)					/"; 
//$min_moneyrex="/\"min\"\>\n										(.*)/";
//$eva_moneyrex="/\"eva\"\>(.*)/";
//$building_rex="/\"area_txt\"\>\n\[건물 (.*)\] \[토지 912.64평\]					/";
//$land_rex="/\"area_txt\"\>\n\[건물 147.0평\] \[토지 (.*)\]/";
//$purpose_rex="/color:#00459C;'\>\n					(.*)/";

//$date_year_rex="/color:#545454;'\>(.*).05.22/"; //[1][2]
//$date_month_rex="/color:#545454;'\>2020.(.*).22/"; //[1][2]
//$date_day_rex="/color:#545454;'\>2020.05.(.*)/"; //[1][2]
//$rex="/img src=\"(.*)\"/";//[1][6]
preg_match_all($rex,iconv("euc-kr","utf-8",$result), $text);


print_r($text);
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