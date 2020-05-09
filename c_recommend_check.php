<?php
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$userid = $_SESSION['user_id'];

?>


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
			<img src="로고.png" alt="" width="50" height="50" margin="0"/>투자자 조회</h1>
			<a href="c_menu.html" data-icon="back">back</a>
			<a href="c_menu.html" data-icon="grid" data-transition="slide">menu</a>
        </div>
		<form action="c_recommend_member_list.php" method="POST">
		<input type ="hidden" name ="id" value="<?=$_GET['id']?>">
        <div data-role="content" class="center">			
			<p style="text-align: center">투자자금</p>
			<label>
					<input type ="radio" name ="money" value="1">1000만원 ~ 2000만원
				</label>
				<label>
					<input type ="radio" name ="money" value="2">2000만원 ~ 3000만원
				</label>
				<label>
					<input type ="radio" name ="money" value="3">5000만원 ~ 1억
				</label>
				<label>
					<input type ="radio" name ="money" value="4">1억 이상
				</label>
			<br>
			<p style="text-align: center">선호지역</p>
			<label>
					<input type ="checkbox" name ="city" value="Seoul">서울
				</label>
				<label>
					<input type ="checkbox" name ="city" value="Gyeonggi">경기
				</label>
				<label>
					<input type ="checkbox" name ="city" value="Daejeon">대전
				</label>
				<label>
					<input type ="checkbox" name ="city" value="Daegu">대구
				</label>
				<label>
					<input type ="checkbox" name ="city" value="Busan">부산
				</label>
				<label>
					<input type ="checkbox" name ="city" value="Jeju">제주
				</label>
				<label>
					<input type ="checkbox" name ="city" value="etc">기타
				</label>
        </div>
		<div data-role="footer" data-position="fixed">
			<h2><input type ="submit" value ="조회"></h2>
		</div>
		</form>	
    </div>
</body>

</html>