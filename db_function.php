<?php
class DB_Functions {


    public $conn;

    function __construct() {
        require_once $_SERVER['DOCUMENT_ROOT'].'/api_gizi/db_connect.php';
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    function __destruct() {

    }

    public function getuserpass($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM login WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            $usern = $user['email'];
            $passw = $user['password'];
            $id = $user['id_user'];
            if ($password == $passw && $email == $usern) {
              $get = "SELECT * FROM user WHERE id_user = '".$id."';";
              $res = mysqli_query($this->conn,$get);
              $row = mysqli_fetch_array($res);
              return $row;
            }
        } else {
            return false;
        }
    }
    public function getadmin($password) {
	
	$email = "admin";
	
        $stmt = $this->conn->prepare("SELECT * FROM login WHERE email = 'admin'");

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            $usern = $user['email'];
            $passw = $user['password'];
            $id = $user['id_user'];
            if ($password == $passw && $email == $usern) {
            	return true;
            }
        } else {
            return false;
        }
    }

    public function registerlogin($username, $email, $password,$nama,$jk,$umur,$tinggi,$berat,$aktif) {
	     $idu = 'user';
        $stmt = $this->conn->prepare("INSERT INTO login (id_user, username, email, password) VALUES(?,?,?,?)");
	       $stmt2 = $this->conn->prepare("INSERT INTO user (id_user, email, nama_user, jk_user, umur_user,tinggi_user,berat_user,aktifitas_user) VALUES(?,?,?,?,?,?,?,?)");

        $stmt->bind_param("ssss", $idu, $username, $email , $password);
	       $stmt2->bind_param("ssssiiii", $idu, $email,$nama,$jk,$umur,$tinggi,$berat,$aktif);

        if ($stmt->execute()&&$stmt2->execute()) {
            $stmt->get_result();
            $stmt2->get_result();
            $stmt2->close();
            $stmt->close();

            $sql = "UPDATE login SET id_user = concat( 'user', id_login ) ;";
            $res = mysqli_query($this->conn,$sql);

            $sql2 = "SELECT id_user FROM login WHERE email = '".$email."';";
          	$res2 = mysqli_query($this->conn,$sql2);
            $row = mysqli_fetch_array($res2);

            $sql3 = "UPDATE user SET id_user = '".$row[0]."' WHERE email = '".$email."';";
            $res3 = mysqli_query($this->conn,$sql3);

            return false;
        } else {
            return true;
        }
    }
    public function cekRegister($email) {

        $stmt = $this->conn->prepare("SELECT email FROM login WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return true;
        }
    }

    public function getPagi(){
      $sqlPagi = "(SELECT id_kode as 'Pagi', energi from data_energi where id_kode LIKE 'AP%'AND nama_bahan LIKE 'Nasi%' OR '%Nasi' ORDER BY RAND() LIMIT 1)
  UNION ALL
  (SELECT id_kode, energi FROM data_energi WHERE id_kode like 'DP%' AND nama_bahan NOT LIKE '%mentah%' ORDER BY RAND() LIMIT 1)
  UNION ALL
  (SELECT id_kode, energi FROM data_energi WHERE id_kode LIKE 'FP%' AND nama_bahan NOT LIKE '%Babi%' AND nama_bahan NOT LIKE '%Anjing%' AND nama_bahan NOT LIKE '%Buaya%' AND nama_bahan NOT LIKE '%mentah%' ORDER BY RAND() LIMIT 1)
  ";
      $res = mysqli_query($this->conn,$sqlPagi);
      $resultpagi = array();
      while($row = mysqli_fetch_array($res)){
         array_push($resultpagi,array('pagi'=>$row[0], 'energi'=>$row[1]));
      }
      return $resultpagi;
    }

    public function getSiang(){
      $sqlSiang = "(SELECT id_kode as 'Siang' , energi from data_energi where id_kode LIKE 'AP%'AND nama_bahan LIKE 'Nasi%' OR '%Nasi' ORDER BY RAND() LIMIT 1)
  UNION ALL
  (SELECT id_kode , energi FROM data_energi WHERE id_kode like 'GP%' AND nama_bahan NOT LIKE '%mentah%'  ORDER BY RAND() LIMIT 1)
  UNION ALL
  (SELECT id_kode , energi FROM data_energi WHERE id_kode LIKE 'HP%' AND nama_bahan NOT LIKE '%mentah%' ORDER BY RAND() LIMIT 1)";
      $res = mysqli_query($this->conn,$sqlSiang);
      $resultsiang = array();
      while($row = mysqli_fetch_array($res)){
         array_push($resultsiang,array('siang'=>$row[0], 'energi'=>$row[1]));
      }
      return $resultsiang;
    }

    public function getMalam(){
      $sqlMalam = "(SELECT id_kode as 'Malam', energi from data_energi where id_kode LIKE 'AP%' OR nama_bahan LIKE '%Mie%' AND nama_bahan LIKE 'Nasi%' OR '%Nasi' ORDER BY RAND() LIMIT 1)
  UNION ALL
  (SELECT id_kode, energi FROM data_energi WHERE id_kode like 'GP%' ORDER BY RAND() LIMIT 1)";
      $res = mysqli_query($this->conn,$sqlMalam);
      $resultmalam = array();
      while($row = mysqli_fetch_array($res)){
         array_push($resultmalam,array('malam'=>$row[0], 'energi'=>$row[1]));
      }
      return $resultmalam;
    }

    public function getSP(){
      $sqlSnack = "(SELECT id_kode as 'Snack Pagi', energi from data_energi where id_kode LIKE 'ER%' OR id_kode LIKE 'EP%' ORDER BY RAND() LIMIT 1)
  UNION ALL
  (SELECT id_kode, energi FROM data_energi WHERE id_kode like 'JP%' ORDER BY RAND() LIMIT 1)";
      $res = mysqli_query($this->conn,$sqlSnack);
      $resultsp= array();
      while($row = mysqli_fetch_array($res)){
         array_push($resultsp,array('sPagi'=>$row[0], 'energi'=>$row[1]));
      }
      return $resultsp;
    }

    public function getSS(){
      $sqlSnack = "(SELECT id_kode as 'Snack Siang', energi from data_energi where id_kode LIKE 'AP%' AND nama_bahan NOT LIKE 'Nasi%' OR '%Nasi' ORDER BY RAND() LIMIT 1)
UNION ALL
(SELECT id_kode, energi FROM data_energi WHERE id_kode like 'BP%' OR id_kode LIKE '%Kue%' OR id_kode LIKE '%Jus%' ORDER BY RAND() LIMIT 1)";
      $res = mysqli_query($this->conn,$sqlSnack);
      $resultss= array();
      while($row = mysqli_fetch_array($res)){
         array_push($resultss,array('sSiang'=>$row[0], 'energi'=>$row[1]));
      }
      return $resultss;
    }

    public function getSM(){
      $sqlSnack = "SELECT id_kode as 'Snack Malam', energi from data_energi where id_kode like 'BP%' OR id_kode LIKE '%Kue%' OR id_kode LIKE '%Jus%' ORDER BY RAND() LIMIT 1";
      $res = mysqli_query($this->conn,$sqlSnack);
      $resultsm= array();
      while($row = mysqli_fetch_array($res)){
          array_push($resultsm,array('sMalam'=>$row[0], 'energi'=>$row[1]));
      }
      return $resultsm;
    }

    public function addDataM($nama, $kode, $enrg, $sumber, $bdd, $air, $protein, $lemak, $karbo, $serat, $abu, $kalsium, $fsfr, $besi, $ntrium, $kalium, $tmbg, $seng, $rtnl, $bkar, $ktot, $thmn, $rbfln, $nsin, $vtc){
        $sql = "INSERT INTO data_energi (id_kode,nama_bahan,sumber,air,energi,protein,lemak,kh,serat,abu,kalsium,fosfor,besi,natrium,kalium,tembaga,seng,retinol,b_kar,kar_total,thiamin,riboflavin,niasin,vitc,bdd) VALUES ('$kode','$nama','$sumber',$air,$enrg,$protein, $lemak, $karbo, $serat, $abu, $kalsium, $fsfr, $besi, $ntrium, $kalium, $tmbg, $seng, $rtnl, $bkar, $ktot, $thmn, $rbfln, $nsin, $vtc,$bdd)";
        $result = mysqli_query($this->conn,$sql);
        return $result;
    }

    public function updateDataM($oldkode, $nama, $kode, $enrg, $sumber, $bdd, $air, $protein, $lemak, $karbo, $serat, $abu, $kalsium, $fsfr, $besi, $ntrium, $kalium, $tmbg, $seng, $rtnl, $bkar, $ktot, $thmn, $rbfln, $nsin, $vtc ){
        $sql ="UPDATE data_energi SET id_kode = '$kode' , nama_bahan = '$nama' ,sumber = '$sumber' ,air =$air ,energi = $enrg ,protein = $protein ,lemak = $lemak ,kh = $karbo ,serat = $serat ,abu = $abu ,kalsium = $kalsium ,fosfor = $fsfr ,besi = $besi ,natrium = $ntrium ,kalium = $kalium ,tembaga = $tmbg ,seng = $seng ,retinol = $rtnl ,b_kar = $bkar ,kar_total = $ktot ,thiamin = $thmn ,riboflavin = $rbfln ,niasin = $nsin ,vitc = $vtc ,bdd = $bdd WHERE id_kode = '$oldkode'";
        $result = mysqli_query($this->conn,$sql);
        return $result;
    }

    public function deleteDataM($kode){
        $sql ="DELETE FROM data_energi WHERE id_kode = '$kode'";
        $result = mysqli_query($this->conn,$sql);
        return $result;
    }
}

?>
