<?php

namespace App\Http\Controllers;

use App\Models\{
    Students,
    Gender,
    Teachers
};
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use DataTables;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['genders'] = Gender::select('id','gender')->get();
        $data['teachers'] = Teachers::select('id','name')->get();
        return view('students.studentlist',$data);
    }

    /**
     * List a student List.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Students::with('gender','teacher')->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="'.$row->id.'">Edit</a> | <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $student = Students::updateOrCreate([
                "id" => $request->student_id
            ],
            [
                "student_name" => $request->student_name,
                "age" => $request->age,
                "gender_id" => $request->gender_id,
                "teacher_id" => $request->teacher_id,
            ]
        );

        if($student){
            $message = $request->student_id ? 'Student Updated Successfully' : 'Student Created Successfully';
            return response()->json([ 
                'success' => true,
                'notifytype' => 'info',
                'notifytitle' => 'Success!',
                'notifymessage' => $message,
            ]);
        }else{
            $message = $request->student_id ? 'Failed to update student!' : 'Failed to create student!';
            return response()->json([ 
                'success' => false,
                'notifytype' => 'error',
                'notifytitle' => 'Failed!',
                'notifymessage' => $message
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $students, $id)
    {
        if($id){
            $student = Students::with('gender','teacher')->find($id);
            if(!$student){
                return response()->json([ 
                    'success' => false,
                    'notifytype' => 'error',
                    'notifytitle' => 'Failed!',
                    'notifymessage' => 'Failed to retrive student!'
                ]);
            }
            return response()->json(['data' => $student]);
        }else{
            return response()->json([ 
                'success' => false,
                'notifytype' => 'error',
                'notifytitle' => 'Failed!',
                'notifymessage' => 'Failed to retrive student!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $students, $id)
    {
        if($id){
            $students = Students::find($id);
            $students->marks()->delete();
            $students->delete();
            if($students){
                return response()->json([ 
                    'success' => true,
                    'notifytype' => 'info',
                    'notifytitle' => 'Success!',
                    'notifymessage' => 'Student Deleted Successfully',
                ]);
            }else{
                return response()->json([ 
                    'success' => false,
                    'notifytype' => 'error',
                    'notifytitle' => 'Failed!',
                    'notifymessage' => 'Failed to delete student!'
                ]);
            }
        }
    }
}
