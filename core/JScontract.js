$("#contractinsertdata").on("submit",function(e){
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
       url:  'controller/ControllerContract.php?action=contractinsertdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    // alert(data);
        Swal.fire({ title: 'เพิ่มข้อมูลเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
          window.location.replace(BASEURLJS+'contractform?tabs=2' + data);
        });
       
   }     
})
   return false;
}); 

$("#contracteditdata").on("submit",function(e){
  // alert('contracteditdata');
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
      url:  'controller/ControllerContract.php?action=contracteditdata',
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
      window.location.replace(BASEURLJS+'contractform?tabs=2' + data);
    })

   }     
})
   return false;
}); 

$(document).on('click', '.deletecontract', function(){
  var id = $(this).attr("data-id");
  var photo = $(this).attr("data-photo");
  if(confirm("ต้องการจะยกเลิกข้อมูลนี้ใช่หรือไม่!")){
      $.ajax({
          url: 'controller/ControllerContract.php?action=contractdelete&contract_id='+id,
          type: 'POST',
          async: false,
          cache: false,
          success:function(data){
            // alert(data);
              $(".reloadcontract").load(window.location.href + " .reloadcontract" );

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
                  title: 'ยกเลิกข้อมูลเรียบร้อย'
                })
          }     
      })
  }
});
/////////////////////////////////////////marrydetail//////////////////////////////////////////
$("#marrydetailinsertdata").on("submit",function(e){
  // alert('marrydetailinsertdata');
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
       url:  'controller/ControllerContract.php?action=marrydetailinsertdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    // alert(data);
        Swal.fire({ title: 'เพิ่มข้อมูลเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
          window.location.replace(BASEURLJS+'contractform?tabs=3' + data);
        });
       
   }     
})
   return false;
}); 

$("#marrydetaileditdata").on("submit",function(e){
  // alert('contracteditdata');
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
      url:  'controller/ControllerContract.php?action=marrydetaileditdata',
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
      window.location.replace(BASEURLJS+'contractform?tabs=3' + data);
    })

   }     
})
   return false;
}); 
/////////////////////////////////////////contact_emergency//////////////////////////////////////////
$("#contactemergencyinsertdata").on("submit",function(e){
  // alert('marrydetailinsertdata');
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
       url:  'controller/ControllerContract.php?action=contactemergencyinsertdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    // alert(data);
        Swal.fire({ title: 'เพิ่มข้อมูลเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
          window.location.replace(BASEURLJS+'contractform?tabs=4' + data);
        });
       
   }     
})
   return false;
}); 

$("#contactemergencyeditdata").on("submit",function(e){
  // alert('contracteditdata');
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
      url:  'controller/ControllerContract.php?action=contactemergencyeditdata',
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
      window.location.replace(BASEURLJS+'contractform?tabs=4' + data);
    })

   }     
})
   return false;
}); 
/////////////////////////////////////////guarantor//////////////////////////////////////////
$("#guarantorinsertdata").on("submit",function(e){
  // alert('marrydetailinsertdata');
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
       url:  'controller/ControllerContract.php?action=guarantorinsertdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    // alert(data);
        Swal.fire({ title: 'เพิ่มข้อมูลเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
          window.location.replace(BASEURLJS+'contractform?tabs=5' + data);
        });
       
   }     
})
   return false;
}); 

