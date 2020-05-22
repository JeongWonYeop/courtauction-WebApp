<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$checkbox1="";
$checkbox1 = $_POST['city'];
$chk = "";
foreach ($checkbox1 as $chk1) {
  $chk .= $chk1." ";
}

$sql = "
  update i_info
    set
      i_money = '{$_POST['money']}',
      i_f_location = '$chk'
    where
      user_id = '{$_SESSION['user_id']}'
";

$result = mysqli_query($conn,$sql);

if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}else{
  header('Location: i_member_info.php');
}

?>
