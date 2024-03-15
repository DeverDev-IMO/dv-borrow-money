<?php

include_once '../connect/conDB.php';
include_once '../model/Contract.class.php';

$contract = new Contract();

if (isset($_REQUEST['contract_id']) && !empty($_REQUEST['contract_id'])) {
  $id = $_REQUEST['contract_id'];
}
if (isset($_REQUEST['cusid']) && !empty($_REQUEST['contract_id'])) {
  $cusid = $_REQUEST['cusid'];
}

if (isset($_REQUEST['provinceID']) && !empty($_REQUEST['provinceID'])) {
  $provinceID = $_REQUEST['provinceID'];
}
if (isset($_REQUEST['amphurID']) && !empty($_REQUEST['amphurID'])) {
  $amphurID = $_REQUEST['amphurID'];
}
if (isset($_REQUEST['tumbonID']) && !empty($_REQUEST['tumbonID'])) {
  $tumbonID = $_REQUEST['tumbonID'];
}
if (isset($_REQUEST['querylist']) && !empty($_REQUEST['querylist'])) {
  $querylist = $_REQUEST['querylist'];
}
$data = $_POST;
$action = $_REQUEST['action'];
switch ($action) {
  case 'contractinsertdata':
    if (isset($data) && !empty($data)) {
      echo $contract->insertClient("contract", "customer", $data);
    }
    break;
  case 'contracteditdata':
    if (isset($id) && !empty($id)) {
      echo $contract->updateClient("contract", "customer", $data, $id);
    }
    break;
  case 'contractdelete':
    if (isset($id) && !empty($id)) {
      $contract->deleteClient("contract", $id);
    }
    break;

  case 'marrydetailinsertdata':
    if (isset($data) && !empty($data)) {
      // echo $contract->marrydetailinsertClient("contract", "marry_detail", $data);
      echo $contract->marrydetailinsertClient("marry_detail", $data);
    }
    break;
  case 'marrydetaileditdata':
    if (isset($id) && !empty($id)) {
      echo $contract->marrydetailupdateClient("contract", "marry_detail", $data, $id);
    }
    break;
  case 'contactemergencyinsertdata':
    if (isset($data) && !empty($data)) {
      echo $contract->contactemergencyinsertClient("contact_emergency", $data);
    }
    break;
  case 'contactemergencyeditdata':
    if (isset($id) && !empty($id)) {
      echo $contract->contactemergencyupdateClient("contract", "contact_emergency", $data, $id);
    }
    break;
  case 'guarantorinsertdata':
    if (isset($data) && !empty($data)) {
      echo $contract->guarantorinsertClient("guarantor", $data);
    }
    break;
  case 'guarantoreditdata':
    if (isset($id) && !empty($id)) {
      echo $contract->guarantorupdateClient("contract", "guarantor", $data, $id);
    }
    break;
  case 'cashloaninsertdata':
    if (isset($data) && !empty($data)) {
      echo $contract->cashloaninsertClient("cashloan", $data);
    }
    break;
  case 'cashloaneditdata':
    if (isset($id) && !empty($id)) {
      echo $contract->cashloanupdateClient("contract", "cashloan", $data, $id);
    }
    break;

  case 'amphurdata':
    if (isset($provinceID) && !empty($provinceID)) {
      echo json_encode($contract->getdataAmphures("amphures", $provinceID));
    }
    break;
  case 'tumbondata':
    if (isset($amphurID) && !empty($amphurID)) {
      echo json_encode($contract->getdataDistricts("districts", $amphurID));
    }
    break;
  case 'zipcodedata':
    if (isset($tumbonID) && !empty($tumbonID)) {
      echo json_encode($contract->getdataZipcode("districts", $tumbonID));
    }
    break;
  case 'selectgetdata':
    echo json_encode($contract->getdataInfo("linework"));
    break;


  case 'searchcardiddata':
    if (isset($querylist) && !empty($querylist)) {
      echo json_encode($contract->getdataCardid("customer", $querylist));
    }
    break;
  case 'selectgetdatacustomer':
    echo json_encode($contract->getdatacustomerInfo("customer"));
    break;

  case 'searchcardidguarantordata':
    if (isset($querylist) && !empty($querylist)) {
      echo json_encode($contract->getdataCardidGuarantor("customer", $querylist));
    }
    break;
  case 'selectgetdataguarantor':
    echo json_encode($contract->getdataguarantorInfo("guarantor"));
    break;
  case 'numbercontracteditdata':
    if (isset($id) && !empty($id)) {
      $contract->updatenumbercontractClient("contract", $data, $id);
    }
    break;
}
