<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = mysqli_connect("localhost","root","111111","courtauction");

$userid = $_POST['user_id'];
$userpw = $_POST['user_pw'];

$query = "select * from member_info where user_id='$userid' and user_pw='$userpw'";
$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result) == 1){
  $row = mysqli_fetch_assoc($result);
  $_SESSION['user_id'] = $row['user_id'];
  $_SESSION['user_name'] = $row['user_name'];
  if(isset($_SESSION['user_id'])){
    if($row['member_type'] == "1"){
      header('Location: i_menu.php');
    }
    else{
      header('Location: c_menu.php');
    }
  }
}
else{
  echo "로그인에 실패했습니다(아이디 또는 비밀번호를 확인해주세요)";
  echo "<a href=\"main.html\">돌아가기</a>";
}
?>
