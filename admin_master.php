<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_function.php';
$db = new DB_Functions();

$response = array("error" => FALSE);

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if($action=='add'){
        $add = $db->addDataM($_POST['nama'], $_POST['jns'], $_POST['enrg'], $_POST['sumber'], $_POST['bdd'], $_POST['air'], $_POST['protein'], $_POST['lemak'], $_POST['karbo'],$_POST['serat'], $_POST['abu'], $_POST['kalsium'], $_POST['fsfr'], $_POST['besi'], $_POST['ntrium'], $_POST['kalium'], $_POST['tmbg'], $_POST['seng'], $_POST['rtnl'], $_POST['bkar'], $_POST['ktot'], $_POST['thmn'], $_POST['rbfln'], $_POST['nsin'], $_POST['vtc']);
        if ($add) {
            $response["error"] = FALSE;
            echo json_encode($response);
        } else {
            $response["error"] = TRUE;
            echo json_encode($response);
        }
    }elseif ($action=='update') {
        $update = $db->updateDataM($_POST['oldkode'], $_POST['nama'], $_POST['jns'], $_POST['enrg'], $_POST['sumber'], $_POST['bdd'], $_POST['air'], $_POST['protein'], $_POST['lemak'], $_POST['karbo'],$_POST['serat'], $_POST['abu'], $_POST['kalsium'], $_POST['fsfr'], $_POST['besi'], $_POST['ntrium'], $_POST['kalium'], $_POST['tmbg'], $_POST['seng'], $_POST['rtnl'], $_POST['bkar'], $_POST['ktot'], $_POST['thmn'], $_POST['rbfln'], $_POST['nsin'], $_POST['vtc']);
        if ($update) {
            $response["error"] = FALSE;
            echo json_encode($response);
        } else {
            $response["error"] = TRUE;
            echo json_encode($response);
        }
    }elseif ($action=='delete') {
        $delete = $db->deleteDataM($_POST['kode']);
        if ($delete) {
            $response["error"] = FALSE;
            echo json_encode($response);
        } else {
            $response["error"] = TRUE;
            echo json_encode($response);
        }
    }
}
?>