<?php
if (isset($_SESSION['sess_id']) && !empty($_SESSION['sess_id'])) {
  $id = $_SESSION['sess_id'];
}
$profile = new Profile();
$client = $profile->getInfo("users", $id);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>แก้ไขรหัสผ่าน</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">แก้ไขรหัสผ่าน</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-success card-outline">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h3 class="card-title">ฟอร์มจัดการรหัสผ่าน</h3>
            </div>
            <div class="col-md-6 text-right">
              <!-- <a type="button" class="btn btn-success" href="usersform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
            </div>
          </div>
        </div> <!-- /.card-body -->
        <div class="card-body">
          <form id="changepassworddata" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>รหัสผ่านใหม่</label>
                  <input type="password" class="form-control" name="password_new" placeholder="ระบุรหัสผ่านใหม่" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ยืนยันรหัสผ่านใหม่</label>
                  <input type="password" class="form-control" name="password_new_confirm" placeholder="ยืนยันรหัสผ่านใหม่" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>รหัสผ่านเดิม</label>
                  <input type="password" class="form-control" name="password_old" placeholder="ระบุรหัสผ่านเดิม" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <input type="hidden" name="u_id" value="<?php echo $id; ?>">
                <input type="submit" value="เปลี่ยนรหัสผ่าน" class="btn btn-success">
                <!-- <a href="users" class="btn btn-secondary float-right">Cancel</a> -->

              </div>
            </div>
          </form>
        </div><!-- /.card-body -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->