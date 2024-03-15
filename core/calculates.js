function sumAll(a1, a2) {
  return a1 + a2;
}


  $("#tbl_exporttable_to_xls").on('input', '.inputtarget', function() {
    var calculated_total_sum = 0;
    var calculated_total_sumavg = 0;

    // code logic here
    var dataid = $(this).attr('data-id'); //แสดง id สายงาน
    var datasummarizesales = $(this).attr('datasummarizesales'); //แสดง ยอดขายปัจจุบัน
    var showvaluetokey = $(this).val(); //ค่าจำนวนเป้าหมายที่คีย์ในสายงานนั้น
    var thisshowvaluetoclass = '.showvaluetarget'+dataid; //ชื่อ class ฟิลเป้าหมาย สายงานที่คีย์
    var valueaverageshowtoclass = '.valueaveragetoclass'+dataid; //ชื่อ class ฟิลเป้าหมาย สายงานที่คีย์
    // console.log(thisshowvaluetoclass);
    var sumvalueaverage = (showvaluetokey) - datasummarizesales; //เป้าหมาย - ยอดขายปัจจุบัน = เป้าหมายเฉลี่ยต่อวัน
    $(thisshowvaluetoclass).html(addCommas(showvaluetokey)); //เเสดงจำนวนเป้าหมายที่คีย์ในสายงานนั้น
    $(valueaverageshowtoclass).html(addCommas(sumvalueaverage)); //เเสดงเป้าหมายเฉลี่ยต่อวันในสายงานนั้น
    $(valueaverageshowtoclass).val(sumvalueaverage); //เเสดงเป้าหมายเฉลี่ยต่อวันในสายงานนั้น

    $("#tbl_exporttable_to_xls .inputtarget").each(function () {
      var get_textbox_value = $(this).val();
      if ($.isNumeric(get_textbox_value)) {
         calculated_total_sum += parseFloat(get_textbox_value);
         }     
        //  console.log(calculated_total_sum); 
                 
    });
    // $("#targettotel").html(addCommas(calculated_total_sum));
    $("#targettotel").html(addCommas(calculated_total_sum));
    $("#targettotelnonCommas").val(calculated_total_sum);

    // $(".inputtargetavg").each(function () {
    // var get_textbox_valueavg = $(this).val();
    // if ($.isNumeric(get_textbox_valueavg)) {
    //   calculated_total_sumavg += parseFloat(get_textbox_valueavg);
    //     }   
    //     console.log(get_textbox_valueavg);               
    // }); 
    var toteltargetSales = parseFloat($('#targettotelnonCommas').val());
    var totelcurrentSales = parseFloat($('#totelcurrentSales').val());
    
    $("#targetavgtotel").text(addCommas((toteltargetSales-totelcurrentSales)));    

});


