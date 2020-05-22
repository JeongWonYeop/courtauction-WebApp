<?php
header('Content-Type: text/html; charset=utf-8');
  session_start();

  $user = '';
  if(isset($_SESSION['user_id'])){
    $user = $user."<img src=\"image\사람.JPG\" width=\"70\" height=\"70\" alt=\"\"/>
    <p style=\"margin: 0px\">{$_SESSION['user_name']}님 환영합니다.</p>";
  }

  $conn = mysqli_connect("localhost","root","111111","courtauction");

  $userid = $_SESSION['user_id'];
  $sql = "select * from recommend_item where c_id='$userid'";
  $result = mysqli_query($conn,$sql);
  $count = mysqli_num_rows($result);

?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>컨설턴트 메뉴</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="c_menu">
    <div data-role="header" data-theme="b" data-position="fixed">
			<h1><img src="image\로고.png" alt="" width="50" height="50" id="imgMargin"/>컨설턴트 메뉴</h1>
      <a data-ajax="false" href="logout.php" class="ui-btn-right" data-icon="lock">logout</a>
    </div>
    <div data-role="content" class="center">
      <?=$user?>
			<p><a href="c_item_list.php">등록 매물</a></p>
			<p><a href="c_recommend_list.php">매물 추천 목록(<?=$count?>)</a></p>
			<p><a href="c_investor_list.php">투자자 연결</a></p>
      <p><a href="c_member_info.php">회원 정보</a></p>
    </div>
    <div data-role="footer" data-position="fixed">

    </div>
  </div>
</body>

</html>
