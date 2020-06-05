<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>매물 등록</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
  <script>
    function clearinput(){
      var el = document.getElementsByClassName('input-text');
      for(var i = 0;i<el.length;i++){
        el[i].value = "";
      }
    }
  </script>
	<div data-role="page" id="c_add_item">
    <div data-role="header" data-theme="b" data-position="fixed">
			<h1><img src="image\로고.png" alt="" width="50" height="50" id="imgMargin"/>매물 등록</h1>
			<a href="c_item_list.php" data-icon="back" onclick="clearinput()">back</a>
			<a href="c_menu.php" data-icon="bars" data-transition="slide">menu</a>
    </div>
		<form data-ajax="false" action="c_process_add.php" method="POST" enctype="multipart/form-data">
      <div data-role="content" class="center">

				<div class="clearboth">
					<div class="leftFloat labelmargin">사건번호</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="number" size="30" maxlength="100" autocomplete="off" required>
						<a href="c_crawling.php">자동입력</a>
					</div>
				</div>
				       <div class="clearboth">
					<div class="leftFloat labelmargin">제목</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="title" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">소재지</div>
          <div class="rightfloat">
						<input class="input-text"type="text" name="location" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">경매구분</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="auction_sort" size="30" maxlength="50" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">용도</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="use_sort" size="30" maxlength="50" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">감정가</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="appraisal_price" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">최저가</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="lowest_price" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">입찰보증금</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="bid_bond" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">토지면적</div>
          <div class="rightfloat">
						<input class="input-text" type="text" name="land_area" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">건물면적</div>
            <div class="rightfloat">
						<input class="input-text" type="text" name="building_area" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
				<div class="clearboth">
					<div class="leftFloat labelmargin">매각기일</div>
          <div class="rightfloat">
						<input class="input-text" type="datetime-local" name="deadline_date" size="30" maxlength="100" autocomplete="off" required>
					</div>
				</div>
        <div class="clearboth">
					<div class="leftFloat labelmargin">소견</div>
          <div class="rightfloat">
            <textarea class="input-text" name="opinion" cols="32" rows="50"></textarea>
					</div>
				</div>
        <div class="clearboth">
          <div class="leftFloat labelmargin">사진</div>
          <div class="rightfloat">
            <input class="input-text" type="file" name="imgurl" required>
					</div>
				</div>
      </div>
      <div data-role="footer" data-position="fixed">
        <h2 class="leftFloat"><a href="c_item_list.php" onclick="clearinput()">취소</a></h2>
        <h2 class="rightfloat"><input type="submit" value="완료"></h2>
      </div>
		</form>
  </div>
</body>

</html>
