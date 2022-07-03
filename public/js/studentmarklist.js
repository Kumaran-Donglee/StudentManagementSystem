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
        ajax: "/students/mark/list",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {
                data: 'student_id', name: 'name',
                render: function (data, type, row, meta) {
                    if(row.students){
                        return row.students.student_name;
                    }else{
                        return data;
                    }
                },
            },
            {data: 'maths', name: 'maths'},
            {data: 'science', name: 'science'},
            {data: 'history', name: 'history'},
            {data: 'term', name: 'term',
                render: function (data, type, row, meta) {
                    if(row.term){
                        return row.term.term;
                    }else{
                        return data;
                    }
                },
            },
            {data: 'total_marks', name: 'total_marks'},
            {data: 'created_at', name: 'created_at',
                render: function (data, type, row, meta) {
                    if(data){
                        const mon = ["Jan","Feb","Mar","Apr","May","June","July","Aug","Sept","Oct","Nov","Dec"];
                        var date = new Date(data);
                        let month = mon[date.getMonth()+1];
                        let day = date.getDate();
                        let year = date.getFullYear();
                        let hours = date.getHours();
                        let minutes = date.getMinutes();
                        let AMpm = formatAMPM(date);
                        return month+" "+day+", "+year+" "+hours+":"+minutes+" "+AMpm.toUpperCase();
                    }else{
                        return data;
                    }
                },
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });


  function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
  }
    // Get the modal
var modal = document.getElementById('termModal');
var Studentmodal = document.getElementById('studentsModal');

// When the user clicks anywhere outside of the modal, close it
$("#addTerm").click(function(){
    $("#termName").val("");
    modal.style.display = "block";
});

$("#addStudent").click(function(){
    $('.alert-danger').text("");
    $('.alert-danger').hide();
    $("#student_mark_id").val("");
    $("#student_id").val("");
    $("#maths").val("");
    $("#science").val("");
    $("#history").val("");
    $("#term").val("");
    $("#total_mark").val("");
    $("#studentHeading").text("Create Student Mark");
    $("#createTeacher").text("Create Student Mark");
    Studentmodal.style.display = "block";
});

$(document).on('click','.edit',function(){
    var id = $(this).data('id');
    console.log(id);
    if(id){
        $.get('/student/mark/edit/'+id, function(data){ 
            console.log(data);
            if(data && data.data){
                $("#student_mark_id").val(data.data.id);
                $("#student_id").val(data.data.student_id);
                $("#maths").val(data.data.maths);
                $("#science").val(data.data.science);
                $("#history").val(data.data.history);
                $("#term").val(data.data.term_id);
                $("#total_mark").val(data.data.total_marks);
                $("#studentHeading").text("Update Student");
                $("#createTeacher").text("Update Student");
                Studentmodal.style.display = "block";
            }
        }).fail(function() {
            alert('woops'); // or whatever
        });
    }
});

$("#termName").keyup(function(){
    $("#term-name-error").text("");
});

$("#termCreateForm").submit(function(event){
    event.preventDefault();
    var termName = $("#termName").val();
    var token = $("input[name='_token']").val();
    $.post("/term/create", {term: termName, _token: token,}).done(function(data){
        if(data){
            if(data.success){
                $(".alert-success").show();
                $(".alert-success").text(data.notifymessage);
                setTimeout(() => {
                    $(".alert-success").hide();
                    $(".alert-success").text("");
                }, 1500);
                $("#term-name-error").text("");
                $("#termName").val("");
                modal.style.display = "none";
                window.location.reload();
            }else{
                $("#term-name-error").text(data.notifymessage);
            }
        }
    }).fail(function(xhr, textStatus, errorThrown){
        $("#term-name-error").text("");
        if(textStatus){
            $("#term-name-error").text("Term is required");
        }
    });
});

$(document).on('click','.delete',function(){
    if (confirm("Are you sure do you need to delete this student mark!") == true) {
        var id = $(this).data('id');
        if(id){
            $.get('/student/mark/delete/'+id, function(data){ 
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

$("#studentCreateForm").submit(function(event){
    event.preventDefault();
    var student_mark_id = $("#student_mark_id").val();
    var student_id = $("#student_id").val();
    var maths = $("#maths").val();
    var science = $("#science").val();
    var history = $("#history").val();
    var term_id = $("#term").val();
    var token = $("input[name='_token']").val();
    $.post("/student/mark/create", {student_id : student_id, student_mark_id: student_mark_id, maths: maths, science : science, history: history, term_id:term_id,  _token: token,}).done(function(data){
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