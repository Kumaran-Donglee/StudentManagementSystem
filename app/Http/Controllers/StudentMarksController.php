<?php

namespace App\Http\Controllers;

use App\Models\{
    StudentMarks,
    Students,
    Term
};
use Illuminate\Http\Request;
use App\Http\Requests\StudentMarkRequest;
use DataTables;

class StudentMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['students'] = Students::select('id','student_name')->get();
        $data['terms'] = Term::select('id','term')->get();
        return view('students.studentmarklist',$data);
    }

    /**
     * List a student List.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = StudentMarks::with('students','term')->latest()->get();
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentMarkRequest $request)
    {
        $student = StudentMarks::updateOrCreate([
                "id" => $request->student_mark_id
            ],
            [
                "student_id" => $request->student_id,
                "term_id" => $request->term_id,
                "maths" => $request->maths,
                "science" => $request->science,
                "history" => $request->history,
                "total_marks" => (int) $request->maths + (int) $request->science + (int) $request->history
            ]
        );

        if($student){
            $message = $request->student_mark_id ? 'Student Mark Updated Successfully' : 'Student Mark Created Successfully';
            return response()->json([ 
                'success' => true,
                'notifytype' => 'info',
                'notifytitle' => 'Success!',
                'notifymessage' => $message,
            ]);
        }else{
            $message = $request->student_id ? 'Failed to update student mark!' : 'Failed to create student mark!';
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
     * @param  \App\Models\StudentMarks  $studentMarks
     * @return \Illuminate\Http\Response
     */
    public function show(StudentMarks $studentMarks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentMarks  $studentMarks
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentMarks $studentMarks, $id)
    {
        if($id){
            $student = StudentMarks::with('students','term')->find($id);
            if(!$student){
                return response()->json([ 
                    'success' => false,
                    'notifytype' => 'error',
                    'notifytitle' => 'Failed!',
                    'notifymessage' => 'Failed to retrive student mark!'
                ]);
            }
            return response()->json(['data' => $student]);
        }else{
            return response()->json([ 
                'success' => false,
                'notifytype' => 'error',
                'notifytitle' => 'Failed!',
                'notifymessage' => 'Failed to retrive student mark!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentMarks  $studentMarks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentMarks $studentMarks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentMarks  $studentMarks
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentMarks $studentMarks, $id)
    {
        if($id){
            $students = StudentMarks::find($id);
            $students->delete();
            if($students){
                return response()->json([ 
                    'success' => true,
                    'notifytype' => 'info',
                    'notifytitle' => 'Success!',
                    'notifymessage' => 'Student Mark Deleted Successfully',
                ]);
            }else{
                return response()->json([ 
                    'success' => false,
                    'notifytype' => 'error',
                    'notifytitle' => 'Failed!',
                    'notifymessage' => 'Failed to delete student mark!'
                ]);
            }
        }
    }
}
