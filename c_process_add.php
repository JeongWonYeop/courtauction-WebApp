<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");
mysqli_set_charset($conn,"utf8");
$uploaddir = './image\\';
$uploadfile = $uploaddir.basename($_FILES['imgurl']['name']);
move_uploaded_file($_FILES['imgurl']['tmp_name'],$uploadfile);

$sql = "
  insert into item_info
    (title,number,location,auction_sort,use_sort,appraisal_price,lowest_price,bid_bond,land_area,building_area,deadline_date,opinion,consult_id,imgurl,imgurl2)
    values(
      '{$_POST['title']}',
      '{$_POST['number']}',
      '{$_POST['location']}',
      '{$_POST['auction_sort']}',
      '{$_POST['use_sort']}',
      {$_POST['appraisal_price']},
      {$_POST['lowest_price']},
      {$_POST['bid_bond']},
      '{$_POST['land_area']}',
      '{$_POST['building_area']}',
      '{$_POST['deadline_date']}',
      '{$_POST['opinion']}',
      '{$_SESSION['user_id']}',
      '{$_FILES['imgurl']['name']}',
	  '{$_POST['imgurl2']}'
    )";

$result = mysqli_query($conn,$sql);

//item_info의 마지막 행
$sql2 = "select * from item_info order by id desc limit 1";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2);

//자신의 투자자들에 해당되는 수 만큼 매물 열람 여부 확인을 위한 i_check 행 추가
$sql3 = "select * from i_info where i_consultant_id='{$_SESSION['user_id']}'";
$result3 = mysqli_query($conn,$sql3);
while($row3 = mysqli_fetch_array($result3)){
  $sql4 = "
    insert into i_check(user_id,item_id,item_check)
    values('{$row3['user_id']}',{$row2['id']},0)";
  $result4 = mysqli_query($conn,$sql4);
}

if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}else{
    header('Location: c_item_list.php');
}

?>
