<?php

class Home extends Connect
{

  public function checkLogin($table, $username, $password)
  {
    $pdo = parent::getInstance();
    $username = trim($username);
    $password = trim($password);
    // $sql = "SELECT * FROM $table WHERE u_username = :username AND u_status=1";
    $sql = "SELECT * FROM $table WHERE u_username = :username AND u_status=1";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":username", $username);
    $statement->execute();
    $data =  $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetch(PDO::FETCH_ASSOC);
    $countchk = $statement->rowCount();
    // return $statement->fetchAll();
    if ($countchk > 0) {

      if (password_verify($password, $data['u_password'])) {
        echo $_SESSION['sess_id'] = $data['u_id'];
        echo $_SESSION['sess_fullname'] = $data['u_firstname'] . ' ' . $data['u_lastname'];
        echo $_SESSION['sess_accessrights'] = $data['u_accessrights'];

        // echo $_SESSION['sess_agency'] = $data['ag_id'];
        // echo $_SESSION['sess_agencyname'] = $data['ag_name'];
        // echo $_SESSION['sess_photo'] = $data['u_photo'];
        // return 1;
      } else {
        return 0;
      }
    } else {
      return 0;
    }
  }
  public function checkRegister($table, $data)
  {
    $pdo = parent::getInstance();

    $sql1 = "SELECT * FROM $table WHERE u_username = :u_username";
    $checkuser = $pdo->prepare($sql1);
    $checkuser->bindValue(":u_username", $data['u_username']);
    $checkuser->execute();
    $datauser =  $checkuser->fetch(PDO::FETCH_ASSOC);
    // $datauser = $checkuser->fetchAll();
    if ($datauser['u_username'] != '') {
      return 'checkuserno';
      exit();
    } else {
      // return 'checkuseryes';
    }

    if ($data['u_password'] != $data['u_password_confirm']) {
      return 'no';
      exit();
    } else {
    }
    $options = array("cost" => 4);
    $hashPassword = password_hash($data['u_password'], PASSWORD_BCRYPT, $options);

    $sql = "INSERT INTO $table SET u_prename=:u_prename,
        u_firstname=:u_firstname,
        u_lastname=:u_lastname,
        u_username=:u_username,
        u_password=:u_password,
        u_accessrights=:u_accessrights,
        u_address=:u_address,
        u_road=:u_road,
        u_district=:u_district,
        u_amphoe=:u_amphoe,
        u_province=:u_province,
        u_zipcode=:u_zipcode,
        u_tel=:u_tel,
        u_email=:u_email,
        u_government=:u_government,
        u_booknumber=:u_booknumber,
        u_head_government=:u_head_government
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":u_prename", $data['u_prename']);
    $statement->bindValue(":u_firstname", $data['u_firstname']);
    $statement->bindValue(":u_lastname", $data['u_lastname']);
    $statement->bindValue(":u_username", $data['u_username']);
    $statement->bindValue(":u_password", $hashPassword);
    $statement->bindValue(":u_accessrights", 'user');
    $statement->bindValue(":u_address", $data['u_address']);
    $statement->bindValue(":u_road", $data['u_road']);
    $statement->bindValue(":u_district", $data['u_district']);
    $statement->bindValue(":u_amphoe", $data['u_amphoe']);
    $statement->bindValue(":u_province", $data['u_province']);
    $statement->bindValue(":u_zipcode", $data['u_zipcode']);
    $statement->bindValue(":u_tel", $data['u_tel']);
    $statement->bindValue(":u_email", $data['u_email']);
    $statement->bindValue(":u_government", $data['u_government']);
    $statement->bindValue(":u_booknumber", $data['u_booknumber']);
    $statement->bindValue(":u_head_government", $data['u_head_government']);
    $statement->execute();
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
