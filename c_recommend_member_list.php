<?php
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");
settype($_POST['money'],'integer');
$userid = $_SESSION['user_id'];
$itemid = $_POST['id'];

$sql = "
SELECT * FROM i_info WHERE i_consultant_id = '$userid' AND i_money ={$_POST['money']} AND i_location = '{$_POST['city']}'
";

$result = mysqli_query($conn,$sql);
$list ='';

while($row = mysqli_fetch_array($result))
{
    $list = $list."
    <li data-icon=\"false\">
    <a href=\"c_suggestion.php?id=$itemid&i_id={$row['user_id']}\">
    <div class=\"leftFloat\">
        <img src=\"사람.JPG\" width=\"70\" height=\"70\" alt=\"\"/>
        <p class=\"pstyle\" style=\"margin: 0px\">{$row[user_id]}</p>
    </div>
    <div class=\"leftFloat leftMargin topMargin\">
        투자 자금 : <p style=\"display: inline\">{$row[i_money]}</p><br>
        선호 지역 : <p style=\"display: inline\">{$row[i_location]}</p><br>
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
    <title>해당 투자자 목록</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

</head>

<body>
	<div data-role="page" id="c_recommend_member_list">
        <div data-role="header" data-theme="b">
            <h1 class="ui-title">
			<img src="로고.png" alt="" width="50" height="50" margin="0"/>투자자 목록</h1>
			<a href="c_recommend_check.html" data-icon="back">back</a>
			<a href="c_menu.html" data-icon="grid" data-transition="slide">menu</a>
        </div>
        <div data-role="content" class="center">
			<ul data-role="listview">				
               <?=$list?>
			</ul>
        </div>
    </div>
</body>

</html>