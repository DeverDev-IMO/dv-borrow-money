<?php
$contract = new Contract();
$client = $contract->getInfoCashloan("contract", $id);
?>
<form id="<?php if ($client['contract_cashloan_id'] != '0') {
            echo 'cashloaneditdata';
          } else {
            echo 'cashloaninsertdata';
          } ?>" method="post" enctype="multipart/form-data">
  <div class="row">

    <div class="col-md-3">
      <div class="form-group">
        <label>เงินต้น</label>
        <input type="number" class="form-control" name="cash_principle" placeholder="ระบุเงินต้น" value="<?php echo $client['cash_principle']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>ดอกเบี้ย</label>
        <input type="number" class="form-control" name="cash_interest" placeholder="ระบุดอกเบี้ย" value="<?php echo $client['cash_interest']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>จำนวนเงินชำระต่อวัน</label>
        <input type="number" class="form-control" name="cash_installments_daily" placeholder="ระบุชำระต่อวัน" value="<?php echo $client['cash_installments_daily']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>จำนวนงวด</label>
        <input type="number" class="form-control" name="cash_number_installment" placeholder="ระบุชำระต่อวัน" value="<?php echo $client['cash_number_installment']; ?>" readonly>
        <span style="font-size: 12px;color:red;">**คำนวณให้อัตโนมัติ</span>
      </div>
    </div>


  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>วันที่เริ่มผ่อน</label>
        <input type="date" class="form-control cash_date_start" name="cash_date_start" placeholder="ระบุเงินต้น" value="<?php echo $client['cash_date_start']; ?>" required>
        <span style="font-size: 12px;color:red;">**ระบุปีเป็น ค.ศ.</span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>กำหนดจำนวนงวดชำระสูงสุด</label>
        <select class="custom-select" name="installment_limit" required>
          <option value="58">58 งวด</option>
          <option value="73">73 งวด</option>
          <option value="76">76 งวด</option>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>วันที่ผ่อนชำระงวดสุดท้าย</label>
        <input type="date" class="form-control" name="cash_date_end" placeholder="ระบุเงินต้น" value="<?php echo $client['cash_date_end']; ?>" readonly>
        <span style="font-size: 12px;color:red;">**คำนวณให้อัตโนมัติ</span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>งวดสุดท้าย</label>
        <!-- <input type="number" class="form-control" name="cash_difference" placeholder="ระบุเงินต้น" value="<?php echo $client['cash_difference']; ?>" readonly> -->
        <input type="number" class="form-control" name="cash_difference" placeholder="ระบุเงินต้น" value="<?php echo ($client['cash_difference'] == "0" ? $client['cash_installments_daily'] : $client['cash_difference']); ?>" readonly>
        <span style="font-size: 12px;color:red;">**คำนวณให้อัตโนมัติ</span>
      </div>
    </div>

  </div>
  <?php
  $dateTime = new DateTime();
  $month = $dateTime->format('m');
  ?>
  <h5>กำหนดสายงาน</h5>
  <hr style="border-bottom:2px solid #28a745;">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>กำหนดสายงาน</label>
        <select id="select_lineworkfrom" class="custom-select" name="contract_linework_id" required>
          <?php if ($client['contract_cashloan_id'] == '0') { ?>
            <option value="">---เลือก---</option>
          <?php } else { ?>
            <option date-val="<?php echo $client['lw_id']; ?>" value="<?php echo $client['lw_id']; ?>"><?php echo $client['lw_code'] . '-' . $client['lw_name']; ?></option>
          <?php } ?>
          <?php foreach ($contract->listLineworkClient("linework") as $clientLinework) : ?>
            <option date-val="<?php echo $clientLinework['lw_id']; ?>" value="<?php echo $clientLinework['lw_id']; ?>"><?php echo $clientLinework['lw_code'] . '-' . $clientLinework['lw_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>พนักงาน(หัวหน้า)</label>
        <input type="text" class="form-control" name="contract_personnelhead_name" id="contract_personnelhead_name" value="<?php echo $client['contract_personnelhead_name']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เบอร์โทร</label>
        <input type="text" class="form-control" name="contract_personnelhead_tel" id="contract_personnelhead_tel" value="<?php echo $client['contract_personnelhead_tel']; ?>" required>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3">
      <div class="form-group">
        <label>พนักงาน(ลูกน้อง)</label>
        <input type="text" class="form-control" name="contract_personnelhenchman_name" id="contract_personnelhenchman_name" value="<?php echo $client['contract_personnelhenchman_name']; ?>" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>เบอร์โทร</label>
        <input type="text" class="form-control" name="contract_personnelhenchman_tel" id="contract_personnelhenchman_tel" value="<?php echo $client['contract_personnelhenchman_tel']; ?>" required>
      </div>
    </div>
  </div>
  <!-- <hr style="border-bottom:2px solid #28a745;"> -->



  <div class="row mt-3">
    <div class="col-12">
      <input type="hidden" name="cash_id" value="<?php echo $client['cash_id']; ?>">
      <input type="hidden" name="cus_id" value="<?php echo $cusid; ?>">
      <input type="hidden" name="contract_id" value="<?php echo $id; ?>">
      <input type="submit" value="บันทึกข้อมูล/คำนวณ" class="btn btn-success">
      <a href="contract" class="btn btn-secondary float-right">Cancel</a>

    </div>
  </div>
</form>