<?php
$payments = new Payments();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary card-outline">
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
          <form id="search_payments" action="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-3">
                <!-- <a type="button" class="btn btn-success mr-1" href="usersform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
                <!-- <a type="button" class="btn btn-danger" href="">เพิ่มข้อมูล</a> -->
                <div class="form-group">
                  <label>ประจำวันที่:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="payments_date_start" id="payments_date_start">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ถึงวันที่:</label>
                  <div class="input-group">
                    <input type="date" class="form-control" name="payments_date_end" id="payments_date_end">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ตามสายบริการ:</label>
                  <div class="input-group">
                    <select id="payments_linework_id" class="custom-select" name="payments_linework_id" required>
                      <option value="">---เลือก---</option>
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
                    <!-- <button type="button" class="btn btn-success"><i class='fas fa-search'></i> ค้นหา</button> -->
                    <button type="submit" class="btn btn-primary btnsubmit">ค้นหา</button>
                  </div>
                </div>

              </div>
            </div>
          </form>
          <table class="table table-hover projects mt-3 reloadpayments">
            <thead>
              <tr>
                <th style="width: 2%"> #</th>
                <th>เลขที่สัญญา</th>
                <th>รหัสลูกค้า</th>
                <th>ชื่อ-สกุล</th>
                <th>วันที่เริ่มสัญญา</th>
                <th>วันที่หมดสัญญา</th>
                <th style="width: 20%">จัดการ</th>
              </tr>
            </thead>
            <tbody id="tbpayments">


            </tbody>
          </table>
        </div><!-- /.card-body -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

</script>