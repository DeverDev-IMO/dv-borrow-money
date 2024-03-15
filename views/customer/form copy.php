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
          <h1>ข้อมูลลูกค้า</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="users">รายการข้อมูลลูกค้า</a></li>
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
              <h3 class="card-title">ฟอร์มบันทึกข้อมูลส่วนตัวผู้กู้</h3>
            </div>
            <div class="col-md-6 text-right">
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
              <div class="col-md-2">
                <div class="form-group">
                  <label>คำนำหน้าชื่อ</label>
                  <select class="custom-select" name="cus_prename" required>
                    <?php if ($id == '') { ?>
                      <option value="">---เลือก---</option>
                    <?php } else { ?>
                      <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
                    <?php } ?>
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
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
              <div class="col-md-4">
                <div class="form-group">
                  <label>เลขบัตรประชาชน</label>
                  <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" type="number" class="form-control" name="cus_username" placeholder="เลขบัตรประชาชน 13 หลัก ไม่ต้องใส่ขีด" value="<?php echo $client['cus_cardid']; ?>" required>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-2">
                <div class="form-group">
                  <label>วันเกิด</label>
                  <input type="date" class="form-control" name="cus_tel" placeholder="ระบุวันเกิด" value="<?php echo $client['cus_tel']; ?>" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>อายุ</label>
                  <input type="number" class="form-control" name="cus_email" placeholder="ระบุชื่ออีเมล์" value="<?php echo $client['cus_email']; ?>" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>เพศ</label>
                  <select class="custom-select" name="cus_prename" required>
                    <?php if ($id == '') { ?>
                      <option value="">---เลือก---</option>
                    <?php } else { ?>
                      <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
                    <?php } ?>
                    <option value="ชาย">ชาย</option>
                    <option value="หญิง">หญิง</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>สถานะ</label>
                  <select class="custom-select" name="cus_prename" required>
                    <?php if ($id == '') { ?>
                      <option value="">---เลือก---</option>
                    <?php } else { ?>
                      <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
                    <?php } ?>
                    <option value="โสด">โสด</option>
                    <option value="แต่งงาน">แต่งงาน</option>
                    <option value="หย่าร้าง">หย่าร้าง</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ที่อยู่ปัจจุบันที่ติดต่อได้</label>
                  <input type="text" class="form-control" name="cus_tel" placeholder="ระบุวันเกิด" value="<?php echo $client['cus_tel']; ?>" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>บ้านเลขที่</label>
                  <input type="text" class="form-control" name="cus_address" placeholder="ระบุที่อยู่" value="<?php echo $client['cus_address']; ?>">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label>หมู่ที่</label>
                  <input type="text" class="form-control" name="cus_road" placeholder="" value="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ซอย</label>
                  <input type="text" class="form-control" name="cus_district" placeholder="ระบุชื่อตำบล" value="<?php echo $client['cus_district']; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ถนน</label>
                  <input type="text" class="form-control" name="cus_district" placeholder="ระบุชื่อตำบล" value="<?php echo $client['cus_district']; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ตำบล/แขวง</label>
                  <input type="text" class="form-control" name="cus_district" placeholder="ระบุชื่ออำเภอ" value="<?php echo $client['cus_amphoe']; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>อำเภอ/เขต</label>
                  <input type="text" class="form-control" name="cus_amphoe" placeholder="ระบุชื่อจังหวัด" value="<?php echo $client['cus_province']; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>จังหวัด</label>
                  <input type="text" class="form-control" name="cus_province" placeholder="ระบุรหัสไปรษณีย์" value="<?php echo $client['cus_zipcode']; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>รหัสไปรษณีย์</label>
                  <input type="text" class="form-control" name="cus_zipcode" placeholder="ระบุรหัสไปรษณีย์" value="<?php echo $client['cus_zipcode']; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>โทรศัพท์บ้าน</label>
                  <input type="text" class="form-control" name="cus_district" placeholder="ระบุชื่ออำเภอ" value="<?php echo $client['cus_amphoe']; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>โทรศัพท์มือถือ</label>
                  <input type="text" class="form-control" name="cus_amphoe" placeholder="ระบุชื่อจังหวัด" value="<?php echo $client['cus_province']; ?>">
                </div>
              </div>
              <div class="col-md-2">
                <label>จำนวนปีที่อาศัยอยู่</label>
                <div class="input-group">
                  <input type="text" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">ปี</span>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <label>&nbsp;</label>
                <div class="input-group">
                  <input type="text" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">เดือน</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <label>สถานภาพที่อยู่</label>
                <select class="custom-select" name="cus_prename" required>
                  <?php if ($id == '') { ?>
                    <option value="">---เลือก---</option>
                  <?php } else { ?>
                    <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
                  <?php } ?>
                  <option value="เจ้าของบ้าน">เจ้าของบ้าน</option>
                  <option value="ผู้อยู่อาศัย">ผู้อาศัยร่วม</option>
                </select>
              </div>
              <div class="col-md-3">
                <label>อาศัยอยู่กับ</label>
                <select class="custom-select" name="cus_prename" required>
                  <?php if ($id == '') { ?>
                    <option value="">---เลือก---</option>
                  <?php } else { ?>
                    <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
                  <?php } ?>
                  <option value="คู่สมรส">คู่สมรส</option>
                  <option value="ญาติ">ญาติ</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>จำนวนบุคคลที่อาศัยอยู่ด้วย(คน)</label>
                  <input type="number" class="form-control" name="cus_amphoe" placeholder="ระบุชื่อจังหวัด" value="<?php echo $client['cus_province']; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <label>สถานภาพการงาน</label>
                <select class="custom-select" name="cus_prename" required>
                  <?php if ($id == '') { ?>
                    <option value="">---เลือก---</option>
                  <?php } else { ?>
                    <option value="<?php echo $client['cus_prename']; ?>"><?php echo $client['cus_prename']; ?></option>
                  <?php } ?>
                  <option value="ลูกจ้างบริษัท">ลูกจ้างบริษัท</option>
                  <option value="ธุรกิจส่วนตัว">ธุรกิจส่วนตัว</option>
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
                  <label>จำนวนปีที่ทำงาน (ปี)</label>
                  <input type="number" class="form-control" name="" placeholder="" value="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>เงินรายได้ (ต่อวัน)</label>
                  <input type="number" class="form-control" name="" placeholder="" value="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>เงินรายได้ (ต่อเดือน)</label>
                  <input type="number" class="form-control" name="" placeholder="" value="">
                </div>
              </div>

            </div>

            <div class="row mt-3">
              <div class="col-12">
                <input type="hidden" name="cus_id" value="<?php echo $client['cus_id'] ?>">
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