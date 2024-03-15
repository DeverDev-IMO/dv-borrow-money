<?php
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
}
$users = new Users();
$client = $users->getInfo("users", $id);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ข้อมูลผู้ใช้งาน</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="users">รายการข้อมูลผู้ใช้งาน</a></li>
            <li class="breadcrumb-item active">ฟอร์มบันทึกข้อมูล</li>
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
              <h3 class="card-title">ฟอร์มบันทึกข้อมูล</h3>
            </div>
            <div class="col-md-6 text-right">
              <!-- <a type="button" class="btn btn-success" href="usersform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
            </div>
          </div>
        </div> <!-- /.card-body -->
        <div class="card-body">
          <form id="<?php if ($id != '') {
                      echo 'userseditdata';
                    } else {
                      echo 'usersinsertdata';
                    } ?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>คำนำหน้าชื่อ</label>
                  <select class="custom-select" name="u_prename" required>
                    <?php if ($id == '') { ?>
                      <option value="">---เลือก---</option>
                    <?php } else { ?>
                      <option value="<?php echo $client['u_prename']; ?>"><?php echo $client['u_prename']; ?></option>
                    <?php } ?>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ชื่อ</label>
                  <input type="text" class="form-control" name="u_firstname" placeholder="ไม่ต้องพิมพ์คำนำหน้าชือ" value="<?php echo $client['u_firstname']; ?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>นามสกุล</label>
                  <input type="text" class="form-control" name="u_lastname" placeholder="ระบุนามสกุล" value="<?php echo $client['u_lastname']; ?>" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>ชื่อผู้ใช้</label>
                  <input type="text" class="form-control" name="u_username" placeholder="ระบุชื่อผู้ใช้" value="<?php echo $client['u_username']; ?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>เบอร์โทร</label>
                  <input type="text" class="form-control" name="u_tel" placeholder="ระบุชื่อเบอร์โทร" value="<?php echo $client['u_tel']; ?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>อีเมล์</label>
                  <input type="email" class="form-control" name="u_email" placeholder="ระบุชื่ออีเมล์" value="<?php echo $client['u_email']; ?>" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>ที่อยู่</label>
                  <input type="text" class="form-control" name="u_address" placeholder="ระบุที่อยู่" value="<?php echo $client['u_address']; ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ถนน</label>
                  <input type="text" class="form-control" name="u_road" placeholder="ระบุชื่อถนน" value="<?php echo $client['u_road']; ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ตำบล</label>
                  <input type="text" class="form-control" name="u_district" placeholder="ระบุชื่อตำบล" value="<?php echo $client['u_district']; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>อำเภอ</label>
                  <input type="text" class="form-control" name="u_amphoe" placeholder="ระบุชื่ออำเภอ" value="<?php echo $client['u_amphoe']; ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>จังหวัด</label>
                  <input type="text" class="form-control" name="u_province" placeholder="ระบุชื่อจังหวัด" value="<?php echo $client['u_province']; ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>รหัสไปรษณีย์</label>
                  <input type="text" class="form-control" name="u_zipcode" placeholder="ระบุรหัสไปรษณีย์" value="<?php echo $client['u_zipcode']; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>สิทธิ์การใช้งาน</label>
                  <select class="custom-select" name="u_accessrights" required>
                    <?php if ($id == '') { ?>
                      <option value="">---เลือก---</option>
                    <?php } else { ?>
                      <option value="<?php echo $client['u_accessrights']; ?>"><?php echo $client['u_accessrights']; ?></option>
                    <?php } ?>
                    <option value="admin">ผู้ดูแลระบบ</option>
                    <option value="user">สมาชิก</option>
                    <?php if ($_SESSION['sess_accessrights'] == 'superadmin') { ?>
                      <option value="superadmin">ผู้ดูแลระบบสูงสุด</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>สถานะอนุมัติใช้งาน</label>
                  <select class="custom-select" name="u_status" required>
                    <?php if ($id == '') { ?>
                      <option value="">---เลือก---</option>
                    <?php
                    } else {
                      if ($client['u_status'] != 1) {
                        echo '<option value="0">ไม่อนุมัติใช้งาน</option>';
                      } else {
                        echo '<option value="1">อนุมัติใช้งาน</option>';
                      }
                    }
                    ?>
                    <option value="0">ไม่อนุมัติใช้งาน</option>
                    <option value="1">อนุมัติใช้งาน</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-12">
                <input type="hidden" name="u_id" value="<?php echo $client['u_id'] ?>">
                <input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
                <a href="users" class="btn btn-secondary float-right">Cancel</a>

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