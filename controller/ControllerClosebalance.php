<?php

include_once '../connect/conDB.php';
include_once '../model/Closebalance.class.php';

$closebalance = new Closebalance();

if (isset($_REQUEST['contract_id']) && !empty($_REQUEST['contract_id'])) {
  $contract_id = $_REQUEST['contract_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {

  case 'cancelclosebalance':
    if (isset($contract_id) && !empty($contract_id)) {
      $closebalance->cancelstatusClosebalanceClient("contract", $contract_id);
    }
    break;
}
