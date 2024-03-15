<?php

class Payments extends Connect
{
  public function listClient($table)
  {
    // $pdo = parent::getInstance();
    // $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    // LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    // LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    // LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    // LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    // LEFT JOIN set_prename ON cus_prename=setpre_id 
    // ORDER BY contract_id DESC";
    // $statement = $pdo->query($sql);
    // $statement->execute();
    // return $statement->fetchAll();

    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    ORDER BY contract_id ASC";
    $statement = $pdo->query($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
      $data[] = $row;
    }
    return $data;
    // $data = ['name' => 'John', 'age' => 35];
    // return json_encode($data);
  }
  public function listSearchClient($table, $date, $lineworkid)
  {
    // $pdo = parent::getInstance();
    // $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    // LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    // LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    // LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    // LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    // LEFT JOIN set_prename ON cus_prename=setpre_id 
    // WHERE contract_linework_id=:payments_linework_id
    // ORDER BY contract_id DESC";
    // $statement = $pdo->prepare($sql);
    // $statement->bindValue(":payments_linework_id", $_POST['payments_linework_id']);
    // $statement->execute();
    // $result = $statement->fetchAll();
    // foreach ($result as $row) {
    //   $data[] = $row;
    // }
    // return $data;

    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    WHERE contract_linework_id=:payments_linework_id AND contract_status_cancel = 1";
    $sql .= " ORDER BY contract_id ASC";
    $statement = $pdo->prepare($sql);
    // $statement->bindValue(":payments_linework_id", $_POST['payments_linework_id']);
    $statement->bindValue(":payments_linework_id", $lineworkid);
    $statement->execute();
    return $statement->fetchAll();
  }
  public function listShowContractClient($table) //jquery show list customer
  {
    // $pdo = parent::getInstance();
    // $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    // LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    // LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    // LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    // LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    // LEFT JOIN set_prename ON cus_prename=setpre_id 
    // LEFT JOIN payments ON pay_contract_id=contract_id 
    // WHERE contract_id=:contract_id AND pay_date=:pay_date";
    // $sql .= " ORDER BY contract_id ASC";
    // $statement = $pdo->prepare($sql);
    // $statement->bindValue(":contract_id", $_POST['contract_id']);
    // $statement->bindValue(":pay_date", $_POST['payments_date_end']);
    // $statement->execute();
    // $result = $statement->fetchAll();
    $pdo = parent::getInstance();
    ///////////////////หาตาราง payments ว่ามีไหม/////////////////
    $sqlchkpay = "SELECT COUNT(*) as chkpay FROM payments WHERE pay_contract_id=:pay_contract_id AND pay_date=:pay_date";
    $statementchkpay = $pdo->prepare($sqlchkpay);
    $statementchkpay->bindValue(":pay_contract_id", $_REQUEST['contract_id']);
    $statementchkpay->bindValue(":pay_date", $_REQUEST['payments_date_end']);
    $statementchkpay->execute();
    $datachkpay = $statementchkpay->fetch(PDO::FETCH_ASSOC);
    /////////////////////////////////////////////////////////////
    // $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    //   LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    //   LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    //   LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    //   LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    //   LEFT JOIN set_prename ON cus_prename=setpre_id 
    //   LEFT JOIN payments ON pay_contract_id=contract_id 
    //   LEFT JOIN payments_summarize ON paysum_contract_id=contract_id 
    //   WHERE contract_id=:contract_id";
    // $sql .= " ORDER BY contract_id ASC";
    // $statement = $pdo->prepare($sql);
    // $statement->bindValue(":contract_id", $_POST['contract_id']);
    // $statement->execute();
    if ($datachkpay['chkpay'] > 0) {
      $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
      LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
      LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
      LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
      LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
      LEFT JOIN set_prename ON cus_prename=setpre_id 
      LEFT JOIN payments ON pay_contract_id=contract_id 
      LEFT JOIN payments_summarize ON paysum_contract_id=contract_id 
      WHERE contract_id=:contract_id AND pay_date=:pay_date AND contract_status_cancel = 1";
      $sql .= " ORDER BY contract_id ASC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":contract_id", $_POST['contract_id']);
      $statement->bindValue(":pay_date", $_POST['payments_date_end']);
      $statement->execute();
    } else {
      $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
      LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
      LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
      LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
      LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
      LEFT JOIN set_prename ON cus_prename=setpre_id 
      LEFT JOIN payments ON pay_contract_id=contract_id 
      LEFT JOIN payments_summarize ON paysum_contract_id=contract_id 
      WHERE contract_id=:contract_id AND contract_status_cancel = 1 GROUP BY pay_contract_id";
      $sql .= " ORDER BY contract_id ASC";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":contract_id", $_POST['contract_id']);
      $statement->execute();
    }

