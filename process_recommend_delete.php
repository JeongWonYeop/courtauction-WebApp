<?php

session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$sql = "
  delete
    from recommend_item
    where id = {$_GET['id']}
";
$result = mysqli_query($conn,$sql);

$sql="select * from member_info where user_id='{$_SESSION['user_id']}'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}
else{
  if($row['member_type']=="1"){
    header('Location: i_recommend_list.php');
  }
  else{
    header('Location: c_recommend_list.php');
  }
}

?>
