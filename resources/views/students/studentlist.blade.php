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
    <script src="{{ asset('js/studentlist.js') }}" defer></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
@endsection
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
    <div class="alert alert-success">
    </div>
    <div class="w3-row-padding w3-padding-16 w3-center" id="food">
        <div class="w3-quarter">
            <button class="w3-button w3-white w3-border w3-border-blue" id="addStudent">Add Student</button>
            <button class="w3-button w3-white w3-border w3-border-green" id="addTeacher">Add Teacher</button>
        </div>
    </div>
    <div class="w3-row-padding w3-padding-16 w3-center" id="food">
        <div class="container">
            <h1>Student List</h1>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Reporting Teacher</th>
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

            <h4 id="studentHeading">Create Student</h4>

            <form class="w3-container" action="{{ route('student.create') }}" id="studentCreateForm">
                @csrf
                <div class="w3-section">
                    <div class="alert alert-danger">
                    </div>
                    <input type="hidden" name="student_id" id="student_id" value=""> 
                    <label><b>Student Name</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Student Name" id="student_name" name="student_name" autocomplete="off">
                    <span id="student_name-name-error" style="color:red"></span>
                    <label><b>Student Age</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="Enter Student Age" id="age" name="age" autocomplete="off">
                    <span id="age-error" style="color:red"></span>
                    @isset($genders)
                        @foreach($genders as $gender)
                            <input class="w3-radio w3-border w3-margin-bottom" type="radio" name="gender_id" value="{{ $gender->id }}" @if($gender->gender == 'Male') checked @endif>
                            <label>{{ $gender->gender }}</label>
                        @endforeach
                    @endisset
                    <br>
                    <label><b>Reporting Teacher</b></label>
                    <select class="w3-select w3-border w3-margin-bottom" id="teacher_id" name="teacher_id">
                        <option value="">Select Reporting Teacher</option>
                        @isset($teachers)
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                    <!-- <label><b>Password</b></label> -->
                    <!-- <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="psw" required> -->
                    <button class="w3-button w3-block w3-green w3-section w3-padding" id="createTeacher" type="submit">Create Student</button>
                </div>
            </form>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <button onclick="document.getElementById('studentsModal').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
            </div>

        </div>
    </div>

    <div id="teachersModal" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
            <div class="w3-center"><br>
                <span onclick="document.getElementById('teachersModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            </div>

            <form class="w3-container" action="{{ route('teacher.create') }}" id="teacherCreateForm">
                @csrf
                <div class="w3-section">
                    <label><b>Teacher Name</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Teacher Name" id="teacherName" name="name" autocomplete="off" required>
                    <span id="teacher-name-error" style="color:red"></span>
                    <button class="w3-button w3-block w3-green w3-section w3-padding" id="createTeacher" type="submit">Create Teacher</button>
                </div>
            </form>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <button onclick="document.getElementById('teachersModal').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
            </div>

        </div>
    </div>
</div>
@endsection