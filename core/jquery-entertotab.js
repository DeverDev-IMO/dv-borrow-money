// $(function(){
//   $("input,select,textarea").keyup(function(e){ ////เวลากด enter ให้ tab
//       if(e.keyCode==13){
//         var tabindex = $(this).attr('tabindex');
//         tabindex = parseInt(tabindex)+1; // increment tabindex
//         $('[tabindex=]' + tabindex +']').focus(); ///// set focus ที่ tabindex+1
//         $('[tabindex=]' + tabindex +']').select(); ///// เลือก obj /////
//       }
//   });
//   $('[tabindex=]' + 1 + ']').focus();

// });

// $(document).ready(function() {
//   $('input:text:first').focus();
//   $('input:text').bind("keydown", function(e) {
//   if (e.which == 13) {   //Enter key
//   e.preventDefault(); //ไม่สนใจ default behaviour ของ enter key
//   var nextIndex = $('input:text').index(this) + 1;
//   $('input:text')[nextIndex].focus();
//   $('input:number')[nextIndex].focus();
//   }
//   });$('#btnReset').click(
//   function() {
//   $('form')[0].reset();
//   });
// });