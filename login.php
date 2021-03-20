<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_function.php';
$db = new DB_Functions();

$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    $username = $_POST['email'];
    $password = $_POST['password'];

    $user = $db->getuserpass($username, $password);

    if ($user != false) {
        $response["error"] = FALSE;
        $response["user"]["id"] = $user["id_user"];
        $response["user"]["username"] = $user["nama_user"];
        $response["user"]["jk"] = $user["jk_user"];
        $response["user"]["umur"] = $user["umur_user"];
        $response["user"]["tinggi"] = $user["tinggi_user"];
        $response["user"]["berat"] = $user["berat_user"];
        $response["user"]["aktifitas"] = $user["aktifitas_user"];
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter (email atau password) ada yang kurang";
    echo json_encode($response);
}
?>
