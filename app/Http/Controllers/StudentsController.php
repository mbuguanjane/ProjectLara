<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use DB;

class StudentsController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'userid'=>'required',
            'StudentName'=>'required',
            'RegNo'=>'required',
            'YearofIntern'=>'required',
            'Course'=>'required',
            'DateofAdmmission'=>'required',
            'AdmissionLetter'=>'required'
        ]);

        //upload image
        if($request->hasFile('AdmissionLetter'))
        {
                $fileNameWithExt=$request->file('AdmissionLetter')->getClientOriginalname();
                $filename=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                $extension=$request->file('AdmissionLetter')->getClientOriginalExtension();
                $fileNameToStore=$filename.'_'.time().'.'.$extension;
                $path=$request->file('AdmissionLetter')->storeAs('public/admissionLetter',$fileNameToStore);
        }else
        {
            $fileNameToStore="noimage.jpg";
        }

        //upload image
          $student=new Student;
          $student->SchoolRegNo=$request->RegNo;
          $student->DateofAdmission=$request->DateofAdmmission;
          $student->Course=$request->Course;
          $student->Internshipyear=$request->YearofIntern;
          $student->userid=$request->userid;
          $student->AdmissionLetter=$fileNameToStore;
          $student->save();
          //update user
           $user=User::find($request->userid);
           $user->HasSubmitted="Confirm";
           $user->save();
 
         return redirect('StudentDash');//->with('success','Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "Am student edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "am student destroy";
    }
}
