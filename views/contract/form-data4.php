<?php
$contract = new Contract();
$client = $contract->getInfoGuarantor("contract", $id);
$client1 = $contract->getInfoGuarantorSub("contract", $id);
?>
<form id="<?php if ($client['contract_guarantor_id'] != '0') {
            echo 'guarantoreditdata';
          } else {
            echo 'guarantorinsertdata';
          } ?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>เลขบัตรประชาชน</label>
        <input id="search-cardid-guarantor" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" type="number" class="form-control" name="guarantor_card_id" placeholder="เลขบัตรประชาชน 13 หลัก ไม่ต้องใส่ขีด" value="<?php echo $client['guarantor_card_id']; ?>" required>
        <div class="list-group" style="position:absolute;z-index:99;width:250px;" id="show-list-guarantor"></div>
      </div>
    </div>
    <div class="col-md-9">
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>คำนำหน้าชื่อ</label>
        <select class="custom-select" name="guarantor_prename" required>
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_prename'] == '0' or $client['guarantor_prename'] == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['setpre_id']; ?>"><?php echo $client['setpre_name']; ?></option>
          <?php } ?>
          <?php foreach ($contract->listPrenameClient("set_prename") as $clientprename) : ?>
            <option value="<?php echo $clientprename['setpre_id']; ?>"><?php echo $clientprename['setpre_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ชื่อ</label>
        <input type="text" class="form-control" name="guarantor_firstname" placeholder="ไม่ต้องพิมพ์คำนำหน้าชือ" value="<?php echo $client['guarantor_firstname']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>นามสกุล</label>
        <input type="text" class="form-control" name="guarantor_lastname" placeholder="ระบุนามสกุล" value="<?php echo $client['guarantor_lastname']; ?>" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>ชื่อเล่น</label>
        <input type="text" class="form-control" name="guarantor_nickname" placeholder="ระบุชื่อเล่น" value="<?php echo $client['guarantor_nickname']; ?>" required>
      </div>
    </div>


  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>วันเกิด</label>
        <input type="date" class="form-control" name="guarantor_birthday" placeholder="" value="<?php echo $client['guarantor_birthday']; ?>" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>อายุ</label>
        <input type="number" class="form-control" name="guarantor_age" placeholder="" value="<?php echo $client['guarantor_age']; ?>" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>เพศ</label>
        <select class="custom-select" name="guarantor_gender" required>
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_gender'] == '0' or $client['guarantor_gender'] == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['guarantor_gender']; ?>"><?php echo $client['guarantor_gender']; ?></option>
          <?php } ?>
          <option value="ชาย">ชาย</option>
          <option value="หญิง">หญิง</option>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>สถานภาพสมรส</label>
        <select class="custom-select" name="guarantor_statusmarry" required>
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_statusmarry'] == '0' or $client['guarantor_statusmarry'] == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['setmar_id']; ?>"><?php echo $client['setmar_name']; ?></option>
          <?php } ?>
          <?php foreach ($contract->listStatusMarryClient("set_statusmarry") as $clientstatusmarry) : ?>
            <option value="<?php echo $clientstatusmarry['setmar_id']; ?>"><?php echo $clientstatusmarry['setmar_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เลขทะเบียนการค้า</label>
        <input type="text" class="form-control" name="guarantor_business_registration" placeholder="" value="<?php echo $client['guarantor_business_registration']; ?>">
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>ที่อยู่ปัจจุบันที่ติดต่อได้</label>
        <input type="text" class="form-control" name="guarantor_address" placeholder="ระบุวันเกิด" value="<?php echo $client['guarantor_address']; ?>" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>บ้านเลขที่</label>
        <input type="text" class="form-control" name="guarantor_house_no" placeholder="" value="<?php echo $client['guarantor_house_no']; ?>" required>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label>หมู่ที่</label>
        <input type="text" class="form-control" name="guarantor_village" placeholder="" value="<?php echo $client['guarantor_village']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ซอย</label>
        <input type="text" class="form-control" name="guarantor_lane" placeholder="" value="<?php echo $client['guarantor_lane']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ถนน</label>
        <input type="text" class="form-control" name="guarantor_streee" placeholder="" value="<?php echo $client['guarantor_streee']; ?>">
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>จังหวัด</label>
        <select name="guarantor_province" id="selProvince" class="custom-select select2bs4" required>
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_province'] == '0' or $client['guarantor_province'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client['province_id']; ?>"><?php echo $client['province_name_th']; ?></option>
          <?php } ?>
          <?php foreach ($contract->listProvinces("provinces") as $clientProvinceslist) : ?>
            <option value="<?php echo $clientProvinceslist['province_id']; ?>"><?php echo $clientProvinceslist['province_name_th']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>อำเภอ/เขต</label>
        <select name="guarantor_district" id="selAmphur" class="custom-select select2bs4" required>
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_district'] == '0' or $client['guarantor_district'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client['amphures_id']; ?>"><?php echo $client['amphures_name_th']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ตำบล/แขวง</label>
        <select name="guarantor_sub_district" id="selTumbon" class="custom-select select2bs4" required>
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_sub_district'] == '0' or $client['guarantor_sub_district'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client['districts_id']; ?>"><?php echo $client['districts_name_th']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>รหัสไปรษณีย์</label>
        <select name="guarantor_postal_code" id="selZipcode" class="custom-select" required>
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_postal_code'] == '0' or $client['guarantor_postal_code'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client['guarantor_postal_code']; ?>"><?php echo $client['guarantor_postal_code']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์บ้าน</label>
        <input type="text" class="form-control" name="guarantor_home_phone" placeholder="" value="<?php echo $client['guarantor_home_phone']; ?>" required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์มือถือ</label>
        <input type="text" class="form-control" name="guarantor_mobile_phone" placeholder="" value="<?php echo $client['guarantor_mobile_phone']; ?>" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>จำนวนปีที่อาศัยอยู่</label>
        <input type="text" class="form-control" name="guarantor_numberyears_lived" placeholder="" value="<?php echo $client['guarantor_numberyears_lived']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <label>สถานภาพที่อยู่</label>
      <select class="custom-select" name="guarantor_statusaddress" required>
        <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_statusaddress'] == '0' or $client['guarantor_statusaddress'] == '') { ?>
          <option value="">---เลือก---</option>
        <?php } else { ?>
          <option value="<?php echo $client['setadd_id']; ?>"><?php echo $client['setadd_name']; ?></option>
        <?php } ?>
        <?php foreach ($contract->listStatusAddressClient("set_statusaddress") as $clientstatusaddress) : ?>
          <option value="<?php echo $clientstatusaddress['setadd_id']; ?>"><?php echo $clientstatusaddress['setadd_name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div><br>
  <h5>ข้อมูลคู่สมรส</h5>
  <hr style="border-bottom:2px solid #28a745;">
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>คำนำหน้าชื่อ</label>
        <select class="custom-select" name="guarantor_prename_marry">
          <?php //if ($client['setpre_id'] != '' and  $client['setpre_id'] != 0) { 
          ?>
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_prename_marry'] == '0' or $client['guarantor_prename_marry'] == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['setpre_id']; ?>"><?php echo $client['setpre_name']; ?></option>
          <?php } ?>
          <?php foreach ($contract->listPrenameClient("set_prename") as $clientprename) : ?>
            <option value="<?php echo $clientprename['setpre_id']; ?>"><?php echo $clientprename['setpre_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ชื่อ</label>
        <input type="text" class="form-control" name="guarantor_firstname_marry" placeholder="ไม่ต้องพิมพ์คำนำหน้าชือ" value="<?php echo $client['guarantor_firstname_marry']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>นามสกุล</label>
        <input type="text" class="form-control" name="guarantor_lastname_marry" placeholder="ระบุนามสกุล" value="<?php echo $client['guarantor_lastname_marry']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <label>สถานภาพการงาน</label>
      <select class="custom-select" name="guarantor_statuswork_marry">
        <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_statuswork_marry'] == '0' or $client['guarantor_statuswork_marry'] == '') { ?>
          <option value="">---เลือก---</option>
        <?php } else { ?>
          <option value="<?php echo $client['setwork_id']; ?>"><?php echo $client['setwork_name']; ?></option>
        <?php } ?>
        <?php foreach ($contract->listStatusWorkClient("set_statuswork") as $clientStatusWork) : ?>
          <option value="<?php echo $clientStatusWork['setwork_id']; ?>"><?php echo $clientStatusWork['setwork_name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>สถานที่ทำงาน ชื่ออาคาร</label>
        <input type="text" class="form-control" name="guarantor_workplace_marry" placeholder="" value="<?php echo $client['guarantor_workplace_marry']; ?>">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>เลขที่</label>
        <input type="text" class="form-control" name="guarantor_workplace_no_marry" placeholder="" value="<?php echo $client['guarantor_workplace_no_marry']; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label>หมู่ที่</label>
        <input type="text" class="form-control" name="guarantor_village_marry" placeholder="" value="<?php echo $client['guarantor_village_marry']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ซอย</label>
        <input type="text" class="form-control" name="guarantor_lane_marry" placeholder="" value="<?php echo $client['guarantor_lane_marry']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ถนน</label>
        <input type="text" class="form-control" name="guarantor_streee_marry" placeholder="" value="<?php echo $client['guarantor_streee_marry']; ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>จังหวัด</label>
        <select name="guarantor_province_marry" id="selProvince1" class="custom-select select2bs4">
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_province_marry'] == '0' or $client['guarantor_province_marry'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client1['province_id']; ?>"><?php echo $client1['province_name_th']; ?></option>
          <?php } ?>
          <?php foreach ($contract->listProvinces("provinces") as $clientProvinceslist) : ?>
            <option value="<?php echo $clientProvinceslist['province_id']; ?>"><?php echo $clientProvinceslist['province_name_th']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>อำเภอ/เขต</label>
        <select name="guarantor_district_marry" id="selAmphur1" class="custom-select select2bs4">
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_district_marry'] == '0' or $client['guarantor_district_marry'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client1['amphures_id']; ?>"><?php echo $client1['amphures_name_th']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ตำบล/แขวง</label>
        <select name="guarantor_sub_district_marry" id="selTumbon1" class="custom-select select2bs4">
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_sub_district_marry'] == '0' or $client['guarantor_sub_district_marry'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client1['districts_id']; ?>"><?php echo $client1['districts_name_th']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>รหัสไปรษณีย์</label>
        <select name="guarantor_postal_code_marry" id="selZipcode1" class="custom-select">
          <?php if ($client['contract_guarantor_id'] == '0' or $client['guarantor_postal_code_marry'] == '0' or $client['guarantor_postal_code_marry'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client['guarantor_postal_code_marry']; ?>"><?php echo $client['guarantor_postal_code_marry']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์</label>
        <input type="text" class="form-control" name="guarantor_home_phone_marry" placeholder="" value="<?php echo $client['guarantor_home_phone_marry']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์มือถือ</label>
        <input type="text" class="form-control" name="guarantor_mobile_phone_marry" placeholder="" value="<?php echo $client['guarantor_mobile_phone_marry']; ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>ลักษณะของงาน</label>
        <input type="text" class="form-control" name="guarantor_nature_work_marry" placeholder="" value="<?php echo $client['guarantor_nature_work_marry']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>แผนก</label>
        <input type="text" class="form-control" name="guarantor_department_work_marry" placeholder="" value="<?php echo $client['guarantor_department_work_marry']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ตำแหน่ง</label>
        <input type="text" class="form-control" name="guarantor_position_work_marry" placeholder="" value="<?php echo $client['guarantor_position_work_marry']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เวลาที่สะดวกในการติดต่อ</label>
        <input type="text" class="form-control" name="guarantor_contact_time_marry" placeholder="" value="<?php echo $client['guarantor_contact_time_marry']; ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>จำนวนปีที่ทำงาน</label>
        <input type="text" class="form-control" name="guarantor_numberyears_work_marry" placeholder="" value="<?php echo $client['guarantor_numberyears_work_marry']; ?>">
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-12">
      <input type="hidden" name="guarantor_id" value="<?php echo $client['guarantor_id']; ?>">
      <input type="hidden" name="cus_id" value="<?php echo $cusid; ?>">
      <input type="hidden" name="contract_id" value="<?php echo $id; ?>">
      <input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
      <a href="contract" class="btn btn-secondary float-right">Cancel</a>

    </div>
  </div>
</form>