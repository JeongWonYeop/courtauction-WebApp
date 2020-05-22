<?php
header('Content-Type: text/html; charset=utf-8');
  session_start();
  $conn = mysqli_connect("localhost","root","111111","courtauction");

  $list = '';
  $sql = "select * from member_info left join c_info on member_info.user_id = c_info.user_id where member_type=2";
  $result = mysqli_query($conn,$sql);

  $list = '';
  while($row = mysqli_fetch_array($result)){
    $list = $list."
    <li data-icon=\"false\">
      <a data-ajax=\"false\" href=\"process_signup2.php?user_id={$_GET['user_id']}&user_pw={$_GET['user_pw']}&user_name={$_GET['user_name']}&user_tel={$_GET['user_tel']}&member_type={$_GET['member_type']}&i_consultant_id={$row['user_id']}\">
      <div class=\"leftFloat\">
        <img src=\"image\\사람.JPG\" width=\"70\" height=\"70\" alt=\"\"/>
        <p class=\"pstyle\" style=\"margin: 0px\">{$row['user_name']}</p>
      </div>
      <div class=\"leftFloat leftMargin topMargin\">
        소개 : <p style=\"display: inline\">{$row['c_introduction']}</p><br>
      </div>
      </a>
    </li>";
  }

?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>컨설턴트 목록</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="i_consultant_list">
    <div data-role="header" data-theme="b">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>컨설턴트 목록</h1>
			<a href="javascript:history.back();" data-icon="back">back</a>
    </div>
    <div data-role="content" class="center">
			<ul data-role="listview">
        <?=$list?>
			</ul>
    </div>
  </div>
</body>

</html>
