<form id="<?php if ($id != '') {
            echo 'customereditdata';
          } else {
            echo 'customerinsertdata';
          } ?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>คำนำหน้าชื่อ</label>
        <select class="custom-select" name="cus_prename" required>
          <?php if ($id == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
          <?php } ?>
          <?php foreach ($customer->listPrenameClient("set_prename") as $clientprename) : ?>
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
    <div class="col-md-4">
      <div class="form-group">
        <label>เลขบัตรประชาชน</label>
        <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" type="number" class="form-control" name="cus_card_id" placeholder="เลขบัตรประชาชน 13 หลัก ไม่ต้องใส่ขีด" value="<?php echo $client['cus_card_id']; ?>" required>
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
            <option value="<?php echo $client['cus_statusmarry']; ?>"><?php echo $client['cus_statusmarry']; ?></option>
          <?php } ?>
          <?php foreach ($customer->listStatusMarryClient("set_statusmarry") as $clientstatusmarry) : ?>
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
    <div class="col-md-3">
      <div class="form-group">
        <label>ตำบล/แขวง</label>
        <input type="text" class="form-control" name="cus_sub_district" placeholder="ระบุชื่อตำบล/แขวง" value="<?php echo $client['cus_sub_district']; ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>อำเภอ/เขต</label>
        <input type="text" class="form-control" name="cus_district" placeholder="ระบุชื่อจังหวัด" value="<?php echo $client['cus_district']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>จังหวัด</label>
        <input type="text" class="form-control" name="cus_province" placeholder="" value="<?php echo $client['cus_province']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>รหัสไปรษณีย์</label>
        <input type="text" class="form-control" name="cus_postal_code" placeholder="ระบุรหัสไปรษณีย์" value="<?php echo $client['cus_postal_code']; ?>">
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
        <input type="number" class="form-control" name="cus_numberyears_lived" value="<?php echo $client['cus_numberyears_lived']; ?>">
        <div class="input-group-append">
          <span class="input-group-text">ปี</span>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <label>&nbsp;</label>
      <div class="input-group">
        <input type="number" class="form-control" name="cus_numbermonths_lived" value="<?php echo $client['cus_numbermonths_lived']; ?>">
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
          <option value="<?php echo $client['cus_statusaddress']; ?>"><?php echo $client['cus_statusaddress']; ?></option>
        <?php } ?>
        <?php foreach ($customer->listStatusAddressClient("set_statusaddress") as $clientstatusaddress) : ?>
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
          <option value="<?php echo $client['cus_cohabiting']; ?>"><?php echo $client['cus_cohabiting']; ?></option>
        <?php } ?>
        <?php foreach ($customer->listCohabitingClient("set_cohabiting") as $clientcohabiting) : ?>
          <option value="<?php echo $clientcohabiting['setcoh_id']; ?>"><?php echo $clientcohabiting['setcoh_name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>จำนวนบุคคลที่อาศัยอยู่ด้วย(คน)</label>
        <input type="number" class="form-control" name="cus_number_lived" placeholder="ระบุจำนวนบุคคลที่อาศัยอยู่ด้วย(คน)" value="<?php echo $client['cus_number_lived']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <label>สถานภาพการงาน</label>
      <select class="custom-select" name="cus_statuswork" required>
        <?php if ($id == '') { ?>
          <option value="">---เลือก---</option>
        <?php } else { ?>
          <option value="<?php echo $client['cus_statuswork']; ?>"><?php echo $client['cus_statuswork']; ?></option>
        <?php } ?>
        <?php foreach ($customer->listStatusWorkClient("set_statuswork") as $clientStatusWork) : ?>
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
        <label>ตำบล/แขวง</label>
        <input type="text" class="form-control" name="cus_sub_district_work" placeholder="" value="<?php echo $client['cus_sub_district_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>อำเภอ/เขต</label>
        <input type="text" class="form-control" name="cus_district_work" placeholder="" value="<?php echo $client['cus_district_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>จังหวัด</label>
        <input type="text" class="form-control" name="cus_province_work" placeholder="" value="<?php echo $client['cus_province_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>รหัสไปรษณีย์</label>
        <input type="text" class="form-control" name="cus_postal_code_work" placeholder="" value="<?php echo $client['cus_postal_code_work']; ?>">
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
        <input type="number" class="form-control" name="cus_numberyears_work" placeholder="" value="<?php echo $client['cus_numberyears_work']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เงินรายได้ (ต่อวัน)</label>
        <input type="number" class="form-control" name="cus_income_day" placeholder="" value="<?php echo $client['cus_income_day']; ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เงินรายได้ (ต่อเดือน)</label>
        <input type="number" class="form-control" name="cus_income_month" placeholder="" value="<?php echo $client['cus_income_month']; ?>">
      </div>
    </div>

  </div>

  <div class="row mt-3">
    <div class="col-12">
      <input type="hidden" name="cus_id" value="<?php echo $client['cus_id'] ?>">
      <input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
      <a href="customer" class="btn btn-secondary float-right">Cancel</a>

    </div>
  </div>
</form>