$(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('students.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'student_name', name: 'student_name'},
            {data: 'age', name: 'age'},
            {data: 'gender', name: 'gender'},
            {data: 'teacher', name: 'teacher'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});