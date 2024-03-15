$(document).on('click', '.cancelclosebalance', function(){
  var id = $(this).attr("data-id");
  // if(confirm("ต้องการปิดบัญชีนี้ใช่หรือไม่!")){

  // }
  Swal.fire({
    title: 'ต้องการยกเลิกปิดบัญชีนี้ใช่หรือไม่ !',
    // text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonText: 'ไม่ใช่',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ใช่'
  }).then((result) => {
    console.log(result);
    if (result.isConfirmed) {
      // Swal.fire(
      //   'Deleted!',
      //   'Your file has been deleted.',
      //   'success'
      // )
      $.ajax({
        url: 'controller/ControllerClosebalance.php?action=cancelclosebalance&contract_id='+id,
        type: 'POST',
        async: false,
        cache: false,
        success:function(data){
          $(".reloadcontract").load(window.location.href + " .reloadcontract");

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
                title: 'ยกเลิกการปิดยอดเรียบร้อย'
              })
        }     
      })

    }
  })
});