<?php

class Setstatuswork extends Connect
{

  public function insertClient($table, $data)
  {
    $pdo = parent::getInstance();
    $sql = "INSERT INTO $table SET setwork_name=:setwork_name,
        setwork_created_at=now(),
        setwork_updated_at=now()
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":setwork_name", $data['setwork_name']);
    $statement->execute();

    $sql = "SELECT * FROM $table ORDER BY setwork_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);
  }

  public function listClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY setwork_id DESC";
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
    $sql = "DELETE FROM $table where setwork_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
  }

  public function getInfo($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE setwork_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function updateClient($table, $data, $id)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table SET  setwork_name=:setwork_name,setwork_updated_at=now() WHERE setwork_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['setwork_id'],
      'setwork_name' => $data['setwork_name']
    ));
  }
}
