<?php
  session_start();

  $conn = mysqli_connect("localhost","root","111111","courtauction");

  $sql = "
    insert into recommend_item
      (c_id,reason,i_id,item_id)
      values(
        '{$_SESSION['user_id']}',
        '{$_POST['reason']}',
        '{$_GET['user_id']}',
        '{$_GET['id']}'
      )";
  $result = mysqli_query($conn,$sql);

  header("Location:c_recommend_list.php");
?>
