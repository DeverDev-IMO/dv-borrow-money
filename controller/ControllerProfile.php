<?php

include_once '../connect/conDB.php';
include_once '../model/Profile.class.php';

$profile = new Profile();

$id = $_SESSION['sess_id'];
$data = $_POST;
$action = $_REQUEST['action'];

switch ($action) {
  case 'profileeditdata':
    if (isset($id) && !empty($id)) {
      $profile->updateClient("users", $data, $id);
    }
    break;
  case 'passwordeditdata':
    if (isset($id) && !empty($id)) {
      $data = $profile->updatepasswordClient("users", $data, $id);
      echo $data;
    }
    break;
  case 'selectgetdata':
    echo json_encode($profile->getdataInfo("agency"));
    break;
}
