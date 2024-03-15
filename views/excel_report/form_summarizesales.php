<?php
$excelreport = new ExcelReport();

$date_start = $_REQUEST['date_start'];
$date_end = $_REQUEST['date_end'];

if ($date_end != '') {
  /////////////////////ผลรวม/////////////////////
  $sumcurrentSalesAll = 0; //ผลรวมยอดขายปัจจุบัน
  $sumoldcustomerAll = 0; //ลูกค้า (เก่า)
  $sumnewcustomerAll = 0; //ลูกค้า (ใหม่)
  $sumcustomerAll = 0; //ลูกค้า (ทั้งหมด)

  $sumAllsalesOldcus = 0;
  $sumAllsalesNewcus = 0;
  foreach ($excelreport->listlinework("linework") as $client) :
    $sumcurrentSales = $excelreport->getInfocurrentSales("contract", $client['lw_id'], $date_start, $date_end); //ยอดขายปัจจุบัน
    $sumoldcustomer = $excelreport->getInfoOldcustomer("contract", $client['lw_id'], $date_start, $date_end); ////ลูกค้าเก่า
    $sumnewcustomer = $excelreport->getInfoNewcustomer("contract", $client['lw_id'], $date_start, $date_end); ////ลูกค้าใหม่

    $sumcurrentSalesAll = $sumcurrentSalesAll + $sumcurrentSales['summarizesales'];
    $sumoldcustomerAll = $sumoldcustomerAll + count($sumoldcustomer);
    $sumnewcustomerAll = $sumnewcustomerAll + count($sumnewcustomer);
    $sumcustomerAll = $sumcustomerAll + (count($sumnewcustomer) + count($sumoldcustomer));


    foreach ($excelreport->salesOldcustomer("contract", $client['lw_id'], $date_start, $date_end) as $clientsumAllsalesOldcus) :
      $sumAllsalesOldcus = $sumAllsalesOldcus + $clientsumAllsalesOldcus['sumsalesOldcus'];
    endforeach;

    foreach ($excelreport->salesNewcustomer("contract", $client['lw_id'], $date_start, $date_end) as $clientsumAllsalesNewcus) :
      $sumAllsalesNewcus = $sumAllsalesNewcus + $clientsumAllsalesNewcus['sumsalesNewcus'];
    endforeach;

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
          <h1><i class='fas fa-file-pdf'></i> รายงานสรุปยอดขาย </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">รายงานสรุปยอดขาย</li>
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
              <h3 class="card-title mt-2">ค้นหารายงานสรุปยอดขาย</h3>
            </div>
            <div class="col-md-6 text-right">
              <!-- <a type="button" class="btn btn-success" href="customerform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
              <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add-setlinework"><i class='fas fa-plus'></i> เพิ่มข้อมูล</button> -->
            </div>
          </div>
        </div> <!-- /.card-body -->
        <div class="card-body">
          <form action="summarizesales" method="get" enctype="multipart/form-data">
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
                <table class="table table-bordered table-hover" id="tbl_exporttable_to_xls">
                  <thead>
                    <tr class="text-center">
                      <th colspan="11">สรุปยอดขาย</th>
                    </tr>
                    <tr>
                      <th colspan="11">วันที่ <?php echo changeDate($date_start); ?> ถึง <?php echo changeDate($date_start); ?></th>
                    </tr>
                    <tr class="table-primary text-center">
                      <th scope="col" rowspan="2">ลำดับ<br><br></th>
                      <th scope="col" rowspan="2">เหลื่ออีก 3 วัน<br><br></th>
                      <th scope="col" rowspan="2">เป้าหมาย<br><br></th>
                      <th scope="col" rowspan="2">ยอดขายปัจจุบัน<br><br></th>
                      <th scope="col" rowspan="2">เป้าหมายเฉลี่ยต่อวัน<br><br></th>
                      <th scope="col" colspan="6">จำนวน</th>

                    </tr>
                    <tr class="table-primary text-center">
                      <th scope="col">ลูกค้าใหม่ (ราย)</th>
                      <th scope="col">น้ำหนัก (บาท)</th>
                      <th scope="col">ลูกค้าเก่า (ราย)</th>
                      <th scope="col">น้ำหนัก (บาท)</th>
                      <th scope="col">ราย</th>
                      <th scope="col">น้ำหนัก (บาท)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <input id="totelcurrentSales" type="hidden" value="<?php echo $sumcurrentSalesAll; ?>">
                    <input id="targettotelnonCommas" type="hidden">
                    <tr class="table-secondary">
                      <td class="text-center" colspan="2"><b>สาขา</b></td>
                      <td id="targettotel"></td>
                      <td class="text-right"><?php echo number_format($sumcurrentSalesAll, 2); ?></td>

                      <td id="targetavgtotel"></td>
                      <td class="text-right"><?php echo number_format($sumnewcustomerAll); ?></td>
                      <td><?php echo number_format($sumAllsalesNewcus, 2); ?></td>
                      <td class="text-right"><?php echo number_format($sumoldcustomerAll); ?></td>
                      <td><?php echo number_format($sumAllsalesOldcus, 2); ?></td>
                      <td class="text-right"><?php echo number_format($sumcustomerAll); ?></td>
                      <td><?php echo number_format(($sumAllsalesNewcus + $sumAllsalesOldcus), 2); ?></td>
                    </tr>
                    <?php $i = 1;

                    foreach ($excelreport->listlinework("linework") as $client) :
                      $currentSales = $excelreport->getInfocurrentSales("contract", $client['lw_id'], $date_start, $date_end); //ยอดขายปัจจุบัน
                      $oldcustomer = $excelreport->getInfoOldcustomer("contract", $client['lw_id'], $date_start, $date_end); ////ลูกค้าเก่า
                      $newcustomer = $excelreport->getInfoNewcustomer("contract", $client['lw_id'], $date_start, $date_end); ////ลูกค้าใหม่

                      // $sumoldcustomer = $excelreport->salesOldcustomer("contract", $client['lw_id'], $date_start, $date_end); ////รวมยอดลูกค้าเก่า
                      // $sumnewcustomer = $excelreport->salesNewcustomer("contract", $client['lw_id'], $date_start, $date_end); ////รวมยอดลูกค้าใหม่

                      $sumsalesOldcus = 0;
                      foreach ($excelreport->salesOldcustomer("contract", $client['lw_id'], $date_start, $date_end) as $clientsumsalesOldcus) :
                        $sumsalesOldcus = $sumsalesOldcus + $clientsumsalesOldcus['sumsalesOldcus'];
                      endforeach;
                      $sumsalesNewcus = 0;
                      foreach ($excelreport->salesNewcustomer("contract", $client['lw_id'], $date_start, $date_end) as $clientsumsalesNewcus) :
                        $sumsalesNewcus = $sumsalesNewcus + $clientsumsalesNewcus['sumsalesNewcus'];
                      endforeach;
                    ?>
                      <tr>
                        <th scope="row" class="text-center"><?php echo $i; ?></th>
                        <td><?php echo $client['lw_personnelhead_name']; ?></td>
                        <td><span class="showvaluetarget<?php echo $client['lw_id']; ?>"></span><input type="text" class="form-control form-control-sm inputtarget" data-id="<?php echo $client['lw_id']; ?>" datasummarizesales="<?php echo $currentSales['summarizesales']; ?>"></td>
                        <td class="text-right"><?php echo number_format($currentSales['summarizesales'], 2); ?></td>
                        <td class="valueaveragetoclass<?php echo $client['lw_id']; ?>"></td>
                        <td class="text-right"><?php echo count($newcustomer); ?></td>
                        <td><?php echo number_format($sumsalesNewcus, 2); ?></td>
                        <td class="text-right"><?php echo count($oldcustomer); ?></td>
                        <td><?php echo number_format($sumsalesOldcus, 2); ?></td>
                        <td class="text-right"><?php echo (count($newcustomer) + count($oldcustomer)); ?></td>
                        <td><?php echo number_format(($sumsalesNewcus + $sumsalesOldcus), 2); ?></td>
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
    var elt = document.getElementById('tbl_exporttable_to_xls');
    var wb = XLSX.utils.table_to_book(elt, {
      sheet: "sheet1"
    });
    return dl ?
      XLSX.write(wb, {
        bookType: type,
        bookSST: true,
        type: 'base64'
      }) :
      XLSX.writeFile(wb, fn || ('summarizesales.' + (type || 'xlsx')));
  }
</script>