<?php

class Users extends Connect
{

  public function insertClient($table, $data)
  {
    $pdo = parent::getInstance();
    // $sql = "INSERT INTO $table (mt_name) VALUES (:mt_name)";
    $options = array("cost" => 4);
    $hashPassword = password_hash("123456", PASSWORD_BCRYPT, $options);

    $sql = "INSERT INTO $table SET u_prename=:u_prename,
        u_firstname=:u_firstname,
        u_lastname=:u_lastname,
        u_username=:u_username,
        u_accessrights=:u_accessrights,
        u_address=:u_address,
        u_tel=:u_tel,
        u_email=:u_email,
        u_password=:u_password,
        u_road=:u_road,
        u_district=:u_district,
        u_amphoe=:u_amphoe,
        u_province=:u_province,
        u_zipcode=:u_zipcode,
        u_status=:u_status
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":u_prename", $data['u_prename']);
    $statement->bindValue(":u_firstname", $data['u_firstname']);
    $statement->bindValue(":u_lastname", $data['u_lastname']);
    $statement->bindValue(":u_username", $data['u_username']);
    $statement->bindValue(":u_accessrights", $data['u_accessrights']);
    $statement->bindValue(":u_address", $data['u_address']);
    $statement->bindValue(":u_tel", $data['u_tel']);
    $statement->bindValue(":u_email", $data['u_email']);
    $statement->bindValue(":u_password", $hashPassword);
    $statement->bindValue(":u_road", $data['u_road']);
    $statement->bindValue(":u_district", $data['u_district']);
    $statement->bindValue(":u_amphoe", $data['u_amphoe']);
    $statement->bindValue(":u_province", $data['u_province']);
    $statement->bindValue(":u_zipcode", $data['u_zipcode']);
    $statement->bindValue(":u_status", $data['u_status']);
    $statement->execute();

    $sql = "SELECT * FROM $table ORDER BY u_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);

    // $extension = array("jpeg", "jpg", "png", "gif");
    // $ii = 0;
    // $iactive = 1;
    // foreach ($_FILES["fileupload"]["tmp_name"] as $key => $tmp_name) {
    //   $file_name = $_FILES["fileupload"]["name"][$key];
    //   $file_tmp = $_FILES["fileupload"]["tmp_name"][$key];
    //   $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    //   $target_dir = "../file/users/";
    //   $newfileName = 'users' . time() . $ii . "." . $ext;
    //   $target_dirname = "file/users/" . $newfileName;
    //   if ($_FILES["fileupload"]["tmp_name"][$key] != '') {
    //     if (in_array($ext, $extension)) {
    //       move_uploaded_file($_FILES["fileupload"]["tmp_name"][$key], $target_dir . $newfileName);
    //       $sql1 = "UPDATE $table SET u_photo=:u_photo WHERE u_id=:id";
    //       $statement1 = $pdo->prepare($sql1);
    //       $statement1->execute(array('id' => $dataid['u_id'], 'u_photo' => $target_dirname));
    //     } else {
    //       return 'NOTFILE';
    //       exit();
    //     }
    //     $ii++;
    //   }
    // }
  }

  public function listClient($table)
  {
    $pdo = parent::getInstance();
    // if($_SESSION['sess_accessrights']=='superadmin'){
    $sql = "SELECT * FROM $table ORDER BY u_id DESC";
    $statement = $pdo->query($sql);
    $statement->execute();
    // } else if ($_SESSION['sess_accessrights']=='admin') {
    //     $sql = "SELECT * FROM $table WHERE u_government = :id AND u_accessrights!='superadmin' ORDER BY u_id DESC";
    //     $statement = $pdo->prepare($sql);
    //     $statement->bindValue(":id", $_SESSION['sess_agency']);
    //     $statement->execute();
    // }else{

    // }
    return $statement->fetchAll();
  }

  public function deleteClient($table, $id)
  {
    if ($_REQUEST['photo'] != '') {
      unlink('../' . $_REQUEST['photo']);
    }
    $pdo = parent::getInstance();
    $sql = "DELETE FROM $table where u_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
  }

  public function getInfo($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE u_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    // return $statement->fetchAll();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetch();
  }

  public function updateClient($table, $data, $id)
  {
    // $pdo = parent::getInstance();
    // $new_values = "";
    // foreach ($data as $key => $value) {
    //     $new_values .= "$key=:$key, ";
    // }
    // $new_values = substr($new_values, 0, -2);
    // $sql = "UPDATE $table SET $new_values WHERE mt_id = :id";
    // $statement = $pdo->prepare($sql);
    // foreach ($data as $key => $value) {
    //     $statement->bindValue(":$key", $value, PDO::PARAM_STR);
    // }
    // $statement->bindValue(":id", $id);
    // $statement->execute();
    $pdo = parent::getInstance();
    $sql = "UPDATE $table SET  u_prename=:u_prename,
        u_firstname=:u_firstname,
        u_lastname=:u_lastname,
        u_username=:u_username, 
        u_accessrights=:u_accessrights, 
        u_address=:u_address, 
        u_tel=:u_tel, 
        u_email=:u_email,
        u_road=:u_road,
        u_district=:u_district,
        u_amphoe=:u_amphoe,
        u_province=:u_province,
        u_zipcode=:u_zipcode,
        u_status=:u_status
        WHERE u_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['u_id'],
      'u_prename' => $data['u_prename'],
      'u_firstname' => $data['u_firstname'],
      'u_lastname' => $data['u_lastname'],
      'u_username' => $data['u_username'],
      'u_accessrights' => $data['u_accessrights'],
      'u_address' => $data['u_address'],
      'u_tel' => $data['u_tel'],
      'u_email' => $data['u_email'],
      'u_road' => $data['u_road'],
      'u_district' => $data['u_district'],
      'u_amphoe' => $data['u_amphoe'],
      'u_province' => $data['u_province'],
      'u_zipcode' => $data['u_zipcode'],
      'u_status' => $data['u_status']
    ));

    // $extension = array("jpeg", "jpg", "png", "gif");
    // $ii = 0;
    // $iactive = 1;
    // foreach ($_FILES["fileupload"]["tmp_name"] as $key => $tmp_name) {
    //   $file_name = $_FILES["fileupload"]["name"][$key];
    //   $file_tmp = $_FILES["fileupload"]["tmp_name"][$key];
    //   $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    //   $target_dir = "../file/users/";
    //   $newfileName = 'users' . time() . $ii . "." . $ext;
    //   $target_dirname = "file/users/" . $newfileName;
    //   if ($_FILES["fileupload"]["tmp_name"][$key] != '') {
    //     if (in_array($ext, $extension)) {
    //       if ($_REQUEST['oldphoto'] != '') {
    //         unlink('../' . $_REQUEST['oldphoto']);
    //       }
    //       move_uploaded_file($_FILES["fileupload"]["tmp_name"][$key], $target_dir . $newfileName);
    //       $sql1 = "UPDATE $table SET u_photo=:u_photo WHERE u_id=:id";
    //       $statement1 = $pdo->prepare($sql1);
    //       $statement1->execute(array('id' => $data['u_id'], 'u_photo' => $target_dirname));
    //     } else {
    //       return 'NOTFILE';
    //       exit();
    //     }
    //     $ii++;
    //   }
    // }
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
