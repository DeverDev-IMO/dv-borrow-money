<?php

class Personnel extends Connect
{

  public function insertClient($table, $data)
  {
    $pdo = parent::getInstance();
    $sql = "INSERT INTO $table SET per_fullname=:per_fullname,
        per_tel=:per_tel,
        per_created_at=now()
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":per_fullname", $data['per_fullname']);
    $statement->bindValue(":per_tel", $data['per_tel']);
    $statement->execute();

    $sql = "SELECT * FROM $table ORDER BY per_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);
  }

  public function listClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY per_id DESC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function deleteClient($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "DELETE FROM $table where per_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
  }

  public function getInfo($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE per_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function updateClient($table, $data, $id)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table SET  per_fullname=:per_fullname,per_tel=:per_tel WHERE per_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['per_id'],
      'per_fullname' => $data['per_fullname'],
      'per_tel' => $data['per_tel']
    ));
  }
}
