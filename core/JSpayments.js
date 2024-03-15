$("#paymentsinsertdata").on("submit",function(e){
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
       url:  'controller/ControllerPayments.php?action=paymentsinsertdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    // alert(data);
        Swal.fire({ title: 'เพิ่มข้อมูลเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
          window.location.replace(BASEURLJS+'paymentsform?id='+data);
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
 
 $(function(){
  // ============================================================================
  // เริ่มต้นให้โหลดข้อมูลทั้งหมดออกมาแสดง โดยเรียกฟังก์ชัน all_users()
  all_users();

  // สร้างฟังก์ชันดึงข้อมูลจากตาราง user ทั้งหมด โดยอ่านจากไฟล์ all_users.php
  function all_users(){
    // alert('159');
      $.ajax({ 
              url: 'controller/ControllerPayments.php?action=paymentsfetchdata',
              type: 'GET',
              dataType: 'json',
              success: function(data){
                   console.log(data);
                    // กำหนดตัวแปรเก็บโครงสร้างแถวของตาราง
                    var trstring ="";
                    // ตัวแปรนับจำนวนแถว
                    var countrow = 1;

                    // วนลูปข้อมูล JSON ลงตาราง
                    $.each(data, function(key, value){
                      let cash_date_start = value.cash_date_start;
                        // ทดสอบแสดงชื่อ
                        // console.log(value.fullname);
                        // แสดงค่าลงในตาราง
                        trstring += `
                        <tr>
                            <td>${countrow}</td>
                            <td>${value.contract_number}</td>
                            <td>${value.cus_card_id}</td>
                            <td>${value.setpre_name+value.cus_firstname+' '+value.cus_lastname}</td>
                            <td>${value.cash_date_start}</td>
                            <td>${value.cash_date_end}</td>
                            <td><a class="btn btn-primary btn-xs" href="#">
                            <i class="fa fa-print">
                            </i>
                          </a></td>
                        </tr>`;
                        $('table #tbpayments').html(trstring);
                        countrow++;
                   
                      });
                    }
                });
            }

  // ============================================================================
  // เมื่อมีการ submit form
  $('form#search_payments').submit(function(event) {
    // alert('search_payments');
     event.preventDefault();

      // รับค่าจากฟอร์ม
      // var payments_date_start = $('input#payments_date_start').val();
      // var payments_date_end = $('input#payments_date_end').val();
      var payments_linework_id = $('#payments_linework_id').val();

      // ส่งค่าไป search_result.php ด้วย jQuery Ajax
      $.ajax({
          // url: 'search_result.php',
          url: 'controller/ControllerPayments.php?action=paymentssearchdata',
          type: 'POST',
          dataType: 'json',
          data: {
            // payments_date_start:payments_date_start,
            // payments_date_end:payments_date_end,
            payments_linework_id:payments_linework_id
          },
          success: function(data){
              if(data.length != 0){
                  // กรณีมีข้อมูล
                  // กำหนดตัวแปรเก็บโครงสร้างแถวของตาราง
                  var trstring ="";

                  // ตัวแปรนับจำนวนแถว
                  var countrow = 1;

                  // วนลูปข้อมูล JSON ลงตาราง
                  $.each(data, function(key, value){
                      // แสดงค่าลงในตาราง
                      trstring += `
                        <tr>
                            <td>${countrow}</td>
                            <td>${value.contract_number}</td>
                            <td>${value.cus_card_id}</td>
                            <td>${value.setpre_name+value.cus_firstname+' '+value.cus_lastname}</td>
                            <td>${value.cash_date_start}</td>
                            <td>${value.cash_date_end}</td>
                            <td><a class="btn btn-primary btn-xs" href="#">
                            <i class="fa fa-print">
                            </i>
                          </a></td>
                        </tr>`;
                      $('table tbody').html(trstring);
                      countrow++;
                  });


              }else{
                  alert('ไม่พบข้อมูลที่ค้นหา');
              }
          }
      });
  });

  // ============================================================================
  // เมื่อกดปุ่มล้างข้อมูลการค้นหา
  $('input#resetform').click(function(){
      // ล้างค่าในฟอร์มทั้งหมด
      $("#search_user").trigger('reset');
      // โฟกัสช่องชื่อ
      $('input#fullname').focus();
      // เรียกแสดงผลข้อมูลทั้งหมด
      all_users();
  });

});

// ============================================================================
  // $('#showlistcontract').submit(function(event) {
    $(document).on('click', '.showlistcontract', function(){
     var id = $(this).attr("data-id");
     var paymentsdateend = $('.payments-date-end').val();
     var payments_linework_id = $('.paymentslineworkid').val();
    //  alert(paymentsdateend);
     $(".reloadcontract").load(window.location.href + " .reloadcontract");
     $(".reloadtotalpayment").load(window.location.href + " .reloadtotalpayment");
      $.ajax({
          url: 'controller/ControllerPayments.php?action=paymentsshowcontractdata',
          type: 'POST',
          dataType: 'json',
          data: {
            contract_id:id,
            payments_date_end:paymentsdateend,
            payments_linework_id:payments_linework_id
          },
          success: function(data){
            $(".reloadcontract").load(window.location.href + " .reloadcontract");
          console.log(data);

                  var trstring ="";
                  $.each(data, function(key, value){
                    var sumcreditbalance = (parseInt(value.cash_principle)+parseInt(value.cash_interest));
                    var numinstallment = (parseInt(value.paysum_pay_installment)+1);
                      // trstring += `
                      //   <tr>
                      //       <td>${value.contract_number}</td>
                      //       <td>${value.setpre_name+value.cus_firstname+' '+value.cus_lastname}</td>
                      //       <td>${value.cash_date_start}</td>
                      //       <td>${paymentsdateend}</td>
                      //       <td><input class="form-control form-control-sm keynum" type="text" name="pay_number_money" value="${value.pay_number_money}">
                      //       <input class="contract-id" type="text" name="contract_id" value="${value.contract_id}">
                      //       </td>
                      //   </tr>`;
                      trstring += `
                        <tr>`;
                        trstring += `<td>${value.contract_number}</td>`;
                        trstring += `<td>${value.setpre_name+value.cus_firstname+' '+value.cus_lastname}</td>`;
                        // trstring += `<td>${value.paysum_pay_installment}</td>`;
                        if(value.paysum_pay_installment==undefined || value.paysum_pay_installment==null || value.paysum_pay_installment==NaN){
                          trstring += `<td>0</td>`;
                        }else{
                          trstring += `<td>${numinstallment}</td>`;
                        }
                        trstring += `<td>${paymentsdateend}</td>`;
                        trstring += `<td>${addCommas(sumcreditbalance)}</td>`;
                            if(value.paysum_pay_amount==undefined || value.paysum_pay_amount==null){
                              trstring += `<td>0</td>`;
                            }else{
                              trstring += `<td>${addCommas(value.paysum_pay_amount)}</td>`;
                            }

                            if(value.paysum_pay_balance==undefined || value.paysum_pay_balance==null){
                              trstring += `<td>0</td>`;
                            }else{
                              trstring += `<td>${addCommas(value.paysum_pay_balance)}</td>`;
                            }
                        
                        trstring += `<td>${value.cash_installments_daily}</td>`;
                        trstring += `<td>`;
                            if(value.pay_number_money ==undefined || value.pay_number_money ==null){
                              trstring += `<input class="form-control form-control-sm keynum" type="text" name="pay_number_money">`;
                            }else{
                              // trstring += `<input class="form-control form-control-sm keynum" type="text" name="pay_number_money" value="${value.pay_number_money}">`;
                              trstring += `<input class="form-control form-control-sm keynum" type="text" name="pay_number_money">`;
                            }
                           trstring += ` <input class="contract-id" type="hidden" name="contract_id" value="${value.contract_id}">
                            </td>
                        </tr>`;
                      $('table #tbshowcontract').html(trstring);

                      // $('input.keynum').focus();
                      var searchInput = $('input.keynum');
                      var strLength = searchInput.val().length * 2;
                      searchInput.focus();
                      searchInput[0].setSelectionRange(strLength, strLength);
                  });

          }
      });
  });
////////////////////////บันทึกรับชำระ///////////////////
  $("#payinsertdata").on("submit",function(e){
    var paymentsdateend = $('.payments-date-end').val();
    var payments_linework_id = $('.paymentslineworkid').val();
    var contractid = $('.contract-id').val();
    var pay_number_money = $('.keynum').val();
    e.preventDefault(); 
    var formData = new FormData($(this)[0]); 
    // alert(paymentsdateend);
    // alert(contractid);
    // alert(payments_linework_id);
    // alert(pay_number_money);
    $(".reloadcontract").load(window.location.href + " .reloadcontract");
    $(".reloadtotalpayment").load(window.location.href + " .reloadtotalpayment");
     $.ajax({
        url:  'controller/ControllerPayments.php?action=paymentsinsertdata',
         type: 'POST',
        data: {
          contract_id:contractid,
          payments_date_end:paymentsdateend,
          pay_number_money:pay_number_money,
          payments_linework_id:payments_linework_id

        },
         dataType:'json',
        //  contentType: false,
        //  processData: false,
     success:function(data){
      // alert(data);
      $(".reloadcontract").load(window.location.href + " .reloadcontract");
          // alert(data.contract_number);
          console.log(data);
          var sumcreditbalance = (parseInt(data.cash_principle)+parseInt(data.cash_interest));
          var numinstallment = (parseInt(data.paysum_pay_installment)+1);
          var trstring ="";
                      // trstring += `
                      //   <tr>
                      //       <td>${data.contract_number}</td>
                      //       <td>${data.setpre_name+data.cus_firstname+' '+data.cus_lastname}</td>
                      //       <td>${paymentsdateend}</td>
                      //       <td>${paymentsdateend}</td>
                      //       <td>`;
                      //       trstring += `<input class="form-control form-control-sm keynum" type="text" name="pay_number_money">`;

                      //       trstring += `<input class="contract-id" type="hidden" name="contract_id" value="${data.contract_id}">
                      //       </td>
                      //   </tr>`;
                      trstring += `
                        <tr>`;
                        trstring += `<td>${data.contract_number}</td>`;
                        trstring += `<td>${data.setpre_name+data.cus_firstname+' '+data.cus_lastname}</td>`;
                        trstring += `<td>${numinstallment}</td>`;
                        trstring += `<td>${paymentsdateend}</td>`;
                        trstring += `<td>${addCommas(sumcreditbalance)}</td>`;
                            if(data.paysum_pay_amount==undefined || data.paysum_pay_amount==null || data.paysum_pay_amount==NaN){
                              trstring += `<td>0</td>`;
                            }else{
                              trstring += `<td>${addCommas(data.paysum_pay_amount)}</td>`;
                            }

                            if(data.paysum_pay_balance==undefined || data.paysum_pay_balance==null){
                              trstring += `<td>0</td>`;
                            }else{
                              trstring += `<td>${addCommas(data.paysum_pay_balance)}</td>`;
                            }
                        
                        trstring += `<td>${data.cash_installments_daily}</td>`;
                        trstring += `<td>`;
                            if(data.pay_number_money ==undefined || data.pay_number_money ==null){
                              trstring += `<input class="form-control form-control-sm keynum" type="text" name="pay_number_money">`;
                            }else{
                              // trstring += `<input class="form-control form-control-sm keynum" type="text" name="pay_number_money" value="${data.pay_number_money}">`;
                              trstring += `<input class="form-control form-control-sm keynum" type="text" name="pay_number_money">`;
                            }
                           trstring += ` <input class="contract-id" type="hidden" name="contract_id" value="${data.contract_id}">
                                        
                            </td>
                        </tr>`;

                      $('table #tbshowcontract').html(trstring);

                      // $('input.keynum').focus();
                      var searchInput = $('input.keynum');
                      var strLength = searchInput.val().length * 2;
                      searchInput.focus();
                      searchInput[0].setSelectionRange(strLength, strLength);
                    
         
     }     
  })
     return false;
  }); 


  $(document).on('click', '.reloadcontractaa', function(){
    $(".reloadcontract").load(window.location.href + " .reloadcontract" );
  });


  $(document).on('click', '.confirmclosebalance', function(){
    var id = $(this).attr("data-id");
    var dateclosebalance = $(this).attr("data-dateclosebalance");
    // if(confirm("ต้องการปิดบัญชีนี้ใช่หรือไม่!")){

    // }
    Swal.fire({
      title: 'ต้องการปิดบัญชีนี้ใช่หรือไม่ !',
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
          url: 'controller/ControllerPayments.php?action=paymentsconfirmclosebalance&contract_id='+id+'&dateclosebalance='+dateclosebalance,
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
                  title: 'ปิดยอดเรียบร้อย'
                })
          }     
        })

      }
    })
  });



