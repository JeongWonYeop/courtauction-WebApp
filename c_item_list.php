<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$userid = $_SESSION['user_id'];
if(isset($_GET['num'])){
	if($_GET['num']==1){
		$sql = "select * from item_info where consult_id='$userid' and lowest_price<20000000";
	}
	else if($_GET['num']==2){
		$sql = "select * from item_info where consult_id='$userid' and lowest_price>=20000000 and lowest_price<50000000";
	}
	else if($_GET['num']==3){
		$sql = "select * from item_info where consult_id='$userid' and lowest_price>=50000000 and lowest_price<100000000";
	}
	else if($_GET['num']==4){
		$sql = "select * from item_info where consult_id='$userid' and lowest_price>=100000000";
	}
}
else{
	$sql = "select * from item_info where consult_id='$userid'";
}

$result = mysqli_query($conn,$sql);
$list = '';
while($row = mysqli_fetch_array($result)){
	$list = $list."<li class=\"leftClear\">
  <a href=\"c_detail_item.php?id={$row['id']}\">
  <div class=\"titlestyle\" style = \"font-size:1.2em\";>{$row['title']}</div>
  <div class=\"leftFloat\">
    <img src=\"image\\{$row['imgurl']}\" width=\"150\" height=\"150\" alt=\"\" />
  </div>
  <div class=\"leftFloat leftMargin\">
    매각기일 <p style=\"display: inline\">{$row['deadline_date']}</p><br>
    사건번호 <p style=\"display: inline\">{$row['number']}</p><br>
    감정가 <p style=\"display: inline\">{$row['appraisal_price']}</p><br>
    최저가 <p style=\"display: inline\">{$row['lowest_price']}</p><br>
    용도 <p style=\"display: inline\">{$row['use_sort']}</p><br>
    건물면적 <p style=\"display: inline\">{$row['building_area']}</p><br>
    토지면적 <p style=\"display: inline\">{$row['land_area']}</p><br>
  </div>
  </a>
  <div style=\"text-align: right\">
		<a href=\"c_recommend_check.php?id={$row['id']}\">[추천]</a>
    <a href=\"c_edit_item.php?id={$row['id']}\">[변경]</a>
		<a data-ajax=\"false\" href=\"c_process_delete.php?id={$row['id']}\">[삭제]</a>
  </div>
  </li>";
}
?>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>등록 매물</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="c_item_list">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>등록 매물</h1>
			<a href="c_menu.php" class="ui-btn-right" data-icon="bars" data-transition="slide">menu</a>
			<div data-role="navbar">
				<ul>
					<li><a href="c_item_list.php">모든 매물</a></li>
					<li><a href="c_item_list.php?num=1">0~2천만원</a></li>
					<li><a href="c_item_list.php?num=2">2천~5천만원</a></li>
					<li><a href="c_item_list.php?num=3">5천~1억</a></li>
					<li><a href="c_item_list.php?num=4">1억 이상</a></li>
				</ul>
			</div>
    </div>
    <div data-role="content" class="center">
			<ul data-role="listview">
        <?=$list?>
      </ul>
    </div>
    <div data-role="footer" data-position="fixed">
        <h2><a href="c_add_item.php">추가</a></h2>
    </div>
  </div>
</body>
</html>
