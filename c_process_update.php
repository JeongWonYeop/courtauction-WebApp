<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

if($_FILES['imgurl']['name']==""){
  $img = $_POST['img'];
}
else{
  unlink("image\\{$_POST['img']}");
  $uploaddir = '/courtauction/image\\';
  $uploadfile = $uploaddir.basename($_FILES['imgurl']['name']);
  move_uploaded_file($_FILES['imgurl']['tmp_name'],$uploadfile);
  $img = $_FILES['imgurl']['name'];
}

$sql = "
  update item_info
    set
      title = '{$_POST['title']}',
      number = '{$_POST['number']}',
      location = '{$_POST['location']}',
      auction_sort = '{$_POST['auction_sort']}',
      use_sort = '{$_POST['use_sort']}',
      appraisal_price = {$_POST['appraisal_price']},
      lowest_price = {$_POST['lowest_price']},
      bid_bond = {$_POST['bid_bond']},
      land_area = '{$_POST['land_area']}',
      building_area = '{$_POST['building_area']}',
      deadline_date = '{$_POST['deadline_date']}',
      opinion = '{$_POST['opinion']}',
      consult_id = '{$_SESSION['user_id']}',
      imgurl = '$img'
    where
      id = {$_POST['id']}
";

$result = mysqli_query($conn,$sql);
if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}else{
  header('Location: c_item_list.php');
}

?>