    $result = $statement->fetchAll();
    foreach ($result as $row) {
      $data[] = $row;
    }
    return $data;
  }
  public function insertClient($table, $data)
  {
    $pdo = parent::getInstance();
    ////////////////////////ข้อมูลผู้กู้///////////////////////
    $sqldatacont = "SELECT * FROM contract LEFT JOIN customer ON contract_customer_id=cus_id 
      LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
      LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
      LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
      LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
      WHERE contract_id=:contract_id";
    $statementdatacont = $pdo->prepare($sqldatacont);
    $statementdatacont->bindValue(":contract_id", $data['contract_id']);
    $statementdatacont->execute();
    $datadatacont = $statementdatacont->fetch(PDO::FETCH_ASSOC);
    ///////////////////////////////////////////////

    ///////////////////หาตาราง payments_summarize ว่ามีไหม/////////////////
    // $sqlchkpaysum = "SELECT * FROM linework WHERE lw_id = :id";
    $sqlchkpaysum = "SELECT COUNT(*) as chkpaysum FROM payments_summarize WHERE paysum_contract_id=:paysum_contract_id";
    $statementchkpaysum = $pdo->prepare($sqlchkpaysum);
    $statementchkpaysum->bindValue(":paysum_contract_id", $data['contract_id']);
    $statementchkpaysum->execute();
    $datachkpaysum = $statementchkpaysum->fetch(PDO::FETCH_ASSOC);
    ////////////////////////////////////////////////////////////////////
    ///////////////////หาตาราง payments ว่ามีไหม/////////////////
    $sqlchkpay = "SELECT COUNT(*) as chkpay FROM payments WHERE pay_contract_id=:pay_contract_id AND pay_date=:pay_date";
    $statementchkpay = $pdo->prepare($sqlchkpay);
    $statementchkpay->bindValue(":pay_contract_id", $data['contract_id']);
    $statementchkpay->bindValue(":pay_date", $data['payments_date_end']);
    $statementchkpay->execute();
    $datachkpay = $statementchkpay->fetch(PDO::FETCH_ASSOC);
    ////////////////////////////////////////////////////////////////////


    if ($datachkpay['chkpay'] > 0) { //เช็คตารางว่ามี row ไหม
      $sql1 = "UPDATE payments SET pay_number_money=:pay_number_money
      WHERE pay_contract_id=:pay_contract_id AND pay_date=:pay_date";
      $statement1 = $pdo->prepare($sql1);
      $statement1->execute(array(
        'pay_contract_id' => $data['contract_id'],
        'pay_date' => $data['payments_date_end'],
        'pay_number_money' => $data['pay_number_money']
      ));
    } else {
      $sql = "INSERT INTO payments SET pay_number_money=:pay_number_money,
        pay_date=:pay_date,
        pay_contract_id=:pay_contract_id,
        pay_status=1
        ";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(":pay_number_money", $data['pay_number_money']);
      $statement->bindValue(":pay_date", $data['payments_date_end']);
      $statement->bindValue(":pay_contract_id", $data['contract_id']);
      $statement->execute();
    }


    ///////////////////หาตาราง payments มีจำนวนเท่าไหร่/////////////////
    $sqlchkpayall = "SELECT COUNT(*) as chkpayall FROM payments WHERE pay_contract_id=:pay_contract_id";
    $statementchkpayall = $pdo->prepare($sqlchkpayall);
    $statementchkpayall->bindValue(":pay_contract_id", $data['contract_id']);
    $statementchkpayall->execute();
    $datachkpayall = $statementchkpayall->fetch(PDO::FETCH_ASSOC);
    ////////////////////////////////////////////////////////////////////
    /////////////////////////////รวมยอดชำระเงิน//////////////////////////////////
    $sqlsumpay = "SELECT SUM(pay_number_money) as sum_rows FROM payments WHERE pay_contract_id=:pay_contract_id";
    $statementsumpay = $pdo->prepare($sqlsumpay);
    $statementsumpay->bindValue(":pay_contract_id", $data['contract_id']);
    $statementsumpay->execute();
    $sumnumbermoney =  $statementsumpay->fetch(PDO::FETCH_ASSOC);
    ///////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////
    $paysumpaybalance = ($datadatacont['cash_principle'] + $datadatacont['cash_interest']) - $sumnumbermoney['sum_rows'];

    if ($datachkpaysum['chkpaysum'] > 0) { //เช็คตารางว่ามี row ไหม
      $sqlsum = "UPDATE payments_summarize SET  
      paysum_pay_amount=:paysum_pay_amount,
      paysum_pay_installment=:paysum_pay_installment,
      paysum_pay_balance=:paysum_pay_balance
      WHERE paysum_contract_id=:paysum_contract_id";
      $statementsum = $pdo->prepare($sqlsum);
      $statementsum->execute(array(
        'paysum_contract_id' => $data['contract_id'],
        'paysum_pay_amount' => $sumnumbermoney['sum_rows'],
        'paysum_pay_installment' => $datachkpayall['chkpayall'],
        'paysum_pay_balance' => $paysumpaybalance
      ));
    } else {
      $sqlsum = "INSERT INTO payments_summarize SET paysum_contract_id=:paysum_contract_id,
        paysum_pay_amount=:paysum_pay_amount,
        paysum_pay_installment=:paysum_pay_installment,
        paysum_pay_balance=:paysum_pay_balance
        ";
      $statementsum = $pdo->prepare($sqlsum);
      $statementsum->bindValue(":paysum_contract_id", $data['contract_id']);
      $statementsum->bindValue(":paysum_pay_amount", $sumnumbermoney['sum_rows']);
      $statementsum->bindValue(":paysum_pay_installment", $datachkpayall['chkpayall']);
      $statementsum->bindValue(":paysum_pay_balance", $paysumpaybalance);
      $statementsum->execute();
    }


    $sqlnextcontract = "SELECT * FROM contract WHERE contract_id > :contract_id AND contract_linework_id=:contract_linework_id AND (contract_status_closebalance!=1) AND (contract_status_cancel=1) ORDER BY contract_id ASC limit 1";
    $lastidnextcontract = $pdo->prepare($sqlnextcontract);
    $lastidnextcontract->bindValue(":contract_id", $data['contract_id']);
    $lastidnextcontract->bindValue(":contract_linework_id", $data['payments_linework_id']);
    $lastidnextcontract->execute();
    $dataidnextcontract =  $lastidnextcontract->fetch(PDO::FETCH_ASSOC);

    $sqlshownextcont = "SELECT * FROM contract LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN payments ON pay_contract_id=contract_id 
    LEFT JOIN payments_summarize ON paysum_contract_id=contract_id 
    WHERE (contract_id=:contract_id)";
    $sqlshownextcont .= " ORDER BY contract_id ASC";
    $statementshownextcont = $pdo->prepare($sqlshownextcont);
    $statementshownextcont->bindValue(":contract_id", $dataidnextcontract['contract_id']);
    $statementshownextcont->execute();
    $resultshownextcont = $statementshownextcont->fetch(PDO::FETCH_ASSOC);

    return $resultshownextcont;
    // return $dataidnextcontract['contract_id'];
  }
  public function listPaymentsClient($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table 
    WHERE pay_contract_id=:id
    ORDER BY pay_date DESC";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function getInfoDetailpaymentsForm($table, $id)
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
    WHERE contract_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoPaymentAmount($table, $id) //ยอดชำระเเล้ว
  {
    $pdo = parent::getInstance();
    $sqlsumpay = "SELECT SUM(pay_number_money) as sumPaymentAmount FROM payments WHERE pay_contract_id=:pay_contract_id";
    $statementsumpay = $pdo->prepare($sqlsumpay);
    $statementsumpay->bindValue(":pay_contract_id", $id);
    $statementsumpay->execute();
    return $statementsumpay->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoPaymentCount($table, $id) //จำนวนงวดที่ชำระ
  {
    $pdo = parent::getInstance();
    $sql = "SELECT COUNT(pay_id) as countPayment FROM payments WHERE pay_contract_id=:pay_contract_id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":pay_contract_id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function listLineworkClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY lw_id ASC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
  public function getInfoPaidBalance($table, $id, $date) //รวมยอดชำระเงินรายวัน
  {
    $pdo = parent::getInstance();
    $sqlsumpay = "SELECT * FROM $table 
    WHERE pay_contract_id=:pay_contract_id AND pay_date=:pay_date";
    $statementsumpay = $pdo->prepare($sqlsumpay);
    $statementsumpay->bindValue(":pay_contract_id", $id);
    // $statementsumpay->bindValue(":pay_date", $date);
    $statementsumpay->bindValue(":pay_date", $date);
    $statementsumpay->execute();
    return $statementsumpay->fetch(PDO::FETCH_ASSOC);
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
  public function getInfoPayStatus($table, $id, $date)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE pay_contract_id=:pay_contract_id AND pay_date=:pay_date";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":pay_contract_id", $id);
    $statement->bindValue(":pay_date", $date);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoNumInstallment($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE paysum_contract_id=:paysum_contract_id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":paysum_contract_id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoTotalPayment($table, $date, $lineworkid) //ยอดรวมชำระเเล้ว
  {
    $pdo = parent::getInstance();
    $sqlsumpay = "SELECT SUM(pay_number_money) as sumTotalPaymentDate FROM $table LEFT JOIN contract ON pay_contract_id=contract_id 
    WHERE pay_date=:pay_date and contract_linework_id=:contract_linework_id";
    $statementsumpay = $pdo->prepare($sqlsumpay);
    $statementsumpay->bindValue(":pay_date", $date);
    $statementsumpay->bindValue(":contract_linework_id", $lineworkid);
    $statementsumpay->execute();
    return $statementsumpay->fetch(PDO::FETCH_ASSOC);
  }

  public function statusClosebalanceClient($table, $id, $dateclosebalance)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table SET  contract_status_closebalance=:contract_status_closebalance,contract_date_closebalance=:contract_date_closebalance WHERE contract_id=:contract_id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'contract_id' => $id,
      'contract_status_closebalance' => 1,
      'contract_date_closebalance' => $dateclosebalance
    ));
  }
}
