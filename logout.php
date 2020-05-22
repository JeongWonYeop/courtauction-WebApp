<?php
header('Content-Type: text/html; charset=utf-8');
  session_start();
  $result = session_destroy();
  if($result){
    header('Location: main.html');
  }
?>
