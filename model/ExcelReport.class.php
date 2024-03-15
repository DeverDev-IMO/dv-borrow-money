<?php

class ExcelReport extends Connect
{
  public function listlinework($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY lw_code ASC";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
  public function getInfocurrentSales($table, $id, $date_start, $date_end)
  { //ยอดขายปัจจุบัน
    $pdo = parent::getInstance();
    // $sql = "SELECT SUM(cash_principle) as cashprinciple , SUM(cash_interest) as cashinterest FROM $table 
    // LEFT JOIN customer ON contract_customer_id=cus_id 
    // LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    // WHERE contract_linework_id=:lw_id";
    $sql = "SELECT SUM(cash_principle + cash_interest) as summarizesales FROM $table 
    LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    WHERE contract_linework_id=:lw_id AND (contract_created_at BETWEEN :date_start AND :date_end)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":date_start", $date_start);
    $statement->bindValue(":date_end", $date_end);
    $statement->bindValue(":lw_id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoOldcustomer($table, $id, $date_start, $date_end) ////ลูกค้าเก่า
  { //ลูกค้าเก่า
    $pdo = parent::getInstance();
    // $sql = "SELECT cus_card_id, COUNT(cus_card_id) as numoldcustomer
    // FROM $table LEFT JOIN customer ON contract_customer_id=cus_id
    // WHERE contract_linework_id=:lw_id
    // GROUP BY cus_card_id HAVING COUNT(cus_card_id) > 1";
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    WHERE contract_linework_id=:lw_id AND (contract_created_at BETWEEN :date_start AND :date_end) GROUP BY cus_card_id HAVING COUNT(cus_card_id) > 1";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":date_start", $date_start);
    $statement->bindValue(":date_end", $date_end);
    $statement->bindValue(":lw_id", $id);
    $statement->execute();
    // return $statement->fetch(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
  }
  public function salesOldcustomer($table, $id, $date_start, $date_end) //ยอดขายลูกค้าเก่า
  { //ยอดขายลูกค้าเก่า
    // $pdo = parent::getInstance();
    // $sql = "SELECT SUM(cash_principle + cash_interest) as sumsalesOldcus FROM $table 
    // LEFT JOIN customer ON contract_customer_id=cus_id 
    // LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    // WHERE contract_linework_id=:lw_id AND (contract_created_at BETWEEN :date_start AND :date_end) AND contract_id=:contract_id";
    // $statement = $pdo->prepare($sql);
    // $statement->bindValue(":date_start", $date_start);
    // $statement->bindValue(":date_end", $date_end);
    // $statement->bindValue(":lw_id", $id);
    // $statement->bindValue(":contract_id", $contractid);
    // $statement->execute();
    // return $statement->fetch(PDO::FETCH_ASSOC);
    $pdo = parent::getInstance();
    $sql = "SELECT SUM(cash_principle + cash_interest) as sumsalesOldcus FROM $table LEFT JOIN customer ON contract_customer_id=cus_id LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    WHERE contract_linework_id=:lw_id AND (contract_created_at BETWEEN :date_start AND :date_end) GROUP BY cus_card_id HAVING COUNT(cus_card_id) > 1";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":date_start", $date_start);
    $statement->bindValue(":date_end", $date_end);
    $statement->bindValue(":lw_id", $id);
    $statement->execute();
    // return $statement->fetch(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
  }
  public function getInfoNewcustomer($table, $id, $date_start, $date_end) //ลูกค้าใหม่
  { //ลูกค้าใหม่
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id WHERE contract_linework_id=:lw_id AND (contract_created_at BETWEEN :date_start AND :date_end) GROUP BY cus_card_id HAVING COUNT(cus_card_id) = 1";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":date_start", $date_start);
    $statement->bindValue(":date_end", $date_end);
    $statement->bindValue(":lw_id", $id);
    $statement->execute();
    // return $statement->fetch(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
  }
  public function salesNewcustomer($table, $id, $date_start, $date_end) //ยอดขายลูกค้าใหม่
  { //ยอดขายลูกค้าใหม่

    $pdo = parent::getInstance();
    $sql = "SELECT SUM(cash_principle + cash_interest) as sumsalesNewcus FROM $table LEFT JOIN customer ON contract_customer_id=cus_id LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    WHERE contract_linework_id=:lw_id AND (contract_created_at BETWEEN :date_start AND :date_end) GROUP BY cus_card_id HAVING COUNT(cus_card_id) = 1";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":date_start", $date_start);
    $statement->bindValue(":date_end", $date_end);
    $statement->bindValue(":lw_id", $id);
    $statement->execute();
    // return $statement->fetch(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
  }

