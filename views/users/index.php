<?php
$users = new Users();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ข้อมูลผู้ใช้งาน</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active">ข้อมูลผู้ใช้งาน</li>
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
              <h3 class="card-title mt-2">รายการข้อมูลผู้ใช้งาน</h3>
            </div>
            <div class="col-md-6 text-right">
              <a type="button" class="btn btn-success" href="usersform"><i class='fas fa-plus'></i> เพิ่มข้อมูล</a>
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
          <table class="table table-hover projects mt-3 reloadusers">
            <thead>
              <tr>
                <th style="width: 2%"> #</th>
                <th>ชื่อ-สกุล</th>
                <th>ชื่อผู้ใช้</th>
                <th>เบอร์โทร</th>
                <th>สิทธิ์การใช้งาน</th>
                <th class="text-center">สถานะ</th>
                <th style="width: 20%" class="text-center">จัดการ</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($users->listClient("users") as $client) : ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $client['u_prename'] . $client['u_firstname'] . " " . $client['u_lastname']; ?></td>
                  <td><?php echo $client['u_username']; ?></td>
                  <td><?php echo $client['u_tel']; ?></td>
                  <td><?php echo $client['u_accessrights']; ?></td>
                  <td class="project-state">
                    <?php
                    if ($client['u_status'] != 0) {
                      echo '<span class="badge badge-success">อนุมัติ</span>';
                    } else {
                      echo '<span class="badge badge-danger">ไม่อนุมัติ</span>';
                    }
                    ?>

                  </td>
                  <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#">
                      <i class="fas fa-folder">
                      </i>
                      View
                    </a>
                    <a class="btn btn-info btn-sm" href="<?php echo 'usersform?id=' . $client['u_id']; ?>">
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                    </a>
                    <button type="button" class="btn btn-danger btn-sm deleteusers" data-id="<?php echo $client['u_id']; ?>">
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