<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_connect.php';
$db = new Db_Connect();
$conn = $db->connect();

if(isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "Select * from data_energi WHERE id_kode = '$id'";
  $res = mysqli_query($conn,$sql);

  $result = array();
  while($row = mysqli_fetch_array($res)){
     array_push($result,array('id'=>$row[0], 'nama'=>$row[1], 'sumber'=>$row[2], 'air'=>$row[3],
   'energi'=>$row[4], 'protein'=>$row[5], 'lemak'=>$row[6], 'kh'=>$row[7],'serat'=>$row[8], 'abu'=>$row[9], 'kalsium'=>$row[10], 'fosfor'=>$row[11],
'besi'=>$row[12], 'natrium'=>$row[13], 'kalium'=>$row[14], 'tembaga'=>$row[15],'seng'=>$row[16], 'retinol'=>$row[17], 'b_kar'=>$row[18], 'kar_total'=>$row[18],
'thiamin'=>$row[19], 'riboflavin'=>$row[20], 'niasin'=>$row[21], 'vitc'=>$row[22],'bdd'=>$row[23]));

}
echo json_encode(array("result"=>$result));
mysqli_close($conn);
}
?>
