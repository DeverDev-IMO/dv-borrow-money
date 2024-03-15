<?php
include_once '../connect/conDB.php';
include_once '../model/Home.class.php';

$home = new Home();

$data = $_POST;
$action = $_REQUEST['action'];
if (isset($_REQUEST['textusername'])) {
  $username = $_REQUEST['textusername'];
  $password = $_REQUEST['textpassword'];
}

switch ($action) {
  case 'getlogin':
    $data = $home->checkLogin("users", $username, $password);
    // echo $data['per_firstname'];
    echo $data;
    break;
  case 'getlogout':
    session_destroy(); //destroy the session
    break;
  case 'getregister':
    $data = $home->checkRegister("users", $data);
    // echo $data['per_firstname'];
    echo $data;
    break;
  case 'selectgetdata':
    echo json_encode($home->getdataInfo("agency"));
    break;
}
