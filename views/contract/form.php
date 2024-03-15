<?php
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
  $id = $_REQUEST['id']; //id contract
}

if (isset($_GET['tabs']) && !empty($_GET['tabs'])) {
  $tabs = $_GET['tabs'];
}
if (isset($_GET['cusid']) && !empty($_GET['cusid'])) {
  $cusid = $_GET['cusid'];
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ฟอร์มข้อมูลสัญญาซื้อ-ขาย </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="contract">รายการข้อมูลสัญญาซื้อ-ขาย</a></li>
            <li class="breadcrumb-item active">ฟอร์มบันทึกข้อมูลสัญญาซื้อ-ขาย</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-success card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link <?php echo ($tabs == 1 or $tabs == '') ? ' active' : ''; ?>" href="contractform?tabs=1&id=<?php echo $id; ?>&cusid=<?php echo $cusid; ?>">ข้อมูลส่วนตัวผู้กู้</a>
                </li>
                <?php if ($id != '') { ?>
                  <li class="nav-item">
                    <a class="nav-link <?php echo ($tabs == 2) ? ' active' : ''; ?>" href="contractform?tabs=2&id=<?php echo $id; ?>&cusid=<?php echo $cusid; ?>">ข้อมูลรายละเอียดเกี่ยวกับคู่สมรส</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo ($tabs == 3) ? ' active' : ''; ?>" href="contractform?tabs=3&id=<?php echo $id; ?>&cusid=<?php echo $cusid; ?>">ข้อมูลบุคคลติดต่อกรณีฉุกเฉิน</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo ($tabs == 4) ? ' active' : ''; ?>" href="contractform?tabs=4&id=<?php echo $id; ?>&cusid=<?php echo $cusid; ?>">ข้อมูลผู้ค้ำประกัน</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php echo ($tabs == 5) ? ' active' : ''; ?>" href="contractform?tabs=5&id=<?php echo $id; ?>&cusid=<?php echo $cusid; ?>">ข้อมูลสินเชื่อเงินสด/สายงาน</a>
                  </li>
                <?php } ?>
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
              require 'views/contract/form-data1.php';
              break;
            case '2':
              require 'views/contract/form-data2.php';
              break;
            case '3':
              require 'views/contract/form-data3.php';
              break;
            case '4':
              require 'views/contract/form-data4.php';
              break;
            case '5':
              require 'views/contract/form-data5.php';
              break;
            default:
              require 'views/contract/form-data1.php';
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