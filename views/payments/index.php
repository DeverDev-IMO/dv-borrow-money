<?php
$payments = new Payments();
$dateend = $_GET['payments_date_end'];
$lineworkid = $_GET['payments_linework_id'];

$clientlineworkselect = $payments->getInfoLinework("linework", $lineworkid);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ข้อมูลชำระเงิน</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">ข้อมูลชำระเงิน</li>
          </ol>
        </div>
      </div>
    </div>
  </section> -->

  <!-- Main content -->
  <section class="content mt-2">
    <div class="container-fluid">
      <div class="card card-primary card-outline" style="height:50%;">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h3 class="card-title mt-2">รายการข้อมูลชำระเงิน</h3>
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
          <form action="payments" method="get" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-3">
                <!-- <a type="button" class="btn btn-success mr-1" href="usersform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
                <!-- <a type="button" class="btn btn-danger" href="">เพิ่มข้อมูล</a> -->
                <div class="form-group">
                  <label>ประจำวันที่:</label>
                  <div class="input-group">
                    <!-- <input type="date" class="form-control" name="payments_date_start" value="<?php echo $_GET['payments_date_start']; ?>"> -->
                    <input type="date" class="form-control" name="payments_date_start" value="<?php echo '2023-01-01'; ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ถึงวันที่:</label>
                  <div class="input-group">
                    <input type="date" class="form-control payments-date-end" name="payments_date_end" value="<?php echo $_GET['payments_date_end']; ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ตามสายบริการ:</label>
                  <div class="input-group">
                    <select id="select_lineworkfrom" class="custom-select payments_linework_id" name="payments_linework_id">
                      <!-- <option value="">---ทุกสายบริการ---</option> -->
                      <?php if ($lineworkid == '') { ?>
                        <option value="">---ทุกสายบริการ---</option>
                      <?php } else { ?>
                        <option value="<?php echo $clientlineworkselect['lw_id']; ?>"><?php echo $clientlineworkselect['lw_code'] . '-' . $clientlineworkselect['lw_name']; ?></option>
                      <?php } ?>
                      <?php foreach ($payments->listLineworkClient("linework") as $clientLinework) : ?>
                        <option date-val="<?php echo $clientLinework['lw_id']; ?>" value="<?php echo $clientLinework['lw_id']; ?>"><?php echo $clientLinework['lw_code'] . '-' . $clientLinework['lw_name']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input class="paymentslineworkid" type="hidden" name="paymentslineworkid" value="<?php echo $_GET['payments_linework_id']; ?>">
                    <button type="submit" class="btn btn-primary btnsubmit">ค้นหา</button>&nbsp;
                    <!-- <a href="payments" class="btn btn-default">ล้างค่า</a> -->
                    <!-- <button type="button" class="btn btn-default reloadcontractaa">ล้างค่า</button> -->
                  </div>
                </div>

              </div>
            </div>
          </form>
          <div style="overflow-y: scroll;height:30em" class="table-responsive">
            <table class="table table-sm table-hover projects mt-3 reloadcontract">
              <thead>
                <tr style="font-size: 13px;">
                  <th style="width: 2%"> #</th>
                  <th>เลขที่สัญญา</th>
                  <th>ชื่อ-สกุล</th>
                  <th>งวดที่</th>
                  <th>งวดวันที่</th>
                  <th>ราคาขาย</th>
                  <th>ยอดชำระเเล้ว</th>
                  <th>ยอดค้างชำระ</th>
                  <th>ผ่อนงวดละ</th>
                  <th>ต้องชำระรวม</th>
                  <th>ค้างถึงงวดนี้</th>
                  <th>ชำระเเล้ว</th>
                  <th>สถานะ</th>
                  <th>ปิดยอด</th>
                  <!-- <th style="width: 20%" class="text-center">จัดการ</th> -->
                  <!-- <th class="text-center">จัดการ</th> -->
                </tr>
              </thead>
              <tbody class="">
                <?php $i = 1;
                foreach ($payments->listSearchClient("contract", $dateend, $lineworkid) as $client) :
                  // foreach ($payments->listSearchClient("contract", '2023-07-28', '12') as $client) :
                ?>
                  <?php
                  $clientpaymentsform = $payments->getInfoDetailpaymentsForm("contract", $client['contract_id']);
                  $clientsumpaymentamount = $payments->getInfoPaymentAmount("payments", $client['contract_id']); //ยอดชำระเเล้ว
                  $clientpaymentcount = $payments->getInfoPaymentCount("payments", $client['contract_id']);
                  $clientpaidbalance = $payments->getInfoPaidBalance("payments", $client['contract_id'], $dateend);
                  $clientpaystatus = $payments->getInfoPayStatus("payments", $client['contract_id'], $dateend);
                  $clientnuminstallment = $payments->getInfoNumInstallment("payments_summarize", $client['contract_id']);
                  ?>
                  <?php
                  if ($client['contract_status_closebalance'] == 1) {
                    if ($dateend <= $client['contract_date_closebalance']) {
                  ?>
                      <div class="reloadcontract1">
                        <!-- <tr style="font-size: 13px;" class="reloadcontract<?php echo $client['contract_id']; ?>"> -->
                        <!-- <tr style="font-size: 13px; <?php echo $clientpaidbalance['pay_number_money'] >= ($client['cash_principle'] + $client['cash_interest']) ? ' background-color:#ff9999;' : " " ?>" class="reloadcontract<?php echo $client['contract_id']; ?>"> -->
                        <tr style="font-size: 13px; <?php echo $clientsumpaymentamount['sumPaymentAmount'] >= ($client['cash_principle'] + $client['cash_interest']) ? ' background-color:#ff9999;' : " " ?>" class="reloadcontract<?php echo $client['contract_id']; ?>">
                          <td><?php echo $i; ?></td>
                          <td><a style="cursor: pointer;" class="showlistcontract" data-id="<?php echo $client['contract_id']; ?>"><?php echo $client['contract_number']; ?></a></td>
                          <td><a style="cursor: pointer;" class="showlistcontract" data-id="<?php echo $client['contract_id']; ?>"><?php echo $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname']; ?></a></td>
                          <td><?php echo $clientnuminstallment['paysum_pay_installment'] + 1; ?></td> <!--งวดที่-->
                          <td><?php echo $_GET['payments_date_end']; ?></td>
                          <td><?php echo number_format($client['cash_principle']); ?></td> <!--ราคาขาย-->
                          <td><?php echo number_format(($clientsumpaymentamount['sumPaymentAmount']), 2); ?></td> <!--ยอดชำระเเล้ว-->
                          <td><?php echo number_format(($clientpaymentsform['cash_principle'] + $clientpaymentsform['cash_interest']) - $clientsumpaymentamount['sumPaymentAmount'], 2); ?></td>
                          <td><?php echo $client['cash_installments_daily']; ?></td>
                          <td><?php echo number_format($client['cash_principle'] + $client['cash_interest']); ?></td> <!--ยอดชำระเเล้ว-->
                          <td>ค้างถึงงวดนี้</td>
                          <td><?php echo number_format($clientpaidbalance['pay_number_money']); ?></td> <!--ชำระเเล้ว-->
                          <td <?php echo $clientpaystatus['pay_status'] == "1" ? ' style="background-color:#00e600;color:#fff"' : " " ?>><?php echo $clientpaystatus['pay_status'] == "1" ? "True" : "False" ?></td>
                          <td class="project-actions text-center">
                            <?php if ($clientsumpaymentamount['sumPaymentAmount'] >= ($client['cash_principle'] + $client['cash_interest'])) { ?>
                              <a class="btn btn-info btn-xs confirmclosebalance" data-id="<?php echo $client['contract_id']; ?>" data-dateclosebalance="<?php echo $_GET['payments_date_end']; ?>">
                                <i class="fas fa-window-close">
                                </i>
                              </a>
                            <?php } ?>
                          </td>
                        </tr>
                      </div>
                    <?php
                      $i++;
                    }
                  } else {
                    ?>
                    <div class="reloadcontract1">
                      <!-- <tr style="font-size: 13px;" class="reloadcontract<?php echo $client['contract_id']; ?>"> -->
                      <!-- <tr style="font-size: 13px; <?php echo $clientpaidbalance['pay_number_money'] >= ($client['cash_principle'] + $client['cash_interest']) ? ' background-color:#ff9999;' : " " ?>" class="reloadcontract<?php echo $client['contract_id']; ?>"> -->
                      <tr style="font-size: 13px; <?php echo $clientsumpaymentamount['sumPaymentAmount'] >= ($client['cash_principle'] + $client['cash_interest']) ? ' background-color:#ff9999;' : " " ?>" class="reloadcontract<?php echo $client['contract_id']; ?>">
                        <td><?php echo $i; ?></td>
                        <td><a style="cursor: pointer;" class="showlistcontract" data-id="<?php echo $client['contract_id']; ?>"><?php echo $client['contract_number']; ?></a></td>
                        <td><a style="cursor: pointer;" class="showlistcontract" data-id="<?php echo $client['contract_id']; ?>"><?php echo $client['setpre_name'] . $client['cus_firstname'] . ' ' . $client['cus_lastname']; ?></a></td>
                        <td><?php echo $clientnuminstallment['paysum_pay_installment'] + 1; ?></td> <!--งวดที่-->
                        <td><?php echo $_GET['payments_date_end']; ?></td>
                        <td><?php echo number_format($client['cash_principle']); ?></td> <!--ราคาขาย-->
                        <td><?php echo number_format(($clientsumpaymentamount['sumPaymentAmount']), 2); ?></td> <!--ยอดชำระเเล้ว-->
                        <td><?php echo number_format(($clientpaymentsform['cash_principle'] + $clientpaymentsform['cash_interest']) - $clientsumpaymentamount['sumPaymentAmount'], 2); ?></td>
                        <td><?php echo $client['cash_installments_daily']; ?></td>
                        <td><?php echo number_format($client['cash_principle'] + $client['cash_interest']); ?></td> <!--ยอดชำระเเล้ว-->
                        <td>ค้างถึงงวดนี้</td>
                        <td><?php echo number_format($clientpaidbalance['pay_number_money']); ?></td> <!--ชำระเเล้ว-->
                        <td <?php echo $clientpaystatus['pay_status'] == "1" ? ' style="background-color:#00e600;color:#fff"' : " " ?>><?php echo $clientpaystatus['pay_status'] == "1" ? "True" : "False" ?></td>
                        <td class="project-actions text-center">
                          <?php if ($clientsumpaymentamount['sumPaymentAmount'] >= ($client['cash_principle'] + $client['cash_interest'])) { ?>
                            <a class="btn btn-info btn-xs confirmclosebalance" data-id="<?php echo $client['contract_id']; ?>" data-dateclosebalance="<?php echo $_GET['payments_date_end']; ?>">
                              <i class="fas fa-window-close">
                              </i>
                            </a>
                          <?php } ?>
                        </td>
                      </tr>
                    </div>

                  <?php
                    $i++;
                  }
                  ?>


                <?php
                endforeach; ?>

              </tbody>
            </table>

          </div>
          <?php
          $clienttotalpayment = $payments->getInfoTotalPayment("payments",  $dateend, $_GET['payments_linework_id']);
          ?>
          <table class="table table-sm table-bordered reloadtotalpayment" style="margin-top:10px;">
            <tbody style="font-size: 13px;">
              <tr style="font-size: 18px;" class="table-secondary">
                <td style="text-align: right;">ยอดรวมชำระเเล้ว</td>
                <td width="15%" style="text-align: right;"><?php echo number_format(($clienttotalpayment['sumTotalPaymentDate']), 2); ?></td>
                <!-- <td width="15%" style="text-align: right;"></td> -->
              </tr>
            </tbody>
          </table>
        </div><!-- /.card-body -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <!-- <section class="content" style="position: fixed;right:0px;bottom:0px;width: 83.5%;"> -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary card-outline">
        <div class="card-body">
          <form id="payinsertdata" method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
              <thead>
                <tr style="font-size: 13px;">
                  <th> เลขที่สัญญา</th>
                  <th>ชื่อ-สกุล</th>
                  <th>งวดที่</th>
                  <th>งวดวันที่</th>
                  <th>ราคาขาย</th>
                  <th>ยอดชำระเเล้ว</th>
                  <th>คงเหลือ</th>
                  <th>งวดละ</th>
                  <th>ชำระเเล้ว</th>
                </tr>
              </thead>
              <tbody id="tbshowcontract" style="font-size: 13px;">
                <!-- <td>1</td>
              <td>1</td>
              <td>1</td>
              <td>1</td>
              <td>1</td>
              <td>1</td> -->
              </tbody>
            </table>
            <!-- <input type="hidden" name="contract_id" value="<?php echo $id; ?>"> -->
            <input type="submit" value="บันทึกข้อมูล" class="btn btn-success" style="display:none">
          </form>
          <div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
<!-- /.content-wrapper -->