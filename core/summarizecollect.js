$("#exporttablexls_summarizecollect").on('input', '.inputtargetcollect', function() {
  var calculated_total_sum = 0;

   // code logic here
   var dataid = $(this).attr('data-id'); //แสดง id สายงาน
  //  var datasummarizesales = $(this).attr('datasummarizesales'); //แสดง ยอดขายปัจจุบัน
   var showvaluetokey = $(this).val(); //ค่าจำนวนเป้าหมายที่คีย์ในสายงานนั้น
   var thisshowvaluetoclass = '.showvaluetargetcollect'+dataid; //ชื่อ class ฟิลเป้าหมาย สายงานที่คีย์

   $(thisshowvaluetoclass).html(addCommas(showvaluetokey)); //เเสดงจำนวนเป้าหมายที่คีย์ในสายงานนั้น

   $("#exporttablexls_summarizecollect .inputtargetcollect").each(function () {
     var get_textbox_value = $(this).val();
     if ($.isNumeric(get_textbox_value)) {
        calculated_total_sum += parseFloat(get_textbox_value);
        }     
       //  console.log(calculated_total_sum); 
                
   });

   $("#targettotelcollect").html(addCommas(calculated_total_sum));  

});