<?php
$showreport = new ShowReport();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fas fa-file-pdf'></i> ข้อมูลลูกหนี้ตามเงื่อนไข</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">ข้อมูลลูกหนี้ตามเงื่อนไข</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h3 class="card-title mt-2">ค้นหารายงานลูกหนี้ตามเงื่อนไข</h3>
            </div>
            <div class="col-md-6 text-right">
              <!-- <a type="button" class="btn btn-success" href="customerform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
              <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add-setlinework"><i class='fas fa-plus'></i> เพิ่มข้อมูล</button> -->
            </div>
          </div>
        </div> <!-- /.card-body -->
        <div class="card-body">
          <form action="views/report/report_debtor.php" method="post" enctype="multipart/form-data" target="_blank">
            <div class="row">
              <div class="col-md-3">
                <!-- <a type="button" class="btn btn-success mr-1" href="usersform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
                <!-- <a type="button" class="btn btn-danger" href="">เพิ่มข้อมูล</a> -->
                <div class="form-group">
                  <label>วันที่:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="date_start" required>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label>ถึง:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="date_end" required>
                  </div>
                </div> -->
                <div class="form-group">
                  <label>ตามสายบริการ:</label>
                  <div class="input-group">
                    <select id="linework_id" class="custom-select" name="linework_id">
                      <option value="">---ทุกสายบริการ---</option>
                      <?php foreach ($showreport->listLineworkClient("linework") as $clientLinework) : ?>
                        <option date-val="<?php echo $clientLinework['lw_id']; ?>" value="<?php echo $clientLinework['lw_id']; ?>"><?php echo $clientLinework['lw_code'] . '-' . $clientLinework['lw_name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <!-- <label>&nbsp;</label> -->
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <button type="submit" class="btn btn-primary btnsubmit">แสดงข้อมูล</button>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio1" name="debtortype" value="debtortype1" required>
                    <label for="customRadio1" class="custom-control-label">ยอดค้างชำระ ระหว่าง 1 ถึง 10 งวด</label>
                  </div>
                  <div class="custom-control custom-radio mt-2">
                    <input class="custom-control-input" type="radio" id="customRadio2" name="debtortype" value="debtortype2" required>
                    <label for="customRadio2" class="custom-control-label">ค้างมากกว่า 10 งวด และยังไม่ครบสัญญา</label>
                  </div>
                  <div class="custom-control custom-radio mt-2">
                    <input class="custom-control-input" type="radio" id="customRadio3" name="debtortype" value="debtortype3" required>
                    <label for="customRadio3" class="custom-control-label">หมดสัญญา</label>
                  </div>
                  <div class="custom-control custom-radio mt-2">
                    <input class="custom-control-input" type="radio" id="customRadio4" name="debtortype" value="debtortype4" required>
                    <label for="customRadio4" class="custom-control-label">หนี้ NPL [ หลังจากหมดสัญญา 30 วัน ]</label>
                  </div>
                  <div class="custom-control custom-radio mt-4">
                    <input class="custom-control-input" type="radio" id="customRadio5" name="debtortype" value="debtortype5" required>
                    <label for="customRadio5" class="custom-control-label">ลูกหนี้การค้ารวม ตั้งแต่เปิดมายังไม่ปิดบัญชี</label>
                  </div>
                  <div class="custom-control custom-radio mt-2">
                    <input class="custom-control-input" type="radio" id="customRadio6" name="debtortype" value="debtortype6" required>
                    <label for="customRadio6" class="custom-control-label">ลูกหนี้การค้าไม่รวม NPL</label>
                  </div>
                </div>
              </div>
              <div class="col-md-3">

              </div>
              <div class="col-md-3">


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