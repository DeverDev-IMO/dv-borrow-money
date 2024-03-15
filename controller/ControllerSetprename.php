<?php

include_once '../connect/conDB.php';
include_once '../model/Setprename.class.php';

$setprename = new Setprename();

if (isset($_REQUEST['setpre_id']) && !empty($_REQUEST['setpre_id'])) {
  $id = $_REQUEST['setpre_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'setprenameinsertdata':
    if (isset($data) && !empty($data)) {
      $setprename->insertClient("set_prename", $data);
    }
    break;
  case 'setprenameeditdata':
    if (isset($id) && !empty($id)) {
      $setprename->updateClient("set_prename", $data, $id);
    }
    break;
  case 'setprenamedelete':
    if (isset($id) && !empty($id)) {
      $setprename->deleteClient("set_prename", $id);
    }
    break;
}
