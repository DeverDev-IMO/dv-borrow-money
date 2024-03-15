<form id="<?php if ($id != '') {
            echo 'contactemergencyeditdata';
          } else {
            echo 'contactemergencyinsertdata';
          } ?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>คำนำหน้าชื่อ</label>
        <select class="custom-select" name="coem_prename" required>
          <?php if ($id == '') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option value="<?php echo $client['coem_prename']; ?>"><?php echo $client['coem_prename']; ?></option>
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
        <input type="text" class="form-control" name="coem_firstname" placeholder="ไม่ต้องพิมพ์คำนำหน้าชือ" value="<?php echo $client['coem_firstname']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>นามสกุล</label>
        <input type="text" class="form-control" name="coem_lastname" placeholder="ระบุนามสกุล" value="<?php echo $client['coem_lastname']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ความสัมพันธ์</label>
        <input type="text" class="form-control" name="coem_relation" placeholder="" value="<?php echo $client['coem_relation']; ?>" required>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-7">
      <div class="form-group">
        <label>สถานที่ติดต่อได้</label>
        <input type="text" class="form-control" name="coem_place_contact" placeholder="" value="<?php echo $client['coem_place_contact']; ?>" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>โทรศัพท์</label>
        <input type="text" class="form-control" name="coem_phone_number" placeholder="" value="<?php echo $client['coem_phone_number']; ?>" required>
      </div>
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