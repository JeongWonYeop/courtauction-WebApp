<?php
  session_start();

  $conn = mysqli_connect("localhost","root","111111","courtauction");

  $list = '';
  $sql = "select * from member_info left join i_info on member_info.user_id = i_info.user_id where i_consultant_id='{$_SESSION['user_id']}'";
  $result = mysqli_query($conn,$sql);

  $list = '';
  while($row = mysqli_fetch_array($result)){
    $list = $list."
    <li data-icon=\"false\">
      <a data-ajax=\"false\" href=\"c_investor_connect.php?user_id={$row['user_id']}\">
      <div class=\"leftFloat\">
        <img src=\"image\\사람.JPG\" width=\"70\" height=\"70\" alt=\"\"/>
        <p class=\"pstyle\" style=\"margin: 0px\">{$row['user_name']}</p>
      </div>
      <div class=\"leftFloat leftMargin topMargin\">
        투자자금 : <p style=\"display: inline\">{$row['i_money']}</p><br>
        선호지역 : <p style=\"display: inline\">{$row['i_f_location']}</p>
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
    <title>투자자 목록</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="c_investor_list">
    <div data-role="header" data-theme="b">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>투자자 목록</h1>
      <a href="c_menu.php" data-icon="bars" class="ui-btn-right" data-transition="slide">menu</a>
    </div>
    <div data-role="content" class="center">
			<ul data-role="listview">
        <?=$list?>
			</ul>
    </div>
  </div>
</body>

</html>
