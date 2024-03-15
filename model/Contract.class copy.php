<?php

class Contract extends Connect
{

  public function insertClient($table1, $table2, $data)
  {
    $pdo = parent::getInstance();

    $sql = "INSERT INTO $table2 SET cus_prename=:cus_prename,
        cus_firstname=:cus_firstname,
        cus_lastname=:cus_lastname,
        cus_card_id=:cus_card_id,
        cus_birthday=:cus_birthday,
        cus_age=:cus_age,
        cus_gender=:cus_gender,
        cus_statusmarry=:cus_statusmarry,
        cus_address=:cus_address,
        cus_house_no=:cus_house_no,
        cus_village=:cus_village,
        cus_lane=:cus_lane,
        cus_streee=:cus_streee,
        cus_sub_district=:cus_sub_district,
        cus_district=:cus_district,
        cus_province=:cus_province,
        cus_postal_code=:cus_postal_code,
        cus_home_phone=:cus_home_phone,
        cus_mobile_phone=:cus_mobile_phone,
        cus_numberyears_lived=:cus_numberyears_lived,
        cus_numbermonths_lived=:cus_numbermonths_lived,
        cus_statusaddress=:cus_statusaddress,
        cus_cohabiting=:cus_cohabiting,
        cus_number_lived=:cus_number_lived,
        cus_statuswork=:cus_statuswork,
        cus_workplace=:cus_workplace,
        cus_workplace_no=:cus_workplace_no,
        cus_village_work=:cus_village_work,
        cus_lane_work=:cus_lane_work,
        cus_streee_work=:cus_streee_work,
        cus_sub_district_work=:cus_sub_district_work,
        cus_district_work=:cus_district_work,
        cus_province_work=:cus_province_work,
        cus_postal_code_work=:cus_postal_code_work,
        cus_home_phone_work=:cus_home_phone_work,
        cus_mobile_phone_work=:cus_mobile_phone_work,
        cus_nature_work=:cus_nature_work,
        cus_department_work=:cus_department_work,
        cus_position_work=:cus_position_work,
        cus_contact_time=:cus_contact_time,
        cus_numberyears_work=:cus_numberyears_work,
        cus_income_day=:cus_income_day,
        cus_income_month=:cus_income_month,
        cus_nickname=:cus_nickname
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":cus_prename", $data['cus_prename']);
    $statement->bindValue(":cus_firstname", $data['cus_firstname']);
    $statement->bindValue(":cus_lastname", $data['cus_lastname']);
    $statement->bindValue(":cus_card_id", $data['cus_card_id']);
    $statement->bindValue(":cus_birthday", $data['cus_birthday']);
    $statement->bindValue(":cus_age", $data['cus_age']);
    $statement->bindValue(":cus_gender", $data['cus_gender']);
    $statement->bindValue(":cus_statusmarry", $data['cus_statusmarry']);
    $statement->bindValue(":cus_address", $data['cus_address']);
    $statement->bindValue(":cus_house_no", $data['cus_house_no']);
    $statement->bindValue(":cus_village", $data['cus_village']);
    $statement->bindValue(":cus_lane", $data['cus_lane']);
    $statement->bindValue(":cus_streee", $data['cus_streee']);
    $statement->bindValue(":cus_sub_district", $data['cus_sub_district']);
    $statement->bindValue(":cus_district", $data['cus_district']);
    $statement->bindValue(":cus_province", $data['cus_province']);
    $statement->bindValue(":cus_postal_code", $data['cus_postal_code']);
    $statement->bindValue(":cus_home_phone", $data['cus_home_phone']);
    $statement->bindValue(":cus_mobile_phone", $data['cus_mobile_phone']);
    $statement->bindValue(":cus_numberyears_lived", $data['cus_numberyears_lived']);
    $statement->bindValue(":cus_numbermonths_lived", $data['cus_numbermonths_lived']);
    $statement->bindValue(":cus_statusaddress", $data['cus_statusaddress']);
    $statement->bindValue(":cus_cohabiting", $data['cus_cohabiting']);
    $statement->bindValue(":cus_number_lived", $data['cus_number_lived']);
    $statement->bindValue(":cus_statuswork", $data['cus_statuswork']);
    $statement->bindValue(":cus_workplace", $data['cus_workplace']);
    $statement->bindValue(":cus_workplace_no", $data['cus_workplace_no']);
    $statement->bindValue(":cus_village_work", $data['cus_village_work']);
    $statement->bindValue(":cus_lane_work", $data['cus_lane_work']);
    $statement->bindValue(":cus_streee_work", $data['cus_streee_work']);
    $statement->bindValue(":cus_sub_district_work", $data['cus_sub_district_work']);
    $statement->bindValue(":cus_district_work", $data['cus_district_work']);
    $statement->bindValue(":cus_province_work", $data['cus_province_work']);
    $statement->bindValue(":cus_postal_code_work", $data['cus_postal_code_work']);
    $statement->bindValue(":cus_home_phone_work", $data['cus_home_phone_work']);
    $statement->bindValue(":cus_mobile_phone_work", $data['cus_mobile_phone_work']);
    $statement->bindValue(":cus_nature_work", $data['cus_nature_work']);
    $statement->bindValue(":cus_department_work", $data['cus_department_work']);
    $statement->bindValue(":cus_position_work", $data['cus_position_work']);
    $statement->bindValue(":cus_contact_time", $data['cus_contact_time']);
    $statement->bindValue(":cus_numberyears_work", $data['cus_numberyears_work']);
    $statement->bindValue(":cus_income_day", $data['cus_income_day']);
    $statement->bindValue(":cus_income_month", $data['cus_income_month']);
    $statement->bindValue(":cus_nickname", $data['cus_nickname']);
    $statement->execute();

    $sql = "SELECT * FROM $table2 ORDER BY cus_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);

    ///////////////////////INSERT table 4 table///////////////////////////

    ///////////////////////INSERT table marry_detail///////////////////////////
    $sqlmd = "INSERT INTO marry_detail SET marryd_cusid=:marryd_cusid";
    $statementmd = $pdo->prepare($sqlmd);
    $statementmd->bindValue(":marryd_cusid", $dataid['cus_id']);
    $statementmd->execute();

    $sqlselectmd = "SELECT * FROM marry_detail ORDER BY marryd_id DESC limit 1";
    $lastidmd = $pdo->query($sqlselectmd);
    $lastidmd->execute();
    $dataidmd =  $lastidmd->fetch(PDO::FETCH_ASSOC);
    ///////////////////////INSERT table contact_emergency///////////////////////////
    $sqlce = "INSERT INTO contact_emergency SET coem_cusid=:coem_cusid";
    $statementce = $pdo->prepare($sqlce);
    $statementce->bindValue(":coem_cusid", $dataid['cus_id']);
    $statementce->execute();

