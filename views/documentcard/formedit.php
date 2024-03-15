<?php
$clientInfo = $documentcard->getInfo("contract", $client['contract_id']);
$clientInfoSubHenchman = $documentcard->getInfoSubHenchman("contract", $client['contract_id']);
?>
<div class="modal fade" id="modal-edit-documentcard<?php echo $i; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">ฟอร์มบันทึกข้อมูลพนักงาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="documentcardeditdata" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>ชื่อพนักงาน (หัวหน้า)</label>
                <select class="custom-select" name="contract_personnelhead_id" required>
                  <?php if ($clientInfo['contract_personnelhead_id'] == '0') { ?>
                    <option value="">---เลือก---</option>
                  <?php } else { ?>
                    <option value="<?php echo $clientInfo['per_id']; ?>"><?php echo $clientInfo['per_fullname']; ?></option>
                  <?php } ?>
                  <?php foreach ($documentcard->listPersonnelClient("personnel") as $clientpersonnel) : ?>
                    <option value="<?php echo $clientpersonnel['per_id']; ?>"><?php echo $clientpersonnel['per_fullname']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>ชื่อพนักงาน (ลูกน้อง)</label>
                <select class="custom-select" name="contract_personnelhenchman_id" required>
                  <?php if ($clientInfoSubHenchman['contract_personnelhenchman_id'] == '0') { ?>
                    <option value="">---เลือก---</option>
                  <?php } else { ?>
                    <option value="<?php echo $clientInfoSubHenchman['per_id']; ?>"><?php echo $clientInfoSubHenchman['per_fullname']; ?></option>
                  <?php } ?>
                  <?php foreach ($documentcard->listPersonnelClient("personnel") as $clientpersonnel) : ?>
                    <option value="<?php echo $clientpersonnel['per_id']; ?>"><?php echo $clientpersonnel['per_fullname']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <!-- <div class="col-md-12">
              <div class="form-group text-left">
                <label>เบอร์โทร</label>
                <input type="text" class="form-control" name="per_tel" placeholder="ระบุเบอร์โทร" value="<?php echo $client['per_tel']; ?>" required>
              </div>
            </div> -->
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="contract_id" value="<?php echo $clientInfo['contract_id']; ?>">
          <input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->