$("#guarantoreditdata").on("submit",function(e){
  // alert('contracteditdata');
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
      url:  'controller/ControllerContract.php?action=guarantoreditdata',
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
      window.location.replace(BASEURLJS+'contractform?tabs=5' + data);
    })

   }     
})
   return false;
}); 
/////////////////////////////////////////guarantor//////////////////////////////////////////
$("#cashloaninsertdata").on("submit",function(e){
  // alert('marrydetailinsertdata');
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
       url:  'controller/ControllerContract.php?action=cashloaninsertdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    // alert(data);
    if(data=='dayover58'){
      Swal.fire({ title: 'จำนวนงวดเกิน 58 งวด กรุณาแก้ไขข้อมูล!',icon: 'error',confirmButtonText: 'ตกลง'});
    } else if (data=="dayover73") {
      Swal.fire({ title: 'จำนวนงวดเกิน 73 งวด กรุณาแก้ไขข้อมูล!',icon: 'error',confirmButtonText: 'ตกลง'});
    } else if (data=="dayover76") {
      Swal.fire({ title: 'จำนวนงวดเกิน 76 งวด กรุณาแก้ไขข้อมูล!',icon: 'error',confirmButtonText: 'ตกลง'});
    }else{
      Swal.fire({ title: 'แก้ไขข้อมูลเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
        // $('.Modaledituserstype').modal('hide');
        window.location.replace(BASEURLJS+'contractform?tabs=5' + data);
      })
    }
     
   }     
})
   return false;
}); 

$("#cashloaneditdata").on("submit",function(e){
  // alert($('.cash_date_start').val())
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
      url:  'controller/ControllerContract.php?action=cashloaneditdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    //  alert(data);
    if(data=='dayover58'){
      Swal.fire({ title: 'จำนวนงวดเกิน 58 งวด กรุณาแก้ไขข้อมูล!',icon: 'error',confirmButtonText: 'ตกลง'});
    } else if (data=="dayover73") {
      Swal.fire({ title: 'จำนวนงวดเกิน 73 งวด กรุณาแก้ไขข้อมูล!',icon: 'error',confirmButtonText: 'ตกลง'});
    } else if (data=="dayover76") {
      Swal.fire({ title: 'จำนวนงวดเกิน 76 งวด กรุณาแก้ไขข้อมูล!',icon: 'error',confirmButtonText: 'ตกลง'});
    }else{
      Swal.fire({ title: 'แก้ไขข้อมูลเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
        // $('.Modaledituserstype').modal('hide');
        window.location.replace(BASEURLJS+'contractform?tabs=5' + data);
      })
    }

   }     
})
   return false;
}); 


$("#select_lineworkfrom").change(function() {    
  var id = $(this).find(":selected").attr("date-val");
  // alert(id);
  var dataString = 'lwid='+ id;
  $.ajax({
    url: 'controller/ControllerContract.php?action=selectgetdata',
    dataType: "json",
    data: dataString,  
    cache: false,
    success: function(personnelData) {
      // console.log(personnelData);
      // alert(personnelData.lw_personnelhead_name);
          $("#contract_personnelhead_name").val(personnelData.lw_personnelhead_name);
          $("#contract_personnelhead_tel").val(personnelData.lw_personnelhead_tel);
          $("#contract_personnelhenchman_name").val(personnelData.lw_personnelhenchman_name);
          $("#contract_personnelhenchman_tel").val(personnelData.lw_personnelhenchman_tel);

    } 
  });

 }) 


