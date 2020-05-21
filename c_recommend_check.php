<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>추천 투자자 조회</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="c_recommend_check">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>투자자 조회</h1>
			<a href="c_item_list.php" data-icon="back">back</a>
			<a href="c_menu.php" data-icon="bars" data-transition="slide">menu</a>
    </div>
		<form data-ajax="false" action="c_recommend_member_list.php?id=<?=$_GET['id']?>" method="post">
      <div data-role="content" class="center">
        <p style="text-align: center">투자자금</p>
				<label>
					<input type ="radio" name ="money" value="0 ~ 2천만원">0 ~ 2천만원
				</label>
				<label>
					<input type ="radio" name ="money" value="2천 ~ 5천만원">2천 ~ 5천만원
				</label>
				<label>
					<input type ="radio" name ="money" value="5천 ~ 1억">5천 ~ 1억
				</label>
				<label>
					<input type ="radio" name ="money" value="1억 이상">1억 이상
				</label>
        <br>
			  <p style="text-align: center">선호지역</p>
				<label>
					<input type ="checkbox" name ="city[]" value="서울" autocomplete="off">서울
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="경기" autocomplete="off">경기
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="대전" autocomplete="off">대전
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="대구" autocomplete="off">대구
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="부산" autocomplete="off">부산
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="제주" autocomplete="off">제주
				</label>
				<label>
					<input type ="checkbox" name ="city[]" value="기타" autocomplete="off">기타
				</label>
      </div>
      <div data-role="footer" data-position="fixed">
        <h2><input type ="submit" value ="조회"></h2>
		  </div>
		</form>
  </div>
</body>

</html>
