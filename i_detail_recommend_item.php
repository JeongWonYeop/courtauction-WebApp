<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$sql = "select * from item_info where id={$_GET['id']}";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$sql2 = "select * from recommend_item where id={$_GET['r_id']}";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2);

$description = array(
  'title' => $row['title'],
  'number' => $row['number'],
  'location' => $row['location'],
  'auction_sort' => $row['auction_sort'],
  'use_sort' => $row['use_sort'],
  'appraisal_price' => $row['appraisal_price'],
  'lowest_price' => $row['lowest_price'],
  'bid_bond' => $row['bid_bond'],
  'land_area' => $row['land_area'],
  'building_area' => $row['building_area'],
  'deadline_date' => $row['deadline_date'],
  'opinion' => $row['opinion'],
  'imgurl' => $row['imgurl'],
  'reason' => $row2['reason'],
  'imgurl2' =>$row['imgurl2']
);

$userid = $_SESSION['user_id'];

$sql3 = "select * from i_info where user_id='$userid'";
$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_array($result3);

$sql4 = "select * from member_info where user_id='{$row3['i_consultant_id']}'";
$result4 = mysqli_query($conn,$sql4);
$row4 = mysqli_fetch_array($result4);

//이전에 열람했는지 확인
$check = "select * from i_check where user_id='$userid' and item_id={$_GET['id']}";
$checkresult = mysqli_query($conn,$check);
$checkrow = mysqli_fetch_array($checkresult);

//열람하지 않았다면
if($checkrow['item_check']==0){
  //매물 열람시 70원 차감
  $sql5 = "update i_info set i_point = {$row3['i_point']}-70 where user_id='$userid'";
  $result5 = mysqli_query($conn,$sql5);

  //열람 한것으로 표시
  $sql6 = "update i_check set item_check = 1 where user_id='$userid' and item_id={$_GET['id']}";
  $result6 = mysqli_query($conn,$sql6);
}
?>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>추천 매물보기(상세)</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="i_detail_recommend_item">
    <div data-role="header" data-theme="b" data-position="fixed">
			<h1><img src="image\로고.png" alt="" width="50" height="50" id="imgMargin"/>추천매물 상세보기</h1>
			<a href="i_recommend_list.php" data-icon="back">back</a>
			<a href="i_menu.php" data-icon="bars" data-transition="slide">menu</a>
    </div>
    <div data-role="content" class="center">
      <div>
				<div>
					<div class="leftFloat">사건번호</div>
					<div class="rightfloat"><?=$description['number']?></div>
				</div>
        <div class="clearboth">
					<hr>
					<div class="leftFloat">소재지</div>
					<div class="rightfloat"><?=$description['location']?></div>
				</div>
				<div class="clearboth">
					<hr>
					<div class="leftFloat">경매구분</div>
					<div class="rightfloat"><?=$description['auction_sort']?></div>
				</div>
				<div class="clearboth">
					<hr>
					<div class="leftFloat">용도</div>
					<div class="rightfloat"><?=$description['use_sort']?></div>
				</div>
				<div class="clearboth">
					<hr>
					<div class="leftFloat">감정가</div>
					<div class="rightfloat"><?=$description['appraisal_price']?></div>
				</div>
				<div class="clearboth">
					<hr>
					<div class="leftFloat">최저가</div>
					<div class="rightfloat"><?=$description['lowest_price']?></div>
				</div>
				<div class="clearboth">
					<hr>
					<div class="leftFloat">입찰보증금</div>
					<div class="rightfloat"><?=$description['bid_bond']?></div>
				</div>
				<div class="clearboth">
					<hr>
					<div class="leftFloat">토지면적</div>
					<div class="rightfloat"><?=$description['land_area']?></div>
				</div>
				<div class="clearboth">
					<hr>
					<div class="leftFloat">건물면적</div>
					<div class="rightfloat"><?=$description['building_area']?></div>
				</div>
				<div class="clearboth">
					<hr>
					<div class="leftFloat">매각기일</div>
					<div class="rightfloat"><?=$description['deadline_date']?></div>
				</div>
        <div class="clearboth">
					<hr>
					<div class="leftFloat">소견</div>
					<div class="rightfloat"><?=$description['opinion']?></div>
				</div>
        <div class="clearboth">
					<hr>
					<div class="leftFloat">추천 이유</div>
					<div class="rightfloat"><?=$description['reason']?></div>
				</div>
				<div class="clearboth">
					<hr>
          <img src="image\<?=$description['imgurl']?>" width="100%" height="300" alt="사진(외관,위치(지도)등)" />
		     <img src="<?=$description['imgurl2']?>" width="200px" height="250px" alt="사진(외관,위치(지도)등)" />
				</div>
      </div>
    </div>
      <div data-role="footer" data-position="fixed">
        <h2 class="leftFloat"><a data-ajax="false" href="process_recommend_delete.php?id=<?=$_GET['r_id']?>">삭제</a></h2>
        <h2 class="rightfloat"><a href="tel:<?=$row4['user_tel']?>">경매컨설턴트</a></h2>
      </div>
    </div>
</body>

</html>