var defaultOption = '<option value=""> ------- เลือก ------ </option>';
var loadingImage  = '<img src="public/loading4.gif" alt="loading" />';
	$('#selProvince').change(function() {
		$("#selAmphur").html(defaultOption);
		$("#selTumbon").html(defaultOption);
		$("#selZipcode").html(defaultOption);
    // alert(json);
		// alert($('#selProvince').val());
		$.ajax({
			url: "controller/ControllerContract.php?action=amphurdata",
			// data: ({ nextList : 'amphurdata', provinceID: $('#selProvince').val() }),
			data: ({ provinceID: $('#selProvince').val() }),
			dataType: "json",
			// beforeSend is called before the request is sent
			beforeSend: function() {
				$("#waitAmphur").html(loadingImage);
			},
			success: function(json){
        // console.log(json);
				$("#waitAmphur").html("");
				$.each(json, function(index, value) {
					 $("#selAmphur").append('<option value="' + value.amphures_id + 
											'">' + value.amphures_name_th + '</option>');
				});
			}
		});
	});

  $('#selAmphur').change(function() {
		$("#selTumbon").html(defaultOption);
		$("#selZipcode").html(defaultOption);
		$.ajax({
			url: "controller/ControllerContract.php",
			data: ({ action : 'tumbondata', amphurID: $('#selAmphur').val() }),
			dataType: "json",
			beforeSend: function() {
				$("#waitTumbon").html(loadingImage);
			},
			success: function(json){
				$("#waitTumbon").html("");
				$.each(json, function(index, value) {
					 $("#selTumbon").append('<option value="' + value.districts_id + 
											'">' + value.districts_name_th + '</option>');
				});
			}
		});
	});
  $('#selTumbon').change(function() {
		$("#selZipcode").html(defaultOption);
		$.ajax({
			url: "controller/ControllerContract.php",
			data: ({ action : 'zipcodedata', tumbonID: $('#selTumbon').val() }),
			dataType: "json",
			beforeSend: function() {
				$("#waitZipcode").html(loadingImage);
			},
			success: function(json){
				$("#waitZipcode").html("");
				$.each(json, function(index, value) {
					 $("#selZipcode").append('<option value="' + value.districts_zip_code + 
											'">' + value.districts_zip_code + '</option>');
				});
			}
		});
	});
