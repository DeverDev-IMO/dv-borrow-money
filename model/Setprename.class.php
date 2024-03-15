<?php

class Setprename extends Connect
{

  public function insertClient($table, $data)
  {
    $pdo = parent::getInstance();
    $sql = "INSERT INTO $table SET setpre_name=:setpre_name,
        setpre_created_at=now(),
        setpre_updated_at=now()
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":setpre_name", $data['setpre_name']);
    $statement->execute();

    $sql = "SELECT * FROM $table ORDER BY setpre_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);
  }

  public function listClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY setpre_id DESC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function deleteClient($table, $id)
  {
    if ($_REQUEST['photo'] != '') {
      unlink('../' . $_REQUEST['photo']);
    }
    $pdo = parent::getInstance();
    $sql = "DELETE FROM $table where setpre_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
  }

  public function getInfo($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE setpre_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function updateClient($table, $data, $id)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table SET  setpre_name=:setpre_name,setpre_updated_at=now() WHERE setpre_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['setpre_id'],
      'setpre_name' => $data['setpre_name']
    ));
  }
}
