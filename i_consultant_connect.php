<?php
header('Content-Type: text/html; charset=utf-8');
  session_start();

  $conn = mysqli_connect("localhost","root","111111","courtauction");
  mysqli_set_charset($conn,"utf8");
  
  $userid = $_SESSION['user_id'];
  $sql = "select * from i_info where user_id ='$userid'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);

  $sql2 = "select * from member_info left join c_info on member_info.user_id=c_info.user_id where member_info.user_id ='{$row['i_consultant_id']}'";
  $result2 = mysqli_query($conn,$sql2);
  $row2 = mysqli_fetch_array($result2);

  $user = "
  <p>이름 : {$row2['user_name']}</p>
  <p>ID : {$row2['user_id']}</p>
  <p>연락처 : {$row2['user_tel']}</p>
  <p>소개 : {$row2['c_introduction']}</p>
";

?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>컨설턴트 연결</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="i_consultant_connect">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>컨설턴트 연결</h1>
			<a href="i_menu.php" data-icon="bars" class="ui-btn-right" data-transition="slide">menu</a>
    </div>
    <div data-role="content" class="center">
      <?=$user?>
		</div>
    <div data-role="footer" data-position="fixed">
      <h2 class="leftFloat"><a href="sms:<?=$row2['user_tel']?>">문자</a></h2>
      <h2 class="rightfloat"><a href="tel:<?=$row2['user_tel']?>">전화</a></h2>
    </div>
  </div>
</body>

</html>
