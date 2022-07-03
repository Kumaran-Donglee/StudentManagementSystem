$(function () {
    $(".alert-success").text("");
    $(".alert-success").hide();
    $('.alert-danger').text("");
    $('.alert-danger').hide();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/students/list",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'student_name', name: 'name'},
            {data: 'age', name: 'age'},
            {data: 'gender.gender', name: 'gender', 
                render: function (data, type, row, meta) {
                    return data === 'Male'
                        ? 'M'
                        : "F";
                },
            },
            {data: 'teacher.name', name: 'teacher'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });

  // Get the modal
var modal = document.getElementById('teachersModal');
var Studentmodal = document.getElementById('studentsModal');

// When the user clicks anywhere outside of the modal, close it
$("#addTeacher").click(function(){
    $("#teacherName").val("");
    modal.style.display = "block";
});

$("#addStudent").click(function(){
    $('.alert-danger').text("");
    $('.alert-danger').hide();
    $("#student_id").val("");
    $("#student_name").val("");
    $("#age").val("");
    $("input[name=gender_id][value=1]").attr('checked', true);
    $("#teacher_id").val("");
    $("#studentHeading").text("Create Student");
    $("#createTeacher").text("Create Student");
    Studentmodal.style.display = "block";
});

$(document).on('click','.edit',function(){
    var id = $(this).data('id');
    console.log(id);
    if(id){
        $.get('/student/edit/'+id, function(data){ 
            console.log(data);
            if(data && data.data){
                $("#student_id").val(data.data.id);
                $("#student_name").val(data.data.student_name);
                $("#age").val(data.data.age);
                $("input[name=gender_id][value="+data.data.gender_id+"]").attr('checked', true);
                $("#teacher_id").val(data.data.teacher_id);
                $("#studentHeading").text("Update Student");
                $("#createTeacher").text("Update Student");
                Studentmodal.style.display = "block";
            }
        }).fail(function() {
            alert('woops'); // or whatever
        });
    }
});

$(document).on('click','.delete',function(){
    if (confirm("Are you sure do you need to delete this student!") == true) {
        var id = $(this).data('id');
        if(id){
            $.get('/student/delete/'+id, function(data){ 
                if(data && data.success){
                    $(".alert-success").show();
                    $(".alert-success").text(data.notifymessage);
                    $('.data-table').DataTable().ajax.reload();
                    setTimeout(() => {
                        $(".alert-success").hide();
                        $(".alert-success").text("");
                    }, 1500);
                } 
            }).fail(function() {
                alert('woops'); // or whatever
            });
        }   
    } else {
        console.log("Safe");
    }
});

    $("#teacherName").keyup(function(){
        $("#teacher-name-error").text("");
    });

$("#studentCreateForm").submit(function(event){
    event.preventDefault();
    var student_id = $("#student_id").val();
    var studentName = $("#student_name").val();
    var age = $("#age").val();
    var gender_id = document.querySelector('input[name="gender_id"]:checked').value;;
    var teacher_id = $("#teacher_id").val();
    var token = $("input[name='_token']").val();
    $.post("student/create", {student_id : student_id, student_name: studentName, age: age, gender_id : gender_id, teacher_id: teacher_id,  _token: token,}).done(function(data){
        if(data){
            if(data.success){
                $(".alert-success").show();
                $(".alert-success").text(data.notifymessage);
                $('.data-table').DataTable().ajax.reload();
                setTimeout(() => {
                    $(".alert-success").hide();
                    $(".alert-success").text("");
                }, 1500);
                $("#teacher-name-error").text("");
                $("#teacherName").val("");
                Studentmodal.style.display = "none";
            }else{
                $("#teacher-name-error").text(data.notifymessage);
            }
        }
    }).fail(function(xhr, textStatus, errorThrown){
        $('.alert-danger').text("");
        $('.alert-danger').hide();
        if(textStatus){
            $('.alert-danger').show();
            $('.alert-danger').text(xhr.responseJSON.message);
            setTimeout(() => {
                $('.alert-danger').text("");
                $('.alert-danger').hide();
            }, 1500);
        }
    });
});

$("#teacherCreateForm").submit(function(event){
    event.preventDefault();
    var teacherName = $("#teacherName").val();
    var token = $("input[name='_token']").val();
    $.post("teacher/create", {name: teacherName, _token: token,}).done(function(data){
        if(data){
            if(data.success){
                $(".alert-success").show();
                $(".alert-success").text(data.notifymessage);
                setTimeout(() => {
                    $(".alert-success").hide();
                    $(".alert-success").text("");
                }, 1500);
                $("#teacher-name-error").text("");
                $("#teacherName").val("");
                modal.style.display = "none";
                window.location.reload();
            }else{
                $("#teacher-name-error").text(data.notifymessage);
            }
        }
    }).fail(function(xhr, textStatus, errorThrown){
        $("#teacher-name-error").text("");
        if(textStatus){
            $("#teacher-name-error").text("Teacher name is required");
        }
    });
});

//   $(document).on("click","#addStudent", function(){
//         $("#id01").modal("show");
//   });

//   $("#addStudent").click(function(){
//     $("#id01").modal("show");
//   });