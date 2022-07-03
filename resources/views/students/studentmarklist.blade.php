@extends('welcome')
@section('content')
@section('scriptincludes')
<!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">	
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('js/studentmarklist.js') }}" defer></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
@endsection
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
    <div class="alert alert-success">
    </div>
    <div class="w3-row-padding w3-padding-16 w3-center" id="food">
        <div class="w3-quarter">
            <button class="w3-button w3-white w3-border w3-border-blue" id="addStudent">Add Student Marks</button>
            <button class="w3-button w3-white w3-border w3-border-green" id="addTerm">Add Term</button>
        </div>
    </div>
    <div class="w3-row-padding w3-padding-16 w3-center" id="food">
        <div class="container">
            <h1>Student Mark List</h1>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Maths</th>
                        <th>Science</th>
                        <th>History</th>
                        <th>Term</th>
                        <th>Total Marks</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div id="studentsModal" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
            <div class="w3-center"><br>
                <span onclick="document.getElementById('studentsModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            </div>

            <h4 id="studentHeading">Create Student Mark</h4>

            <form class="w3-container" action="{{ route('student.create') }}" id="studentCreateForm">
                @csrf
                <div class="w3-section">
                    <div class="alert alert-danger">
                    </div>
                    <input type="hidden" name="student_mark_id" id="student_mark_id" value="">
                    <input type="hidden" name="total_mark" id="total_mark" value=""> 
                    <label><b>Student Name</b></label>
                    <select class="w3-select w3-border w3-margin-bottom" id="student_id" name="student_id">
                        <option value="">Select Student Name</option>
                        @isset($students)
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->student_name }}</option>
                            @endforeach
                        @endisset
                    </select>
                    <label><b>Maths</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="Enter maths" id="maths" name="maths">
                    <label><b>Science</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="Enter science" id="science" name="science">
                    <label><b>History</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="Enter history" id="history" name="history">
                    <label><b>Student Term</b></label>
                    <select class="w3-select w3-border w3-margin-bottom" id="term" name="term_id">
                        <option value="">Select Term</option>
                        @isset($terms)
                            @foreach($terms as $term)
                                <option value="{{ $term->id }}">{{ $term->term }}</option>
                            @endforeach
                        @endisset
                    </select>
                    <button class="w3-button w3-block w3-green w3-section w3-padding" id="createTeacher" type="submit">Create Student Mark</button>
                </div>
            </form>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <button onclick="document.getElementById('studentsModal').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
            </div>

        </div>
    </div>

    <div id="termModal" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
            <div class="w3-center"><br>
                <span onclick="document.getElementById('termModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            </div>

            <form class="w3-container" action="{{ route('term.create') }}" id="termCreateForm">
                @csrf
                <div class="w3-section">
                    <label><b>Term Name</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Term Name" id="termName" name="term" required>
                    <span id="term-name-error" style="color:red"></span>
                    <button class="w3-button w3-block w3-green w3-section w3-padding" id="createTeacher" type="submit">Create Term</button>
                </div>
            </form>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <button onclick="document.getElementById('termModal').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
            </div>

        </div>
    </div>
</div>
@endsection