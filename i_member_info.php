<?php
  header('Content-Type: text/html; charset=utf-8');
  session_start();

  $conn = mysqli_connect("localhost","root","111111","courtauction");
  mysqli_set_charset($conn,"utf8");

  $userid = $_SESSION['user_id'];
  $sql = "select * from member_info where user_id ='$userid'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);

  $sql2 = "select * from i_info where user_id ='$userid'";
  $result2 = mysqli_query($conn,$sql2);
  $row2 = mysqli_fetch_array($result2);

  $user = "
  <p>이름 : {$row['user_name']}</p>
  <p>ID : {$row['user_id']}</p>
  <p>연락처 : {$row['user_tel']}</p>
  <p>보유 포인트 : {$row2['i_point']}</p>
  <p>투자자금 : {$row2['i_money']}</p>
  <p>선호지역 : {$row2['i_f_location']}</p>
";

$money_check = array("","","","");
$check = array("0 ~ 2천만원","2천 ~ 5천만원","5천 ~ 1억","1억 이상");
for($i = 0;$i<4;$i++){
  if($row2['i_money']==$check[$i]){
    $money_check[$i] = "checked";
  }
}

$city_split = explode(" ",$row2['i_f_location']);

$city_check = array("unchecked","unchecked","unchecked","unchecked","unchecked","unchecked","unchecked");
$check = array("서울","경기","대전","대구","부산","제주","기타");
for($i = 0;$i<count($city_split);$i++){
  for($j = 0;$j<7;$j++){
    if($city_split[$i]==$check[$j]){
      $city_check[$j] = "checked";
    }
  }
}
?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>회원(투자자)정보</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="i_member_info">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>회원 정보</h1>
			<a href="i_menu.php" data-icon="bars" class="ui-btn-right" data-transition="slide">menu</a>
    </div>
    <div data-role="content" class="center">
      <?=$user?>
    <form data-ajax="false" action="i_process_member_info.php" method="post">
      <div data-role="content" class="center">
        <p style="text-align: center">투자자금</p>
				<label>
					<input type ="radio" name ="money" value="0 ~ 2천만원" <?=$money_check[0]?>>0 ~ 2천만원
				</label>
				<label>
					<input type ="radio" name ="money" value="2천 ~ 5천만원" <?=$money_check[1]?>>2천 ~ 5천만원
				</label>
				<label>
					<input type ="radio" name ="money" value="5천 ~ 1억" <?=$money_check[2]?>>5천 ~ 1억
				</label>
				<label>
					<input type ="radio" name ="money" value="1억 이상" <?=$money_check[3]?>>1억 이상
				</label>
        <br>
			  <p style="text-align: center">선호지역</p>
				<label>
					<input type ="checkbox" name ="city[]" value="서울" autocomplete="off" <?=$city_check[0]?>>서울
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="경기" autocomplete="off" <?=$city_check[1]?>>경기
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="대전" autocomplete="off" <?=$city_check[2]?>>대전
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="대구" autocomplete="off" <?=$city_check[3]?>>대구
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="부산" autocomplete="off" <?=$city_check[4]?>>부산
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="제주" autocomplete="off" <?=$city_check[5]?>>제주
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="기타" autocomplete="off" <?=$city_check[6]?>>기타
				</label>
        <p>* 투자자금, 선호지역 변경사항 있을시<br>&nbsp;&nbsp;수정 완료 버튼 클릭하셔야 반영됩니다.</p>
      </div>
    <div data-role="footer" data-position="fixed">
			<h2><input type ="submit" value ="수정 완료"></h2>
		</div>
		</form>
		</div>
  </div>

</body>

</html>
