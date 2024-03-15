<?php
$contract = new Contract();
$client = $contract->getInfoContactEmergency("contract", $id);
?>
<form id="<?php if ($client['contract_contactemergency_id'] != '0') {
            echo 'contactemergencyeditdata';
          } else {
            echo 'contactemergencyinsertdata';
          } ?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label>คำนำหน้าชื่อ</label>
        <select class="custom-select" name="coem_prename" required>
          <?php if ($client['contract_contactemergency_id'] == '0' or $client['coem_prename'] == '0' or $client['coem_prename'] == '') { ?>
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
      <input type="hidden" name="coem_id" value="<?php echo $client['coem_id']; ?>">
      <input type="hidden" name="cus_id" value="<?php echo $cusid; ?>">
      <input type="hidden" name="contract_id" value="<?php echo $id; ?>">
      <input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
      <a href="contract" class="btn btn-secondary float-right">Cancel</a>

    </div>
  </div>
</form>