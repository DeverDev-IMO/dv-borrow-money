<?php

include_once '../connect/conDB.php';
include_once '../model/Personnel.class.php';

$personnel = new Personnel();

if (isset($_REQUEST['per_id']) && !empty($_REQUEST['per_id'])) {
  $id = $_REQUEST['per_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'personnelinsertdata':
    if (isset($data) && !empty($data)) {
      $personnel->insertClient("personnel", $data);
    }
    break;
  case 'personneleditdata':
    if (isset($id) && !empty($id)) {
      $personnel->updateClient("personnel", $data, $id);
    }
    break;
  case 'personneldelete':
    if (isset($id) && !empty($id)) {
      $personnel->deleteClient("personnel", $id);
    }
    break;
}
