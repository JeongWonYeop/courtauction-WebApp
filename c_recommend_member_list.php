<?php
header('Content-Type: text/html; charset=utf-8');
  session_start();

  $conn = mysqli_connect("localhost","root","111111","courtauction");
  mysqli_set_charset($conn,"utf8");
  
  $checkbox1 = $_POST['city'];
  $userid = $_SESSION['user_id'];
  $money = $_POST['money'];
  $sql = "select * from i_info where i_consultant_id ='$userid' and i_money='$money'";
  $result = mysqli_query($conn,$sql);

  $id_array = array();
  //투자자 정보에서 투자자금이 내가(현재 로그인 하고 있는 컨설턴트) 선택한 투자자금과 같은 투자자의 모든 정보 select
  //그 수만큼 차례대로 반복
  while($row = mysqli_fetch_array($result)){
    //선호지역이 한줄로 저장되어 있으므로 공백을 기준으로 하나씩 자름(배열로 한개씩 저장됨)
    $city_split = explode(" ",$row['i_f_location']);
    //내가 체크한 선호지역의 수만큼 반복
    for($i = 0;$i<count($checkbox1);$i++){
      //투자자의 선호지역의 수만큼 반복
      for($j = 0;$j<count($city_split);$j++){
        //내가 체크한 선호지역과 투자자의 선호지역이 같다면
        if($checkbox1[$i] == $city_split[$j]){
          //배열에 투자자의 id(여기서는 user_id로 하지 않았음,auto_increment로 증가되는 id) 저장 후 빠져나감(하나만 같으면 됨)
          $id_array[] = $row['id'];
          break 2;
        }
      }
    }
  }

  $list = '';
  //조건에 맞는 투자자 수 만큼 반복
  for($i = 0;$i<count($id_array);$i++){
    //투자자 정보에서 조건에 맞는 투자자의 모든 정보 select(아래에서 투자자금,선호지역 출력하기 위함)
    $sql2 = "select * from i_info where id =$id_array[$i]";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    //회원정보에서 방금 select했던 투자자의 id와 같은것(즉 조건에 맞는 투자자)의 모든 정보 select
    //(아래에서 투자자 이름을 출력하기 위함)
    $sql3 = "select * from member_info where user_id = '{$row2['user_id']}'";
    $result3 = mysqli_query($conn,$sql3);
    $row3 = mysqli_fetch_array($result3);
    //해당 매물에 대해 추천한적이 있는지 체크(있다면 $count값이 1)
    $sql4 = "select * from recommend_item where i_id='{$row2['user_id']}' and item_id='{$_GET['id']}'";
    $result4 = mysqli_query($conn,$sql4);
    $count = mysqli_num_rows($result4);
    //추천한적이 없다면 해당 투자자 선택가능
    if($count == 0){
      $a = "<a href=\"c_recommend_reason.php?id={$_GET['id']}&user_id={$row2['user_id']}\">";
    }
    //추천한적이 있다면 해당 투자자 선택해도 넘어가지 않음(선택불가능)
    else{
      $a = "<a href=\"#\">
      <p>&nbsp;&nbsp;추천 완료</p>";
    }

    $list = $list."
    <li data-icon=\"false\">".
      $a."
      <div class=\"leftFloat\">
        <img src=\"image\\사람.JPG\" width=\"70\" height=\"70\" alt=\"\"/>
        <p class=\"pstyle\" style=\"margin: 0px\">{$row3['user_name']}</p>
      </div>
      <div class=\"leftFloat leftMargin topMargin\">
        투자 자금 : <p style=\"display: inline\">{$row2['i_money']}</p><br>
        선호 지역 : <p style=\"display: inline\">{$row2['i_f_location']}</p><br>
      </div>
      </a>
    </li>";
  }
?>
<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>해당 투자자 목록</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="c_recommend_member_list">
    <div data-role="header" data-theme="b">
      <h1 class="ui-title">
			<img src="image\로고.png" alt="" width="50" height="50" margin="0"/>투자자 목록</h1>
			<a href="javascript:history.back();" data-icon="back">back</a>
			<a href="c_menu.php" data-icon="bars" data-transition="slide">menu</a>
    </div>
    <div data-role="content" class="center">
			<ul data-role="listview">
        <?=$list?>
			</ul>
    </div>
  </div>
</body>

</html>
