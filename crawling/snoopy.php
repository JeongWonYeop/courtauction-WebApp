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
$addressrex="/\"address\"(.*)/"; 
$rex="/\"min\"(.*)>/";
preg_match_all($addressrex,iconv("euc-kr","utf-8",$result), $text);


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