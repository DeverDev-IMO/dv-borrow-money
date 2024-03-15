<?php
$documentcard = new Documentcard();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ข้อมูลใบกำกับภาษี</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">ข้อมูลใบกำกับภาษี</li>
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
              <h3 class="card-title mt-2">รายการข้อมูลใบกำกับภาษี</h3>
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
          <table class="table table-sm table-hover projects mt-3 reloadcontract" id="myTabledocumenttaxinvoice">
            <thead>
              <tr>
                <th style="width: 2%"> #</th>
                <th>เลขที่การ์ด</th>
                <th>ชื่อลูกค้า</th>
                <th>ชื่อพนักงาน</th>
                <th>เบอร์โทร</th>
                <th style="width: 20%" class="text-center">จัดการ</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($documentcard->listClient("contract") as $client) :
                $clientInfoSubHenchman = $documentcard->getInfoSubHenchman("contract", $client['contract_id']);
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $client['contract_number']; ?></td>
                  <td><?php echo $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname']; ?></td>
                  <!-- <td><?php echo $client['per_fullname']; ?><br><?php echo $clientInfoSubHenchman['per_fullname']; ?></td> -->
                  <td><?php echo $client['contract_personnelhead_name']; ?><br><?php echo $client['contract_personnelhenchman_name']; ?></td>
                  <!-- <td><?php echo TelFormat($client['per_tel']); ?><br><?php echo TelFormat($clientInfoSubHenchman['per_tel']); ?></td> -->
                  <td><?php echo $client['contract_personnelhead_tel']; ?><br><?php echo $client['contract_personnelhenchman_tel']; ?></td>
                  <td class="project-actions text-center">
                    <a class="btn btn-primary btn-sm" href="views/report/report_documenttaxinvoice.php?contractid=<?php echo $client['contract_id']; ?>" target="_blank">
                      <i class="fa fa-print">
                      </i>
                      พิมพ์
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