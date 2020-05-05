<?php
$conn = mysqli_connect("localhost","root","apmsetup","courtauction");

$sql = "select * from item_info where id={$_GET['id']}";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);


$sql = "
  delete
    from item_info
    where id = {$_GET['id']}
";
$result = mysqli_query($conn,$sql);
if($result === false){
  //echo '저장하는 과정에서 문제가 생겼습니다 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}else{
  header('Location: c_item_list.php');
}

?>