    $sqlselectce = "SELECT * FROM contact_emergency ORDER BY coem_id DESC limit 1";
    $lastidce = $pdo->query($sqlselectce);
    $lastidce->execute();
    $dataidce =  $lastidce->fetch(PDO::FETCH_ASSOC);
    ///////////////////////INSERT table guarantor///////////////////////////
    $sqlgua = "INSERT INTO guarantor SET guarantor_cusid=:guarantor_cusid";
    $statementgua = $pdo->prepare($sqlgua);
    $statementgua->bindValue(":guarantor_cusid", $dataid['cus_id']);
    $statementgua->execute();

    $sqlselectgua = "SELECT * FROM guarantor ORDER BY guarantor_id DESC limit 1";
    $lastidgua = $pdo->query($sqlselectgua);
    $lastidgua->execute();
    $dataidgua =  $lastidgua->fetch(PDO::FETCH_ASSOC);
    ///////////////////////INSERT table cashloan///////////////////////////
    // $sqlcash = "INSERT INTO cashloan SET cash_cusid=:cash_cusid";
    // $statementcash = $pdo->prepare($sqlcash);
    // $statementcash->bindValue(":cash_cusid", $dataid['cus_id']);
    // $statementcash->execute();

    // $sqlselectcash = "SELECT * FROM cashloan ORDER BY cash_id DESC limit 1";
    // $lastidcash = $pdo->query($sqlselectcash);
    // $lastidcash->execute();
    // $dataidcash =  $lastidcash->fetch(PDO::FETCH_ASSOC);

    ///////////////////////End INSERT table 4 table///////////////////////////


    $sqlcontract = "INSERT INTO $table1 SET 
        contract_customer_id=:contract_customer_id,
        contract_marrydetail_id=:contract_marrydetail_id,
        contract_contactemergency_id=:contract_contactemergency_id,
        contract_guarantor_id=:contract_guarantor_id,
        contract_usercreate=:contract_usercreate
        ";
    $statementcontract = $pdo->prepare($sqlcontract);
    // $statementcontract->bindValue(":contract_number", $gentimestamp);
    $statementcontract->bindValue(":contract_customer_id", $dataid['cus_id']);
    $statementcontract->bindValue(":contract_marrydetail_id", $dataidmd['marryd_id']);
    $statementcontract->bindValue(":contract_contactemergency_id", $dataidce['coem_id']);
    $statementcontract->bindValue(":contract_guarantor_id", $dataidgua['guarantor_id']);
    $statementcontract->bindValue(":contract_usercreate", $_SESSION['sess_id']);
    $statementcontract->execute();

