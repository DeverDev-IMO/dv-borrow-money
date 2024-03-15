<?php

include_once '../connect/conDB.php';
include_once '../model/Payments.class.php';

$payments = new Payments();

if (isset($_REQUEST['per_id']) && !empty($_REQUEST['per_id'])) {
  $id = $_REQUEST['per_id'];
}
if (isset($_REQUEST['contract_id']) && !empty($_REQUEST['contract_id'])) {
  $contract_id = $_REQUEST['contract_id'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'paymentsfetchdata':
    // if (isset($data) && !empty($data)) {
    echo json_encode($payments->listClient("contract"));

    // }
    break;
    // case 'paymentssearchdata':
    //   // if (isset($data) && !empty($data)) {
    //   echo json_encode($payments->listSearchClient("contract"));

    //   // }
    //   break;
  case 'paymentsinsertdata':
    if (isset($data) && !empty($data)) {
      // echo $payments->insertClient("payments", $data);
      echo json_encode($payments->insertClient("payments", $data));
    }
    break;
    // case 'paymentseditdata':
    //   if (isset($id) && !empty($id)) {
    //     $payments->updateClient("payments", $data, $id);
    //   }
    //   break;
    // case 'paymentsdelete':
    //   if (isset($id) && !empty($id)) {
    //     $payments->deleteClient("payments", $id);
    //   }
    //   break;

  case 'paymentsshowcontractdata':
    echo json_encode($payments->listShowContractClient("contract"));
    break;
  case 'paymentsconfirmclosebalance':
    if (isset($contract_id) && !empty($contract_id)) {
      $payments->statusClosebalanceClient("contract", $contract_id, $_REQUEST['dateclosebalance']);
    }
    break;
}
