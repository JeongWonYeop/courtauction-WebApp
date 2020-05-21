<?php
  session_start();

  $conn = mysqli_connect("localhost","root","111111","courtauction");

  $sql = "select * from member_info left join i_info on member_info.user_id=i_info.user_id where member_info.user_id ='{$_GET['user_id']}'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);

  $user = "
  <p>이름 : {$row['user_name']}</p>
  <p>ID : {$row['user_id']}</p>
  <p>연락처 : {$row['user_tel']}</p>
  <p>투자자금 : {$row['i_money']}</p>
  <p>선호지역 : {$row['i_f_location']}</p>
";

?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>투자자 연결</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="c_investor_connect">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>투자자 연결</h1>
      <a href="javascript:history.back();" data-icon="back">back</a>
			<a href="i_menu.php" data-icon="bars" class="ui-btn-right" data-transition="slide">menu</a>
    </div>
    <div data-role="content" class="center">
      <?=$user?>
		</div>
    <div data-role="footer" data-position="fixed">
      <h2 class="leftFloat"><a href="sms:<?=$row['user_tel']?>">문자</a></h2>
      <h2 class="rightfloat"><a href="tel:<?=$row['user_tel']?>">전화</a></h2>
    </div>
  </div>
</body>

</html>
