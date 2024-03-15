<?php

class ShowReport extends Connect
{
  public function listreportsalesClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id 
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id 
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id 
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id 
    LEFT JOIN set_prename ON cus_prename=setpre_id 
    LEFT JOIN linework ON contract_linework_id=lw_id
    -- WHERE cash_date_start BETWEEN '2023-07-05' AND '2023-07-05'
    ORDER BY contract_id DESC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function listLineworkClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY lw_id ASC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
}
