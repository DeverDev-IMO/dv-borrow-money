<?php
$setlinework = new Setlinework();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fas fa-cog'></i> ตั้งค่าสายงาน</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">ตั้งค่าสายงาน</li>
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
              <h3 class="card-title mt-2">รายการตั้งค่าสายงาน</h3>
            </div>
            <div class="col-md-6 text-right">
              <!-- <a type="button" class="btn btn-success" href="customerform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a> -->
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add-setlinework"><i class='fas fa-plus'></i> เพิ่มข้อมูล</button>
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
          <table class="table table-hover projects reloadsetlinework">
            <thead>
              <tr>
                <th style="width: 5%"> #</th>
                <th>รหัส</th>
                <th>รายการ</th>
                <th>ชื่อพนักงาน</th>
                <th>เบอร์โทร</th>
                <th style="width: 20%" class="text-center">จัดการ</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($setlinework->listClient("linework") as $client) : ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $client['lw_code']; ?></td>
                  <td><?php echo $client['lw_name']; ?></td>
                  <td><?php echo $client['lw_personnelhead_name']; ?><br><?php echo $client['lw_personnelhenchman_name']; ?></td>
                  <td><?php echo $client['lw_personnelhead_tel']; ?><br><?php echo $client['lw_personnelhenchman_tel']; ?></td>
                  <td class="project-actions text-center">
                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit-setlinework<?php echo $i; ?>">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <?php include('formedit.php'); ?>
                    <button type="button" class="btn btn-danger btn-sm deletesetlinework" data-id="<?php echo $client['lw_id']; ?>">
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


<div class="modal fade" id="modal-add-setlinework">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">ฟอร์มบันทึกข้อมูลสายงาน/พนักงาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="setlineworkinsertdata" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group text-left">
                <label>รหัส</label>
                <input type="text" class="form-control" name="lw_code" placeholder="ระบุรหัสสายงาน" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>ชื่อสายงาน</label>
                <input type="text" class="form-control" name="lw_name" placeholder="ระบุสายงาน" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>ชื่อพนักงาน(หัวหน้า)</label>
                <input type="text" class="form-control" name="lw_personnelhead_name" placeholder="ชื่อพนักงาน" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>เบอร์โทร</label>
                <input type="text" class="form-control" name="lw_personnelhead_tel" placeholder="เบอร์โทร" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>ชื่อพนักงาน(ลูกน้อง)</label>
                <input type="text" class="form-control" name="lw_personnelhenchman_name" placeholder="ชื่อพนักงาน" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>เบอร์โทร</label>
                <input type="text" class="form-control" name="lw_personnelhenchman_tel" placeholder="เบอร์โทร" required>
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