<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_function.php';
$db = new DB_Functions();
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Manual Indri - Electree</title>
	<style>
	table, th, td {
  		border: 2px solid black;
  		border-collapse: collapse;
	}
	th, td {
		padding: 5px;
	}
	.column {
  		float: left;
  		width: 15%;
	}

	.row:after {
	  content: "";
	  display: table;
	  clear: both;
	}
</style>
</head>
<body>';
$response = array("error" => FALSE);
$Ai = array();
$Ax = array();
$Bi = array();
$Bx = array();
$Ci = array();
$Cx = array();

if (isset($_GET['lowPagi']) && isset($_GET['lowSiang'] )&& isset($_GET['lowMalam'])&& isset($_GET['lowSP'])&& isset($_GET['lowSS'])&& isset($_GET['lowSM'])) {

$lowPagi = $_GET['lowPagi'];
$lowSiang = $_GET['lowSiang'];
$lowMalam = $_GET['lowMalam'];
$lowSP = $_GET['lowSP'];
$lowSS = $_GET['lowSS'];
$lowSM = $_GET['lowSM'];

	for($i=0;$i<3;$i++){
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
		$totalxpagi = 0;
		foreach ($resultpagi as $key => $value) {
		  array_push($pagi,$value['energi']);
		  $totalxpagi += $value['energi'];
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
		$totalxsiang = 0;
		foreach ($resultsiang as $key => $value) {
		  array_push($siang,$value['energi']);
		  $totalxsiang += $value['energi'];
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
		$totalxmalam = 0;
		foreach ($resultmalam as $key => $value) {
		  array_push($malam,$value['energi']);
		  $totalxmalam += $value['energi'];
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
		$totalxsp =0;
		foreach ($resultsp as $key => $value) {
		  array_push($snackpagi,$value['energi']);
		  $totalxsp += $value['energi'];
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
		 $totalxss = 0;
		foreach ($resultss as $key => $value) {
		  array_push($snacksiang,$value['energi']);
		  $totalxss += $value['energi'];
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
		$totalxsm = 0;
		foreach ($resultsm as $key => $value) {
		  array_push($snackmalam,$value['energi']);
		   $totalxsm += $value['energi'];
		}
		$countsm = 1;
	      }else {
		$countsm = 0;
	      }
	    } while ($countsm == 0);
	    if($i == 0){
	    	array_push($Ai,$pagi,$siang,$malam,$snackpagi,$snacksiang,$snackmalam);
	    	array_push($Ax,$totalxpagi,$totalxsp,$totalxsiang,$totalxss,$totalxmalam,$totalxsm);
	    }else if ($i == 1){
	    	array_push($Bi,$pagi,$siang,$malam,$snackpagi,$snacksiang,$snackmalam);
	    	array_push($Bx,$totalxpagi,$totalxsp,$totalxsiang,$totalxss,$totalxmalam,$totalxsm);
	    }else if($i == 2){
	    	array_push($Ci,$pagi,$siang,$malam,$snackpagi,$snacksiang,$snackmalam);
	    	array_push($Cx,$totalxpagi,$totalxsp,$totalxsiang,$totalxss,$totalxmalam,$totalxsm);
	    }
	}
	 
	echo json_encode(array("Alternatif 1 : "=>$Ai));
	echo "<br>";
	echo json_encode(array("Alternatif 2 : "=>$Bi));
	echo "<br>";
	echo json_encode(array("Alternatif 3 : "=>$Ci));
	echo "<br>";
	echo "<br>";
	echo json_encode(array("Alternatif 1 : "=>$Ax));
	echo "<br>";
	echo json_encode(array("Alternatif 2 : "=>$Bx));
	echo "<br>";
	echo json_encode(array("Alternatif 3 : "=>$Cx));
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	$angka=array($Ax[0],$Ax[1],$Ax[2],$Ax[3],$Ax[4],$Ax[5],$Bx[0],$Bx[1],$Bx[2],$Bx[3],$Bx[4],$Bx[5],$Cx[0],$Cx[1],$Cx[2],$Cx[3],$Cx[4],$Cx[5]);
	$no=0;
	echo "<h3> Tabel belum ternormalisasi </h3>";
	echo '<table>';
	for($i=1; $i <=3; $i++){
      	echo "<tr>";
      	for($j=1; $j<=6; $j++){
            echo "<td>";
            $angkabaru[$i][$j]=$angka[$no];
            echo $angkabaru[$i][$j];
            echo "</td>";
            $no++;
      	    }
      	    echo "</tr>";
	}
	echo "</table>";
	echo "<br>";
	echo "<br>";
	
	$has1i = pow($Ax[0],2);
	$has1ii =pow($Bx[0],2);
	$has1iii =pow($Cx[0],2);
	$gethas1 = sqrt($has1i+$has1ii+$has1iii);
	
	$has2i = pow($Ax[1],2);
	$has2ii =pow($Bx[1],2);
	$has2iii =pow($Cx[1],2);
	$gethas2 = sqrt($has2i+$has2ii+$has2iii);
	
	$has3i = pow($Ax[2],2);
	$has3ii =pow($Bx[2],2);
	$has3iii =pow($Cx[2],2);
	$gethas3 = sqrt($has3i+$has3ii+$has3iii);
	
	$has4i = pow($Ax[3],2);
	$has4ii =pow($Bx[3],2);
	$has4iii =pow($Cx[3],2);
	$gethas4 = sqrt($has4i+$has4ii+$has4iii);
	
	$has5i = pow($Ax[4],2);
	$has5ii =pow($Bx[4],2);
	$has5iii =pow($Cx[4],2);
	$gethas5 = sqrt($has5i+$has5ii+$has5iii);
	
	$has6i = pow($Ax[5],2);
	$has6ii =pow($Bx[5],2);
	$has6iii =pow($Cx[5],2);
	$gethas6 = sqrt($has6i+$has6ii+$has6iii);
	
	echo '<div class="row">
  	     <div class="column">';
	$r11i = ($Ax[0]) / ($gethas1);
	$r11 = round($r11i,3);
	echo "r11 = ".$r11;
	echo "<br>";
	$r12i = ($Ax[1]) / ($gethas2);
	$r12 = round($r12i,3);
	echo "r12 = ".$r12;
	echo "<br>";
	$r13i = ($Ax[2]) / ($gethas3);
	$r13 = round($r13i,3);
	echo "r13 = ".$r13;
	echo "<br>";
	$r14i = ($Ax[3]) / ($gethas4);
	$r14 = round($r14i,3);
	echo "r14 = ".$r14;
	echo "<br>";
	$r15i = ($Ax[4]) / ($gethas5);
	$r15 = round($r15i,3);
	echo "r15 = ".$r15;
	echo "<br>";
	$r16i = ($Ax[5]) / ($gethas6);
	$r16 = round($r16i,3);
	echo "r16 = ".$r16;
	echo "<br>";
	echo '</div>
	<div class="column">';
	$r21i = ($Bx[0]) / ($gethas1);
	$r21 = round($r21i,3);
	echo "r21 = ".$r21;
	echo "<br>";
	$r22i = ($Bx[1]) / ($gethas2);
	$r22 = round($r22i,3);
	echo "r22 = ".$r22;
	echo "<br>";
	$r23i = ($Bx[2]) / ($gethas3);
	$r23 = round($r23i,3);
	echo "r23 = ".$r23;
	echo "<br>";
	$r24i = ($Bx[3]) / ($gethas4);
	$r24 = round($r24i,3);
	echo "r24 = ".$r24;
	echo "<br>";
	$r25i = ($Bx[4]) / ($gethas5);
	$r25 = round($r25i,3);
	echo "r25 = ".$r25;
	echo "<br>";
	$r26i = ($Bx[5]) / ($gethas6);
	$r26 = round($r26i,3);
	echo "r26 = ".$r26;
	echo "<br>";
	echo '</div>
	<div class="column">';
	$r31i = ($Cx[0]) / ($gethas1);
	$r31 = round($r31i,3);
	echo "r31 = ".$r31;
	echo "<br>";
	$r32i = ($Cx[1]) / ($gethas2);
	$r32 = round($r32i,3);
	echo "r32 = ".$r32;
	echo "<br>";
	$r33i = ($Cx[2]) / ($gethas3);
	$r33 = round($r33i,3);
	echo "r33 = ".$r33;
	echo "<br>";
	$r34i = ($Cx[3]) / ($gethas4);
	$r34 = round($r34i,3);
	echo "r34 = ".$r34;
	echo "<br>";
	$r35i = ($Cx[4]) / ($gethas5);
	$r35 = round($r35i,3);
	echo "r35 = ".$r35;
	echo "<br>";
	$r36i = ($Cx[5]) / ($gethas6);
	$r36 = round($r36i,3);
	echo "r36 = ".$r36;
	echo '</div>';
	echo '</div>';
	echo "<br>";
	echo "<br>";

	$angka=array($r11,$r12,$r13,$r14,$r15,$r16,$r21,$r22,$r23,$r24,$r25,$r26,$r31,$r32,$r33,$r34,$r35,$r36);
	$no=0;
	echo "<h3> Tabel ternormalisasi </h3>";
	echo "<table>";
	for($i=1; $i <=3; $i++){
      	echo "<tr>";
      	for($j=1; $j<=6; $j++){
            echo "<td>";
            $angkabaru[$i][$j]=$angka[$no];
            echo $angkabaru[$i][$j];
            echo "</td>";
            $no++;
      	    }
      	    echo "</tr>";
	}
	echo "</table>";
	echo "<br>";
	echo "<br>";

	$n11 = $r11 * 25;
	$n21 = $r21 * 25;
	$n31 = $r31 * 25;
	
	$n12 = $r12 * 5;
	$n22 = $r22 * 5;
	$n32 = $r32 * 5;
	
	$n13 = $r13 * 30;
	$n23 = $r23 * 30;
	$n33 = $r33 * 30;
	
	$n14 = $r14 * 5;
	$n24 = $r24 * 5;
	$n34 = $r34 * 5;
	
	$n15 = $r15 * 30;
	$n25 = $r25 * 30;
	$n35 = $r35 * 30;
	
	$n16 = $r16 * 5;
	$n26 = $r26 * 5;
	$n36 = $r36 * 5;
	
	
	$angka=array($n11,$n12,$n13,$n14,$n15,$n16,$n21,$n22,$n23,$n24,$n25,$n26,$n31,$n32,$n33,$n34,$n35,$n36);
	$no=0;
	echo "<h3> Tabel Pemberian Nilai Bobot </h3>";
	echo "<table>";
	for($i=1; $i <=3; $i++){
      	echo "<tr>";
      	for($j=1; $j<=6; $j++){
            echo "<td>";
            $angkabaru[$i][$j]=$angka[$no];
            echo $angkabaru[$i][$j];
            echo "</td>";
            $no++;
      	    }
      	   echo "</tr>"; 
	}
	echo "</table>";
	echo "<br>";
	echo "<br>";
	
	
	$AA = 0; $AB = 0; $AC = 0;
	$BA = 0; $BB = 0; $BC = 0;
	$CA = 0; $CB = 0; $CC = 0;
	
	//1 - 2 & 2 - 1
	if($n11 > $n21){
		$AB += 0.25;
	}else if($n11 < $n21){
		$BA += 0.25;
	}else if($n11 = $n21) {
		$AB += 0.25;
		$BA += 0.25;
	}
	if($n12 > $n22){
		$AB += 0.05;
	}else if($n12 < $n22){
		$BA += 0.05;
	}else if($n12 = $n22){
		$AB += 0.05;
		$BA += 0.05;
	}
	if($n13 > $n23){
		$AB += 0.30;
	}else if($n13 < $n23){
		$BA += 0.30;
	}else if($n13 = $n23){
		$AB += 0.30;
		$BA += 0.30;
	}
	if($n14 > $n24){
		$AB += 0.05;
	}else if($n14 < $n24){
		$BA += 0.05;
	}else if($n14 = $n24){
		$AB += 0.05;
		$BA += 0.05;
	}
	if($n15 > $n25){
		$AB += 0.30;
	}else if($n15 < $n25){
		$BA += 0.30;
	}else if($n15 = $n25){
		$AB += 0.30;
		$BA += 0.30;
	}
	if($n16 > $n26){
		$AB += 0.05;
	}else if($n16 < $n26){
		$BA += 0.05;
	}else if($n16 = $n26){
		$AB += 0.05;
		$BA += 0.05;
	}
	
	
	//1 - 3 & 3 - 1
	if($n11 > $n31){
		$AC += 0.25;
	}else if($n11 < $n31){
		$CA += 0.25;
	}else if($n11 = $n31){
		$AC += 0.25;
		$CA += 0.25;
	}
	if($n12 > $n32){
		$AC += 0.05;
	}else if($n12 < $n32){
		$CA += 0.05;
	}else if($n12 = $n32){
		$AC += 0.05;
		$CA += 0.05;
	}
	if($n13 > $n33){
		$AC += 0.30;
	}else if($n13 < $n33){
		$CA += 0.30;
	}else if($n13 = $n33){
		$AC += 0.30;
		$CA += 0.30;
	}
	if($n14 > $n34){
		$AC += 0.05;
	}else if($n14 < $n34){
		$CA += 0.05;
	}else if($n14 = $n34){
		$AC += 0.05;
		$CA += 0.05;
	}
	if($n15 > $n35){
		$AC += 0.30;
	}else if($n15 < $n35){
		$CA += 0.30;
	}else if($n15 = $n35){
		$AC += 0.30;
		$CA += 0.30;
	}
	if($n16 > $n36){
		$AC += 0.05;
	}else if($n16 < $n36){
		$CA += 0.05;
	}else if($n16 < $n36){
		$AC += 0.05;
		$CA += 0.05;
	}
	
	
	//2 - 3 & 3 - 2
	if($n21 > $n31){
		$BC += 0.25;
	}else if($n21 < $n31){
		$CB += 0.25;
	}else if($n21 = $n31){
		$BC += 0.25;
		$CB += 0.25;
	}
	if($n22 > $n32){
		$BC += 0.05;
	}else if($n22 < $n32){
		$CB += 0.05;
	}else if($n22 = $n32){
		$BC += 0.05;
		$CB += 0.05;
	}
	if($n23 > $n33){
		$BC += 0.30;
	}else if($n23 < $n33){
		$CB += 0.30;
	}else if($n23 = $n33){
		$BC += 0.30;
		$CB += 0.30;
	}
	if($n24 > $n34){
		$BC += 0.05;
	}else if($n24 < $n34){
		$CB += 0.05;
	}else if($n24 = $n34){
		$BC += 0.05;
		$CB += 0.05;
	}
	if($n25 > $n35){
		$BC += 0.30;
	}else if($n25 < $n35){
		$CB += 0.30;
	}else if($n25 = $n35){
		$CB += 0.30;
		$BC += 0.30;
	}
	if($n26 > $n36){
		$BC += 0.05;
	}else if($n26 < $n36){
		$CB += 0.05;
	}else if($n26 < $n36){
		$BC += 0.05;
		$CB += 0.05;
	}
	
	
	$angka=array($AA,$AB,$AC,$BA,$BB,$BC,$CA,$CB,$CC);
	$no=0;
	echo "<h3> Tabel Concordance </h3>";
	echo '<div class="row">
  	     <div class="column">';
	echo "<table>";
	for($i=1; $i <=3; $i++){
      	echo "<tr>";
      	for($j=1; $j<=3; $j++){
            echo "<td>";
            $angkabaru[$i][$j]=$angka[$no];
            echo $angkabaru[$i][$j];
            echo "</td>";
            $no++;
      	    }
      	   echo "</tr>"; 
	}
	echo "</table>";
	echo '</div>';
	echo '<div class="column">';
	echo 'Alternatif 1 = '.($AA + $BA + $CA);
	echo "<br>";
	echo "<br>";
	echo 'Alternatif 2 = '.($AB + $BB + $CB);
	echo "<br>";
	echo "<br>";
	echo 'Alternatif 3 = '.($AC + $BC + $CC);
	echo "<br>";
	echo "<br>";
	echo '</div>';
	echo '<div class="column">';
	echo "<br>";
	echo "<h5> &nbsp Total = ".($AA+$AB+$AC+$BA+$BB+$BC+$CA+$CB+$CC)."</h5>";
	echo '</div>';
	echo '<div class="column">';
	echo "<br>";
	$cbari = ($AA+$AB+$AC+$BA+$BB+$BC+$CA+$CB+$CC) / 6;
	$cBar = round($cbari,2);
	echo "<h6> &nbsp C BAR = ".$cBar."</h5>";
	echo '</div>';
	echo '<div class="column">';
	
	
	$AAi = 0; $ABi = 0; $ACi = 0;
	$BAi = 0; $BBi = 0; $BCi = 0;
	$CAi = 0; $CBi = 0; $CCi = 0;
	
	
	if($AB >= $cBar){
		$ABi = 1;
	}else{
		$ABi = 0;
	}
	
	if($AC >= $cBar){
		$ACi = 1;
	}else{
		$ACi = 0;
	}
	
	if($BA >= $cBar){
		$BAi = 1;
	}else{
		$BAi = 0;
	}
	
	if($BC >= $cBar){
		$BCi = 1;
	}else{
		$BCi = 0;
	}
	
	if($CA >= $cBar){
		$CAi = 1;
	}else{
		$CAi = 0;
	}
	
	if($CB >= $cBar){
		$CBi = 1;
	}else{
		$CBi = 0;
	}
	
	$angka=array($AAi,$ABi,$ACi,$BAi,$BBi,$BCi,$CAi,$CBi,$CCi);
	$no=0;
	echo "<table>";
	for($i=1; $i <=3; $i++){
      	echo "<tr>";
      	for($j=1; $j<=3; $j++){
            echo "<td>";
            $angkabaru[$i][$j]=$angka[$no];
            echo $angkabaru[$i][$j];
            echo "</td>";
            $no++;
      	    }
      	   echo "</tr>"; 
	}
	echo "</table>";
	echo '</div>';
	echo '</div>';
	echo "<br>";
	echo "<br>";
	
	echo "<h3> Tabel Discordance </h3>";
	echo '<div class="row">
  	     <div class="column">';
	$angka=array($n11,$n12,$n13,$n14,$n15,$n16,$n21,$n22,$n23,$n24,$n25,$n26,$n31,$n32,$n33,$n34,$n35,$n36);
	$no=0;
	echo "<table>";
	for($i=1; $i <=3; $i++){
      	echo "<tr>";
      	for($j=1; $j<=6; $j++){
            echo "<td>";
            $angkabaru[$i][$j]=$angka[$no];
            echo $angkabaru[$i][$j];
            echo "</td>";
            $no++;
      	    }
      	   echo "</tr>"; 
	}
	echo "</table>";
	echo '</div>';
	echo'<div class="column">';
	echo '&nbsp';
	echo '</div>';
	echo'<div class="column">';
	echo '&nbsp';
	echo '</div>';
	
	$ABd = array(); $ACd = array();
	$BAd = array(); $BCd = array();
	$CAd = array(); $CBd = array();
	
	$arA=array($n11,$n12,$n13,$n14,$n15,$n16);
	$arB=array($n21,$n22,$n23,$n24,$n25,$n26);
	$arC=array($n31,$n32,$n33,$n34,$n35,$n36);
	
	for ($i=0; $i<6; $i++){
		$hasili = 0;
		$hasili = ($arA[$i] - $arB[$i]);
		$hasil = round($hasili,2);
		array_push($ABd,$hasil);
	}
	for ($i=0; $i<6; $i++){
		$hasili = 0;
		$hasili = ($arA[$i] - $arC[$i]);
		$hasil = round($hasili,2);
		array_push($ACd,$hasil);
	}
	for ($i=0; $i<6; $i++){
		$hasili = 0;
		$hasili = ($arB[$i] - $arA[$i]);
		$hasil = round($hasili,2);
		array_push($BAd,$hasil);
	}
	for ($i=0; $i<6; $i++){
		$hasili = 0;
		$hasili = ($arB[$i] - $arC[$i]);
		$hasil = round($hasili,2);
		array_push($BCd,$hasil);
	}
	for ($i=0; $i<6; $i++){
		$hasili = 0;
		$hasili = ($arC[$i] - $arA[$i]);
		$hasil = round($hasili,2);
		array_push($CAd,$hasil);
	}
	for ($i=0; $i<6; $i++){
		$hasili = 0;
		$hasili = ($arC[$i] - $arB[$i]);
		$hasil = round($hasili,2);
		array_push($CBd,$hasil);
	}
	
	//discordance
	
	$minAB = min($ABd);
	$maxAB = max($ABd);
	$arrA = array($minAB, $maxAB);
	$arbsA = array(abs($minAB), abs($maxAB));
	$arMaxA = max($arbsA);
	$sbsA = array_search($arMaxA,$arrA);
	$isA = $arrA[$sbsA];
	$sA = array_search($isA,$ABd);
	$nTA = $ABd[$sA];
	$hasdisAB = round(abs($minAB / $nTA),2);
	
	$minAC = min($ACd);
	$maxAC = max($ACd);
	$arrC = array($minAC, $maxAC);
	$arrbsC = array(abs($minAC), abs($maxAC));
	$arMaxC = max($arrbsC);
	$sbsC = array_search($arMaxC,$arrC);
	$isC = $arrC[$sbsC];
	$sC = array_search($isC,$ACd);
	$nTC = $ACd[$sC];
	$hasdisAC = round(abs($minAC / $nTC),2);

	$minBA = min($BAd);
	$maxBA = max($BAd);
	$arrB = array($minBA, $maxBA);
	$arrbsB = array(abs($minBA), abs($maxBA));
	$arMaxB = max($arrbsB);
	$sbsB = array_search($arMaxB,$arrB);
	$isB = $arrB[$sbsB];
	$sB = array_search($isB,$BAd);
	$nTB = $BAd[$sB];
	$hasdisBA = round(abs($minBA / $nTB),2);

	$minBC = min($BCd);
	$maxBC = max($BCd);
	$arrBC = array($minBC,$maxBC);
	$arrbsBC = array(abs($minBC), abs($maxBC));
	$arMaxBC = max($arrbsBC);
	$sbsBC = array_search($arMaxBC,$arrbsBC);
	$isBC = $arrBC[$sbsBC];
	$sBC = array_search($isBC,$BCd);
	$nTBC = $BCd[$sBC];
	$hasdisBC = round(abs($minBC / $nTBC),2);

	$minCA = min($CAd);
	$maxCA = max($CAd);
	$arrCA = array($minCA,$maxCA);
	$arrbsCA = array(abs($minCA), abs($maxCA));
	$arMaxCA = max($arrbsCA);
	$sbsCA = array_search($arMaxCA,$arrCA);
	$isCA = $arrCA[$sbsCA];
	$sCA = array_search($isCA,$CAd);
	$nTCA = $CAd[$sCA];
	$hasdisCA = round(abs($minCA / $nTCA),2);

	$minCB = min($CBd);
	$maxCB = max($CBd);
	$arrCB = array($minCB,$maxCB);
	$arrbsCB = array(abs($minCB), abs($maxCB));
	$arMaxCB = max($arrbsCB);
	$sbsCB = array_search($arMaxCB,$arrCB);
	$isCB = $arrCB[$sbsCB];
	$sCB = array_search($isCB,$CBd);
	$nTCB = $CBd[$sCB];
	$hasdisCB = round(abs($minCB / $nTCB),2);

	echo'<div class="column">';
	$angka=array(0,$hasdisAB,$hasdisAC,$hasdisBA,0,$hasdisBC,$hasdisCA,$hasdisCB,0);
	$no=0;
	echo "<table>";
	for($i=1; $i <=3; $i++){
      	echo "<tr>";
      	for($j=1; $j<=3; $j++){
            echo "<td>";
            $angkabaru[$i][$j]=$angka[$no];
            echo $angkabaru[$i][$j];
            echo "</td>";
            $no++;
      	    }
      	   echo "</tr>"; 
	}
	echo "</table>";
	echo '</div>';
	echo '</div>';

	echo "<br>";

	echo '<div class="row">
	<div class="column">';
	echo 'Alternatif 1 = '.(0 + $hasdisBA + $hasdisCA);
	echo "<br>";
	echo "<br>";
	echo 'Alternatif 2 = '.($hasdisAB + 0 + $hasdisCB);
	echo "<br>";
	echo "<br>";
	echo 'Alternatif 3 = '.($hasdisAC + $hasdisBC + 0);
	echo "<br>";
	echo '</div>';
	echo '<div class="column">';
	echo "<br>";
	echo "<h5> &nbsp Total = ".(0+$hasdisAB+$hasdisAC+$hasdisBA+0+$hasdisBC+$hasdisCA+$hasdisCB+0)."</h5>";
	echo '</div>';
	echo '<div class="column">';
	echo "<br>";
	$dbari = (0+$hasdisAB+$hasdisAC+$hasdisBA+0+$hasdisBC+$hasdisCA+$hasdisCB+0) / 6;
	$dBar = round($dbari,2);
	echo "<h6> &nbsp D BAR = ".$dBar."</h5>";
	echo '</div>';

	$AAds = 0; $ABds = 0; $ACds = 0;
	$BAds = 0; $BBds = 0; $BCds = 0;
	$CAds = 0; $CBds = 0; $CCds = 0;
	
	
	if($hasdisAB >= $dBar){
		$ABds = 1;
	}else{
		$ABds = 0;
	}
	
	if($hasdisAC >= $dBar){
		$ACds = 1;
	}else{
		$ACds = 0;
	}
	
	if($hasdisBA >= $dBar){
		$BAds = 1;
	}else{
		$BAds = 0;
	}
	
	if($hasdisBC >= $dBar){
		$BCds = 1;
	}else{
		$BCds = 0;
	}
	
	if($hasdisCA >= $dBar){
		$CAds = 1;
	}else{
		$CAds = 0;
	}
	
	if($hasdisCB >= $dBar){
		$CBds = 1;
	}else{
		$CBds = 0;
	}


	echo'<div class="column">';
	$angka=array($AAds,$ABds,$ACds,$BAds,$BBds,$BCds,$CAds,$CBds,$CCds);
	$no=0;
	echo "<table>";
	for($i=1; $i <=3; $i++){
      	echo "<tr>";
      	for($j=1; $j<=3; $j++){
            echo "<td>";
            $angkabaru[$i][$j]=$angka[$no];
            echo $angkabaru[$i][$j];
            echo "</td>";
            $no++;
      	    }
      	   echo "</tr>"; 
	}
	echo "</table>";
	echo '</div>';
	echo '</div>';

	echo "<h3> Agregate Tabel Corcondance & Tabel Discordance </h3>";
	echo '<div class="row">
  	     <div class="column">';
		   $angka=array($AAi,$ABi,$ACi,$BAi,$BBi,$BCi,$CAi,$CBi,$CCi);
		   $no=0;
		   echo "<table>";
		   for($i=1; $i <=3; $i++){
				 echo "<tr>";
				 for($j=1; $j<=3; $j++){
				   echo "<td>";
				   $angkabaru[$i][$j]=$angka[$no];
				   echo $angkabaru[$i][$j];
				   echo "</td>";
				   $no++;
					 }
					echo "</tr>"; 
		   }
		   echo "</table>";
	echo '</div>';
	echo'<div class="column">';
	echo '&nbsp';
	echo '</div>';
	echo'<div class="column">';
	$angka=array($AAds,$ABds,$ACds,$BAds,$BBds,$BCds,$CAds,$CBds,$CCds);
	$no=0;
	echo "<table>";
	for($i=1; $i <=3; $i++){
      	echo "<tr>";
      	for($j=1; $j<=3; $j++){
            echo "<td>";
            $angkabaru[$i][$j]=$angka[$no];
            echo $angkabaru[$i][$j];
            echo "</td>";
            $no++;
      	    }
      	   echo "</tr>"; 
	}
	echo "</table>";
	echo '</div>';
	echo '</div>';
echo '</body>
</html>';
    // echo json_encode(array("pagi"=>$pagi,"siang"=>$siang,"malam"=>$malam,"snackpagi"=>$snackpagi,"snacksiang"=>$snacksiang,"snackmalam"=>$snackmalam));
}else {
  $response["error"] = TRUE;
  $response["error_msg"] = "Parameter (email atau password) ada yang kurang";
  echo json_encode($response);
}
?>
