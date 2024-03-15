<div class="modal fade" id="modal-edit-setlinework<?php echo $i; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">ฟอร์มบันทึกข้อมูลสายงาน/พนักงาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="setlineworkeditdata" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>รหัส</label>
                <input type="text" class="form-control" name="lw_code" placeholder="ระบุรหัสสายงาน" value="<?php echo $client['lw_code']; ?>" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>ชื่อสายงาน</label>
                <input type="text" class="form-control" name="lw_name" placeholder="ระบุชื่อสายงาน" value="<?php echo $client['lw_name']; ?>" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>ชื่อพนักงาน(หัวหน้า)</label>
                <input type="text" class="form-control" name="lw_personnelhead_name" placeholder="ชื่อพนักงาน" value="<?php echo $client['lw_personnelhead_name']; ?>" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>เบอร์โทร</label>
                <input type="text" class="form-control" name="lw_personnelhead_tel" placeholder="เบอร์โทร" value="<?php echo $client['lw_personnelhead_tel']; ?>" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>ชื่อพนักงาน(ลูกน้อง)</label>
                <input type="text" class="form-control" name="lw_personnelhenchman_name" placeholder="ชื่อพนักงาน" value="<?php echo $client['lw_personnelhenchman_name']; ?>" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>เบอร์โทร</label>
                <input type="text" class="form-control" name="lw_personnelhenchman_tel" placeholder="เบอร์โทร" value="<?php echo $client['lw_personnelhenchman_tel']; ?>" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="lw_id" value="<?php echo $client['lw_id'] ?>">
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