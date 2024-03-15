<?php
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
}
$payments = new Payments();
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
          <h1>ชำระเงิน</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="payments">รายการข้อมูลชำระเงิน</a></li>
            <li class="breadcrumb-item active">ฟอร์มบันทึกข้อมูลการชำระเงิน</li>
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
                  <i class="fas fa-globe"></i> รายละเอียด
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
                <!-- <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card card-success card-outline">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="card-title">ฟอร์มบันทึกข้อมูลการชำระเงิน</h3>
                </div>

              </div>
            </div> <!-- /.card-body -->
            <div class="card-body">
              <form id="paymentsinsertdata" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>จำนวนเงินที่ชำระ</label>
                      <input type="text" class="form-control" name="pay_number_money" placeholder="จำนวนเงินที่ชำระ" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>วันที่ที่ชำระ</label>
                      <input type="date" class="form-control" name="pay_date" placeholder="จำนวนเงินที่ชำระ" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <input type="hidden" name="contract_id" value="<?php echo $id; ?>">
                    <input type="submit" value="บันทึกข้อมูล" class="btn btn-success btn-block">
                    <!-- <a href="payments" class="btn btn-secondary float-right">Cancel</a> -->

                  </div>
                </div>
              </form>
            </div><!-- /.card-body -->
          </div>
        </div><!-- end col-md- -->
        <div class="col-md-7">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="card-title mt-2">รายการชำระงวดรายวัน</h3>
                </div>

              </div>
            </div> <!-- /.card-body -->
            <div class="card-body">
              <div class="row">
              </div>
              <table class="table table-hover projects mt-3 reloadcontract">
                <thead>
                  <tr>
                    <th style="width: 2%"> #</th>
                    <th>จำนวนเงินที่ชำระ</th>
                    <th>วันที่ที่ชำระ</th>
                    <th style="width: 20%" class="text-center">จัดการ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  foreach ($payments->listPaymentsClient("payments", $id) as $clientpayments) : ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $clientpayments['pay_number_money']; ?></td>
                      <td><?php echo changeDate($clientpayments['pay_date']); ?></td>
                      <td class="project-actions text-right">
                        <a class="btn btn-info btn-xs" href="<?php echo 'paymentsform?id=' . $clientpayments['pay_contract_id']; ?>">
                          <i class="fas fa-pencil-alt">
                          </i>
                          แก้ไข
                        </a>
                      </td>
                    </tr>
                  <?php $i++;
                  endforeach; ?>

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