<?php

class Setlinework extends Connect
{

  public function insertClient($table, $data)
  {
    $pdo = parent::getInstance();
    $sql = "INSERT INTO $table SET lw_code=:lw_code,
        lw_name=:lw_name,
        lw_created_at=now(),
        lw_personnelhead_name=:lw_personnelhead_name,
        lw_personnelhead_tel=:lw_personnelhead_tel,
        lw_personnelhenchman_name=:lw_personnelhenchman_name,
        lw_personnelhenchman_tel=:lw_personnelhenchman_tel
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":lw_code", $data['lw_code']);
    $statement->bindValue(":lw_name", $data['lw_name']);
    $statement->bindValue(":lw_personnelhead_name", $data['lw_personnelhead_name']);
    $statement->bindValue(":lw_personnelhead_tel", $data['lw_personnelhead_tel']);
    $statement->bindValue(":lw_personnelhenchman_name", $data['lw_personnelhenchman_name']);
    $statement->bindValue(":lw_personnelhenchman_tel", $data['lw_personnelhenchman_tel']);
    $statement->execute();

    $sql = "SELECT * FROM $table ORDER BY lw_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);
  }

  public function listClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY lw_id DESC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function deleteClient($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "DELETE FROM $table where lw_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
  }

  public function getInfo($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE lw_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function updateClient($table, $data, $id)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table SET  
    lw_code=:lw_code,
    lw_name=:lw_name,
    lw_personnelhead_name=:lw_personnelhead_name,
    lw_personnelhead_tel=:lw_personnelhead_tel,
    lw_personnelhenchman_name=:lw_personnelhenchman_name,
    lw_personnelhenchman_tel=:lw_personnelhenchman_tel
    WHERE lw_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['lw_id'],
      'lw_code' => $data['lw_code'],
      'lw_name' => $data['lw_name'],
      'lw_personnelhead_name' => $data['lw_personnelhead_name'],
      'lw_personnelhead_tel' => $data['lw_personnelhead_tel'],
      'lw_personnelhenchman_name' => $data['lw_personnelhenchman_name'],
      'lw_personnelhenchman_tel' => $data['lw_personnelhenchman_tel']
    ));
  }
}
