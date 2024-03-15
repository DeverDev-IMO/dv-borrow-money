<?php

class Report extends Connect
{

  public function ContractReport($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN set_statusmarry ON setmar_id=cus_statusmarry
    LEFT JOIN set_statusaddress ON setadd_id=cus_statusaddress
    LEFT JOIN set_cohabiting ON setcoh_id=cus_cohabiting
    LEFT JOIN set_statuswork ON setwork_id=cus_statuswork
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id
    LEFT JOIN provinces ON province_id=cus_province
    LEFT JOIN amphures ON amphures_id=cus_district
    LEFT JOIN districts ON districts_id=cus_sub_district
    -- LEFT JOIN personnel ON contract_personnelhead_id=per_id
    WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetchAll(); 
  }
  public function ContractReport1($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN set_statusmarry ON setmar_id=cus_statusmarry
    LEFT JOIN set_statusaddress ON setadd_id=cus_statusaddress
    LEFT JOIN set_cohabiting ON setcoh_id=cus_cohabiting
    LEFT JOIN set_statuswork ON setwork_id=cus_statuswork
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id
    LEFT JOIN provinces ON province_id=cus_province_work
    LEFT JOIN amphures ON amphures_id=cus_district_work
    LEFT JOIN districts ON districts_id=cus_sub_district_work
    WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetchAll(); 
  }
  public function ContractMarryReport($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN set_prename ON setpre_id=marryd_prename
    LEFT JOIN set_statuswork ON setwork_id=marryd_statuswork
    LEFT JOIN provinces ON province_id=marryd_province
    LEFT JOIN amphures ON amphures_id=marryd_district
    LEFT JOIN districts ON districts_id=marryd_sub_district
    WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetchAll(); 
  }
  public function ContractEmergencyReport($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN set_prename ON setpre_id=coem_prename
    WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetchAll(); 
  }
  public function ContractGuarantorReport($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN set_prename ON setpre_id=guarantor_prename
    LEFT JOIN set_statusmarry ON setmar_id=guarantor_statusmarry
    LEFT JOIN set_statusaddress ON setadd_id=guarantor_statusaddress
    LEFT JOIN provinces ON province_id=guarantor_province
    LEFT JOIN amphures ON amphures_id=guarantor_district
    LEFT JOIN districts ON districts_id=guarantor_sub_district
    WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetchAll(); 
  }
  public function ContractCashloanReport($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetchAll(); 
  }
  public function DocumentcardReport($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN personnel ON contract_personnelhead_id=per_id
    WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function DocumentcardReportSub($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN personnel ON contract_personnelhenchman_id=per_id
    WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function listreportsalesClient($table, $date_start, $date_end)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN linework ON contract_linework_id=lw_id";
    if ($_POST['linework_id'] != '') {
      $sql .= " WHERE (cash_date_start BETWEEN :date_start AND :date_end) AND (contract_linework_id=:linework_id) AND contract_status_cancel = 1";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":date_start", $date_start);
      $statement->bindValue(":date_end", $date_end);
      $statement->bindValue(":linework_id", $_POST['linework_id']);
      $statement->execute();
    } else {
      $sql .= " WHERE contract_status_cancel = 1 AND cash_date_start BETWEEN :date_start AND :date_end";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":date_start", $date_start);
      $statement->bindValue(":date_end", $date_end);
      $statement->execute();
    }
    return $statement->fetchAll();
  }
  public function listreportclosebalanceClient($table, $date_start, $date_end)
  {
    // $pdo = parent::getInstance();
    // $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    // LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    // LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    // LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    // LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    // LEFT JOIN set_prename ON cus_prename=setpre_id 
    // LEFT JOIN linework ON contract_linework_id=lw_id
    // WHERE cash_date_start BETWEEN :date_start AND :date_end
    // ORDER BY contract_id DESC";
    // $statement = $pdo->prepare($sql);
    // $statement->bindValue(":date_start", $date_start);
    // $statement->bindValue(":date_end", $date_end);
    // $statement->execute();
    // return $statement->fetchAll();
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN linework ON contract_linework_id=lw_id";
    if ($_POST['linework_id'] != '') {
      $sql .= " WHERE (contract_date_closebalance BETWEEN :date_start AND :date_end) AND (contract_linework_id=:linework_id) AND (contract_status_closebalance=1)";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":date_start", $date_start);
      $statement->bindValue(":date_end", $date_end);
      $statement->bindValue(":linework_id", $_POST['linework_id']);
      $statement->execute();
    } else {
      $sql .= " WHERE (contract_date_closebalance BETWEEN :date_start AND :date_end) AND (contract_status_closebalance=1)";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":date_start", $date_start);
      $statement->bindValue(":date_end", $date_end);
      $statement->execute();
    }
    return $statement->fetchAll();
  }

  // public function listreportcollectClient($table, $date_start, $date_end)
  // {
  //   $pdo = parent::getInstance();
  //   $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
  //   LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
  //   LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
  //   LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
  //   LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
  //   LEFT JOIN set_prename ON cus_prename=setpre_id 
  //   LEFT JOIN linework ON contract_linework_id=lw_id
  //   LEFT JOIN payments_summarize ON contract_id=paysum_contract_id
  //   ";
  //   if ($_POST['linework_id'] != '') {
  //     $sql .= " WHERE (cash_date_start BETWEEN :date_start AND :date_end) AND (contract_linework_id=:linework_id) AND contract_status_cancel = 1";
  //     $sql .= " ORDER BY contract_id DESC";
  //     $statement = $pdo->prepare($sql);
  //     $statement->bindValue(":date_start", $date_start);
  //     $statement->bindValue(":date_end", $date_end);
  //     $statement->bindValue(":linework_id", $_POST['linework_id']);
  //     $statement->execute();
  //   } else {
  //     $sql .= " WHERE contract_status_cancel = 1 AND cash_date_start BETWEEN :date_start AND :date_end";
  //     $sql .= " ORDER BY contract_id DESC";
  //     $statement = $pdo->prepare($sql);
  //     $statement->bindValue(":date_start", $date_start);
  //     $statement->bindValue(":date_end", $date_end);
  //     $statement->execute();
  //   }
  //   return $statement->fetchAll();
  // }
  public function listreportcollectClient($table, $date_start, $date_end)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN linework ON contract_linework_id=lw_id
    LEFT JOIN payments_summarize ON contract_id=paysum_contract_id
    ";
    if ($_POST['linework_id'] != '') {
      $sql .= " WHERE (contract_linework_id=:linework_id) AND contract_status_cancel = 1";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      // $statement->bindValue(":date_start", $date_start);
      // $statement->bindValue(":date_end", $date_end);
      $statement->bindValue(":linework_id", $_POST['linework_id']);
      $statement->execute();
    } else {
      $sql .= " WHERE contract_status_cancel = 1";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      // $statement->bindValue(":date_start", $date_start);
      // $statement->bindValue(":date_end", $date_end);
      $statement->execute();
    }
    return $statement->fetchAll();
  }
  public function listreportcollectClientSub($table, $date_start, $date_end, $id) //รวมยอดเก็บ ระหว่างวันที่
  {
    $pdo = parent::getInstance();
    $sqlsumpay = "SELECT SUM(pay_number_money) as sumPaymentCollectionAmount FROM payments WHERE (pay_contract_id=:pay_contract_id) AND (pay_date BETWEEN :date_start AND :date_end)";
    $statementsumpay = $pdo->prepare($sqlsumpay);
    $statementsumpay->bindValue(":pay_contract_id", $id);
    $statementsumpay->bindValue(":date_start", $date_start);
    $statementsumpay->bindValue(":date_end", $date_end);
    // $statementsumpay->bindValue(":date_start", '2023-09-01');
    // $statementsumpay->bindValue(":date_end", '2023-09-30');
    $statementsumpay->execute();
    return $statementsumpay->fetch(PDO::FETCH_ASSOC);
  }
  public function listreportdailyClient($table, $date)
  {
    // $dateToday = date("Y-m-d");

    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN linework ON contract_linework_id=lw_id
    LEFT JOIN payments_summarize ON contract_id=paysum_contract_id";
    if ($_POST['linework_id'] != '') {
      // $sql .= " WHERE (contract_linework_id=:linework_id)";
      $sql .= " WHERE (contract_linework_id=:linework_id) AND (:dateselect >= cash_date_start) AND contract_status_cancel = 1";
      // $sql .= " WHERE (contract_linework_id=:linework_id) AND (:dateselect >= cash_date_start) AND (contract_status_closebalance=0)";
    } else {
      $sql .= " WHERE contract_status_cancel = 1";
    }

    $sql .= " ORDER BY contract_id ASC";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":linework_id", $_POST['linework_id']);
    // $statement->bindValue(":linework_id", '11');
    $statement->bindValue(":dateselect", $date);
    // $statement->bindValue(":dateselect", '2023-09-12');
    $statement->execute();
    return $statement->fetchAll();
  }
  public function getInfoLinework($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE lw_id=:lw_id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":lw_id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoChkpayday($table, $id, $day, $month)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE DAY(pay_date) = :daypay and MONTH(pay_date) = :monthpay and pay_contract_id =:contract_id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":daypay", $day);
    $statement->bindValue(":monthpay", $month);
    $statement->bindValue(":contract_id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getInfoPaymentAmount($id) //ยอดชำระเเล้ว
  {
    $pdo = parent::getInstance();
    $sqlsumpay = "SELECT SUM(pay_number_money) as sumPaymentAmount FROM payments WHERE pay_contract_id=:pay_contract_id";
    $statementsumpay = $pdo->prepare($sqlsumpay);
    $statementsumpay->bindValue(":pay_contract_id", $id);
    $statementsumpay->execute();
    return $statementsumpay->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoClosingTrue($table, $id) //ยอดปิดวันสุดท้าย
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE pay_contract_id = :id ORDER BY pay_id DESC limit 1";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function listreportDebtorType1($table, $date_start, $date_end)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN linework ON contract_linework_id=lw_id
    LEFT JOIN payments_summarize ON contract_id=paysum_contract_id
    ";
    if ($_POST['linework_id'] != '') {
      $sql .= " WHERE (contract_linework_id=:linework_id) AND contract_status_cancel = 1";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      // $statement->bindValue(":date_start", $date_start);
      // $statement->bindValue(":date_end", $date_end);
      $statement->bindValue(":linework_id", $_POST['linework_id']);
      $statement->execute();
    } else {
      $sql .= " WHERE contract_status_cancel = 1";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      // $statement->bindValue(":date_start", $date_start);
      // $statement->bindValue(":date_end", $date_end);
      $statement->execute();
    }
    return $statement->fetchAll();
  }
  public function listreportDebtorType3($table, $date_start, $date_end) //ลูกหนี้หมดสัญญา
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN linework ON contract_linework_id=lw_id
    LEFT JOIN payments_summarize ON contract_id=paysum_contract_id
    ";
    if ($_POST['linework_id'] != '') {
      $sql .= " WHERE (cash_date_end BETWEEN :date_start AND :date_end) AND (contract_linework_id=:linework_id) AND contract_status_cancel = 1";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":date_start", $date_start);
      $statement->bindValue(":date_end", $date_end);
      $statement->bindValue(":linework_id", $_POST['linework_id']);
      $statement->execute();
    } else {
      $sql .= " WHERE (cash_date_end BETWEEN :date_start AND :date_end) AND contract_status_cancel = 1";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":date_start", $date_start);
      $statement->bindValue(":date_end", $date_end);
      $statement->execute();
    }
    return $statement->fetchAll();
  }
  public function listreportDebtorType5($table, $date_start, $date_end) //ลูกหนี้หมดสัญญา
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN linework ON contract_linework_id=lw_id
    LEFT JOIN payments_summarize ON contract_id=paysum_contract_id
    ";
    if ($_POST['linework_id'] != '') {
      $sql .= " WHERE (cash_date_start BETWEEN :date_start AND :date_end) AND (contract_linework_id=:linework_id) AND contract_status_cancel = 1 AND contract_status_closebalance=0";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":date_start", $date_start);
      $statement->bindValue(":date_end", $date_end);
      $statement->bindValue(":linework_id", $_POST['linework_id']);
      $statement->execute();
    } else {
      $sql .= " WHERE (cash_date_start BETWEEN :date_start AND :date_end) AND contract_status_cancel = 1 AND contract_status_closebalance=0";
      $sql .= " ORDER BY contract_id DESC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":date_start", $date_start);
      $statement->bindValue(":date_end", $date_end);
      $statement->execute();
    }
    return $statement->fetchAll();
  }
}
