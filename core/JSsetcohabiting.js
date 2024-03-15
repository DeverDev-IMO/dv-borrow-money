$("#setcohabitinginsertdata").on("submit",function(e){
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
       url:  'controller/ControllerSetcohabiting.php?action=setcohabitinginsertdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    // alert(data);
        Swal.fire({ title: 'เพิ่มข้อมูลเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
          window.location.replace(BASEURLJS+'setcohabiting');
        });
       
   }     
})
   return false;
}); 

$(".setcohabitingeditdata").on("submit",function(e){
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
      url:  'controller/ControllerSetcohabiting.php?action=setcohabitingeditdata',
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
      window.location.replace(BASEURLJS+'setcohabiting');
    })

   }     
})
   return false;
}); 

$(document).on('click', '.deletesetcohabiting', function(){
  var id = $(this).attr("data-id");
  var photo = $(this).attr("data-photo");
  if(confirm("ต้องการจะลบข้อมูลนี้ใช่หรือไม่!")){
      $.ajax({
          url: 'controller/ControllerSetcohabiting.php?action=setcohabitingdelete&setcoh_id='+id,
          type: 'POST',
          async: false,
          cache: false,
          success:function(data){
              $(".reloadsetcohabiting").load(window.location.href + " .reloadsetcohabiting" );

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




