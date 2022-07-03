<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    StudentsController,
    TeachersController,
    StudentMarksController,
    TermController
};
use App\Models\{
    Gender,
    Teachers
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data = [];
    $data['genders'] = Gender::select('id','gender')->get();
    $data['teachers'] = Teachers::select('id','name')->get();
    return view('students.studentlist',$data);
});

// Student Route start
Route::get('/students',[StudentsController::class, 'index'])->name('students');
Route::get('/students/list',[StudentsController::class, 'list'])->name('students.list');
Route::post('/student/create',[StudentsController::class, 'store'])->name('student.create');
Route::get('/student/edit/{id}',[StudentsController::class, 'edit'])->name('student.edit');
Route::get('/student/delete/{id}',[StudentsController::class, 'destroy'])->name('student.delete');
// Student Route End

// Student Marks Route start
Route::get('/students/mark',[StudentMarksController::class, 'index'])->name('students.marklist');
Route::get('/students/mark/list',[StudentMarksController::class, 'list'])->name('students.mark.list');
Route::post('/student/mark/create',[StudentMarksController::class, 'store'])->name('student.mark.create');
Route::get('/student/mark/edit/{id}',[StudentMarksController::class, 'edit'])->name('student.mark.edit');
Route::get('/student/mark/delete/{id}',[StudentMarksController::class, 'destroy'])->name('student.mark.delete');
// Student Marks Route End

// Teacher Route Start
Route::post('/teacher/create',[TeachersController::class, 'create'])->name('teacher.create');
// Teacher Route End

// Term Route Start
Route::post('/term/create',[TermController::class, 'create'])->name('term.create');
// Term Route End

