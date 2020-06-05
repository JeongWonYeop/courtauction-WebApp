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
	<div data-role="page" id="c_crawling">
    <div data-role="header" data-theme="b" data-position="fixed">
			<h1><img src="image\로고.png" alt="" width="50" height="50" id="imgMargin"/>매물 등록</h1>
			<a href="c_item_list.php" data-icon="back" onclick="clearinput()">back</a>
			<a href="c_menu.php" data-icon="bars" data-transition="slide">menu</a>
    </div>
		<form data-ajax="false" action="c_add_item_crawling.php" method="POST" enctype="multipart/form-data">
      <div data-role="content" class="center">
				<div class="leftFloat labelmargin">
					<br>
					<label for="court_num1">사건번호 &nbsp;</label>
				</div>
				<div class="leftFloat labelmargin">
				       <input class="input-text" type="number" name="year" size="30" maxlength="100" autocomplete="off" id ="court_num1" required>
				</div>
        <div class="clearboth">
					<div class="leftFloat labelmargin">
  					<br>
  					&nbsp;&nbsp;타경&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
					<div class="leftFloat labelmargin">
            <input class="input-text" type="number" name="number" size="30" maxlength="100" autocomplete="off" id ="court_num2" required>
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
