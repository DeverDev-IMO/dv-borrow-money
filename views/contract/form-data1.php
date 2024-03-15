<?php
$contract = new Contract();
$client = $contract->getInfoCustomer("contract", $id);
$client1 = $contract->getInfoCustomerSub("contract", $id);

// $n = 66.66667;
// echo floor($n);
?>
<style>
  /* .select2-selection__rendered {
    line-height: 38px !important;
  }

  .select2-container .select2-selection--single {
    height: 38px !important;
  }

  .select2-selection__arrow {
    height: 38px !important;
  } */
</style>
<form id="<?php if ($id != '') {
            echo 'contracteditdata';
          } else {
            echo 'contractinsertdata';
          } ?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <!-- <div class="col-md-2">
      <div class="form-group">
        <label>Timezone</label>
        <select class="custom-select js-example-tags" name="cus_card_id">
          <option selected="selected">orange</option>
          <option>white</option>
          <option>purple</option>
        </select>
      </div>
    </div> -->
    <div class="col-md-2">
      <div class="form-group">
        <label>เลขบัตรประชาชน</label>
        <input id="search-cardid" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" type="number" class="form-control" name="cus_card_id" placeholder="เลขบัตรประชาชน 13 หลัก ไม่ต้องใส่ขีด" value="<?php echo $client['cus_card_id']; ?>" required>
        <div class="list-group" style="position:absolute;z-index:99;width:250px;" id="show-list"></div>
      </div>

    </div>
    <!-- <div class="col-md-2">
      <div class="form-group">
        <label>เลขบัตรประชาชน</label>
        <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" type="number" class="form-control" name="cus_card_id" placeholder="เลขบัตรประชาชน 13 หลัก ไม่ต้องใส่ขีด" value="<?php echo $client['cus_card_id']; ?>" required>
      </div>
    </div> -->
    <div class="col-md-2">
      <div class="form-group">
        <label>คำนำหน้าชื่อ</label>
        <select class="custom-select" name="cus_prename" required>
          <!-- <span id="show_cus_prename"></span> -->
          <?php if ($id == '') { ?>
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
        <input type="text" class="form-control" name="cus_firstname" placeholder="ไม่ต้องพิมพ์คำนำหน้าชือ" value="<?php echo $client['cus_firstname']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>นามสกุล</label>
        <input type="text" class="form-control" name="cus_lastname" placeholder="ระบุนามสกุล" value="<?php echo $client['cus_lastname']; ?>" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>ชื่อเล่น</label>
        <input type="text" class="form-control" name="cus_nickname" placeholder="ระบุชื่อเล่น" value="<?php echo $client['cus_nickname']; ?>" required>
      </div>
    </div>

  </div>
  <div class="row">

    <div class="col-md-2">
      <div class="form-group">
        <label>วันเกิด</label>
        <input type="date" class="form-control" name="cus_birthday" placeholder="ระบุวันเกิด" value="<?php echo $client['cus_birthday']; ?>" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>อายุ</label>
        <input type="number" class="form-control" name="cus_age" placeholder="ระบุอายุ" value="<?php echo $client['cus_age']; ?>" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>เพศ</label>
        <select class="custom-select" name="cus_gender" required>
          <?php if ($id == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['cus_gender']; ?>"><?php echo $client['cus_gender']; ?></option>
          <?php } ?>
          <option value="ชาย">ชาย</option>
          <option value="หญิง">หญิง</option>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>สถานภาพสมรส</label>
        <select class="custom-select" name="cus_statusmarry" required>
          <?php if ($id == '') { ?>
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
    <div class="col-md-4">
      <div class="form-group">
        <label>ที่อยู่ปัจจุบันที่ติดต่อได้</label>
        <input type="text" class="form-control" name="cus_address" placeholder="ระบุที่อยู่ปัจจุบันที่ติดต่อได้" value="<?php echo $client['cus_address']; ?>" required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>บ้านเลขที่</label>
        <input type="text" class="form-control" name="cus_house_no" placeholder="ระบุบ้านเลขที่" value="<?php echo $client['cus_house_no']; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label>หมู่ที่</label>
        <input type="text" class="form-control" name="cus_village" placeholder="" value="<?php echo $client['cus_village']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ซอย</label>
        <input type="text" class="form-control" name="cus_lane" placeholder="ระบุชื่อซอย" value="<?php echo $client['cus_lane']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ถนน</label>
        <input type="text" class="form-control" name="cus_streee" placeholder="ระบุชื่อถนน" value="<?php echo $client['cus_streee']; ?>">
      </div>
    </div>
    <!-- <div class="col-md-3">
      <div class="form-group">
        <label>ตำบล/แขวง</label>
        <input type="text" class="form-control" name="cus_sub_district" placeholder="ระบุชื่อตำบล/แขวง" value="<?php echo $client['cus_sub_district']; ?>">
      </div>
    </div> -->
    <div class="col-md-3">
      <div class="form-group">
        <label>จังหวัด</label>
        <select name="cus_province" id="selProvince" class="custom-select select2bs4" required>
          <?php if ($id == '') { ?>
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
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>อำเภอ/เขต</label>
        <select name="cus_district" id="selAmphur" class="custom-select select2bs4" required>
          <?php if ($id == '') { ?>
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
        <select name="cus_sub_district" id="selTumbon" class="custom-select select2bs4" required>
          <?php if ($id == '') { ?>
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
        <select name="cus_postal_code" id="selZipcode" class="custom-select" required>
          <?php if ($id == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client['cus_postal_code']; ?>"><?php echo $client['cus_postal_code']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์บ้าน</label>
        <input type="text" class="form-control" name="cus_home_phone" placeholder="ระบุโทรศัพท์บ้าน" value="<?php echo $client['cus_home_phone']; ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์มือถือ</label>
        <input type="text" class="form-control" name="cus_mobile_phone" placeholder="ระบุโทรศัพท์มือถือ" value="<?php echo $client['cus_mobile_phone']; ?>">
      </div>
    </div>
    <div class="col-md-2">
      <label>จำนวนปีที่อาศัยอยู่</label>
      <div class="input-group">
        <input type="text" class="form-control" name="cus_numberyears_lived" value="<?php echo $client['cus_numberyears_lived']; ?>">
        <div class="input-group-append">
          <span class="input-group-text">ปี</span>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <label>&nbsp;</label>
      <div class="input-group">
        <input type="text" class="form-control" name="cus_numbermonths_lived" value="<?php echo $client['cus_numbermonths_lived']; ?>">
        <div class="input-group-append">
          <span class="input-group-text">เดือน</span>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <label>สถานภาพที่อยู่</label>
      <select class="custom-select" name="cus_statusaddress" required>
        <?php if ($id == '') { ?>
          <option value="">---เลือก---</option>
        <?php } else { ?>
          <option value="<?php echo $client['setadd_id']; ?>"><?php echo $client['setadd_name']; ?></option>
        <?php } ?>
        <?php foreach ($contract->listStatusAddressClient("set_statusaddress") as $clientstatusaddress) : ?>
          <option value="<?php echo $clientstatusaddress['setadd_id']; ?>"><?php echo $clientstatusaddress['setadd_name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label>อาศัยอยู่กับ</label>
      <select class="custom-select" name="cus_cohabiting" required>
        <?php if ($id == '') { ?>
          <option value="">---เลือก---</option>
        <?php } else { ?>
          <option value="<?php echo $client['setcoh_id']; ?>"><?php echo $client['setcoh_name']; ?></option>
        <?php } ?>
        <?php foreach ($contract->listCohabitingClient("set_cohabiting") as $clientcohabiting) : ?>
          <option value="<?php echo $clientcohabiting['setcoh_id']; ?>"><?php echo $clientcohabiting['setcoh_name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>จำนวนบุคคลที่อาศัยอยู่ด้วย(คน)</label>
        <input type="text" class="form-control" name="cus_number_lived" placeholder="ระบุจำนวนบุคคลที่อาศัยอยู่ด้วย(คน)" value="<?php echo $client['cus_number_lived']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <label>สถานภาพการงาน</label>
      <select class="custom-select" name="cus_statuswork" required>
        <?php if ($id == '') { ?>
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
  <hr style="border-bottom:2px solid #28a745;">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>สถานที่ทำงาน ชื่ออาคาร</label>
        <input type="text" class="form-control" name="cus_workplace" placeholder="" value="<?php echo $client['cus_workplace']; ?>">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>เลขที่</label>
        <input type="text" class="form-control" name="cus_workplace_no" placeholder="" value="<?php echo $client['cus_workplace_no']; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label>หมู่ที่</label>
        <input type="text" class="form-control" name="cus_village_work" placeholder="" value="<?php echo $client['cus_village_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ซอย</label>
        <input type="text" class="form-control" name="cus_lane_work" placeholder="" value="<?php echo $client['cus_lane_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ถนน</label>
        <input type="text" class="form-control" name="cus_streee_work" placeholder="" value="<?php echo $client['cus_streee_work']; ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>จังหวัด</label>
        <select name="cus_province_work" id="selProvince1" class="custom-select select2bs4" required>
          <?php if ($id == '') { ?>
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
        <select name="cus_district_work" id="selAmphur1" class="custom-select select2bs4" required>
          <?php if ($id == '') { ?>
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
        <select name="cus_sub_district_work" id="selTumbon1" class="custom-select select2bs4" required>
          <?php if ($id == '') { ?>
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
        <select name="cus_postal_code_work" id="selZipcode1" class="custom-select" required>
          <?php if ($id == '') { ?>
            <option value="">กรุณาเลือก</option>
          <?php } else { ?>
            <option value="<?php echo $client['cus_postal_code_work']; ?>"><?php echo $client['cus_postal_code_work']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์</label>
        <input type="text" class="form-control" name="cus_home_phone_work" placeholder="" value="<?php echo $client['cus_home_phone_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์มือถือ</label>
        <input type="text" class="form-control" name="cus_mobile_phone_work" placeholder="" value="<?php echo $client['cus_home_phone_work']; ?>">
      </div>
    </div>
  </div>
  <hr style="border-bottom:2px solid #28a745;">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>ลักษณะของงาน</label>
        <input type="text" class="form-control" name="cus_nature_work" placeholder="" value="<?php echo $client['cus_nature_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>แผนก</label>
        <input type="text" class="form-control" name="cus_department_work" placeholder="" value="<?php echo $client['cus_department_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ตำแหน่ง</label>
        <input type="text" class="form-control" name="cus_position_work" placeholder="" value="<?php echo $client['cus_position_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เวลาที่สะดวกในการติดต่อ</label>
        <input type="text" class="form-control" name="cus_contact_time" placeholder="" value="<?php echo $client['cus_contact_time']; ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>จำนวนปีที่ทำงาน (ปี)</label>
        <input type="text" class="form-control" name="cus_numberyears_work" placeholder="" value="<?php echo $client['cus_numberyears_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เงินรายได้ (ต่อวัน)</label>
        <input type="text" class="form-control" name="cus_income_day" placeholder="" value="<?php echo $client['cus_income_day']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เงินรายได้ (ต่อเดือน)</label>
        <input type="text" class="form-control" name="cus_income_month" placeholder="" value="<?php echo $client['cus_income_month']; ?>">
      </div>
    </div>

  </div>

  <div class="row mt-3">
    <div class="col-12">
      <input type="hidden" name="contract_id" value="<?php echo $client['contract_id'] ?>">
      <input type="hidden" name="cus_id" value="<?php echo $client['cus_id'] ?>">
      <input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
      <a href="contract" class="btn btn-secondary float-right">Cancel</a>

    </div>
  </div>
</form>