<?php
$conn = mysqli_connect("localhost","root","111111","courtauction");

$userid = $_GET['user_id'];
$check = "select * from member_info where user_id='$userid'";
$result = mysqli_query($conn,$check);

if(mysqli_num_rows($result) != 0){
  echo "중복된 id 입니다.";
  echo "<a href=\"signup.php\">돌아가기</a>";
  exit();
}
mysqli_free_result($result);

$sql = "
  insert into member_info
    (user_id,user_pw,user_name,user_tel,member_type)
    values(
      '{$_GET['user_id']}',
      '{$_GET['user_pw']}',
      '{$_GET['user_name']}',
      '{$_GET['user_tel']}',
      '{$_GET['member_type']}'
    )";
$result = mysqli_query($conn,$sql);

if($_GET['member_type']==1){
  $sql2 = "
    insert into i_info
      (user_id,i_consultant_id)
      values(
        '{$_GET['user_id']}',
        '{$_GET['i_consultant_id']}'
      )";
  $result = mysqli_query($conn,$sql2);
}
else{
  $sql2 = "
    insert into c_info
      (user_id)
      values(
        '{$_GET['user_id']}'
      )";
  $result = mysqli_query($conn,$sql2);
}

mysqli_close($conn);
echo "회원가입을 축하드립니다";
echo "<a href=\"main.html\">홈으로</a>";

?>
