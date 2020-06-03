<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");
mysqli_set_charset($conn,"utf8");
$userid = $_SESSION['user_id'];
$sql = "select item_info.id as item_info_id,title,imgurl,imgurl2,deadline_date,number,appraisal_price,lowest_price,use_sort,building_area,land_area,i_id,recommend_item.id from item_info left join recommend_item on item_info.id=recommend_item.item_id
where recommend_item.i_id='$userid'";
$result = mysqli_query($conn,$sql);
$list = '';
while($row = mysqli_fetch_array($result)){
	//현재 자신이 선택한 매물의 열람 여부(열람했었다면 item_check==1 아니라면 item_check==0)
	$sql2 = "select * from i_check where user_id='$userid' and item_id={$row['item_info_id']}";
	$result2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_array($result2);

	$list = $list."<li class=\"leftClear\">
  <a onclick=\"check({$row2['item_check']},{$row['item_info_id']},{$row['id']})\">
  <div class=\"titlestyle\" style = \"font-size:1.2em\";>{$row['title']}</div>
  <div class=\"leftFloat\">
		<img src=\"{$row['imgurl2']}\" width=\"150\" height=\"150\" alt=\"\" />
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
			<script>
			function check(value1,value2,value3){
				if(value1==0){
					var result = confirm('매물을 열람하겠습니까?\n한건당 70원(다음 열람시 부터 차감 없음)');
					if(result){
						location.href="i_detail_recommend_item.php?id="+value2+"&r_id="+value3;
					}
					else{
						history.go(0);
					}
				}
				else{
					location.href="i_detail_recommend_item.php?id="+value2+"&r_id="+value3;
				}
			}
		</script>
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
