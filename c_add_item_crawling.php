<?php
$year = $_POST['year'];
$number = $_POST['number'];

//Snoopy.class.php를 불러옵니다
require($_SERVER['DOCUMENT_ROOT'].'/Snoopy-2.0.0.tar.gz/Snoopy.class.php');

//스누피를 생성해줍시다

$snoopy = new Snoopy;


$o="";

$snoopy->fetch("http://www.landfuture.co.kr/workdir/upcate/kyg/kyg_srch.php?s_year=".$year."&s_sa_num=".$number);
//스누피의 fetch함수로 제 웹페이지를 긁어볼까요? :)
$result=$snoopy->results;

$addressrex="/\"address\" \>\n								(.*)					/"; 
$min_moneyrex="/\"min\"\>\n										(.*)\<\/span\>\<br\>/";
$eva_moneyrex="/\"eva\"\>(.*)\<\/span\>\<br\>/";
$size_rex="/\"area_txt\"\>\n\[(.*)/";
$purpose_rex="/color:#00459C;'\>\n					(.*)\<\/td\>/";
$date_year_rex="/color:#545454;'\>(.*).05.22/";
$date_month_rex="/color:#545454;'\>2020.(.*).22/";
$date_day_rex="/color:#545454;'\>2020.05.(.*)\<\/span\>/";
$image_rex="/img src=\"(.*)\"/";//[1][6]
preg_match_all($addressrex,iconv("euc-kr","utf-8",$result), $text);
$address = $text[1][0];
if(preg_match_all($min_moneyrex,iconv("euc-kr","utf-8",$result), $text)){
	$min_money = $text[1][0];
	$edit_rex = "/span style/";
	if(preg_match($edit_rex,$min_money,$min_money2)){
		$min_money="변경됨";
	}
}
preg_match_all($eva_moneyrex,iconv("euc-kr","utf-8",$result), $text);
$eva_money = $text[1][0];
preg_match_all($size_rex,iconv("euc-kr","utf-8",$result), $text);	
$before_cut = $text[1][0];
$lr = "/토지 (.*)]/";
$br = "/건물 (.*)]/";

if(!preg_match($lr,$text[1][0],$land_size)){
$land_size[1]="없음";
};
if(!preg_match($br,$text[1][0],$building_size)){
$building_size[1]="없음";
};

//$building_size = $text[1][0];
//preg_match_all($land_rex,iconv("euc-kr","utf-8",$result), $text);
//$land_size=$text[5][0];
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




?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>매물 등록</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
  <script>
    function clearinput(){
      var el = document.getElementsByClassName('input-text');
      for(var i = 0;i<el.length;i++){
        el[i].value = "";
      }
    }
  </script>
	<div data-role="page" id="c_add_item">
    <div data-role="header" data-theme="b" data-position="fixed">
			<h1><img src="image\로고.png" alt="" width="50" height="50" id="imgMargin"/>매물 등록</h1>
			<a href="c_item_list.php" data-icon="back" onclick="clearinput()">back</a>
			<a href="c_menu.html" data-icon="bars" data-transition="slide">menu</a>
    </div>
		<form data-ajax="false" action="c_process_add.php" method="POST" enctype="multipart/form-data">
      <div data-role="content" class="center">
 
				<div class="clearboth">
					<div class="leftFloat labelmargin">사건번호</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="number" value="<?=$_POST['year']?>타경<?=$_POST['number']?>" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				       <div class="clearboth">
					<div class="leftFloat labelmargin">제목</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="title" value="<?=$address?>" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">소재지</div>
          <div class="rightfloat">
						<input class="input-text"type="text" name="location" value="<?=$address?>" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">경매구분</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="auction_sort" size="30" maxlength="50" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">용도</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="use_sort" value="<?=$purpose?>" size="30" maxlength="50" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">감정가</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="appraisal_price" value="<?=$eva_money?>" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">최저가</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="lowest_price" value="<?=$min_money?>" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">입찰보증금</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="bid_bond" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">토지면적</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="land_area" value="<?=$land_size[1]?>" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">건물면적</div>
            <div class="rightfloat">
						<input class="input-text" type="text" name="building_area" value="<?=$building_size[1]?>" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">매각기일</div>
          <div class="rightfloat">
						<input class="input-text" type="datetime-local" name="deadline_date" value="<?=$date_year?>-<?=$date_month?>-<?=$date_day?>T23:59" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
        <div class="clearboth">
					<div class="leftFloat labelmargin">소견</div>
          <div class="rightfloat">
            <textarea class="input-text" name="opinion" cols="32" rows="50"></textarea>
					</div>
				</div>
        <div class="clearboth">
          <div class="leftFloat labelmargin">사진</div>
          <div class="rightfloat">
            <input class="input-text" type="file" name="imgurl">
					</div>
				</div>
	   <div class="clearboth">
          <div class="leftFloat labelmargin">사진url</div>
          <div class="rightfloat">
            <input class="input-text" type="text" name="imgurl2" value="<?=$image_url?>">
					</div>
					</div>
				
      </div>
      <div data-role="footer" data-position="fixed">
        <h2 class="leftFloat"><a href="c_item_list.php" onclick="clearinput()">취소</a></h2>
        <h2 class="rightfloat"><input type="submit" value="완료"></h2>
      </div>
		</form>
  </div>
</body>

</html>
