<?php

class PaymentHistory extends Connect
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
    WHERE contract_status_cancel = 1
    ORDER BY contract_id DESC";
    $statement = $pdo->query($sql);
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
}
