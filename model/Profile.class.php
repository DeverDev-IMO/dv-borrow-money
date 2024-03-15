<?php

class Profile extends Connect
{

  public function getInfo($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE u_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function updateClient($table, $data, $id)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table SET u_prename=:u_prename,
        u_firstname=:u_firstname,
        u_lastname=:u_lastname,
        u_username=:u_username, 
        u_address=:u_address, 
        u_tel=:u_tel, 
        u_email=:u_email,
        u_road=:u_road,
        u_district=:u_district,
        u_amphoe=:u_amphoe,
        u_province=:u_province,
        u_zipcode=:u_zipcode
        WHERE u_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'u_prename' => $data['u_prename'],
      'u_firstname' => $data['u_firstname'],
      'u_lastname' => $data['u_lastname'],
      'u_username' => $data['u_username'],
      'u_address' => $data['u_address'],
      'u_tel' => $data['u_tel'],
      'u_email' => $data['u_email'],
      'u_road' => $data['u_road'],
      'u_district' => $data['u_district'],
      'u_amphoe' => $data['u_amphoe'],
      'u_province' => $data['u_province'],
      'u_zipcode' => $data['u_zipcode'],
      'id' => $data['u_id']
    ));
  }
  public function updatepasswordClient($table, $data, $id)
  {
    $pdo = parent::getInstance();

    $passwordnew = trim($data['password_new']);
    $passwordnewconfirm = trim($data['password_new_confirm']);
    $passwordold = trim($data['password_old']);
    if ($passwordnew != $passwordnewconfirm) {
      return 'checkpassnewno';
      exit();
    } else {
    }
    $sql1 = "SELECT * FROM $table WHERE u_id = :u_id";
    $checkuser = $pdo->prepare($sql1);
    $checkuser->bindValue(":u_id", $id);
    $checkuser->execute();
    $datauser =  $checkuser->fetch(PDO::FETCH_ASSOC);
    // if($datauser['u_username']!=''){
    if (!password_verify($passwordold, $datauser['u_password'])) {
      return 'checkpassoldno';
      exit();
    } else {
    }
    $options = array("cost" => 4);
    $hashPasswordNew = password_hash($passwordnew, PASSWORD_BCRYPT, $options);
    $sql = "UPDATE $table SET u_password=:u_password WHERE u_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $id,
      'u_password' => $hashPasswordNew
    ));
  }

  public function listfromAgencyClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY ag_id DESC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
  public function getdataInfo($table)
  {
    $data = array();
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN manageposition ON ag_id=mp_agid WHERE ag_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $_REQUEST['agid']);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
      $data = $row;
    }
    return $data;
  }
}
