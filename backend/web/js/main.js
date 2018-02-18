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

   $('#enroll-to-course').on('click',function () {
       var enrollForm = $('#enroll-form');
       $('.enroll-check').each(function () {
           if($(this).prop('checked'))
               $(this).appendTo(enrollForm);
       });
       enrollForm.submit();
   });



    // Course enroll end



});

function removeStudent(obj) {
    var confirmMessage = $('#confirm-message').val();
    if(confirm(confirmMessage)) {
        var course = $('#course').val();
        var studentId = obj.attr('data-id');
        $.ajax({
            type: 'POST',
            url: '/course/delete-enroll',
            data: { student: studentId,  course: course},
            success: function (data) {
                $('section.content').prepend(alertMessage(data.message, data.status));
                reloadGrids();
            }
        });
    }
    return false;
}

function alertMessage(message, type) {
    var html = '';
    if(type === 0) {
        html = '<div class="alert-danger alert fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-ban"></i>' + message + '</div>';
    } else if(type === 1) {
        html = '<div class="alert-success alert fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-check"></i>' + message + '</div>';
    }
    return html;
}

function reloadGrids() {
    $.pjax({container: '#notenrolled',timeout: false}).done(function() {$.pjax({container: '#enrolled'});});
}