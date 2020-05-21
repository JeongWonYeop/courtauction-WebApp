<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>매물 추천이유</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="c_recommend_reason">
    <div data-role="header" data-theme="b" data-position="fixed">
      <h1><img src="image\로고.png" alt="" width="50" height="50" id="imgMargin"/>매물 추천</h1>
			<a href="c_menu.php" class="ui-btn-right" data-icon="bars" data-transition="slide">menu</a>
    </div>
    <form data-ajax="false" action="c_process_recommend.php?id=<?=$_GET['id']?>&user_id=<?=$_GET['user_id']?>" method="POST">
      <div data-role="content" class="center">
        <p>추천 이유</p>
        <textarea class="input-text" name="reason" cols="32" rows="50"></textarea>
      </div>
      <div data-role="footer" data-position="fixed">
        <h2 class="leftFloat"><a href="c_item_list.php">취소</a></h2>
        <h2 class="rightfloat"><input type="submit" value="완료"></h2>
      </div>
    </form>
  </div>
</body>

</html>
