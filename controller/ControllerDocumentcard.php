<?php

include_once '../connect/conDB.php';
include_once '../model/Documentcard.class.php';

$documentcard = new Documentcard();

if (isset($_REQUEST['contract_id']) && !empty($_REQUEST['contract_id'])) {
  $id = $_REQUEST['contract_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'documentcardinsertdata':
    if (isset($data) && !empty($data)) {
      $documentcard->insertClient("contract", $data);
    }
    break;
  case 'documentcardeditdata':
    if (isset($id) && !empty($id)) {
      $documentcard->updateClient("contract", $data, $id);
    }
    break;
  case 'documentcarddelete':
    if (isset($id) && !empty($id)) {
      $documentcard->deleteClient("contract", $id);
    }
    break;
}
