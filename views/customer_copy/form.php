<?php
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
}

if (isset($_GET['tabs']) && !empty($_GET['tabs'])) {
  $tabs = $_GET['tabs'];
}
$customer = new Customer();
$client = $customer->getInfo("users", $id);
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
      <div class="card card-success card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link <?php echo ($tabs == 1 or $tabs == '') ? ' active' : ''; ?>" href="customerform?tabs=1">ข้อมูลส่วนตัวผู้กู้</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php echo ($tabs == 2) ? ' active' : ''; ?>" href="customerform?tabs=2">ข้อมูลรายละเอียดเกี่ยวกับคู่สมรส</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php echo ($tabs == 3) ? ' active' : ''; ?>" href="customerform?tabs=3">ข้อมูลบุคคลติดต่อกรณีฉุกเฉิน</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php echo ($tabs == 4) ? ' active' : ''; ?>" href="customerform?tabs=4">ข้อมูลผู้ค้ำประกัน</a>
                </li>
              </ul>
            </div>
            <!-- <div class="col-md-6 text-right">
            </div> -->
          </div>
        </div> <!-- /.card-body -->
        <div class="card-body mt-4">
          <?php
          switch ($tabs) {
            case '1':
              require 'views/customer/form-data1.php';
              break;
            case '2':
              require 'views/customer/form-data2.php';
              break;
            case '3':
              require 'views/customer/form-data3.php';
              break;
            case '4':
              require 'views/customer/form-data4.php';
              break;
            default:
              require 'views/customer/form-data1.php';
              break;
          }
          ?>
        </div><!-- /.card-body -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->