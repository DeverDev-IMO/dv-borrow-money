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
          <h1><i class='fas fa-file-pdf'></i> รายงานยอดขาย</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">รายงานยอดขาย</li>
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
              <h3 class="card-title mt-2">ค้นหารายงานยอดขาย</h3>
            </div>
            <div class="col-md-6 text-right">
              <!-- <a type="button" class="btn btn-success" href="customerform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
              <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add-setlinework"><i class='fas fa-plus'></i> เพิ่มข้อมูล</button> -->
            </div>
          </div>
        </div> <!-- /.card-body -->
        <div class="card-body">
          <form action="views/report/report_saleslist.php" method="post" enctype="multipart/form-data" target="_blank">
            <div class="row">
              <div class="col-md-4">
                <!-- <a type="button" class="btn btn-success mr-1" href="usersform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
                <!-- <a type="button" class="btn btn-danger" href="">เพิ่มข้อมูล</a> -->
                <div class="form-group">
                  <label>ระหว่างวันที่:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="date_start" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ถึง:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="date_end" required>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <!-- <button type="button" class="btn btn-success"><i class='fas fa-search'></i> ค้นหา</button> -->
                    <button type="submit" class="btn btn-primary btnsubmit">แสดงข้อมูล</button>
                  </div>
                </div>

              </div>
            </div>
          </form>

          <!-- <div class="table-responsive">
            <table class="table table-hover projects reloadsetlinework">
              <thead>
                <tr>
                  <th style="width: 5%"> ลำดับ</th>
                  <th>สาย</th>
                  <th>เลขที่สัญญา</th>
                  <th>รหัสลูกค้า</th>
                  <th>ชื่อ-นามสกุลผู้ซื้อ</th>
                  <th>เบอร์โทร</th>
                  <th>วันที่เริ่มสัญญา</th>
                  <th>วันที่หมดสัญญา</th>
                  <th>ราคาขาย</th>
                  <th>ชำระต่องวด</th>
                  <th>พนักงาน</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($showreport->listreportsalesClient("contract") as $client) : ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $client['lw_code']; ?></td>
                    <td><?php echo $client['contract_number']; ?></td>
                    <td><?php echo $client['cus_card_id']; ?></td>
                    <td><?php echo $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname']; ?></td>
                    <td><?php echo $client['cus_mobile_phone']; ?></td>
                    <td><?php echo changeDate($client['cash_date_start']); ?></td>
                    <td><?php echo changeDate($client['cash_date_end']); ?></td>
                    <td><?php echo number_format($client['cash_principle'] + $client['cash_interest']); ?></td>
                    <td><?php echo number_format($client['cash_installments_daily']); ?></td>
                    <td><?php echo $client['contract_personnelhead_name']; ?></td>

                  </tr>
                <?php $i++;
                endforeach; ?>

              </tbody>
            </table>
          </div> -->
        </div><!-- /.card-body -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->