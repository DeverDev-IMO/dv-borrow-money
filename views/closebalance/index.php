<?php
$closebalance = new Closebalance();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ข้อมูลยอดปิด</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">ข้อมูลยอดปิด</li>
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
              <h3 class="card-title mt-2">รายการยอดปิด</h3>
            </div>
            <div class="col-md-6 text-right">
              <a type="button" class="btn btn-success btn-sm" href="reportclosebalance"><i class='fas fa-file-pdf'></i> &nbsp;พิมพ์รายงานยอดปิด</a>
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
              <tr style="font-size: 16px;">
                <th style="width: 2%;"> #</th>
                <th>สาย</th>
                <th>เลขที่สัญญา</th>
                <th>รหัสลูกค้า</th>
                <th>ชื่อ-สกุล</th>
                <th>วันที่เริ่มสัญญา</th>
                <th>วันที่หมดสัญญา</th>
                <th>ยอดขาย</th>
                <th>ปิดจริง</th>
                <th>วันที่ปิด</th>
                <th class="text-right">ยกเลิกปิดยอด</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($closebalance->listClient("contract") as $client) :
                $clientPaymentAmount = $closebalance->getInfoPaymentAmount($client['contract_id']);
              ?>
                <tr style="font-size: 15px;">
                  <td><?php echo $i; ?></td>
                  <td><?php echo $client['lw_code']; ?></td>
                  <td><?php echo $client['contract_number']; ?></td>
                  <td><?php echo $client['cus_card_id']; ?></td>
                  <td><?php echo $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname']; ?></td>
                  <td><?php echo ($client['cash_date_start'] != '') ? changeDate($client['cash_date_start']) : ''; ?></td>
                  <td><?php echo ($client['cash_date_end'] != '') ? changeDate($client['cash_date_end']) : ''; ?></td>
                  <td><?php echo number_format($client['cash_principle'] + $client['cash_interest']); ?></td>
                  <td><?php echo number_format($clientPaymentAmount['sumPaymentAmount']); ?></td>
                  <td><?php echo changeDate($client['contract_date_closebalance']); ?></td>
                  <td class=" project-actions text-right">
                    <a class="btn btn-info btn-sm cancelclosebalance" data-id="<?php echo $client['contract_id']; ?>">
                      <i class="fas fa-pencil-alt">
                      </i>
                      ยกเลิก
                    </a>
                  </td>
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