<?php

include_once '../connect/conDB.php';
include_once '../model/Setlinework.class.php';

$setlinework = new Setlinework();

if (isset($_REQUEST['lw_id']) && !empty($_REQUEST['lw_id'])) {
  $id = $_REQUEST['lw_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'setlineworkinsertdata':
    if (isset($data) && !empty($data)) {
      $setlinework->insertClient("linework", $data);
    }
    break;
  case 'setlineworkeditdata':
    if (isset($id) && !empty($id)) {
      $setlinework->updateClient("linework", $data, $id);
    }
    break;
  case 'setlineworkdelete':
    if (isset($id) && !empty($id)) {
      $setlinework->deleteClient("linework", $id);
    }
    break;
}
