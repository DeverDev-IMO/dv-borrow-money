<?php

include_once '../connect/conDB.php';
include_once '../model/Setstatusmarry.class.php';

$setstatusmarry = new Setstatusmarry();

if (isset($_REQUEST['setmar_id']) && !empty($_REQUEST['setmar_id'])) {
  $id = $_REQUEST['setmar_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'setstatusmarryinsertdata':
    if (isset($data) && !empty($data)) {
      $setstatusmarry->insertClient("set_statusmarry", $data);
    }
    break;
  case 'setstatusmarryeditdata':
    if (isset($id) && !empty($id)) {
      $setstatusmarry->updateClient("set_statusmarry", $data, $id);
    }
    break;
  case 'setstatusmarrydelete':
    if (isset($id) && !empty($id)) {
      $setstatusmarry->deleteClient("set_statusmarry", $id);
    }
    break;
}
