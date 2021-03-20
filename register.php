<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_function.php';
$db = new DB_Functions();

$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nama']) && isset($_POST['jk']) && isset($_POST['umur'])&& isset($_POST['tinggi']) && isset($_POST['berat']) && isset($_POST['aktifitas'])) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $umur=$_POST['umur'];
    $tinggi= $_POST['tinggi'];
    $berat= $_POST['berat'];
    $aktifitas=$_POST['aktifitas'];
    
    $user = $db->registerlogin($username, $email, $password,$nama,$jk,$umur,$tinggi,$berat,$aktifitas);

    if ($user != false) {
        $response["error"] = FALSE;
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter ada yang kurang";
    echo json_encode($response);
}
?>