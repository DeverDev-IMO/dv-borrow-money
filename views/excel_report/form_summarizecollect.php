<?php
$excelreport = new ExcelReport();

$date_start = $_REQUEST['date_start'];
$date_end = $_REQUEST['date_end'];

if ($date_end != '') {
  /////////////////////ผลรวม/////////////////////
  $sumcurrentCollectAll = 0; //ผลรวมยอดเก็บปัจจุบัน
  foreach ($excelreport->listlinework("linework") as $client) :
    $sumcurrentCollect = $excelreport->listreportcollectClient("contract", $date_start, $date_end, $client['lw_id']); //ยอดเก็บปัจจุบัน

    $sumcurrentCollectAll = $sumcurrentCollectAll + $sumcurrentCollect['sumPaymentCollectionAmount'];
  endforeach;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fas fa-file-pdf'></i> รายงานสรุปยอดเก็บ</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">รายงานสรุปยอดเก็บ</li>
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
              <h3 class="card-title mt-2">ค้นหารายงานสรุปยอดเก็บ</h3>
            </div>
            <div class="col-md-6 text-right">
              <!-- <a type="button" class="btn btn-success" href="customerform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
              <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add-setlinework"><i class='fas fa-plus'></i> เพิ่มข้อมูล</button> -->
            </div>
          </div>
        </div> <!-- /.card-body -->
        <div class="card-body">
          <form action="summarizecollect" method="get" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>ระหว่างวันที่:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="date_start" value="<?php if (isset($_REQUEST['date_start'])) {
                                                                                        echo $_REQUEST['date_start'];
                                                                                      }  ?>" required>
                    <!-- <input type="date" class="form-control" name="date_start" value="2023-01-01" required readonly> -->
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ถึง:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="date_end" value="<?php if (isset($_REQUEST['date_end'])) {
                                                                                      echo $_REQUEST['date_end'];
                                                                                    }  ?>" required>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <!-- <button type="button" class="btn btn-success"><i class='fas fa-search'></i> ค้นหา</button> -->
                    <button type="submit" class="btn btn-primary btnsubmit">แสดงข้อมูล</button> &ensp;
                    <?php if ($_REQUEST['date_start']) { ?>
                      <button onclick="ExportToExcel('xlsx')" type="button" class="btn btn-success">ส่งออก excel</button>
                    <?php } ?>
                  </div>
                </div>

              </div>
            </div>
            <?php if ($date_end != '') { ?>
              <div class="row mt-3">
                <table class="table table-bordered table-hover" id="exporttablexls_summarizecollect">
                  <thead>
                    <tr class="text-center">
                      <th colspan="4">สรุปผลยอดเก็บ</th>
                    </tr>
                    <tr>
                      <th colspan="4">วันที่ <?php echo changeDate($date_start); ?> ถึง <?php echo changeDate($date_start); ?></th>
                    </tr>
                    <tr class="table-primary text-center">
                      <th scope="col">ลำดับ</th>
                      <th scope="col">เหลื่ออีก 3 วัน</th>
                      <th scope="col">เป้าหมายยอดเก็บ</th>
                      <th scope="col">ยอดเก็บปัจจุบัน</th>
                      <!-- <th scope="col">เป้าหมายที่เหลือเฉลี่ยต่อวัน</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="table-secondary">
                      <td class="text-center" colspan="2"><b>สาขา</b></td>
                      <td id="targettotelcollect"></td>
                      <td class="text-right"><?php echo number_format($sumcurrentCollectAll, 2); ?></td>
                      <!-- <td></td> -->
                    </tr>
                    <?php $i = 1;

                    foreach ($excelreport->listlinework("linework") as $client) :
                      // $currentSales = $excelreport->getInfocurrentSales("contract", $client['lw_id'], $date_start, $date_end); //ยอดเก็บปัจจุบัน
                      $clientcollect = $excelreport->listreportcollectClient("contract", $date_start, $date_end, $client['lw_id']);
                    ?>
                      <tr>
                        <th scope="row" class="text-center"><?php echo $i; ?></th>
                        <td><?php echo $client['lw_personnelhead_name']; ?></td>
                        <td><span class="showvaluetargetcollect<?php echo $client['lw_id']; ?>"></span><input type="text" class="form-control form-control-sm inputtargetcollect" data-id="<?php echo $client['lw_id']; ?>" datasummarizecollect="<?php echo $clientcollect['sumPaymentCollectionAmount']; ?>"></td>
                        <td class="text-right"><?php echo number_format($clientcollect['sumPaymentCollectionAmount'], 2); ?></td>
                        <!-- <td></td> -->
                      </tr>
                    <?php
                      $i++;
                    endforeach;
                    ?>
                  </tbody>
                </table>
              </div>
            <?php } ?>
          </form>


        </div><!-- /.card-body -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('exporttablexls_summarizecollect');
    var wb = XLSX.utils.table_to_book(elt, {
      sheet: "sheet1"
    });
    return dl ?
      XLSX.write(wb, {
        bookType: type,
        bookSST: true,
        type: 'base64'
      }) :
      XLSX.writeFile(wb, fn || ('summarizecollect.' + (type || 'xlsx')));
  }
</script>