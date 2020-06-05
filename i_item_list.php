<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");
mysqli_set_charset($conn,"utf8");

$userid = $_SESSION['user_id'];
$sql = "select * from i_info where user_id='$userid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$consultantid = $row['i_consultant_id'];
if(isset($_GET['num'])){
	if($_GET['num']==1){
		$sql2 = "select * from item_info where consult_id='$consultantid' and lowest_price<20000000 order by id desc";
	}
	else if($_GET['num']==2){
		$sql2 = "select * from item_info where consult_id='$consultantid' and lowest_price>=20000000 and lowest_price<50000000 order by id desc";
	}
	else if($_GET['num']==3){
		$sql2 = "select * from item_info where consult_id='$consultantid' and lowest_price>=50000000 and lowest_price<100000000 order by id desc";
	}
	else if($_GET['num']==4){
		$sql2 = "select * from item_info where consult_id='$consultantid' and lowest_price>=100000000 order by id desc";
	}
}
else{
	$sql2 = "select * from item_info where consult_id='$consultantid' order by id desc";
}

mysqli_free_result($result);
$result2 = mysqli_query($conn,$sql2);

$list = '';
while($row2 = mysqli_fetch_array($result2)){
	if($row2['imgurl']==null)
	{
		$img = "<img src=\"{$row2['imgurl2']}\" width=\"135\" height=\"135\" alt=\"사진(외관,위치(지도)등)\" />";
	}
	else
	{
		$img = "<img src=\"image\\{$row2['imgurl']}\" width=\"135\" height=\"135\" alt=\"사진(외관,위치(지도)등)\" />";
	}

	//현재 자신이 선택한 매물의 열람 여부(열람했었다면 item_check==1 아니라면 item_check==0)
	$sql3 = "select * from i_check where user_id='$userid' and item_id={$row2['id']}";
	$result3 = mysqli_query($conn,$sql3);
	$row3 = mysqli_fetch_array($result3);

	$list = $list."<li class=\"leftClear\">
  <a data-ajax=\"false\" onclick=\"check({$row3['item_check']},{$row2['id']})\">
  <div class=\"titlestyle\" style = \"font-size:1.2em\";>{$row2['title']}</div>
  <div class=\"leftFloat\">"
    .$img.
  "</div>
  <div class=\"leftFloat leftMargin\">
    매각기일 <p style=\"display: inline\">{$row2['deadline_date']}</p><br>
    사건번호 <p style=\"display: inline\">{$row2['number']}</p><br>
    감정가 <p style=\"display: inline\">{$row2['appraisal_price']}</p><br>
    최저가 <p style=\"display: inline\">{$row2['lowest_price']}</p><br>
    용도 <p style=\"display: inline\">{$row2['use_sort']}</p><br>
    건물면적 <p style=\"display: inline\">{$row2['building_area']}</p><br>
    토지면적 <p style=\"display: inline\">{$row2['land_area']}</p><br>
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
    <title>매물보기</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="i_item_list">
			<script>
			function check(value1,value2){
				if(value1==0){
					var result = confirm('매물을 열람하겠습니까?\n한건당 70원(다음 열람시 부터 차감 없음)');
					if(result){
						location.href="i_detail_item.php?id="+value2;
					}
					else{
						history.go(0);
					}
				}
				else{
					location.href="i_detail_item.php?id="+value2;
				}
			}
		</script>
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>매물보기</h1>
			<a href="i_menu.php" class="ui-btn-right" data-icon="bars" data-transition="slide">menu</a>
			<div data-role="navbar">
				<ul>
					<li><a href="i_item_list.php">모든매물</a></li>
					<li><a href="i_item_list.php?num=1">0~2천</a></li>
					<li><a href="i_item_list.php?num=2">2천~5천</a></li>
					<li><a href="i_item_list.php?num=3">5천~1억</a></li>
					<li><a href="i_item_list.php?num=4">1억 이상</a></li>
				</ul>
			</div>
    </div>
    <div data-role="content" class="center">
			<ul data-role="listview">
        <?=$list?>
      </ul>
    </div>
    <div data-role="footer" data-position="fixed">
    </div>
  </div>
</body>
</html>
