<?php
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");
settype($_POST['money'],'integer');

$userid = $_SESSION['user_id'];

//$itemid = $_GET['id'];
$sql = "UPDATE i_info 
          SET
            i_money = {$_POST['money']},
            i_location = '{$_POST['city']}'
          WHERE
            user_id='$userid'
";
$result = mysqli_query($conn,$sql);

if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}else{
  header("Location: i_menu.php");
}

?>
