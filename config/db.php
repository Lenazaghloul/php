<?php 
$conn = mysqli_connect('localhost' ,'lena', 'lena', 'lena');
if(!$conn){
  echo 'Error'. mysqli_connect_error();
}
?>
