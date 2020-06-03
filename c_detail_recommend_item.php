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
  'imgurl2' => $row['imgurl2']
);

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
	<div data-role="page" id="c_detail_recommend_item">
    <div data-role="header" data-theme="b" data-position="fixed">
			<h1><img src="image\로고.png" alt="" width="50" height="50" id="imgMargin"/>추천매물 상세보기</h1>
			<a href="c_recommend_list.php" data-icon="back">back</a>
			<a href="c_menu.php" data-icon="bars" data-transition="slide">menu</a>
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
				
<div class="clearboth">		
<input type="button" value="지도보기" onclick="location.reload()" />
<div id="map" style="width:100%;height:350px;"></div>

</div>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=78994475d0e658394cf470e68f2c5ec9&libraries=services"></script>
<script>

	window.onload = pageLoad;
    function pageLoad(){
        findmap();
    };
	
	function findmap(){
		var mapContainer = document.getElementById('map'); // The div to display the map
		 mapOption = {
        center: new kakao.maps.LatLng(37.413294, 127.269311), // Center coordinates of the map
        level: 3 // Map zoom level
		};  
			
		// make map
		var map = new kakao.maps.Map(mapContainer, mapOption); 

			// 지도를 표시하는 div 크기를 변경한 이후 지도가 정상적으로 표출되지 않을 수도 있습니다
			// 크기를 변경한 이후에는 반드시  map.relayout 함수를 호출해야 합니다 
			// window의 resize 이벤트에 의한 크기변경은 map.relayout 함수가 자동으로 호출됩니다
			map.relayout();

		// Create an address-coordinate conversion object
		var geocoder = new kakao.maps.services.Geocoder();

		// Search for coordinates by address
		geocoder.addressSearch('<?=$description['location']?>', function(result, status) {

			// If the search is completed
			 if (status === kakao.maps.services.Status.OK) {

				var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

				// Mark the location received as a result with a marker
				var marker = new kakao.maps.Marker({
					map: map,
					position: coords
				});

				// Information window displays the description of the place
				var infowindow = new kakao.maps.InfoWindow({
					content: '<div style="width:150px;text-align:center;padding:6px 0;">매물위치</div>'
				});
				infowindow.open(map, marker);

				// Move the center of the map to the location received as a result
				map.setCenter(coords);
			} 
		
		});
	}

</script>
      </div>
    </div>
      <div data-role="footer" data-position="fixed">
        <h2><a data-ajax="false" href="process_recommend_delete.php?id=<?=$_GET['r_id']?>">삭제</a></h2>
      </div>
    </div>
</body>

</html>