  public function listreportcollectClient($table, $date_start, $date_end, $id) //รวมยอดเก็บ ระหว่างวันที่
  {
    $pdo = parent::getInstance();
    $sqlsumpay = "SELECT SUM(pay_number_money) as sumPaymentCollectionAmount 
    FROM $table LEFT JOIN payments ON contract_id=pay_contract_id 
    WHERE (contract_linework_id=:lw_id) AND (pay_date BETWEEN :date_start AND :date_end)";
    $statementsumpay = $pdo->prepare($sqlsumpay);
    $statementsumpay->bindValue(":lw_id", $id);
    $statementsumpay->bindValue(":date_start", $date_start);
    $statementsumpay->bindValue(":date_end", $date_end);
    // $statementsumpay->bindValue(":date_start", '2023-09-01');
    // $statementsumpay->bindValue(":date_end", '2023-09-30');
    $statementsumpay->execute();
    return $statementsumpay->fetch(PDO::FETCH_ASSOC);
  }
  public function listreportclosebalanceClient($table, $date_start, $date_end, $id)
  {
    $pdo = parent::getInstance();
    $sqlsumpay = "SELECT SUM(pay_number_money) as sumclosingnumber
    FROM $table LEFT JOIN payments ON contract_id=pay_contract_id 
    WHERE (contract_linework_id=:lw_id) AND (contract_date_closebalance BETWEEN :date_start AND :date_end)";
    $statementsumpay = $pdo->prepare($sqlsumpay);
    $statementsumpay->bindValue(":lw_id", $id);
    $statementsumpay->bindValue(":date_start", $date_start);
    $statementsumpay->bindValue(":date_end", $date_end);
    $statementsumpay->execute();
    return $statementsumpay->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoNumberPerson($table, $date_start, $date_end, $id) //สรุปยอดปิด จำนวนคน
  {
    $pdo = parent::getInstance();
    $sql = "SELECT COUNT(contract_id) as countNumberPerson FROM $table
    WHERE (contract_linework_id=:lw_id) AND (contract_date_closebalance BETWEEN :date_start AND :date_end) AND (contract_status_closebalance=1) AND (contract_status_cancel=1)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":lw_id", $id);
    $statement->bindValue(":date_start", $date_start);
    $statement->bindValue(":date_end", $date_end);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function listPersonCloseBalance($table, $date_start, $date_end, $id) //หาคนปิด
  {
    $pdo = parent::getInstance();
    $sql = "SELECT *  FROM $table 
    WHERE (contract_linework_id=:lw_id) AND (contract_date_closebalance BETWEEN :date_start AND :date_end) AND (contract_status_closebalance=1) AND (contract_status_cancel=1)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":lw_id", $id);
    $statement->bindValue(":date_start", $date_start);
    $statement->bindValue(":date_end", $date_end);
    $statement->execute();
    return $statement->fetchAll();
  }
  // public function getInfoClosingTrue($table, $id) //ยอดปิดวันสุดท้าย
  // {
  //   $pdo = parent::getInstance();
  //   $sql = "SELECT * FROM $table WHERE pay_contract_id = :id ORDER BY pay_id DESC limit 1";
  //   $statement = $pdo->prepare($sql);
  //   $statement->bindValue(":id", $id);
  //   $statement->execute();
  //   return $statement->fetch(PDO::FETCH_ASSOC);
  // }
  public function getInfoClosingTrue($table, $id) //ยอดปิดวันสุดท้าย
  {
    $pdo = parent::getInstance();
    // $sql = "SELECT * FROM $table WHERE pay_contract_id = :id ORDER BY pay_id DESC limit 1";
    $sql = "SELECT * FROM $table 
    LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetchAll();
  }
}
