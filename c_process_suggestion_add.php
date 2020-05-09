<?php
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$sql = "
  INSERT into i_item_recommend_reason
    (user_id,item_id,recommend_reason)
    values(
      '{$_POST['i_id']}',
      '{$_POST['item_id']}',
      '{$_POST['reason']}'
      )";

$result = mysqli_query($conn,$sql);
if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}else{
    header('Location: c_menu.php');
}

?>
