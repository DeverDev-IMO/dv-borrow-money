<?php

class Closebalance extends Connect
{
  public function listClient($table)
  {
    $pdo = parent::getInstance();
    // if($_SESSION['sess_accessrights']=='superadmin'){
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN linework ON contract_linework_id=lw_id
    WHERE contract_status_closebalance=:contract_status_closebalance
    ORDER BY contract_id DESC";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":contract_status_closebalance", '1');
    $statement->execute();
    // } else if ($_SESSION['sess_accessrights']=='admin') {
    //     $sql = "SELECT * FROM $table WHERE u_government = :id AND u_accessrights!='superadmin' ORDER BY u_id DESC";
    //     $statement = $pdo->prepare($sql);
    //     $statement->bindValue(":id", $_SESSION['sess_agency']);
    //     $statement->execute();
    // }else{

    // }
    return $statement->fetchAll();
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
}
