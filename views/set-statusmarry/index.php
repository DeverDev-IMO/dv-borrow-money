<?php
$setstatusmarry = new Setstatusmarry();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fas fa-cog'></i> ตั้งค่าสถานภาพสมรส</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">ตั้งค่าสถานภาพสมรส</li>
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
              <h3 class="card-title mt-2">รายการตั้งค่าสถานภาพสมรส</h3>
            </div>
            <div class="col-md-6 text-right">
              <!-- <a type="button" class="btn btn-success" href="customerform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add-setstatusmarry"><i class='fas fa-plus'></i> เพิ่มข้อมูล</button>
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
          <table class="table table-hover projects reloadsetstatusmarry">
            <thead>
              <tr>
                <th style="width: 5%"> #</th>
                <th>รายการ</th>
                <th style="width: 20%" class="text-center">จัดการ</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($setstatusmarry->listClient("set_statusmarry") as $client) : ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $client['setmar_name']; ?></td>
                  <td class="project-actions text-center">
                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit-setstatusmarry<?php echo $i; ?>">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <?php include('formedit.php'); ?>
                    <button type="button" class="btn btn-danger btn-sm deletesetstatusmarry" data-id="<?php echo $client['setmar_id']; ?>">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                    </button>
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


<div class="modal fade" id="modal-add-setstatusmarry">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">ฟอร์มบันทึกข้อมูลสถานภาพสมรส</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="setstatusmarryinsertdata" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>รายการ</label>
                <input type="text" class="form-control" name="setmar_name" placeholder="ระบุสถานภาพสมรส" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <!-- <button type="button" class="btn btn-primary">บันทึก</button> -->
          <input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->