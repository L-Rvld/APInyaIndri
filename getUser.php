<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_connect.php';
$db = new Db_Connect();
$conn = $db->connect();

if($_SERVER['REQUEST_METHOD']=='GET') {
    $sql = "Select * from user";
    $res = mysqli_query($conn,$sql);
    $result = array();
    while($row = mysqli_fetch_array($res)){
       array_push($result,array('email_user'=>$row[1],'nama_user'=>$row[2], 'jk_user'=>$row[3], 'umur_user'=>$row[4], 'tinggi_user'=>$row[5], 'berat_user'=>$row[6], 'aktifitas_user'=>$row[7]));
    }
echo json_encode(array("result"=>$result));
mysqli_close($conn);
}?>