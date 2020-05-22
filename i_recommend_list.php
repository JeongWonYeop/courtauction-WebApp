<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$userid = $_SESSION['user_id'];
$sql = "select item_info.id as item_info_id,title,imgurl,deadline_date,number,appraisal_price,lowest_price,use_sort,building_area,land_area,i_id,recommend_item.id from item_info left join recommend_item on item_info.id=recommend_item.item_id
where recommend_item.i_id='$userid'";
$result = mysqli_query($conn,$sql);
$list = '';
while($row = mysqli_fetch_array($result)){
	$list = $list."<li class=\"leftClear\">
  <a href=\"i_detail_recommend_item.php?id={$row['item_info_id']}&r_id={$row['id']}\">
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
    <a data-ajax=\"false\" href=\"process_recommend_delete.php?id={$row['id']}\">[삭제]</a>
  </div>
  </li>";
}
?>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>추천매물함</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="i_recommend_list">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>추천매물함</h1>
			<a href="i_menu.php" class="ui-btn-right" data-icon="bars" data-transition="slide">menu</a>
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
