$(document).ready(function () {

   $('#enroll-all').on('change',function () {
      if($(this).prop('checked'))
          $('.enroll-check').prop('checked',true);
      else
          $('.enroll-check').prop('checked',false);

      return false;
   });

});