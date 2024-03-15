<?php
$contract = new Contract();
$client = $contract->getInfoMarryDetail("contract", $id);
?>
<form id="<?php if ($client['contract_marrydetail_id'] != '0') {
            echo 'marrydetaileditdata';
          } else {
            echo 'marrydetailinsertdata';
          } ?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>คำนำหน้าชื่อ</label>
        <select class="custom-select" name="marryd_prename">
          <?php //if ($client['setpre_id'] != '' and  $client['setpre_id'] != 0) { 
          ?>
          <?php if ($client['contract_marrydetail_id'] == '0' or $client['marryd_prename'] == '0' or $client['marryd_prename'] == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['setpre_id']; ?>"><?php echo $client['setpre_name']; ?></option>
          <?php } ?>
          <?php foreach ($contract->listPrenameClient("set_prename") as $clientprename) : ?>
            <option value="<?php echo $clientprename['setpre_id']; ?>"><?php echo $clientprename['setpre_name']; ?></option>
          <?php endforeach; ?>
          <option value="0">---ไม่ระบุ---</option>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ชื่อ</label>
        <input type="text" class="form-control" name="marryd_firstname" placeholder="ไม่ต้องพิมพ์คำนำหน้าชือ" value="<?php echo $client['marryd_firstname']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>นามสกุล</label>
        <input type="text" class="form-control" name="marryd_lastname" placeholder="ระบุนามสกุล" value="<?php echo $client['marryd_lastname']; ?>">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>ชื่อเล่น</label>
        <input type="text" class="form-control" name="marryd_nickname" placeholder="ระบุชื่อเล่น" value="<?php echo $client['marryd_nickname']; ?>">
      </div>
    </div>

  </div>
  <!-- <hr style="border-bottom:2px solid #28a745;"> -->
  <div class="row">
    <div class="col-md-3">
      <label>สถานภาพการงาน</label>
      <select class="custom-select" name="marryd_statuswork">
        <?php if ($client['contract_marrydetail_id'] == '0' or $client['marryd_statuswork'] == '0') { ?>
          <option value="">---เลือก---</option>
        <?php } else { ?>
          <option value="<?php echo $client['setwork_id']; ?>"><?php echo $client['setwork_name']; ?></option>
        <?php } ?>
        <?php foreach ($contract->listStatusWorkClient("set_statuswork") as $clientStatusWork) : ?>
          <option value="<?php echo $clientStatusWork['setwork_id']; ?>"><?php echo $clientStatusWork['setwork_name']; ?></option>
        <?php endforeach; ?>
        <option value="0">---ไม่ระบุ---</option>
      </select>
    </div>
  </div>
  <hr style="border-bottom:2px solid #28a745;">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>สถานที่ทำงาน ชื่ออาคาร</label>
        <input type="text" class="form-control" name="marryd_workplace" placeholder="" value="<?php echo $client['marryd_workplace']; ?>">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>เลขที่</label>
        <input type="text" class="form-control" name="marryd_workplace_no" placeholder="" value="<?php echo $client['marryd_workplace_no']; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label>หมู่ที่</label>
        <input type="text" class="form-control" name="marryd_village" placeholder="" value="<?php echo $client['marryd_village']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ซอย</label>
        <input type="text" class="form-control" name="marryd_lane" placeholder="" value="<?php echo $client['marryd_lane']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ถนน</label>
        <input type="text" class="form-control" name="marryd_streee" placeholder="" value="<?php echo $client['marryd_streee']; ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <!-- <div class="col-md-3">
      <div class="form-group">
        <label>ตำบล/แขวง</label>
        <input type="text" class="form-control" name="marryd_sub_district" placeholder="" value="<?php echo $client['marryd_sub_district']; ?>">
      </div>
    </div> -->
    <div class="col-md-3">
      <div class="form-group">
        <label>จังหวัด</label>
        <select name="marryd_province" id="selProvince" class="custom-select select2bs4">
          <?php if ($client['contract_marrydetail_id'] == '0' or $client['marryd_province'] == '') { ?>
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
    <div class="col-md-3">
      <div class="form-group">
        <label>อำเภอ/เขต</label>
        <select name="marryd_district" id="selAmphur" class="custom-select select2bs4">
          <?php if ($client['contract_marrydetail_id'] == '0' or $client['marryd_district'] == '') { ?>
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
        <select name="marryd_sub_district" id="selTumbon" class="custom-select select2bs4">
          <?php if ($client['contract_marrydetail_id'] == '0' or $client['marryd_sub_district'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client['districts_id']; ?>"><?php echo $client['districts_name_th']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>รหัสไปรษณีย์</label>
        <select name="marryd_postal_code" id="selZipcode" class="custom-select">
          <?php if ($client['contract_marrydetail_id'] == '0' or $client['marryd_postal_code'] == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client['marryd_postal_code']; ?>"><?php echo $client['marryd_postal_code']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์</label>
        <input type="text" class="form-control" name="marryd_home_phone" placeholder="" value="<?php echo $client['marryd_home_phone']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์มือถือ</label>
        <input type="text" class="form-control" name="marryd_mobile_phone" placeholder="" value="<?php echo $client['marryd_mobile_phone']; ?>">
      </div>
    </div>
  </div>
  <hr style="border-bottom:2px solid #28a745;">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>ลักษณะของงาน</label>
        <input type="text" class="form-control" name="marryd_nature_work" placeholder="" value="<?php echo $client['marryd_nature_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>แผนก</label>
        <input type="text" class="form-control" name="marryd_department_work" placeholder="" value="<?php echo $client['marryd_department_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ตำแหน่ง</label>
        <input type="text" class="form-control" name="marryd_position_work" placeholder="" value="<?php echo $client['marryd_position_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เวลาที่สะดวกในการติดต่อ</label>
        <input type="text" class="form-control" name="marryd_contact_time" placeholder="" value="<?php echo $client['marryd_contact_time']; ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>จำนวนปีที่ทำงาน</label>
        <input type="text" class="form-control" name="marryd_numberyears_work" placeholder="" value="<?php echo $client['marryd_numberyears_work']; ?>">
      </div>
    </div>
  </div>


  <div class="row mt-3">
    <div class="col-12">
      <input type="hidden" name="marryd_id" value="<?php echo $client['marryd_id']; ?>">
      <input type="hidden" name="cus_id" value="<?php echo $cusid; ?>">
      <input type="hidden" name="contract_id" value="<?php echo $id; ?>">
      <input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
      <a href="contract" class="btn btn-secondary float-right">Cancel</a>

    </div>
  </div>
</form>