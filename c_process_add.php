<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$uploaddir = 'C:\Bitnami\wampstack-7.3.17-0\apache2\htdocs\courtauction\image\\';
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
if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}else{
    header('Location: c_item_list.php');
}

?>
