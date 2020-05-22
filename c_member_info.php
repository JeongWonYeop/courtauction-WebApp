<?php
header('Content-Type: text/html; charset=utf-8');
  session_start();

  $conn = mysqli_connect("localhost","root","111111","courtauction");

  $userid = $_SESSION['user_id'];
  $sql = "select * from member_info where user_id ='$userid'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);

  $sql2 = "select * from c_info where user_id ='$userid'";
  $result2 = mysqli_query($conn,$sql2);
  $row2 = mysqli_fetch_array($result2);

  $user = "
  <p>이름 : {$row['user_name']}</p>
  <p>ID : {$row['user_id']}</p>
  <p>연락처 : {$row['user_tel']}</p>
";

?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>회원(컨설턴트)정보</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="c_member_info">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>회원 정보</h1>
			<a href="c_menu.php" class="ui-btn-right" data-icon="bars" data-transition="slide">menu</a>
    </div>
    <form data-ajax="false" action="c_process_member_info.php" method="post">
      <div data-role="content" class="center">
        <?=$user?>
        <p>소개:</p>
        <textarea name="introduction" cols="32" rows="50"><?=$row2['c_introduction']?></textarea>
        <p>* 소개 변경사항 있을시<br>&nbsp;&nbsp;수정 완료 버튼 클릭하셔야 반영됩니다.</p>
      </div>
      <div data-role="footer" data-position="fixed">
        <h2><input type ="submit" value ="수정 완료"></h2>
      </div>
    </form>
</body>

</html>
