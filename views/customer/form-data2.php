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

  </div>
  <!-- <hr style="border-bottom:2px solid #28a745;"> -->
  <div class="row">
    <div class="col-md-3">
      <label>สถานภาพการงาน</label>
      <select class="custom-select" name="cus_prename" required>
        <?php if ($id == '') { ?>
          <option value="">---เลือก---</option>
        <?php } else { ?>
          <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
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
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>เลขที่</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label>หมู่ที่</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ซอย</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ถนน</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>ตำบล/แขวง</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>อำเภอ/เขต</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>จังหวัด</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>รหัสไปรษณีย์</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>โทรศัพท์มือถือ</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
  </div>
  <hr style="border-bottom:2px solid #28a745;">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>ลักษณะของงาน</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>แผนก</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ตำแหน่ง</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เวลาที่สะดวกในการติดต่อ</label>
        <input type="text" class="form-control" name="" placeholder="" value="">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>จำนวนปีที่ทำงาน</label>
        <input type="number" class="form-control" name="" placeholder="" value="">
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