<?php
header('Content-Type: text/html; charset=utf-8');
$conn = mysqli_connect("localhost","root","111111","courtauction");

  $sql = "select * from member_info where member_type='2'";
  $result = mysqli_query($conn,$sql);
  $option = '';
  while($row = mysqli_fetch_array($result)){
    $option = $option."<option value={$row['user_id']}>아이디 : {$row['user_id']}, 이름 : {$row['user_name']}</option>";
  }
?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>회원가입</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
  <script>
    function investor(){
      $('.consultant_show').css('display','block');
    }
    function consultant(){
      $('.consultant_show').css('display','none');
    }
  </script>
	<div data-role="page" id="signup">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>회원가입</h1>
			<a href="main.html" data-icon="back">back</a>
    </div>
    <div data-role="content" class="center">
      <form data-ajax="false" action="process_signup.php" method="POST">
        <label for="user_id">아이디</label>
        <input type="text" name="user_id" id="user_id" maxlength="30" autocomplete="off" required>
        <label for="user_pw">비밀번호</label>
        <input type="password" name="user_pw" id="user_pw" maxlength="30" required>
        <label for="user_name">이름</label>
        <input type="text" name="user_name" id="user_name" maxlength="30" autocomplete="off" required>
        <label for="user_tel">전화번호</label>
        <input type="tel" name="user_tel" id="user_tel" maxlength="30" autocomplete="off" required>
        <p>사용자 타입</p>
        <div onclick="investor()">
          <label>
            <input type="radio" name="member_type" value="1" required>투자자
          </label>
        </div>
        <div onclick="consultant()">
          <label>
            <input type="radio" name="member_type" value="2" required>컨설턴트
          </label>
        </div>
        <div class="consultant_show" style="display:none">
          <label>컨설턴트 선택</label>
          <select name="i_consultant_id">
            <option value="없음">없음</option>
            <?=$option?>
          </select>
        </div>
        <input type="submit" value="회원가입">
      </form>
		</div>
  </div>
</body>

</html>
