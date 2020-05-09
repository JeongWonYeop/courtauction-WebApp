<?php

session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");
settype($_POST['money'],'integer');
$userid = $_SESSION['user_id'];
$itemid = $_GET['id'];
$sql = "SELECT * FROM item_info WHERE id = $itemid";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$item_name = $row['title'];

?>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>매물 추천하기</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    
</head>

<body>
	<div data-role="page" id="c_suggestion">
        <div data-role="header" data-theme="b" data-position="fixed">
            <h1 class="ui-title">
			<img src="로고.png" alt="" width="50" height="50" margin="0"/>매물 추천</h1>
			<a href="#" data-icon="back">back</a>
			<a href="c_menu.html" data-icon="grid" data-transition="slide">menu</a>
        </div>
        <form action="c_process_suggestion_add.php" method="POST">
            <input type ="hidden" name ="i_id" value ="<?=$_GET['i_id']?>">
            <input type ="hidden" name ="item_id" value ="<?=$_GET['id']?>">
            <div data-role="content" class="center">
                <select name="매물 선택">
                    <option value=""><?=$item_name?></option>
                </select>
                <br><br>
                <label>추천 이유</label>
                <textarea cols="50" rows="50" placeholder="추천 이유 입력" name="reason"></textarea>
            </div>


        <input type="submit" value="완료">
        </form>
</body>

</html>