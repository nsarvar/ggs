$(document).ready(function () {

    // Course enroll begin

   $('#enroll-all').on('change',function () {
      if($(this).prop('checked'))
          $('.enroll-check').prop('checked',true);
      else
          $('.enroll-check').prop('checked',false);

      $('#count-enroll').html(enrollCount());
      return false;
   });

   $('.enroll-check').on('change',function () {
       $('#count-enroll').html(enrollCount());
   });

   function enrollCount() {
       var count = 0;
       $('.enroll-check').each(function () {
           if($(this).prop('checked'))
               count++;
       });
       return count;
   }

    // Course enroll end

});