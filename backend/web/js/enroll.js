confirmMessage = $('#confirm-message').val();
confirmMessage2 = $('#confirm-message-2').val();
course = $('#course').val();

$(document).ready(function () {



    $('#enroll-to-course').on('click',function () {
        var count = 0;
        var postData = {'enroll' : []};
        $('.enroll-check').each(function () {
            if($(this).prop('checked')) {
                postData['enroll'].push($(this).val());
                count++;
            }
        });
        if(count > 0) {
            postData['course'] = course;
            $.ajax({
                type: 'POST',
                url: '/course/add-enrolls',
                data: postData,
                success: function (data) {
                    deleteAlerts();
                    if(data.status === 2) {
                        $('section.content').prepend(alertMessage(data.message2,0));
                        $('section.content').prepend(alertMessage(data.message,1));
                    } else {
                        $('section.content').prepend(alertMessage(data.message,data.status));
                    }
                    reloadGrids();
                }
            });
        }
    });

    $('#delete-from-course').on('click',function () {
        if(confirm(confirmMessage2)) {
            var count = 0;
            var postData = {'enroll' : []};
            $('.enroll-check-2').each(function () {
                if($(this).prop('checked')) {
                    postData['enroll'].push($(this).val());
                    count++;
                }
            });
            if(count > 0) {
                postData['course'] = course;
                $.ajax({
                    type: 'POST',
                    url: '/course/delete-enrolls',
                    data: postData,
                    success: function (data) {
                        deleteAlerts();
                        if(data.status === 2) {
                            $('section.content').prepend(alertMessage(data.message2,0));
                            $('section.content').prepend(alertMessage(data.message,1));
                        } else {
                            $('section.content').prepend(alertMessage(data.message,data.status));
                        }
                        reloadGrids();
                    } });
            }
        }
    });

});
function removeStudent(obj) {

    if(confirm(confirmMessage)) {
        var studentId = obj.attr('data-id');
        $.ajax({
            type: 'POST',
            url: '/course/delete-enroll',
            data: { student: studentId,  course: course},
            success: function (data) {
                deleteAlerts();
                $('section.content').prepend(alertMessage(data.message, data.status));
                reloadGrids();
            }
        });
    }
    return false;
}


function addStudent(obj) {
    var course = $('#course').val();
    var studentId = obj.attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/course/add-enroll',
        data: { student: studentId,  course: course},
        success: function (data) {
            deleteAlerts();
            $('section.content').prepend(alertMessage(data.message, data.status));
            reloadGrids();
        }
    });
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

function deleteAlerts() {
    $('section.content .alert').remove();
}
