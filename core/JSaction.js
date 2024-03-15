$("#getlogin").on("submit",function(e){
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
       url:  'controller/ControllerHome.php?action=getlogin',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    // alert(data);
      if(data!=0){
          window.location.replace(BASEURLJS);
      }else{
        Swal.fire({ title: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {

          })
      }
 
   }     
})
   return false;
}); 

$(document).on('click', '#getlogout', function(){
  if(confirm("ต้องการออกจากระบบใช่หรือไม่!")){
      $.ajax({
          url: 'controller/ControllerHome.php?action=getlogout',
          type: 'POST',
          async: false,
          cache: false,
          success:function(data){
              window.location.replace(BASEURLJS);
          }     
      })
  }
});

$("#profileeditdata").on("submit", function (e) {
  e.preventDefault();
  var formData = new FormData($(this)[0]);
  $.ajax({
    url: "controller/ControllerProfile.php?action=profileeditdata",
    type: "POST",
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
      // alert(data);
      Swal.fire({
        title: "แก้ไขข้อมูลเรียบร้อยแล้ว!",
        icon: "success",
        confirmButtonText: "ตกลง",
      }).then((result) => {
        // $('.Modaleditfaculty').modal('hide');
        // window.location.replace(BASEURLJS);
        window.location.replace(BASEURLJS+'profile');
      });

      // $("#reloadfaculty").load(window.location.href + " #reloadfaculty" );
      // alert(id);
    },
  });
  return false;
});

$("#getregister").on("submit", function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
      url: "controller/ControllerHome.php?action=getregister",
      type: "POST",
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        // alert(data);
        if (data=="checkuserno") {
          Swal.fire({ title: 'ชื่อผู้ใช้ซ้ำกับผู้ใช้อื่นในระบบ!!',icon: 'error',confirmButtonText: 'ตกลง'});
        } else if (data=="no") {
          Swal.fire({ title: 'รหัสผ่านไม่ตรงกันกรุณาตรวจสอบ!!',icon: 'error',confirmButtonText: 'ตกลง'});
        } else {
            Swal.fire({
            title: "สมัครสมาชิกเรียบร้อยแล้ว กรุณา Login เพื่อเข้าสู่ระบบ",
            icon: "success",
            confirmButtonText: "ตกลง",
          }).then((result) => {
            window.location.replace(BASEURLJS);
          });
        }

      },
    });
    return false;
  });
$("#changepassworddata").on("submit", function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
      url: "controller/ControllerProfile.php?action=passwordeditdata",
      type: "POST",
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        // alert(data);
        if (data=="checkpassnewno") {
          Swal.fire({ title: 'รหัสผ่านใหม่ไม่ตรงกัน',icon: 'error',confirmButtonText: 'ตกลง'});
        } else if (data=="checkpassoldno") {
          Swal.fire({ title: 'รหัสผ่านเดิมไม่ถูกต้อง',icon: 'error',confirmButtonText: 'ตกลง'});
        } else {
            Swal.fire({
            title: "แก้ไขรหัสผ่านเรียบร้อยแล้ว",
            icon: "success",
            confirmButtonText: "ตกลง",
          }).then((result) => {
            window.location.replace(BASEURLJS);
          });
        }

      },
    });
    return false;
  });

  $("#select_registergovernmentfrom").change(function() {    
    var id = $(this).find(":selected").attr("date-val");
    var dataString = 'agid='+ id;
    $.ajax({
      url: 'controller/ControllerHome.php?action=selectgetdata',
      dataType: "json",
      data: dataString,  
      cache: false,
      success: function(employeeData) {
            $("#u_booknumber").val(employeeData.ag_booknumber);
            $("#u_head_government").val(employeeData.mp_fullname);

      } 
    });

   }) 

   $("#select_Profilegovernmentfrom").change(function() {    
    var id = $(this).find(":selected").attr("date-val");
    var dataString = 'agid='+ id;
    $.ajax({
      url: 'controller/ControllerProfile.php?action=selectgetdata',
      dataType: "json",
      data: dataString,  
      cache: false,
      success: function(employeeData) {
            $("#u_booknumber").val(employeeData.ag_booknumber);
            $("#u_head_government").val(employeeData.mp_fullname);

      } 
    });

   }) 