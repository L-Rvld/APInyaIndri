<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_function.php';
$db = new DB_Functions();

$response = array("error" => FALSE);

if (isset($_GET['lowPagi']) && isset($_GET['lowSiang'] )&& isset($_GET['lowMalam'])&& isset($_GET['lowSP'])&& isset($_GET['lowSS'])&& isset($_GET['lowSM'])) {

$lowPagi = $_GET['lowPagi'];
$lowSiang = $_GET['lowSiang'];
$lowMalam = $_GET['lowMalam'];
$lowSP = $_GET['lowSP'];
$lowSS = $_GET['lowSS'];
$lowSM = $_GET['lowSM'];

    //Pagi
    $countpagi = 0;
    do {
      $resultpagi = $db->getPagi();
      $totalPagi = 0;
      foreach ($resultpagi as $ke) {
        $totalPagi = $totalPagi + $ke['energi'];
      }
      $minp = $lowPagi - 20;
      $maxp = $lowPagi + 20;

      if ($totalPagi>$minp && $totalPagi<$maxp) {
        $pagi = array();
        foreach ($resultpagi as $key => $value) {
          array_push($pagi,$value['pagi']);
        }
        $countpagi = 1;
      }else {
        $countpagi = 0;
      }
    } while ($countpagi == 0);

    //Siang
    $countsiang = 0;
    do {
      $resultsiang = $db->getSiang();
      $totalSiang = 0;
      foreach ($resultsiang as $ke) {
        $totalSiang = $totalSiang + $ke['energi'];
      }
      $mins = $lowSiang - 20;
      $maxs = $lowSiang + 20;

      if ($totalSiang>$mins && $totalSiang<$maxs) {
        $siang = array();
        foreach ($resultsiang as $key => $value) {
          array_push($siang,$value['siang']);
        }
        $countsiang = 1;
      }else {
        $countsiang = 0;
      }
    } while ($countsiang == 0);

    //Malam
    $countmalam = 0;
    do {
      $resultmalam = $db->getMalam();
      $totalMalam = 0;
      foreach ($resultmalam as $ke) {
        $totalMalam = $totalMalam + $ke['energi'];
      }
      $minm = $lowMalam - 20;
      $maxm = $lowMalam + 20;

      if ($totalMalam>$minm && $totalMalam<$maxm) {
        $malam = array();
        foreach ($resultmalam as $key => $value) {
          array_push($malam,$value['malam']);
        }
        $countmalam = 1;
      }else {
        $countmalam = 0;
      }
    } while ($countmalam == 0);

    //snack pagi
    $countsp = 0;
    do {
      $resultsp = $db->getSP();
      $totalsp = 0;
      foreach ($resultsp as $ke) {
        $totalsp = $totalsp + $ke['energi'];
      }
      $minsp = $lowSP - 25;
      $maxsp = $lowSP + 25;

      if ($totalsp>$minsp && $totalsp<$maxsp) {
        $snackpagi = array();
        foreach ($resultsp as $key => $value) {
          array_push($snackpagi,$value['sPagi']);
        }
        $countsp = 1;
      }else {
        $countsp = 0;
      }
    } while ($countsp == 0);

    //snack siang
    $countss = 0;
    do {
      $resultss = $db->getSS();
      $totalss = 0;
      foreach ($resultss as $ke) {
        $totalss = $totalss + $ke['energi'];
      }
      $minss = $lowSS - 50;
      $maxss = $lowSS + 50;

      if ($totalss>$minss && $totalss<$maxss) {
        $snacksiang = array();
        foreach ($resultss as $key => $value) {
          array_push($snacksiang,$value['sSiang']);
        }
        $countss = 1;
      }else {
        $countss = 0;
      }
    } while ($countss == 0);

    //snack malam
    $countsp = 0;
    do {
      $resultsm = $db->getSM();
      $totalsm = 0;
      foreach ($resultsm as $ke) {
        $totalsm = $totalsm + $ke['energi'];
      }
      $minsm = $lowSM - 30;
      $maxsm = $lowSM + 30;
      
      if ($totalsm>$minsm && $totalsm<$maxsm) {
        $snackmalam = array();
        foreach ($resultsm as $key => $value) {
          array_push($snackmalam,$value['sMalam']);
        }
        $countsm = 1;
      }else {
        $countsm = 0;
      }
    } while ($countsm == 0);

    echo json_encode(array("pagi"=>$pagi,"siang"=>$siang,"malam"=>$malam,"snackpagi"=>$snackpagi,"snacksiang"=>$snacksiang,"snackmalam"=>$snackmalam));
}else {
  $response["error"] = TRUE;
  $response["error_msg"] = "Parameter (email atau password) ada yang kurang";
  echo json_encode($response);
}
?>
