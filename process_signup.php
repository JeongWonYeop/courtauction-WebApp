<?php
header('Content-Type: text/html; charset=utf-8');
$conn = mysqli_connect("localhost","root","111111","courtauction");
mysqli_set_charset($conn,"utf8");

$userid = $_POST['user_id'];
$check = "select * from member_info where user_id='$userid'";
$result = mysqli_query($conn,$check);

if(mysqli_num_rows($result) != 0){
  echo "<meta charset=\"utf-8\"><center>";
  echo "<h1>중복된 id 입니다.</h1>";
  echo "<a href=\"signup.php\">돌아가기</a></center>";
  exit();
}
mysqli_free_result($result);

if($_POST['member_type']=="1" and $_POST['i_consultant_id']=="없음"){
  header("Location:i_consultant_list.php?user_id={$_POST['user_id']}&user_pw={$_POST['user_pw']}&user_name={$_POST['user_name']}&user_tel={$_POST['user_tel']}&member_type={$_POST['member_type']}");
  exit();
}

$sql = "
  insert into member_info
    (user_id,user_pw,user_name,user_tel,member_type)
    values(
      '{$_POST['user_id']}',
      '{$_POST['user_pw']}',
      '{$_POST['user_name']}',
      '{$_POST['user_tel']}',
      '{$_POST['member_type']}'
    )";
$result = mysqli_query($conn,$sql);

if($_POST['member_type']==1){
  $sql2 = "
    insert into i_info
   (user_id,i_consultant_id,i_point)
      values(
        '{$_POST['user_id']}',
        '{$_POST['i_consultant_id']}',
		10000
      )";
  $result2 = mysqli_query($conn,$sql2);

  //자신이 선택한 컨설턴트가 등록한 매물 수만큼 i_check 테이블에 저장(매물 열람 확인을 위함)
  $sql3 = "select * from item_info where consult_id='{$_POST['i_consultant_id']}'";
  $result3 = mysqli_query($conn,$sql3);
  while($row = mysqli_fetch_array($result3)){
    $sql4 = "
      insert into i_check(user_id,item_id,item_check)
      values('{$_POST['user_id']}',{$row['id']},0)";
    $result4 = mysqli_query($conn,$sql4);
  }
}
else{
  $sql2 = "
    insert into c_info
      (user_id)
      values(
        '{$_POST['user_id']}'
      )";
  $result2 = mysqli_query($conn,$sql2);
}

mysqli_close($conn);
echo "<center><meta charset=\"utf-8\">";
echo "<h1>회원가입을 축하드립니다!</h1>";
echo "<a href=\"main.html\">홈으로</a></center>";

?>
