<?php

class Documentcard extends Connect
{


  public function listClient($table)
  {
    $pdo = parent::getInstance();
    // if($_SESSION['sess_accessrights']=='superadmin'){
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    WHERE contract_status_cancel = 1
    ORDER BY contract_id DESC";
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


  public function getInfo($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN personnel ON contract_personnelhead_id=per_id 
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    // return $statement->fetchAll();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetch();
  }
  public function getInfoSubHenchman($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN personnel ON contract_personnelhenchman_id=per_id 
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
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
    $sql = "UPDATE $table SET  contract_personnelhead_id=:contract_personnelhead_id,contract_personnelhenchman_id=:contract_personnelhenchman_id
        WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['contract_id'],
      'contract_personnelhead_id' => $data['contract_personnelhead_id'],
      'contract_personnelhenchman_id' => $data['contract_personnelhenchman_id']
    ));
  }

  public function listPersonnelClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY per_id ASC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
}
