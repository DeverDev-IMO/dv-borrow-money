<?php

include_once '../connect/conDB.php';
include_once '../model/Setstatusaddress.class.php';

$setstatusaddress = new Setstatusaddress();

if (isset($_REQUEST['setadd_id']) && !empty($_REQUEST['setadd_id'])) {
  $id = $_REQUEST['setadd_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'setstatusaddressinsertdata':
    if (isset($data) && !empty($data)) {
      $setstatusaddress->insertClient("set_statusaddress", $data);
    }
    break;
  case 'setstatusaddresseditdata':
    if (isset($id) && !empty($id)) {
      $setstatusaddress->updateClient("set_statusaddress", $data, $id);
    }
    break;
  case 'setstatusaddressdelete':
    if (isset($id) && !empty($id)) {
      $setstatusaddress->deleteClient("set_statusaddress", $id);
    }
    break;
}
