<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_connect.php';
$db = new Db_Connect();
$conn = $db->connect();

if($_SERVER['REQUEST_METHOD']=='GET') {
    $sql = "Select id_kode,nama_bahan,energi,bdd from data_energi";
    $res = mysqli_query($conn,$sql);
    $result = array();
    while($row = mysqli_fetch_array($res)){
       array_push($result,array('id'=>$row[0], 'nama'=>$row[1], 'energi'=>$row[2], 'bdd'=>$row[3]));
    }
echo json_encode(array("result"=>$result));
mysqli_close($conn);
}?>
