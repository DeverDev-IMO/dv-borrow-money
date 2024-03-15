<?php

include_once '../connect/conDB.php';
include_once '../model/Users.class.php';

$users = new Users();

if (isset($_REQUEST['u_id']) && !empty($_REQUEST['u_id'])) {
  $id = $_REQUEST['u_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'usersinsertdata':
    if (isset($data) && !empty($data)) {
      $users->insertClient("users", $data);
    }
    // echo $userstype->insertClient("users_type", $data);
    break;
  case 'userseditdata':
    if (isset($id) && !empty($id)) {
      $users->updateClient("users", $data, $id);
    }
    break;
  case 'usersdelete':
    if (isset($id) && !empty($id)) {
      $users->deleteClient("users", $id);
    }
    break;
  case 'selectgetdata':
    echo json_encode($users->getdataInfo("agency"));
    break;
}
