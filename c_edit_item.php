<?php
header('Content-Type: text/html; charset=utf-8');
$conn = mysqli_connect("localhost","root","111111","courtauction");
mysqli_set_charset($conn,"utf8");

$sql = "select * from item_info where id={$_GET['id']}";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
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
  'imgurl2' => $row['imgurl2']
);

if($row['imgurl']==null)
{
  $img = "<div class=\"leftFloat labelmargin\">사진url</div>
  <div class=\"rightfloat\">
    <input class=\"input-text\" type=\"text\" name=\"imgurl2\" value=\"{$row['imgurl2']}\">
  </div>";
}
else
{
  $img = "<input type=\"hidden\" name=\"img\" value=\"{$row['imgurl']}\">
  <img src=\"image\\{$row['imgurl']}\" width=\"100%\" height=\"300\" alt=\"사진업로드\" />
  <p>변경후 사진(선택하지 않으면 변경하지 않음)</p>
  <input type=\"file\" name=\"imgurl\">";
}
?>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>매물 수정</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="c_edit_item">
    <div data-role="header" data-theme="b" data-position="fixed">
			<h1><img src="image\로고.png" alt="" width="50" height="50" id="imgMargin"/>매물 수정</h1>
			<a href="c_item_list.php" data-icon="back">back</a>
			<a href="c_menu.php" data-icon="bars" data-transition="slide">menu</a>
    </div>
    <form data-ajax="false" action="c_process_update.php" method="POST" enctype="multipart/form-data">
      <div data-role="content" class="center">
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <div class="clearboth">
					<div class="leftFloat labelmargin">제목</div>
          <div class="rightfloat">
						<input type="text" name="title" size="30" value="<?=$description['title']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">사건번호</div>
          <div class="rightfloat">
						<input type="text" name="number" size="30" value="<?=$description['number']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">소재지</div>
          <div class="rightfloat">
						<input type="text" name="location" size="30" value="<?=$description['location']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">경매구분</div>
          <div class="rightfloat">
						<input type="text" name="auction_sort" size="30" value="<?=$description['auction_sort']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">용도</div>
          <div class="rightfloat">
						<input type="text" name="use_sort" size="30" value="<?=$description['use_sort']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">감정가</div>
          <div class="rightfloat">
						<input type="text" name="appraisal_price" size="30" value="<?=$description['appraisal_price']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">최저가</div>
          <div class="rightfloat">
						<input type="text" name="lowest_price" size="30" value="<?=$description['lowest_price']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">입찰보증금</div>
          <div class="rightfloat">
						<input type="text" name="bid_bond" size="30" value="<?=$description['bid_bond']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">토지면적</div>
          <div class="rightfloat">
						<input type="text" name="land_area" size="30" value="<?=$description['land_area']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">건물면적</div>
          <div class="rightfloat">
						<input type="text" name="building_area" size="30" value="<?=$description['building_area']?>" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">매각기일</div>
          <div class="rightfloat">
						<input type="text" name="deadline_date" size="30" value="<?=$description['deadline_date']?>" required>
					</div>
				</div>
        <div class="clearboth">
					<div class="leftFloat labelmargin">소견</div>
          <div class="rightfloat">
            <textarea name="opinion" cols="32" rows="50"><?=$description['opinion']?></textarea>
					</div>
				</div>
				<div class="clearboth">
          <?=$img?>
				</div>
      </div>
      <div data-role="footer" data-position="fixed">
        <h2 class="leftFloat"><a href="c_item_list.php">취소</a></h2>
        <h2 class="rightfloat"><input type="submit" value="완료"></h2>
      </div>
    </form>
  </div>
</body>

</html>