    $sqlcontract = "SELECT * FROM $table1 ORDER BY contract_id DESC limit 1";
    $lastidcontract = $pdo->query($sqlcontract);
    $lastidcontract->execute();
    $dataidcontract =  $lastidcontract->fetch(PDO::FETCH_ASSOC);
    // return $dataid['cus_id'];
    return "&id=" . $dataidcontract['contract_id'] . "&cusid=" . $dataid['cus_id'];
  }

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

  public function deleteClient($table, $id)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table WHERE contract_id = :id";
    $lastid = $pdo->prepare($sql);
    $lastid->bindValue(":id", $id);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);

    $sql1 = "DELETE FROM customer where cus_id = :id";
    $statement1 = $pdo->prepare($sql1);
    $statement1->bindValue(":id", $dataid['contract_customer_id']);
    $statement1->execute();

    $sql2 = "DELETE FROM marry_detail where marryd_id = :id";
    $statement2 = $pdo->prepare($sql2);
    $statement2->bindValue(":id", $dataid['contract_marrydetail_id']);
    $statement2->execute();

    $sql3 = "DELETE FROM contact_emergency where coem_id = :id";
    $statement3 = $pdo->prepare($sql3);
    $statement3->bindValue(":id", $dataid['contract_contactemergency_id']);
    $statement3->execute();

    $sql4 = "DELETE FROM guarantor where guarantor_id = :id";
    $statement4 = $pdo->prepare($sql4);
    $statement4->bindValue(":id", $dataid['contract_guarantor_id']);
    $statement4->execute();

    $sql5 = "DELETE FROM cashloan where cash_id = :id";
    $statement5 = $pdo->prepare($sql5);
    $statement5->bindValue(":id", $dataid['contract_cashloan_id']);
    $statement5->execute();

    $sql6 = "DELETE FROM $table where contract_id = :id";
    $statement6 = $pdo->prepare($sql6);
    $statement6->bindValue(":id", $id);
    $statement6->execute();
  }

  public function getInfoCustomer($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN set_statusmarry ON setmar_id=cus_statusmarry
    LEFT JOIN set_statusaddress ON setadd_id=cus_statusaddress
    LEFT JOIN set_cohabiting ON setcoh_id=cus_cohabiting
    LEFT JOIN set_statuswork ON setwork_id=cus_statuswork
    LEFT JOIN provinces ON province_id=cus_province
    LEFT JOIN amphures ON amphures_id=cus_district
    LEFT JOIN districts ON districts_id=cus_sub_district
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    // return $statement->fetchAll();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetch();
  }
  public function getInfoCustomerSub($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN set_statusmarry ON setmar_id=cus_statusmarry
    LEFT JOIN set_statusaddress ON setadd_id=cus_statusaddress
    LEFT JOIN set_cohabiting ON setcoh_id=cus_cohabiting
    LEFT JOIN set_statuswork ON setwork_id=cus_statuswork
    LEFT JOIN provinces ON province_id=cus_province_work
    LEFT JOIN amphures ON amphures_id=cus_district_work
    LEFT JOIN districts ON districts_id=cus_sub_district_work
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    // return $statement->fetchAll();
    return $statement->fetch(PDO::FETCH_ASSOC);
    // return $statement->fetch();
  }
  public function getInfoMarryDetail($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN set_statusmarry ON setmar_id=cus_statusmarry
    LEFT JOIN set_statusaddress ON setadd_id=cus_statusaddress
    LEFT JOIN set_cohabiting ON setcoh_id=cus_cohabiting
    LEFT JOIN set_statuswork ON setwork_id=cus_statuswork
    LEFT JOIN marry_detail ON contract_marrydetail_id=marryd_id
    LEFT JOIN provinces ON province_id=marryd_province
    LEFT JOIN amphures ON amphures_id=marryd_district
    LEFT JOIN districts ON districts_id=marryd_sub_district
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoContactEmergency($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN contact_emergency ON contract_contactemergency_id=coem_id
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoGuarantor($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN set_statusmarry ON setmar_id=cus_statusmarry
    LEFT JOIN set_statusaddress ON setadd_id=cus_statusaddress
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id
    LEFT JOIN provinces ON province_id=guarantor_province
    LEFT JOIN amphures ON amphures_id=guarantor_district
    LEFT JOIN districts ON districts_id=guarantor_sub_district
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoGuarantorSub($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN set_statusmarry ON setmar_id=cus_statusmarry
    LEFT JOIN set_statusaddress ON setadd_id=cus_statusaddress
    LEFT JOIN guarantor ON contract_guarantor_id=guarantor_id
    LEFT JOIN provinces ON province_id=guarantor_province_marry
    LEFT JOIN amphures ON amphures_id=guarantor_district_marry
    LEFT JOIN districts ON districts_id=guarantor_sub_district_marry
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function getInfoCashloan($table, $id)
  {
    // public function getInfo($table) {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table LEFT JOIN customer ON contract_customer_id=cus_id 
    LEFT JOIN set_prename ON setpre_id=cus_prename
    LEFT JOIN set_statusmarry ON setmar_id=cus_statusmarry
    LEFT JOIN set_statusaddress ON setadd_id=cus_statusaddress
    LEFT JOIN cashloan ON contract_cashloan_id=cash_id
    LEFT JOIN linework ON contract_linework_id=lw_id
    WHERE contract_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function updateClient($table1, $table2, $data, $id)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table2 SET  cus_prename=:cus_prename,
        cus_firstname=:cus_firstname,
        cus_lastname=:cus_lastname,
        cus_card_id=:cus_card_id,
        cus_birthday=:cus_birthday,
        cus_age=:cus_age,
        cus_gender=:cus_gender,
        cus_statusmarry=:cus_statusmarry,
        cus_address=:cus_address,
        cus_house_no=:cus_house_no,
        cus_village=:cus_village,
        cus_lane=:cus_lane,
        cus_streee=:cus_streee,
        cus_sub_district=:cus_sub_district,
        cus_district=:cus_district,
        cus_province=:cus_province,
        cus_postal_code=:cus_postal_code,
        cus_home_phone=:cus_home_phone,
        cus_mobile_phone=:cus_mobile_phone,
        cus_numberyears_lived=:cus_numberyears_lived,
        cus_numbermonths_lived=:cus_numbermonths_lived,
        cus_statusaddress=:cus_statusaddress,
        cus_cohabiting=:cus_cohabiting,
        cus_number_lived=:cus_number_lived,
        cus_statuswork=:cus_statuswork,
        cus_workplace=:cus_workplace,
        cus_workplace_no=:cus_workplace_no,
        cus_village_work=:cus_village_work,
        cus_lane_work=:cus_lane_work,
        cus_streee_work=:cus_streee_work,
        cus_sub_district_work=:cus_sub_district_work,
        cus_district_work=:cus_district_work,
        cus_province_work=:cus_province_work,
        cus_postal_code_work=:cus_postal_code_work,
        cus_home_phone_work=:cus_home_phone_work,
        cus_mobile_phone_work=:cus_mobile_phone_work,
        cus_nature_work=:cus_nature_work,
        cus_department_work=:cus_department_work,
        cus_position_work=:cus_position_work,
        cus_contact_time=:cus_contact_time,
        cus_numberyears_work=:cus_numberyears_work,
        cus_income_day=:cus_income_day,
        cus_income_month=:cus_income_month,
        cus_nickname=:cus_nickname
        WHERE cus_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['cus_id'],
      'cus_prename' => $data['cus_prename'],
      'cus_firstname' => $data['cus_firstname'],
      'cus_lastname' => $data['cus_lastname'],
      'cus_card_id' => $data['cus_card_id'],
      'cus_birthday' => $data['cus_birthday'],
      'cus_age' => $data['cus_age'],
      'cus_gender' => $data['cus_gender'],
      'cus_statusmarry' => $data['cus_statusmarry'],
      'cus_address' => $data['cus_address'],
      'cus_house_no' => $data['cus_house_no'],
      'cus_village' => $data['cus_village'],
      'cus_lane' => $data['cus_lane'],
      'cus_streee' => $data['cus_streee'],
      'cus_sub_district' => $data['cus_sub_district'],
      'cus_district' => $data['cus_district'],
      'cus_province' => $data['cus_province'],
      'cus_postal_code' => $data['cus_postal_code'],
      'cus_home_phone' => $data['cus_home_phone'],
      'cus_mobile_phone' => $data['cus_mobile_phone'],
      'cus_numberyears_lived' => $data['cus_numberyears_lived'],
      'cus_numbermonths_lived' => $data['cus_numbermonths_lived'],
      'cus_statusaddress' => $data['cus_statusaddress'],
      'cus_cohabiting' => $data['cus_cohabiting'],
      'cus_number_lived' => $data['cus_number_lived'],
      'cus_statuswork' => $data['cus_statuswork'],
      'cus_workplace' => $data['cus_workplace'],
      'cus_workplace_no' => $data['cus_workplace_no'],
      'cus_village_work' => $data['cus_village_work'],
      'cus_lane_work' => $data['cus_lane_work'],
      'cus_streee_work' => $data['cus_streee_work'],
      'cus_sub_district_work' => $data['cus_sub_district_work'],
      'cus_district_work' => $data['cus_district_work'],
      'cus_province_work' => $data['cus_province_work'],
      'cus_postal_code_work' => $data['cus_postal_code_work'],
      'cus_home_phone_work' => $data['cus_home_phone_work'],
      'cus_mobile_phone_work' => $data['cus_mobile_phone_work'],
      'cus_nature_work' => $data['cus_nature_work'],
      'cus_department_work' => $data['cus_department_work'],
      'cus_position_work' => $data['cus_position_work'],
      'cus_contact_time' => $data['cus_contact_time'],
      'cus_numberyears_work' => $data['cus_numberyears_work'],
      'cus_income_day' => $data['cus_income_day'],
      'cus_income_month' => $data['cus_income_month'],
      'cus_nickname' => $data['cus_nickname']
    ));

    return "&id=" . $id . "&cusid=" . $data['cus_id'];
    // return '25';

    // $extension = array("jpeg", "jpg", "png", "gif");
    // $ii = 0;
    // $iactive = 1;
    // foreach ($_FILES["fileupload"]["tmp_name"] as $key => $tmp_name) {
    //   $file_name = $_FILES["fileupload"]["name"][$key];
    //   $file_tmp = $_FILES["fileupload"]["tmp_name"][$key];
    //   $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    //   $target_dir = "../file/users/";
    //   $newfileName = 'users' . time() . $ii . "." . $ext;
    //   $target_dirname = "file/users/" . $newfileName;
    //   if ($_FILES["fileupload"]["tmp_name"][$key] != '') {
    //     if (in_array($ext, $extension)) {
    //       if ($_REQUEST['oldphoto'] != '') {
    //         unlink('../' . $_REQUEST['oldphoto']);
    //       }
    //       move_uploaded_file($_FILES["fileupload"]["tmp_name"][$key], $target_dir . $newfileName);
    //       $sql1 = "UPDATE $table SET u_photo=:u_photo WHERE u_id=:id";
    //       $statement1 = $pdo->prepare($sql1);
    //       $statement1->execute(array('id' => $data['u_id'], 'u_photo' => $target_dirname));
    //     } else {
    //       return 'NOTFILE';
    //       exit();
    //     }
    //     $ii++;
    //   }
    // }
  }

  public function listStatusMarryClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY setmar_id ASC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
  public function listStatusAddressClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY setadd_id ASC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
  public function listCohabitingClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY setcoh_id ASC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
  public function listStatusWorkClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY setwork_id ASC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
  public function listPrenameClient($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY setpre_id ASC";
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

  public function marrydetailinsertClient($table1, $data)
  {
    $pdo = parent::getInstance();
    $sql = "INSERT INTO $table1 SET marryd_prename=:marryd_prename,
          marryd_firstname=:marryd_firstname,
          marryd_lastname=:marryd_lastname,
          marryd_statuswork=:marryd_statuswork,
          marryd_workplace=:marryd_workplace,
          marryd_workplace_no=:marryd_workplace_no,
          marryd_village=:marryd_village,
          marryd_lane=:marryd_lane,
          marryd_streee=:marryd_streee,
          marryd_sub_district=:marryd_sub_district,
          marryd_district=:marryd_district,
          marryd_province=:marryd_province,
          marryd_postal_code=:marryd_postal_code,
          marryd_home_phone=:marryd_home_phone,
          marryd_mobile_phone=:marryd_mobile_phone,
          marryd_nature_work=:marryd_nature_work,
          marryd_department_work=:marryd_department_work,
          marryd_position_work=:marryd_position_work,
          marryd_contact_time=:marryd_contact_time,
          marryd_numberyears_work=:marryd_numberyears_work,
          marryd_cusid=:marryd_cusid,
          marryd_nickname=:marryd_nickname
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":marryd_prename", $data['marryd_prename']);
    $statement->bindValue(":marryd_firstname", $data['marryd_firstname']);
    $statement->bindValue(":marryd_lastname", $data['marryd_lastname']);
    $statement->bindValue(":marryd_statuswork", $data['marryd_statuswork']);
    $statement->bindValue(":marryd_workplace", $data['marryd_workplace']);
    $statement->bindValue(":marryd_workplace_no", $data['marryd_workplace_no']);
    $statement->bindValue(":marryd_village", $data['marryd_village']);
    $statement->bindValue(":marryd_lane", $data['marryd_lane']);
    $statement->bindValue(":marryd_streee", $data['marryd_streee']);
    $statement->bindValue(":marryd_sub_district", $data['marryd_sub_district']);
    $statement->bindValue(":marryd_district", $data['marryd_district']);
    $statement->bindValue(":marryd_province", $data['marryd_province']);
    $statement->bindValue(":marryd_postal_code", $data['marryd_postal_code']);
    $statement->bindValue(":marryd_home_phone", $data['marryd_home_phone']);
    $statement->bindValue(":marryd_mobile_phone", $data['marryd_mobile_phone']);
    $statement->bindValue(":marryd_nature_work", $data['marryd_nature_work']);
    $statement->bindValue(":marryd_department_work", $data['marryd_department_work']);
    $statement->bindValue(":marryd_position_work", $data['marryd_position_work']);
    $statement->bindValue(":marryd_contact_time", $data['marryd_contact_time']);
    $statement->bindValue(":marryd_numberyears_work", $data['marryd_numberyears_work']);
    $statement->bindValue(":marryd_cusid", $data['cus_id']);
    $statement->bindValue(":marryd_nickname", $data['marryd_nickname']);
    $statement->execute();

    $sql = "SELECT * FROM $table1 ORDER BY marryd_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);

    $sql1 = "UPDATE contract SET contract_marrydetail_id=:contract_marrydetail_id WHERE contract_id=:id";
    $statement1 = $pdo->prepare($sql1);
    $statement1->execute(array(
      'id' => $data['contract_id'],
      'contract_marrydetail_id' => $dataid['marryd_id']
    ));
    return "&id=" . $data['contract_id'] . "&cusid=" . $data['cus_id'];
  }

  public function marrydetailupdateClient($table1, $table2, $data, $id)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table2 SET  marryd_prename=:marryd_prename,
          marryd_firstname=:marryd_firstname,
          marryd_lastname=:marryd_lastname,
          marryd_statuswork=:marryd_statuswork,
          marryd_workplace=:marryd_workplace,
          marryd_workplace_no=:marryd_workplace_no,
          marryd_village=:marryd_village,
          marryd_lane=:marryd_lane,
          marryd_streee=:marryd_streee,
          marryd_sub_district=:marryd_sub_district,
          marryd_district=:marryd_district,
          marryd_province=:marryd_province,
          marryd_postal_code=:marryd_postal_code,
          marryd_home_phone=:marryd_home_phone,
          marryd_mobile_phone=:marryd_mobile_phone,
          marryd_nature_work=:marryd_nature_work,
          marryd_department_work=:marryd_department_work,
          marryd_position_work=:marryd_position_work,
          marryd_contact_time=:marryd_contact_time,
          marryd_numberyears_work=:marryd_numberyears_work,
          marryd_nickname=:marryd_nickname
          WHERE marryd_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['marryd_id'],
      'marryd_prename' => $data['marryd_prename'],
      'marryd_firstname' => $data['marryd_firstname'],
      'marryd_lastname' => $data['marryd_lastname'],
      'marryd_statuswork' => $data['marryd_statuswork'],
      'marryd_workplace' => $data['marryd_workplace'],
      'marryd_workplace_no' => $data['marryd_workplace_no'],
      'marryd_village' => $data['marryd_village'],
      'marryd_lane' => $data['marryd_lane'],
      'marryd_streee' => $data['marryd_streee'],
      'marryd_sub_district' => $data['marryd_sub_district'],
      'marryd_district' => $data['marryd_district'],
      'marryd_province' => $data['marryd_province'],
      'marryd_postal_code' => $data['marryd_postal_code'],
      'marryd_home_phone' => $data['marryd_home_phone'],
      'marryd_mobile_phone' => $data['marryd_mobile_phone'],
      'marryd_nature_work' => $data['marryd_nature_work'],
      'marryd_department_work' => $data['marryd_department_work'],
      'marryd_position_work' => $data['marryd_position_work'],
      'marryd_contact_time' => $data['marryd_contact_time'],
      'marryd_numberyears_work' => $data['marryd_numberyears_work'],
      'marryd_nickname' => $data['marryd_nickname']
    ));

    return "&id=" . $id . "&cusid=" . $data['cus_id'];
  }
  public function contactemergencyinsertClient($table1, $data)
  {
    $pdo = parent::getInstance();
    $sql = "INSERT INTO $table1 SET coem_prename=:coem_prename,
          coem_firstname=:coem_firstname,
          coem_lastname=:coem_lastname,
          coem_relation=:coem_relation,
          coem_place_contact=:coem_place_contact,
          coem_phone_number=:coem_phone_number,
          coem_cusid=:coem_cusid
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":coem_prename", $data['coem_prename']);
    $statement->bindValue(":coem_firstname", $data['coem_firstname']);
    $statement->bindValue(":coem_lastname", $data['coem_lastname']);
    $statement->bindValue(":coem_relation", $data['coem_relation']);
    $statement->bindValue(":coem_place_contact", $data['coem_place_contact']);
    $statement->bindValue(":coem_phone_number", $data['coem_phone_number']);
    $statement->bindValue(":coem_cusid", $data['cus_id']);
    $statement->execute();

    $sql = "SELECT * FROM $table1 ORDER BY coem_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);

    $sql1 = "UPDATE contract SET contract_contactemergency_id=:contract_contactemergency_id WHERE contract_id=:id";
    $statement1 = $pdo->prepare($sql1);
    $statement1->execute(array(
      'id' => $data['contract_id'],
      'contract_contactemergency_id' => $dataid['coem_id']
    ));
    return "&id=" . $data['contract_id'] . "&cusid=" . $data['cus_id'];
  }

  public function contactemergencyupdateClient($table1, $table2, $data, $id)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table2 SET coem_prename=:coem_prename,
          coem_firstname=:coem_firstname,
          coem_lastname=:coem_lastname,
          coem_relation=:coem_relation,
          coem_place_contact=:coem_place_contact,
          coem_phone_number=:coem_phone_number
          WHERE coem_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['coem_id'],
      'coem_prename' => $data['coem_prename'],
      'coem_firstname' => $data['coem_firstname'],
      'coem_lastname' => $data['coem_lastname'],
      'coem_relation' => $data['coem_relation'],
      'coem_place_contact' => $data['coem_place_contact'],
      'coem_phone_number' => $data['coem_phone_number']
    ));

    return "&id=" . $id . "&cusid=" . $data['cus_id'];
  }
  public function guarantorinsertClient($table1, $data)
  {
    $pdo = parent::getInstance();
    $sql = "INSERT INTO $table1 SET guarantor_prename=:guarantor_prename,
          guarantor_firstname=:guarantor_firstname,
          guarantor_lastname=:guarantor_lastname,
          guarantor_card_id=:guarantor_card_id,
          guarantor_birthday=:guarantor_birthday,
          guarantor_age=:guarantor_age,
          guarantor_gender=:guarantor_gender,
          guarantor_statusmarry=:guarantor_statusmarry,
          guarantor_business_registration=:guarantor_business_registration,
          guarantor_address=:guarantor_address,
          guarantor_house_no=:guarantor_house_no,
          guarantor_village=:guarantor_village,
          guarantor_lane=:guarantor_lane,
          guarantor_streee=:guarantor_streee,
          guarantor_sub_district=:guarantor_sub_district,
          guarantor_district=:guarantor_district,
          guarantor_province=:guarantor_province,
          guarantor_postal_code=:guarantor_postal_code,
          guarantor_home_phone=:guarantor_home_phone,
          guarantor_mobile_phone=:guarantor_mobile_phone,
          guarantor_numberyears_lived=:guarantor_numberyears_lived,
          guarantor_statusaddress=:guarantor_statusaddress,
          guarantor_cusid=:guarantor_cusid,
          guarantor_nickname=:guarantor_nickname
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":guarantor_prename", $data['guarantor_prename']);
    $statement->bindValue(":guarantor_firstname", $data['guarantor_firstname']);
    $statement->bindValue(":guarantor_lastname", $data['guarantor_lastname']);
    $statement->bindValue(":guarantor_card_id", $data['guarantor_card_id']);
    $statement->bindValue(":guarantor_birthday", $data['guarantor_birthday']);
    $statement->bindValue(":guarantor_age", $data['guarantor_age']);
    $statement->bindValue(":guarantor_gender", $data['guarantor_gender']);
    $statement->bindValue(":guarantor_statusmarry", $data['guarantor_statusmarry']);
    $statement->bindValue(":guarantor_business_registration", $data['guarantor_business_registration']);
    $statement->bindValue(":guarantor_address", $data['guarantor_address']);
    $statement->bindValue(":guarantor_house_no", $data['guarantor_house_no']);
    $statement->bindValue(":guarantor_village", $data['guarantor_village']);
    $statement->bindValue(":guarantor_lane", $data['guarantor_lane']);
    $statement->bindValue(":guarantor_streee", $data['guarantor_streee']);
    $statement->bindValue(":guarantor_sub_district", $data['guarantor_sub_district']);
    $statement->bindValue(":guarantor_district", $data['guarantor_district']);
    $statement->bindValue(":guarantor_province", $data['guarantor_province']);
    $statement->bindValue(":guarantor_postal_code", $data['guarantor_postal_code']);
    $statement->bindValue(":guarantor_home_phone", $data['guarantor_home_phone']);
    $statement->bindValue(":guarantor_mobile_phone", $data['guarantor_mobile_phone']);
    $statement->bindValue(":guarantor_numberyears_lived", $data['guarantor_numberyears_lived']);
    $statement->bindValue(":guarantor_statusaddress", $data['guarantor_statusaddress']);
    $statement->bindValue(":guarantor_cusid", $data['cus_id']);
    $statement->bindValue(":guarantor_nickname", $data['guarantor_nickname']);
    $statement->execute();

    $sql = "SELECT * FROM $table1 ORDER BY guarantor_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);

    $sql1 = "UPDATE contract SET contract_guarantor_id=:contract_guarantor_id WHERE contract_id=:id";
    $statement1 = $pdo->prepare($sql1);
    $statement1->execute(array(
      'id' => $data['contract_id'],
      'contract_guarantor_id' => $dataid['guarantor_id']
    ));
    return "&id=" . $data['contract_id'] . "&cusid=" . $data['cus_id'];
  }

  public function guarantorupdateClient($table1, $table2, $data, $id)
  {
    $pdo = parent::getInstance();
    $sql = "UPDATE $table2 SET  guarantor_prename=:guarantor_prename,
          guarantor_firstname=:guarantor_firstname,
          guarantor_lastname=:guarantor_lastname,
          guarantor_card_id=:guarantor_card_id,
          guarantor_birthday=:guarantor_birthday,
          guarantor_age=:guarantor_age,
          guarantor_gender=:guarantor_gender,
          guarantor_statusmarry=:guarantor_statusmarry,
          guarantor_business_registration=:guarantor_business_registration,
          guarantor_address=:guarantor_address,
          guarantor_house_no=:guarantor_house_no,
          guarantor_village=:guarantor_village,
          guarantor_lane=:guarantor_lane,
          guarantor_streee=:guarantor_streee,
          guarantor_sub_district=:guarantor_sub_district,
          guarantor_district=:guarantor_district,
          guarantor_province=:guarantor_province,
          guarantor_postal_code=:guarantor_postal_code,
          guarantor_home_phone=:guarantor_home_phone,
          guarantor_mobile_phone=:guarantor_mobile_phone,
          guarantor_numberyears_lived=:guarantor_numberyears_lived,
          guarantor_statusaddress=:guarantor_statusaddress,
          guarantor_prename_marry=:guarantor_prename_marry,
          guarantor_firstname_marry=:guarantor_firstname_marry,
          guarantor_lastname_marry=:guarantor_lastname_marry,
          guarantor_statuswork_marry=:guarantor_statuswork_marry,
          guarantor_workplace_marry=:guarantor_workplace_marry,
          guarantor_workplace_no_marry=:guarantor_workplace_no_marry,
          guarantor_village_marry=:guarantor_village_marry,
          guarantor_lane_marry=:guarantor_lane_marry,
          guarantor_streee_marry=:guarantor_streee_marry,
          guarantor_sub_district_marry=:guarantor_sub_district_marry,
          guarantor_district_marry=:guarantor_district_marry,
          guarantor_province_marry=:guarantor_province_marry,
          guarantor_postal_code_marry=:guarantor_postal_code_marry,
          guarantor_home_phone_marry=:guarantor_home_phone_marry,
          guarantor_mobile_phone_marry=:guarantor_mobile_phone_marry,
          guarantor_nature_work_marry=:guarantor_nature_work_marry,
          guarantor_department_work_marry=:guarantor_department_work_marry,
          guarantor_position_work_marry=:guarantor_position_work_marry,
          guarantor_contact_time_marry=:guarantor_contact_time_marry,
          guarantor_numberyears_work_marry=:guarantor_numberyears_work_marry,
          guarantor_nickname=:guarantor_nickname
          WHERE guarantor_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['guarantor_id'],
      'guarantor_prename' => $data['guarantor_prename'],
      'guarantor_firstname' => $data['guarantor_firstname'],
      'guarantor_lastname' => $data['guarantor_lastname'],
      'guarantor_card_id' => $data['guarantor_card_id'],
      'guarantor_birthday' => $data['guarantor_birthday'],
      'guarantor_age' => $data['guarantor_age'],
      'guarantor_gender' => $data['guarantor_gender'],
      'guarantor_statusmarry' => $data['guarantor_statusmarry'],
      'guarantor_business_registration' => $data['guarantor_business_registration'],
      'guarantor_address' => $data['guarantor_address'],
      'guarantor_house_no' => $data['guarantor_house_no'],
      'guarantor_village' => $data['guarantor_village'],
      'guarantor_lane' => $data['guarantor_lane'],
      'guarantor_streee' => $data['guarantor_streee'],
      'guarantor_sub_district' => $data['guarantor_sub_district'],
      'guarantor_district' => $data['guarantor_district'],
      'guarantor_province' => $data['guarantor_province'],
      'guarantor_postal_code' => $data['guarantor_postal_code'],
      'guarantor_home_phone' => $data['guarantor_home_phone'],
      'guarantor_mobile_phone' => $data['guarantor_mobile_phone'],
      'guarantor_numberyears_lived' => $data['guarantor_numberyears_lived'],
      'guarantor_statusaddress' => $data['guarantor_statusaddress'],
      'guarantor_prename_marry' => $data['guarantor_prename_marry'],
      'guarantor_firstname_marry' => $data['guarantor_firstname_marry'],
      'guarantor_lastname_marry' => $data['guarantor_lastname_marry'],
      'guarantor_statuswork_marry' => $data['guarantor_statuswork_marry'],
      'guarantor_workplace_marry' => $data['guarantor_workplace_marry'],
      'guarantor_workplace_no_marry' => $data['guarantor_workplace_no_marry'],
      'guarantor_village_marry' => $data['guarantor_village_marry'],
      'guarantor_lane_marry' => $data['guarantor_lane_marry'],
      'guarantor_streee_marry' => $data['guarantor_streee_marry'],
      'guarantor_sub_district_marry' => $data['guarantor_sub_district_marry'],
      'guarantor_district_marry' => $data['guarantor_district_marry'],
      'guarantor_province_marry' => $data['guarantor_province_marry'],
      'guarantor_postal_code_marry' => $data['guarantor_postal_code_marry'],
      'guarantor_home_phone_marry' => $data['guarantor_home_phone_marry'],
      'guarantor_mobile_phone_marry' => $data['guarantor_mobile_phone_marry'],
      'guarantor_nature_work_marry' => $data['guarantor_nature_work_marry'],
      'guarantor_department_work_marry' => $data['guarantor_department_work_marry'],
      'guarantor_position_work_marry' => $data['guarantor_position_work_marry'],
      'guarantor_contact_time_marry' => $data['guarantor_contact_time_marry'],
      'guarantor_numberyears_work_marry' => $data['guarantor_numberyears_work_marry'],
      'guarantor_nickname' => $data['guarantor_nickname']
    ));

    return "&id=" . $id . "&cusid=" . $data['cus_id'];
  }
  public function cashloaninsertClient($table1, $data)
  {
    // // $cashnumberinstallment = $data['cash_principle'] / $data['cash_installments_daily'];
    // $cashnumberinstallment = ($data['cash_principle'] + $data['cash_interest']) / $data['cash_installments_daily'];
    // $numberinstallmentround = floor($cashnumberinstallment);
    // /////////////////คำนวณวันที่ผ่อนชำระงวดสุดท้าย////////////////////
    // $strStartDate = $data['cash_date_start'];
    // // $strEndDate = date("Y-m-d", strtotime("+$cashnumberinstallment day", strtotime($strStartDate)));
    // $strEndDate = date("Y-m-d", strtotime("+" . $numberinstallmentround . "day", strtotime($strStartDate)));

    //////////////////คำนวณจำนวนงวด////////////////////
    $cashnumberinstallment = ($data['cash_principle'] + $data['cash_interest']) / $data['cash_installments_daily'];
    $numberinstallmentrounddown = floor($cashnumberinstallment); //ปัดเศษลง
    $numberinstallmentroundup = ceil($cashnumberinstallment); //ปัดเศษขึ้น
    $deldateoneday = $numberinstallmentroundup - 1; //ลบ 1 วัน เพราะรวมกับวันเริ่ม
    /////////////////คำนวณวันที่ผ่อนชำระงวดสุดท้าย////////////////////
    $strStartDate = $data['cash_date_start'];
    // $strEndDate = date("Y-m-d", strtotime("+" . $numberinstallmentroundup . "day", strtotime($strStartDate)));
    $strEndDate = date("Y-m-d", strtotime("+" . $deldateoneday . "day", strtotime($strStartDate)));
    //////////////////////////ค่าส่วนต่างงวดสุดท้าย///////////////////
    $calDifference = ($data['cash_principle'] + $data['cash_interest']) - ($data['cash_installments_daily'] * $numberinstallmentrounddown);

    ////////////////////เช็คจำนวนงวด ไม่เกิน 73 งวด////////////////////
    if ($data['installment_limit'] == 58) {
      if ($numberinstallmentroundup > 58) {
        return 'dayover58';
        exit();
      }
    } else {
      if ($numberinstallmentroundup > 73) {
        return 'dayover73';
        exit();
      }
    }
    ///////////////////////////////////////////////////////////////
    $pdo = parent::getInstance();
    $sql = "INSERT INTO $table1 SET cash_principle=:cash_principle,
          cash_interest=:cash_interest,
          cash_installments_daily=:cash_installments_daily,
          cash_number_installment=:cash_number_installment,
          cash_date_start=:cash_date_start,
          cash_date_end=:cash_date_end,
          cash_cusid=:cash_cusid,
          cash_difference =:cash_difference
        ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":cash_principle", $data['cash_principle']);
    $statement->bindValue(":cash_interest", $data['cash_interest']);
    $statement->bindValue(":cash_installments_daily", $data['cash_installments_daily']);
    $statement->bindValue(":cash_number_installment", $numberinstallmentroundup);
    $statement->bindValue(":cash_date_start", $data['cash_date_start']);
    $statement->bindValue(":cash_date_end", $strEndDate);
    $statement->bindValue(":cash_cusid", $data['cus_id']);
    $statement->bindValue(":cash_difference", $calDifference);
    $statement->execute();

    // $sqlconnum = "SELECT * FROM contract ORDER BY contract_id DESC limit 1";
    // $lastidconnum = $pdo->query($sqlconnum);
    // $lastidconnum->execute();
    // $dataidconnum =  $lastidconnum->fetch(PDO::FETCH_ASSOC);

    ///////////////////หารหัสสาย/////////////////
    $sqllinework = "SELECT * FROM linework WHERE lw_id = :id";
    $statementlinework = $pdo->prepare($sqllinework);
    $statementlinework->bindValue(":id", $data['contract_linework_id']);
    $statementlinework->execute();
    $dataidlinework = $statementlinework->fetch(PDO::FETCH_ASSOC);

    ////////////////////////เช็ค เลขที่สัญญา////////////////////////
    // $sqllastconnum = "SELECT * FROM contract ORDER BY contract_id DESC limit 1,1";
    // $lastidconnum = $pdo->query($sqllastconnum);
    // $lastidconnum->execute();
    // $datalastidconnum =  $lastidconnum->fetch(PDO::FETCH_ASSOC);
    // $countchk = $lastidconnum->rowCount();

    // $sqllastconnum = "SELECT * FROM contract WHERE contract_linework_id = :id ORDER BY contract_id DESC limit 1,1";
    $sqllastconnum = "SELECT * FROM contract WHERE contract_linework_id = :id ORDER BY contract_id DESC limit 0,1";
    $lastidconnum = $pdo->prepare($sqllastconnum);
    $lastidconnum->bindValue(":id", $data['contract_linework_id']);
    $lastidconnum->execute();
    $datalastidconnum =  $lastidconnum->fetch(PDO::FETCH_ASSOC);
    $countchk = $lastidconnum->rowCount();
    //////////////////////////////////////////////
    $sqlconnum = "SELECT * FROM contract WHERE contract_id = :id";
    $statementconnum = $pdo->prepare($sqlconnum);
    $statementconnum->bindValue(":id", $data['contract_id']);
    $statementconnum->execute();
    $dataidconnum = $statementconnum->fetch(PDO::FETCH_ASSOC);

    //////////////////////////เช็คสายงานว่ามีไหมใน tb contract////////////////////////
    $sqlchklinework = "SELECT * FROM contract WHERE contract_linework_id = :id";
    $statementchklinework = $pdo->prepare($sqlchklinework);
    $statementchklinework->bindValue(":id", $data['contract_linework_id']);
    $statementchklinework->execute();
    $dataidchklinework = $statementchklinework->fetch(PDO::FETCH_ASSOC);
    $countchklinework = $statementchklinework->rowCount();
    ///////////////////////////////////////////////////////////////////////////////

    $connumlinework = $dataidlinework['lw_code'];
    $connumyearcurrent = date('Y') + 543;
    $connummonthcurrent = date('m');

    $ordercal = '0001';
    $ordercalsubstr = substr($datalastidconnum['contract_number'], -10);
    list($oldYear, $oldMomth, $oldDay) = explode("-", $datalastidconnum['contract_created_at']); //ข้อมูลสัญญาแถวก่อน

    $thaiYearold = $oldYear + 543;
    // if ($countchk > 0) {
    //   if ($connumyearcurrent > $thaiYearold) { //ปีถัดไปเริ่มเลขสัญญาใหม่
    //     $connumgen = $connumlinework . $connumyearcurrent . $connummonthcurrent . $ordercal;
    //   } else {
    //     if ($connummonthcurrent > $oldMomth) { //ถ้าเดือนมากกว่าเดือนแถวก่อน
    //       $connumgen = $connumlinework . $connumyearcurrent . $connummonthcurrent . $ordercal;
    //     } else { //ถ้าเดือนน้อยกว่าหรือเท่ากับเดือนแถวก่อน
    //       $connumgen = $connumlinework . ($ordercalsubstr + 1);
    //     }
    //   }
    // } else {
    //   $connumgen = $connumlinework . $connumyearcurrent . $connummonthcurrent . $ordercal; //เริ่มต้นโดยไม่มีข้อมูลสัญญา
    // }
    if ($countchk > 0) {
      if ($connumyearcurrent > $thaiYearold) { //ปีถัดไปเริ่มเลขสัญญาใหม่
        $connumgen = $connumlinework . $connumyearcurrent . $connummonthcurrent . $ordercal;
      } else {
        if ($countchklinework > 0) { //เช็คสายงานว่ามีไหมใน
          if ($connummonthcurrent > $oldMomth) { //ถ้าเดือนมากกว่าเดือนแถวก่อน
            $connumgen = $connumlinework . $connumyearcurrent . $connummonthcurrent . $ordercal;
          } else { //ถ้าเดือนน้อยกว่าหรือเท่ากับเดือนแถวก่อน
            $connumgen = $connumlinework . ($ordercalsubstr + 1);
          }
        } else {
          $connumgen = $connumlinework . $connumyearcurrent . $connummonthcurrent . $ordercal; //เริ่มต้นโดยไม่มีข้อมูลสัญญา
        }
      }
    } else {
      $connumgen = $connumlinework . $connumyearcurrent . $connummonthcurrent . $ordercal; //เริ่มต้นโดยไม่มีข้อมูลสัญญา
    }

    // $connumgen = $connumlinework . $connumyear . $connummonth;
    ////////////////////////////////////////////
    $sql = "SELECT * FROM $table1 ORDER BY cash_id DESC limit 1";
    $lastid = $pdo->query($sql);
    $lastid->execute();
    $dataid =  $lastid->fetch(PDO::FETCH_ASSOC);

    $sql1 = "UPDATE contract SET contract_cashloan_id=:contract_cashloan_id,contract_linework_id=:contract_linework_id,contract_number=:contract_number,
    contract_personnelhead_name=:contract_personnelhead_name,
    contract_personnelhead_tel=:contract_personnelhead_tel,
    contract_personnelhenchman_name=:contract_personnelhenchman_name,
    contract_personnelhenchman_tel=:contract_personnelhenchman_tel
    WHERE contract_id=:id";
    $statement1 = $pdo->prepare($sql1);
    $statement1->execute(array(
      'id' => $data['contract_id'],
      'contract_linework_id' => $data['contract_linework_id'],
      'contract_number' => $connumgen,
      // 'contract_number' => $datalastidconnum['contract_number'],
      'contract_personnelhead_name' => $data['contract_personnelhead_name'],
      'contract_personnelhead_tel' => $data['contract_personnelhead_tel'],
      'contract_personnelhenchman_name' => $data['contract_personnelhenchman_name'],
      'contract_personnelhenchman_tel' => $data['contract_personnelhenchman_tel'],
      'contract_cashloan_id' => $dataid['cash_id']
    ));
    return "&id=" . $data['contract_id'] . "&cusid=" . $data['cus_id'];
  }

  public function cashloanupdateClient($table1, $table2, $data, $id)
  {
    //////////////////คำนวณจำนวนงวด////////////////////
    $cashnumberinstallment = ($data['cash_principle'] + $data['cash_interest']) / $data['cash_installments_daily'];
    $numberinstallmentrounddown = floor($cashnumberinstallment); //ปัดเศษลง
    $numberinstallmentroundup = ceil($cashnumberinstallment); //ปัดเศษขึ้น
    $deldateoneday = $numberinstallmentroundup - 1; //ลบ 1 วัน เพราะรวมกับวันเริ่ม
    /////////////////คำนวณวันที่ผ่อนชำระงวดสุดท้าย////////////////////
    $strStartDate = $data['cash_date_start'];
    $strEndDate = date("Y-m-d", strtotime("+" . $deldateoneday . "day", strtotime($strStartDate)));
    //////////////////////////ค่าส่วนต่างงวดสุดท้าย///////////////////
    $calDifference = ($data['cash_principle'] + $data['cash_interest']) - ($data['cash_installments_daily'] * $numberinstallmentrounddown);

    ////////////////////เช็คจำนวนงวด ไม่เกิน 73 งวด////////////////////
    // if ($numberinstallmentroundup > 73) {
    //   return 'dayover';
    //   exit();
    // }
    if ($data['installment_limit'] == 58) {
      if ($numberinstallmentroundup > 58) {
        return 'dayover58';
        exit();
      }
    } else {
      if ($numberinstallmentroundup > 73) {
        return 'dayover73';
        exit();
      }
    }
    ///////////////////////////////////////////////////////////////
    $pdo = parent::getInstance();
    $sql = "UPDATE $table2 SET  cash_principle=:cash_principle,
          cash_interest=:cash_interest,
          cash_installments_daily=:cash_installments_daily,
          cash_number_installment=:cash_number_installment,
          cash_date_start=:cash_date_start,
          cash_date_end=:cash_date_end,
          cash_difference=:cash_difference
          WHERE cash_id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(array(
      'id' => $data['cash_id'],
      'cash_principle' => $data['cash_principle'],
      'cash_interest' => $data['cash_interest'],
      'cash_installments_daily' => $data['cash_installments_daily'],
      'cash_number_installment' => $numberinstallmentroundup,
      'cash_date_start' => $data['cash_date_start'],
      'cash_date_end' => $strEndDate,
      'cash_difference' => $calDifference
    ));

    ///////////////////หารหัสสาย/////////////////
    $sqllinework = "SELECT * FROM linework WHERE lw_id = :id";
    $statementlinework = $pdo->prepare($sqllinework);
    $statementlinework->bindValue(":id", $data['contract_linework_id']);
    $statementlinework->execute();
    $dataidlinework = $statementlinework->fetch(PDO::FETCH_ASSOC);

    $sqlconnum = "SELECT * FROM contract WHERE contract_id = :id";
    $statementconnum = $pdo->prepare($sqlconnum);
    $statementconnum->bindValue(":id", $data['contract_id']);
    $statementconnum->execute();
    $dataidconnum = $statementconnum->fetch(PDO::FETCH_ASSOC);

    $ordercalsubstr = substr($dataidconnum['contract_number'], -10);
    $gennumcontract = $dataidlinework['lw_code'] . $ordercalsubstr;

    $sql1 = "UPDATE contract SET contract_linework_id=:contract_linework_id,contract_number=:contract_number,
    contract_personnelhead_name=:contract_personnelhead_name,
    contract_personnelhead_tel=:contract_personnelhead_tel,
    contract_personnelhenchman_name=:contract_personnelhenchman_name,
    contract_personnelhenchman_tel=:contract_personnelhenchman_tel
    WHERE contract_id=:id";
    $statement1 = $pdo->prepare($sql1);
    $statement1->execute(array(
      'id' => $data['contract_id'],
      'contract_number' => $gennumcontract,
      'contract_personnelhead_name' => $data['contract_personnelhead_name'],
      'contract_personnelhead_tel' => $data['contract_personnelhead_tel'],
      'contract_personnelhenchman_name' => $data['contract_personnelhenchman_name'],
      'contract_personnelhenchman_tel' => $data['contract_personnelhenchman_tel'],
      'contract_linework_id' => $data['contract_linework_id']
    ));

    return "&id=" . $id . "&cusid=" . $data['cus_id'] . "&date=" . $strEndDate;
  }

  public function listProvinces($table)
  {
    $pdo = parent::getInstance();
    $sql = "SELECT * FROM $table ORDER BY province_id ASC";
    $statement = $pdo->query($sql);
    $statement->execute();
    return $statement->fetchAll();
  }
  public function getdataAmphures($table, $id)
  {
    //   $data = array();
    $pdo = parent::getInstance();
    $sql = "SELECT amphures_id,amphures_name_th FROM $table WHERE amphures_provinceid =:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    $result = $statement->fetchAll();
    foreach ($result as $row) {
      $data[] = $row;
    }
    return $data;
  }
  public function getdataDistricts($table, $id)
  {
    // $data = array();
    $pdo = parent::getInstance();
    $sql = "SELECT districts_id,districts_name_th FROM $table WHERE districts_amphureid =:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    $result = $statement->fetchAll();
    foreach ($result as $row) {
      $data[] = $row;
    }
    return $data;
  }
  public function getdataZipcode($table, $id)
  {
    // $data = array();
    $pdo = parent::getInstance();
    $sql = "SELECT districts_zip_code FROM $table WHERE districts_id =:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    $result = $statement->fetchAll();
    foreach ($result as $row) {
      $data[] = $row;
    }
    return $data;
  }

  public function getdataInfo($table)
  {
    $data = array();
    $pdo = parent::getInstance();
    // $sql = "SELECT * FROM $table LEFT JOIN manageposition ON ag_id=mp_agid WHERE ag_id = :id";
    $sql = "SELECT * FROM $table WHERE lw_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $_REQUEST['lwid']);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
      $data = $row;
    }
    return $data;
  }

  public function getdataCardid($table, $id)
  {
    $data = '';
    $pdo = parent::getInstance();
    $sql = "SELECT cus_card_id FROM $table WHERE cus_card_id LIKE :cardid";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":cardid", '%' . $id . '%');
    $statement->execute();

    $result = $statement->fetchAll();
    if ($result) {
      foreach ($result as $row) {
        $data = '<a class="list-group-item">' . $row['cus_card_id'] . '</a>';
      }
    } else {
      $data = '<p class="list-group-item border-1">No record.</p>';
    }
    return $data;
  }
}