var defaultOption1 = '<option value=""> ------- เลือก ------ </option>';
var loadingImage1  = '<img src="public/loading4.gif" alt="loading" />';
	$('#selProvince1').change(function() {
		$("#selAmphur1").html(defaultOption1);
		$("#selTumbon1").html(defaultOption1);
		$("#selZipcode1").html(defaultOption1);
    // alert(json);
		// alert($('#selProvince').val());
		$.ajax({
			url: "controller/ControllerContract.php?action=amphurdata",
			// data: ({ nextList : 'amphurdata', provinceID: $('#selProvince').val() }),
			data: ({ provinceID: $('#selProvince1').val() }),
			dataType: "json",
			// beforeSend is called before the request is sent
			beforeSend: function() {
				$("#waitAmphur1").html(loadingImage);
			},
			success: function(json){
        // console.log(json);
				$("#waitAmphur1").html("");
				$.each(json, function(index, value) {
					 $("#selAmphur1").append('<option value="' + value.amphures_id + 
											'">' + value.amphures_name_th + '</option>');
				});
			}
		});
	});

  $('#selAmphur1').change(function() {
		$("#selTumbon1").html(defaultOption1);
		$("#selZipcode1").html(defaultOption1);
		$.ajax({
			url: "controller/ControllerContract.php",
			data: ({ action : 'tumbondata', amphurID: $('#selAmphur1').val() }),
			dataType: "json",
			beforeSend: function() {
				$("#waitTumbon1").html(loadingImage);
			},
			success: function(json){
				$("#waitTumbon1").html("");
				$.each(json, function(index, value) {
					 $("#selTumbon1").append('<option value="' + value.districts_id + 
											'">' + value.districts_name_th + '</option>');
				});
			}
		});
	});
  $('#selTumbon1').change(function() {
		$("#selZipcode1").html(defaultOption1);
		$.ajax({
			url: "controller/ControllerContract.php",
			data: ({ action : 'zipcodedata', tumbonID: $('#selTumbon1').val() }),
			dataType: "json",
			beforeSend: function() {
				$("#waitZipcode1").html(loadingImage);
			},
			success: function(json){
				$("#waitZipcode1").html("");
				$.each(json, function(index, value) {
					 $("#selZipcode1").append('<option value="' + value.districts_zip_code + 
											'">' + value.districts_zip_code + '</option>');
				});
			}
		});
	});
  ////////////////////////ฟอร์มผู้กู้//////////////////////////
  $(document).ready(function() {
    $("#search-cardid").keyup(function() {
        let searchText = $(this).val();
        // alert(searchText);
        if (searchText != "") {
            $.ajax({
                url: "controller/ControllerContract.php?action=searchcardiddata",
                method: "post",
                data: {
                    querylist: searchText
                },
                dataType: "json",
                success: function(json) {
                  console.log(json.data);
                    // $("#show-list").html(json);
                  //   $.each(json, function(index, value) {
                  //     $("#show-list").append('<a style="cursor: pointer;" class="list-group-item selcardid" data-val="'+ value.cus_id +'">'+ value.cus_card_id +'</a>');
                  //  });
                  if(json.data!=''){
                    // $("#show-list").append('<a style="cursor: pointer;" class="list-group-item selcardid" data-val="'+ json.data.cus_id +'">'+ json.data.cus_card_id +'</a>');
                    $("#show-list").append('<a style="cursor: pointer;" class="list-group-item selcardid" data-val="'+ json.data.cus_card_id +'">'+ json.data.cus_card_id +'</a>');
                  }

                  if(json.data1!=''){
                    // $("#show-list").append('<a style="cursor: pointer;" class="list-group-item selcardid" data-val="'+ json.data1.guarantor_id +'">'+ json.data1.guarantor_card_id +'</a>');
                    $("#show-list").append('<a style="cursor: pointer;" class="list-group-item selcardid" data-val="'+ json.data1.guarantor_card_id +'">'+ json.data1.guarantor_card_id +'</a>');
                  }
                }
            })
        } else {
            $("#show-list").html("");
        }
    })

    $(document).on('click', '.selcardid', function() {
        $("#search-cardid").val($(this).text());
        $("#show-list").html("");
        $("[name='cus_card_id']").val($(this).text());
        var id = $(this).attr("data-val");
        var dataString = 'cardid='+ id;
        // alert(id);
        $.ajax({
          url: 'controller/ControllerContract.php?action=selectgetdatacustomer',
          dataType: "json",
          data: dataString,  
          cache: false,
          success: function(customerData) {
            // alert(customerData.status);
            if(customerData.status=="dataCustomer"){
              // alert(customerData.status);
                $("[name='cus_prename']").append('<option value="'+customerData.data.setpre_id+'" selected>'+customerData.data.setpre_name+'</option>');
                $("[name='cus_firstname']").val(customerData.data.cus_firstname);
                $("[name='cus_lastname']").val(customerData.data.cus_lastname);
                $("[name='cus_nickname']").val(customerData.data.cus_nickname);
                $("[name='cus_birthday']").val(customerData.data.cus_birthday);
                $("[name='cus_age']").val(customerData.data.cus_age);
                $("[name='cus_gender']").append('<option value="'+customerData.data.cus_gender+'" selected>'+customerData.data.cus_gender+'</option>');
                $("[name='cus_statusmarry']").append('<option value="'+customerData.data.setmar_id+'" selected>'+customerData.data.setmar_name+'</option>');
                $("[name='cus_address']").val(customerData.data.cus_address);
                $("[name='cus_house_no']").val(customerData.data.cus_house_no);
                $("[name='cus_village']").val(customerData.data.cus_village);
                $("[name='cus_lane']").val(customerData.data.cus_lane);
                $("[name='cus_streee']").val(customerData.data.cus_streee);
                $("[name='cus_province']").append('<option value="'+customerData.data.province_id+'" selected>'+customerData.data.province_name_th+'</option>');
                $("[name='cus_district']").append('<option value="'+customerData.data.amphures_id+'" selected>'+customerData.data.amphures_name_th+'</option>');
                $("[name='cus_sub_district']").append('<option value="'+customerData.data.districts_id+'" selected>'+customerData.data.districts_name_th+'</option>');
                $("[name='cus_postal_code']").append('<option value="'+customerData.data.cus_postal_code+'" selected>'+customerData.data.cus_postal_code+'</option>');
                $("[name='cus_home_phone']").val(customerData.data.cus_home_phone);
                $("[name='cus_mobile_phone']").val(customerData.data.cus_mobile_phone);
                $("[name='cus_numberyears_lived']").val(customerData.data.cus_numberyears_lived);
                $("[name='cus_numbermonths_lived']").val(customerData.data.cus_numbermonths_lived);
                $("[name='cus_statusaddress']").append('<option value="'+customerData.data.setadd_id+'" selected>'+customerData.data.setadd_name+'</option>');
                $("[name='cus_cohabiting']").append('<option value="'+customerData.data.setcoh_id+'" selected>'+customerData.data.setcoh_name+'</option>');
                $("[name='cus_number_lived']").val(customerData.data.cus_number_lived);
                $("[name='cus_statuswork']").append('<option value="'+customerData.data.setwork_id+'" selected>'+customerData.data.setwork_name+'</option>');
                $("[name='cus_workplace']").val(customerData.data.cus_workplace);
                $("[name='cus_workplace_no']").val(customerData.data.cus_workplace_no);
                $("[name='cus_village_work']").val(customerData.data.cus_village_work);
                $("[name='cus_lane_work']").val(customerData.data.cus_lane_work);
                $("[name='cus_streee_work']").val(customerData.data.cus_streee_work);

                $("[name='cus_province_work']").append('<option value="'+customerData.data1.province_id+'" selected>'+customerData.data1.province_name_th+'</option>');
                $("[name='cus_district_work']").append('<option value="'+customerData.data1.amphures_id+'" selected>'+customerData.data1.amphures_name_th+'</option>');
                $("[name='cus_sub_district_work']").append('<option value="'+customerData.data1.districts_id+'" selected>'+customerData.data1.districts_name_th+'</option>');
                $("[name='cus_postal_code_work']").append('<option value="'+customerData.data.cus_postal_code_work+'" selected>'+customerData.data.cus_postal_code_work+'</option>');
                $("[name='cus_home_phone_work']").val(customerData.data.cus_home_phone_work);
                $("[name='cus_mobile_phone_work']").val(customerData.data.cus_mobile_phone_work);

                $("[name='cus_nature_work']").val(customerData.data.cus_nature_work);
                $("[name='cus_department_work']").val(customerData.data.cus_department_work);
                $("[name='cus_position_work']").val(customerData.data.cus_position_work);
                $("[name='cus_contact_time']").val(customerData.data.cus_contact_time);
                $("[name='cus_numberyears_work']").val(customerData.data.cus_numberyears_work);
                $("[name='cus_income_day']").val(customerData.data.cus_income_day);
                $("[name='cus_income_month']").val(customerData.data.cus_income_month);
            }else{
              // alert(customerData.status);
                $("[name='cus_prename']").append('<option value="'+customerData.data2.setpre_id+'" selected>'+customerData.data2.setpre_name+'</option>');
                $("[name='cus_firstname']").val(customerData.data2.guarantor_firstname);
                $("[name='cus_lastname']").val(customerData.data2.guarantor_lastname);
                $("[name='cus_nickname']").val(customerData.data2.guarantor_nickname);
                $("[name='cus_birthday']").val(customerData.data2.guarantor_birthday);
                $("[name='cus_age']").val(customerData.data2.guarantor_age);
                $("[name='cus_gender']").append('<option value="'+customerData.data2.guarantor_gender+'" selected>'+customerData.data2.guarantor_gender+'</option>');
                $("[name='cus_statusmarry']").append('<option value="'+customerData.data2.setmar_id+'" selected>'+customerData.data2.setmar_name+'</option>');
                $("[name='cus_address']").val(customerData.data2.guarantor_address);
                $("[name='cus_house_no']").val(customerData.data2.guarantor_house_no);
                $("[name='cus_village']").val(customerData.data2.guarantor_village);
                $("[name='cus_lane']").val(customerData.data2.guarantor_lane);
                $("[name='cus_streee']").val(customerData.data2.guarantor_streee);

                $("[name='cus_province']").append('<option value="'+customerData.data2.province_id+'" selected>'+customerData.data2.province_name_th+'</option>');
                $("[name='cus_district']").append('<option value="'+customerData.data2.amphures_id+'" selected>'+customerData.data2.amphures_name_th+'</option>');
                $("[name='cus_sub_district']").append('<option value="'+customerData.data2.districts_id+'" selected>'+customerData.data2.districts_name_th+'</option>');
                $("[name='cus_postal_code']").append('<option value="'+customerData.data2.cus_postal_code+'" selected>'+customerData.data2.cus_postal_code+'</option>');
                $("[name='cus_home_phone']").val(customerData.data2.guarantor_home_phone);
                $("[name='cus_mobile_phone']").val(customerData.data2.guarantor_mobile_phone);
                $("[name='cus_numberyears_lived']").val(customerData.data2.guarantor_numberyears_lived);
                $("[name='cus_statusaddress']").append('<option value="'+customerData.data2.setadd_id+'" selected>'+customerData.data2.setadd_name+'</option>');
            }
            // console.log(customerData.data.data1);
                
          } 
        });
    })
    ////////////////////////end ฟอร์มผู้กู้//////////////////////////

    ////////////////////////ฟอร์มผู้ค้ำประกัน//////////////////////////
    $("#search-cardid-guarantor").keyup(function() {
      let searchText = $(this).val();
      // alert(searchText);
      if (searchText != "") {
          $.ajax({
              url: "controller/ControllerContract.php?action=searchcardidguarantordata",
              method: "post",
              data: {
                  querylist: searchText
              },
              dataType: "json",
              success: function(json) {
                console.log(json.data);
                console.log(json.data1);
                if(json.data!=''){
                  $("#show-list-guarantor").append('<a style="cursor: pointer;" class="list-group-item selcardidguarantor" data-val="'+ json.data.guarantor_card_id +'">'+ json.data.guarantor_card_id +'</a>');
                }
                if(json.data1!=''){ 
                  $("#show-list-guarantor").append('<a style="cursor: pointer;" class="list-group-item selcardidguarantor" data-val="'+ json.data1.cus_card_id +'">'+ json.data1.cus_card_id +'</a>');
                }
              }
          })
      } else {
          $("#show-list-guarantor").html("");
      }
  })

  $(document).on('click', '.selcardidguarantor', function() {
    $("#search-cardid-guarantor").val($(this).text());
    $("#show-list-guarantor").html("");
    $("[name='guarantor_card_id']").val($(this).text());
    var id = $(this).attr("data-val");
    var dataString = 'cardid='+ id;
    // alert(id);
    $.ajax({
      url: 'controller/ControllerContract.php?action=selectgetdataguarantor',
      dataType: "json",
      data: dataString,  
      cache: false,
      success: function(guarantorData) {
        // alert(guarantorData.status);
        if(guarantorData.status=="dataGuarantor"){
          // alert(customerData.status);
            $("[name='guarantor_prename']").append('<option value="'+guarantorData.data.setpre_id+'" selected>'+guarantorData.data.setpre_name+'</option>');
            $("[name='guarantor_firstname']").val(guarantorData.data.guarantor_firstname);
            $("[name='guarantor_lastname']").val(guarantorData.data.guarantor_lastname);
            $("[name='guarantor_nickname']").val(guarantorData.data.guarantor_nickname);

            $("[name='guarantor_birthday']").val(guarantorData.data.guarantor_birthday);
            $("[name='guarantor_age']").val(guarantorData.data.guarantor_age);
            $("[name='guarantor_gender']").append('<option value="'+guarantorData.data.guarantor_gender+'" selected>'+guarantorData.data.guarantor_gender+'</option>');
            $("[name='guarantor_statusmarry']").append('<option value="'+guarantorData.data.setmar_id+'" selected>'+guarantorData.data.setmar_name+'</option>');
            $("[name='guarantor_business_registration']").val(guarantorData.data.guarantor_business_registration);

            $("[name='guarantor_address']").val(guarantorData.data.guarantor_address);
            $("[name='guarantor_house_no']").val(guarantorData.data.guarantor_house_no);
            $("[name='guarantor_village']").val(guarantorData.data.guarantor_village);
            $("[name='guarantor_lane']").val(guarantorData.data.guarantor_lane);
            $("[name='guarantor_streee']").val(guarantorData.data.guarantor_streee);

            $("[name='guarantor_province']").append('<option value="'+guarantorData.data.province_id+'" selected>'+guarantorData.data.province_name_th+'</option>');
            $("[name='guarantor_district']").append('<option value="'+guarantorData.data.amphures_id+'" selected>'+guarantorData.data.amphures_name_th+'</option>');
            $("[name='guarantor_sub_district']").append('<option value="'+guarantorData.data.districts_id+'" selected>'+guarantorData.data.districts_name_th+'</option>');
            $("[name='guarantor_postal_code']").append('<option value="'+guarantorData.data.guarantor_postal_code+'" selected>'+guarantorData.data.guarantor_postal_code+'</option>');
            $("[name='guarantor_home_phone']").val(guarantorData.data.guarantor_home_phone);
            $("[name='guarantor_mobile_phone']").val(guarantorData.data.guarantor_mobile_phone);
            $("[name='guarantor_numberyears_lived']").val(guarantorData.data.guarantor_numberyears_lived);
            $("[name='guarantor_statusaddress']").append('<option value="'+guarantorData.data.setadd_id+'" selected>'+guarantorData.data.setadd_name+'</option>');

            ///////////////ข้อมูลคู่สมรส/////////////////
            $("[name='guarantor_prename_marry']").append('<option value="'+guarantorData.data1.setpre_id+'" selected>'+guarantorData.data1.setpre_name+'</option>');
            $("[name='guarantor_firstname_marry']").val(guarantorData.data.guarantor_firstname_marry);
            $("[name='guarantor_lastname_marry']").val(guarantorData.data.guarantor_lastname_marry);
            $("[name='guarantor_statuswork_marry']").append('<option value="'+guarantorData.data1.setwork_id+'" selected>'+guarantorData.data1.setwork_name+'</option>');
            $("[name='guarantor_workplace_marry']").val(guarantorData.data.guarantor_workplace_marry);
            $("[name='guarantor_workplace_no_marry']").val(guarantorData.data.guarantor_workplace_no_marry);
            $("[name='guarantor_village_marry']").val(guarantorData.data.guarantor_village_marry);
            $("[name='guarantor_lane_marry']").val(guarantorData.data.guarantor_lane_marry);
            $("[name='guarantor_streee_marry']").val(guarantorData.data.guarantor_streee_marry);

            $("[name='guarantor_province_marry']").append('<option value="'+guarantorData.data1.province_id+'" selected>'+guarantorData.data1.province_name_th+'</option>');
            $("[name='guarantor_district_marry']").append('<option value="'+guarantorData.data1.amphures_id+'" selected>'+guarantorData.data1.amphures_name_th+'</option>');
            $("[name='guarantor_sub_district_marry']").append('<option value="'+guarantorData.data1.districts_id+'" selected>'+guarantorData.data1.districts_name_th+'</option>');
            $("[name='guarantor_postal_code_marry']").append('<option value="'+guarantorData.data1.guarantor_postal_code+'" selected>'+guarantorData.data1.guarantor_postal_code+'</option>');
            $("[name='guarantor_home_phone_marry']").val(guarantorData.data.guarantor_home_phone_marry);
            $("[name='guarantor_mobile_phone_marry']").val(guarantorData.data.guarantor_mobile_phone_marry);

            $("[name='guarantor_nature_work_marry']").val(guarantorData.data.guarantor_nature_work_marry);
            $("[name='guarantor_department_work_marry']").val(guarantorData.data.guarantor_department_work_marry);
            $("[name='guarantor_position_work_marry']").val(guarantorData.data.guarantor_position_work_marry);
            $("[name='guarantor_contact_time_marry']").val(guarantorData.data.guarantor_contact_time_marry);
            $("[name='guarantor_numberyears_work_marry']").val(guarantorData.data.guarantor_numberyears_work_marry);

        }else{
          // alert(guarantorData.status);
          $("[name='guarantor_prename']").append('<option value="'+guarantorData.data2.setpre_id+'" selected>'+guarantorData.data2.setpre_name+'</option>');
          $("[name='guarantor_firstname']").val(guarantorData.data2.cus_firstname);
          $("[name='guarantor_lastname']").val(guarantorData.data2.cus_lastname);
          $("[name='guarantor_nickname']").val(guarantorData.data2.cus_nickname);

          $("[name='guarantor_birthday']").val(guarantorData.data2.cus_birthday);
          $("[name='guarantor_age']").val(guarantorData.data2.cus_age);
          $("[name='guarantor_gender']").append('<option value="'+guarantorData.data2.cus_gender+'" selected>'+guarantorData.data2.cus_gender+'</option>');
          $("[name='guarantor_statusmarry']").append('<option value="'+guarantorData.data2.setmar_id+'" selected>'+guarantorData.data2.setmar_name+'</option>');

          $("[name='guarantor_address']").val(guarantorData.data2.cus_address);
          $("[name='guarantor_house_no']").val(guarantorData.data2.cus_house_no);
          $("[name='guarantor_village']").val(guarantorData.data2.cus_village);
          $("[name='guarantor_lane']").val(guarantorData.data2.cus_lane);
          $("[name='guarantor_streee']").val(guarantorData.data2.cus_streee);

          $("[name='guarantor_province']").append('<option value="'+guarantorData.data2.province_id+'" selected>'+guarantorData.data2.province_name_th+'</option>');
          $("[name='guarantor_district']").append('<option value="'+guarantorData.data2.amphures_id+'" selected>'+guarantorData.data2.amphures_name_th+'</option>');
          $("[name='guarantor_sub_district']").append('<option value="'+guarantorData.data2.districts_id+'" selected>'+guarantorData.data2.districts_name_th+'</option>');
          $("[name='guarantor_postal_code']").append('<option value="'+guarantorData.data2.cus_postal_code+'" selected>'+guarantorData.data2.cus_postal_code+'</option>');
          $("[name='guarantor_home_phone']").val(guarantorData.data2.cus_home_phone);
          $("[name='guarantor_mobile_phone']").val(guarantorData.data2.cus_mobile_phone);
          $("[name='guarantor_numberyears_lived']").val(guarantorData.data2.cus_numberyears_lived);
          $("[name='guarantor_statusaddress']").append('<option value="'+guarantorData.data2.setadd_id+'" selected>'+guarantorData.data2.setadd_name+'</option>');
        }
        // console.log(guarantorData.data.data1);
            
      } 
    });
})

    ////////////////////////end ฟอร์มผู้ค้ำประกัน//////////////////////////


}) //end ready function 




$(".numbercontracteditdata").on("submit",function(e){
  // alert('contracteditdata');
  e.preventDefault(); 
  var formData = new FormData($(this)[0]); 
   $.ajax({
      url:  'controller/ControllerContract.php?action=numbercontracteditdata',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
   success:function(data){
    //  alert(data);
    Swal.fire({ title: 'แก้ไขข้อมูลเลขสัญญาเรียบร้อยแล้ว!',icon: 'success',confirmButtonText: 'ตกลง'}).then((result) => {
      // $('.Modaledituserstype').modal('hide');
      window.location.replace(BASEURLJS+'contract');
    })

   }     
})
   return false;
}); 
