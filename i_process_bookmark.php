<?php
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$userid = $_SESSION['user_id'];
$itemid = $_GET['id'];
$check = "select * from i_bookmark where user_id='$userid' and item_id='$itemid'";
$result = mysqli_query($conn,$check);

if(mysqli_num_rows($result) == 0){
  $sql = "
    insert into i_bookmark
      (user_id,item_id)
      values(
        '{$_SESSION['user_id']}',
        '{$_GET['id']}'
      )";

  $result = mysqli_query($conn,$sql);
}
else{
  $sql = "
    delete
      from i_bookmark
      where item_id={$_GET['id']}
  ";

  $result = mysqli_query($conn,$sql);
}

$prevPage = $_SERVER['HTTP_REFERER'];

if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}else{
  header('location:'.$prevPage);
}

?>
