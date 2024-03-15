<div class="modal fade" id="modal-edit-personnel<?php echo $i; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">ฟอร์มบันทึกข้อมูลพนักงาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="personneleditdata" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>ชื่อพนักงาน</label>
                <input type="text" class="form-control" name="per_fullname" placeholder="ระบุชื่อพนักงาน" value="<?php echo $client['per_fullname']; ?>" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>เบอร์โทร</label>
                <input type="text" class="form-control" name="per_tel" placeholder="ระบุเบอร์โทร" value="<?php echo $client['per_tel']; ?>" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="per_id" value="<?php echo $client['per_id'] ?>">
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