<?php
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
}
$payments = new Payments();
$paymenthistory = new PaymentHistory();
$clientpaymentsform = $payments->getInfoDetailpaymentsForm("contract", $id);
$clientsumpaymentamount = $payments->getInfoPaymentAmount("payments", $id);
$clientpaymentcount = $payments->getInfoPaymentCount("payments", $id);

$diff = ($clientpaymentsform['cash_difference'] == "0" ? $clientpaymentsform['cash_installments_daily'] : $clientpaymentsform['cash_difference']);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ประวัติการชำระเงิน</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="paymenthistory">รายการข้อมูลประวัติการชำระเงิน</a></li>
            <li class="breadcrumb-item active">ฟอร์มบันทึกข้อมูลประวัติการชำระเงิน</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-12">
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> ประวัติการชำระเงิน
                  <small class="float-right">เลขที่สัญญา : <?php echo $clientpaymentsform['contract_number']; ?></small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info mt-2">
              <div class="col-sm-4 invoice-col">
                <b>ชื่อผู้ซื้อ : </b><?php echo $clientpaymentsform['setpre_name'] . $clientpaymentsform['cus_firstname'] . ' ' . $clientpaymentsform['cus_lastname']; ?><br>
              </div>
              <div class="col-sm-2 invoice-col">
                <b>ชื่อเล่น : </b><?php echo $clientpaymentsform['cus_nickname']; ?><br>
              </div>
              <div class="col-sm-2 invoice-col">
                <b>อายุ : </b><?php echo $clientpaymentsform['cus_age']; ?> ปี<br>
              </div>
              <div class="col-sm-4 invoice-col">
                <b>เบอร์โทรศัพท์ : </b> <?php echo $clientpaymentsform['cus_mobile_phone']; ?><br>
              </div>
            </div>
            <div class="row invoice-info mt-2">
              <div class="col-sm-4 invoice-col">
                <b>อาชีพ : </b><?php echo $clientpaymentsform['cus_nature_work']; ?><br>
              </div>
              <div class="col-sm-8 invoice-col">
                <b>ที่อยู่ : </b> บ้านเลขที่ <?php echo $clientpaymentsform['cus_address']; ?>
                &nbsp;หมู่ที่ <?php echo $clientpaymentsform['cus_village']; ?>
                &nbsp;ตำบล <?php echo $clientpaymentsform['districts_name_th']; ?>
                &nbsp;อำเภอ <?php echo $clientpaymentsform['amphures_name_th']; ?>
                &nbsp;จังหวัด <?php echo $clientpaymentsform['province_name_th']; ?>
                &nbsp;<?php echo $clientpaymentsform['cus_postal_code']; ?>
                <br>
              </div>
            </div>
            <div class="row invoice-info mt-2">
              <div class="col-sm-6 invoice-col">
                <b>ชื่อผู้ค้ำประกัน : </b><?php echo $clientpaymentsform['setpre_name'] . $clientpaymentsform['marryd_firstname'] . ' ' . $clientpaymentsform['marryd_lastname']; ?><br>
              </div>
              <div class="col-sm-6 invoice-col">
                <b>เบอร์โทรศัพท์ : </b><?php echo $clientpaymentsform['marryd_mobile_phone']; ?><br>
              </div>
            </div>
            <div class="row invoice-info mt-2">
              <div class="col-sm-3 invoice-col">
                <b>ยอดสินเชื่อ : </b><?php echo number_format(($clientpaymentsform['cash_principle'] + $clientpaymentsform['cash_interest']), 2); ?><br>
              </div>
              <div class="col-sm-3 invoice-col">
                <b>จำนวนงวด : </b><?php echo number_format($clientpaymentsform['cash_number_installment']); ?><br>
              </div>
              <div class="col-sm-3 invoice-col">
                <b>ชำระต่องวด : </b><?php echo number_format($clientpaymentsform['cash_installments_daily'], 2); ?><br>
              </div>
              <div class="col-sm-3 invoice-col">
                <b>งวดสุดท้าย : </b><?php echo number_format($diff, 2); ?><br>
              </div>
            </div>
            <div class="row invoice-info mt-2">
              <div class="col-sm-3 invoice-col">
                <b>ยอดชำระเเล้ว : </b><?php echo number_format(($clientsumpaymentamount['sumPaymentAmount']), 2); ?><br>
              </div>
              <div class="col-sm-3 invoice-col">
                <b>ยอดค้าง : </b><?php echo number_format(($clientpaymentsform['cash_principle'] + $clientpaymentsform['cash_interest']) - $clientsumpaymentamount['sumPaymentAmount'], 2); ?><br>
              </div>
              <div class="col-sm-3 invoice-col">
                <b>จำนวนงวดที่ชำระเเล้ว : </b><?php echo number_format($clientpaymentcount['countPayment']); ?><br>
              </div>
              <div class="col-sm-3 invoice-col">
                <b>จำนวนงวดค้างชำระ : </b><?php echo number_format(($clientpaymentsform['cash_number_installment'] - $clientpaymentcount['countPayment'])); ?><br>
              </div>

            </div>

            <!-- this row will not appear when printing -->
            <div class="row no-print mt-2">
              <div class="col-12">
                <a href="views/report/report_paymenthistory.php?contractid=<?php echo $id; ?>" target="_blank" rel="noopener" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> พิมพ์</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="card-title mt-2">ตารางชำระค่างวดรายวัน</h3>
                </div>

              </div>
            </div> <!-- /.card-body -->
            <div class="card-body">
              <div class="row">
              </div>
              <table class="table table-sm table-hover table-bordered projects mt-3">
                <thead class="table-secondary">
                  <tr>
                    <th style="width:8%" class="text-center">วัน/เดือน</th>
                    <th class="text-right">ม.ค.</th>
                    <th class="text-right">ก.พ.</th>
                    <th class="text-right">มี.ค.</th>
                    <th class="text-right">เม.ย.</th>
                    <th class="text-right">พ.ค.</th>
                    <th class="text-right">มิ.ย.</th>
                    <th class="text-right">ก.ค.</th>
                    <th class="text-right">ส.ค.</th>
                    <th class="text-right">ก.ย.</th>
                    <th class="text-right">ต.ค.</th>
                    <th class="text-right">พ.ย.</th>
                    <th class="text-right">ธ.ค.</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $iDay = 1;
                  while ($iDay <= 31) {
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $iDay; ?></td>
                      <?php
                      /////////เดือน มค/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 1);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน กพ/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 2);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน มีค/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 3);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน เมย/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 4);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน พค/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 5);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน มิย/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 6);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน กค/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 7);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน สค/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 8);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน กย/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 9);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน ตค/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 10);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน พย/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 11);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      /////////เดือน ธค/////////
                      $clientChkpayday = $paymenthistory->getInfoChkpayday("payments", $id, $iDay, 12);
                      echo '<td class="text-right">' . ($clientChkpayday['pay_number_money'] == "" ? '' : number_format($clientChkpayday['pay_number_money'])) . '</td>';
                      ?>

                    </tr>
                  <?php
                    $iDay++;
                  }
                  ?>
                </tbody>
              </table>
            </div><!-- /.card-body -->
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->