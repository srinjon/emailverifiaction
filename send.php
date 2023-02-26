<?php
include('db.php');
$id = mysqli_real_escape_string($conn,$_GET['id']);
mysqli_query($conn,"update user set status='1' where id = '$id' ");
?>
<h1>Message Verified</h1>