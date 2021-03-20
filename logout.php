<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_function.php';
$db = new DB_Functions();

$response = array("error" => FALSE);

if (isset($_POST['code'])) {

    $code = $_POST['code'];

    $act = $db->logout($code);
 
    if ($act != false) {
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
