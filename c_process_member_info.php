<?php

session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$sql = "
  update c_info
    set
      c_introduction = '{$_POST['introduction']}'
    where
      user_id = '{$_SESSION['user_id']}'
";

$result = mysqli_query($conn,$sql);

if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}else{
  header('Location: c_member_info.php');
}

?>
