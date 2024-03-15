<form id="<?php if ($id != '') {
            echo 'userseditdata';
          } else {
            echo 'usersinsertdata';
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
        <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" type="number" class="form-control" name="cus_username" placeholder="เลขบัตรประชาชน 13 หลัก ไม่ต้องใส่ขีด" value="<?php echo $client['cus_cardid']; ?>" required>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>วันเกิด</label>
        <input type="date" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>เพศ</label>
        <select class="custom-select" name="cus_prename" required>
          <?php if ($id == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
          <?php } ?>
          <option value="ชาย">ชาย</option>
          <option value="หญิง">หญิง</option>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>สถานภาพสมรส</label>
        <select class="custom-select" name="cus_prename" required>
          <?php if ($id == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
          <?php } ?>
          <?php foreach ($customer->listStatusMarryClient("set_statusmarry") as $clientstatusmarry) : ?>
            <option value="<?php echo $clientstatusmarry['setmar_id']; ?>"><?php echo $clientstatusmarry['setmar_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เลขทะเบียนการค้า</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>ที่อยู่ปัจจุบันที่ติดต่อได้</label>
        <input type="text" class="form-control" name="cus_tel" placeholder="ระบุวันเกิด" value="<?php echo $client['cus_tel']; ?>" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>บ้านเลขที่</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label>หมู่ที่</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ซอย</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ถนน</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>ตำบล/แขวง</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>อำเภอ/เขต</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>จังหวัด</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>รหัสไปรษณีย์</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์บ้าน</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์มือถือ</label>
        <input type="text" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>จำนวนปีที่อาศัยอยู่</label>
        <input type="number" class="form-control" name="" placeholder="" value="" required>
      </div>
    </div>
    <div class="col-md-3">
      <label>สถานภาพที่อยู่</label>
      <select class="custom-select" name="cus_prename" required>
        <?php if ($id == '') { ?>
          <option value="">---เลือก---</option>
        <?php } else { ?>
          <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
        <?php } ?>
        <?php foreach ($customer->listStatusAddressClient("set_statusaddress") as $clientstatusaddress) : ?>
          <option value="<?php echo $clientstatusaddress['setadd_id']; ?>"><?php echo $clientstatusaddress['setadd_name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <!-- <hr style="border-bottom:2px solid #28a745;"> -->



  <div class="row mt-3">
    <div class="col-12">
      <input type="hidden" name="cus_id" value="<?php echo $client['cus_id'] ?>">
      <input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
      <a href="customer" class="btn btn-secondary float-right">Cancel</a>

    </div>
  </div>
</form>