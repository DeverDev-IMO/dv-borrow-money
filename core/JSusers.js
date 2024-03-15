$("#usersinsertdata").on("submit",function(e){
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
       url:  'controller/ControllerUsers.php?action=usersinsertdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    // alert(data);
        Swal.fire({ title: 'เพิ่มข้อมูลเรียบร้อยแล้ว! รหัสผ่านคือ 123456',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
          window.location.replace(BASEURLJS+'users');
        });
       
   }     
})
   return false;
}); 

$("#userseditdata").on("submit",function(e){
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
      url:  'controller/ControllerUsers.php?action=userseditdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    //  alert(data);
    Swal.fire({ title: 'แก้ไขข้อมูลเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
      // $('.Modaledituserstype').modal('hide');
      window.location.replace(BASEURLJS+'users');
    })

   }     
})
   return false;
}); 

$(document).on('click', '.deleteusers', function(){
  var id = $(this).attr("data-id");
  var photo = $(this).attr("data-photo");
  if(confirm("ต้องการจะลบข้อมูลนี้ใช่หรือไม่!")){
      $.ajax({
          url: 'controller/ControllerUsers.php?action=usersdelete&u_id='+id + "&photo=" + photo,
          type: 'POST',
          async: false,
          cache: false,
          success:function(data){
              $(".reloadusers").load(window.location.href + " .reloadusers" );

              const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                
                Toast.fire({
                  icon: 'success',
                  title: 'ลบข้อมูลเรียบร้อย'
                })
          }     
      })
  }
});

$("#select_usersgovernmentfrom").change(function() {    
  var id = $(this).find(":selected").attr("date-val");
  var dataString = 'agid='+ id;
  $.ajax({
    url: 'controller/ControllerUsers.php?action=selectgetdata',
    dataType: "json",
    data: dataString,  
    cache: false,
    success: function(employeeData) {
          $("#u_booknumber").val(employeeData.ag_booknumber);
          $("#u_head_government").val(employeeData.mp_fullname);

    } 
  });

 }) 



