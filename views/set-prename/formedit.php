<div class="modal fade" id="modal-edit-setprename<?php echo $i; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">ฟอร์มบันทึกข้อมูลคำนำหน้าชื่อ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="setprenameeditdata" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>รายการ</label>
                <input type="text" class="form-control" name="setpre_name" placeholder="ระบุคำนำหน้าชื่อ" value="<?php echo $client['setpre_name']; ?>" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="setpre_id" value="<?php echo $client['setpre_id'] ?>">
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