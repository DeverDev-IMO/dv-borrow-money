<?php

include_once '../connect/conDB.php';
include_once '../model/Setcohabiting.class.php';

$setcohabiting = new Setcohabiting();

if (isset($_REQUEST['setcoh_id']) && !empty($_REQUEST['setcoh_id'])) {
  $id = $_REQUEST['setcoh_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'setcohabitinginsertdata':
    if (isset($data) && !empty($data)) {
      $setcohabiting->insertClient("set_cohabiting", $data);
    }
    break;
  case 'setcohabitingeditdata':
    if (isset($id) && !empty($id)) {
      $setcohabiting->updateClient("set_cohabiting", $data, $id);
    }
    break;
  case 'setcohabitingdelete':
    if (isset($id) && !empty($id)) {
      $setcohabiting->deleteClient("set_cohabiting", $id);
    }
    break;
}
