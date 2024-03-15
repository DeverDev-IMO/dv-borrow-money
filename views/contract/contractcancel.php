<?php
$contract = new Contract();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ข้อมูลสัญญาซื้อ-ขายที่ยกเลิก</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">ข้อมูลสัญญาซื้อ-ขายที่ยกเลิก</li>
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
              <h3 class="card-title mt-2">รายการสัญญาซื้อ-ขายที่ยกเลิก</h3>
            </div>
            <div class="col-md-6 text-right">
              <!-- <a type="button" class="btn btn-success" href="contractform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
            </div>
          </div>
        </div> <!-- /.card-body -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <!-- <a type="button" class="btn btn-success mr-1" href="usersform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
              <!-- <a type="button" class="btn btn-danger" href="">เพิ่มข้อมูล</a> -->
            </div>
            <div class="col-md-6">

            </div>
          </div>
          <table class="table table-sm table-hover projects mt-3 reloadcontract" id="myTablecontract">
            <thead>
              <tr>
                <th style="width: 2%"> #</th>
                <th>เลขที่สัญญา</th>
                <th>รหัสลูกค้า</th>
                <th>ชื่อ-สกุล</th>
                <!-- <th>เบอร์โทรติดต่อ</th> -->
                <th>วันที่เริ่มสัญญา</th>
                <th>วันที่หมดสัญญา</th>
                <!-- <th style="width: 20%" class="text-center">จัดการ</th> -->
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($contract->listContractCancelClient("contract") as $client) : ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td>
                    <?php echo $client['contract_number']; ?>
                  </td>
                  <td><?php echo $client['cus_card_id']; ?></td>
                  <td><?php echo $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname']; ?></td>
                  <!-- <td><?php echo $client['u_username']; ?></td> -->
                  <td><?php echo ($client['cash_date_start'] != '') ? changeDate($client['cash_date_start']) : ''; ?></td>
                  <td><?php echo ($client['cash_date_end'] != '') ? changeDate($client['cash_date_end']) : ''; ?></td>

                </tr>
              <?php $i++;
              endforeach; ?>

            </tbody>
          </table>
        </div><!-- /.card-body -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->