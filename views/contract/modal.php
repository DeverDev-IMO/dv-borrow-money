<div class="modal fade" id="modal-edit-numbercontract<?php echo $i; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เเก้ไขเลขที่สัญญา</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="numbercontracteditdata" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>เลขที่สัญญา</label>
                <input type="text" class="form-control" name="contract_number" value="<?php echo $client['contract_number']; ?>" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>ชื่อ-สกุล</label>
                <input type="text" class="form-control-plaintext" value="<?php echo $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname']; ?>" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="contract_id" value="<?php echo $client['contract_id'] ?>">
          <input type="submit" value="แก้ไขข้อมูล" class="btn btn-success">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->