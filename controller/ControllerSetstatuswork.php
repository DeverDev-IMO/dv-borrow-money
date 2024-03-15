<?php

include_once '../connect/conDB.php';
include_once '../model/Setstatuswork.class.php';

$setstatuswork = new Setstatuswork();

if (isset($_REQUEST['setwork_id']) && !empty($_REQUEST['setwork_id'])) {
  $id = $_REQUEST['setwork_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'setstatusworkinsertdata':
    if (isset($data) && !empty($data)) {
      $setstatuswork->insertClient("set_statuswork", $data);
    }
    break;
  case 'setstatusworkeditdata':
    if (isset($id) && !empty($id)) {
      $setstatuswork->updateClient("set_statuswork", $data, $id);
    }
    break;
  case 'setstatusworkdelete':
    if (isset($id) && !empty($id)) {
      $setstatuswork->deleteClient("set_statuswork", $id);
    }
    break;
}
