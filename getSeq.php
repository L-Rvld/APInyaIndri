<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_connect.php';
$db = new Db_Connect();
$conn = $db->connect();

if(isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "Select * from sequence_energi WHERE id = '$id'";
  $res = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_array($res)){
    $result = $row[1];
}
$response["result"] = $result;
echo json_encode($response);
mysqli_close($conn);
}
?>