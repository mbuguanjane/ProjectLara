<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;
use App\Models\Applications;
use App\Models\Student;
use Image;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\FirstEmail;


class InternshipController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show','internshipsReturn','IntershipSearch']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       return Internship::latest()->paginate(5);
    }
    public function search()
    {
        if($search=\Request::get('q'))
        {
            $internship=Internship::where(function($query) use ($search){
                $query->Where('requiredcourse','LIKE',"%$search%")->orWhere('companyname','LIKE',"%$search%");
            })->paginate(10);
        }else{
            $internship=Internship::latest()->paginate(10);
        }
        return $internship;
    }
    public function Dashboard()
    {
        $this->middleware('auth:api');
        if(auth()->user()->usertype==='admin')
        {
            return view('Admin.Dashboard');
        }else{

            if(auth()->user()->HasSubmitted==='NotConfirm')
            {
            return redirect('Studentdetails');
            }else{
                return redirect('StudentDash');
            }
        }
    }
    public function internshipsReturn()
    {
       $internship=Internship::all();
       return view('pages.job_listing')->with('internship',$internship);
    }

    public function Applynow($id)
    {
        
            $internship=Internship::find($id);
            if($internship->Vacancy>0)
            {
            $application=new Applications;
            $application->studentid=auth()->user()->id;
            $application->internshipid=$id;
            $application->userid=auth()->user()->id;
            $application->InternShipTitle=$internship->companyname;
            try {
            $application->save();
            }
            catch(\Exception $e){
                return view('pages.Notfound')->with('message','You have already applied for this Internship');
            }
            
           
            //update vacancy
            $internship->Vacancy-=1;
            $internship->save(); 
            Mail::to('mbuguanjane@gmail.com')->send(new FirstEmail);

            return view('pages.Thankyou');
            }else{
                return view('pages.job_details');
            }
        
       
        
            
          

    }   

    public function IntershipSearch(Request $request)
    {
        if(($keyword=\Request::get('searchitem')) && ($location=\Request::get('location')))
        {
            
            $internship=Internship::where(function($query) use ($keyword,$location){
                $query->Where('Title','LIKE',"%$keyword%")->Where('location','LIKE',"%$location%");
            })->paginate(3);

            return view('pages.job_listing')->with('internship',$internship);
        }else{
               $internship=Internship::all();
              return view('pages.job_listing');//->with('internship',$internship);
        }
       
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
               'Title'=>'required|string',
               'location'=>'required|string',
               'Description'=>'required|string',
               'Duration'=>'required|string',
               'Requirements'=>'required|string',
               'Vacancy'=>'required|string',
               'requiredcourse'=>'required|string',
               'deadline'=>'required|string',
               'salary'=>'required|string',
               'companyname'=>'required|string',
               'companyemail'=>'required|email|string',
               'companyweb'=>'required|string',
               'companyhistory'=>'required|string',
               'companylogo'=>'required|string',

           ]);
            
        $course=$request->input('requiredcourse');
        $student=DB::select("SELECT `email` FROM users INNER JOIN students ON users.id = students.userid where students.Course LIKE '%$course%'");
          if(Sizeof($student)>0)
          {
            foreach ($student as $stud) {
               
                     //send email
                        $to_email = $stud->email;
                        Mail::to($to_email)->send(new FirstEmail);
              
              }
            echo  Sizeof($student);
          }else
            {
                echo "Sorry Man";
            }

        if($request->companylogo ){
            $name = time().'.' . explode('/', explode(':', substr($request->companylogo, 0, strpos($request->companylogo, ';')))[1])[1];

            Image::make($request->companylogo)->save(public_path('assets/img/icon/').$name);
        }
           $internship=new Internship;
           $internship->Title=$request->input('Title');
           $internship->location=$request->input('location');
           $internship->Description=$request->input('Description');
           $internship->Duration=$request->input('Duration');
           $internship->Requirements=$request->input('Requirements');
           $internship->Vacancy=$request->input('Vacancy');
           $internship->requiredcourse=$request->input('requiredcourse');
           $internship->Category=$request->input('requiredcourse');
           $internship->deadline=$request->input('deadline');
           $internship->salary=$request->input('salary');
           $internship->Company=$request->input('companyname');
           $internship->companyname=$request->input('companyname');
           $internship->companyemail=$request->input('companyemail');
           $internship->companyweb=$request->input('companyweb');
           $internship->companyhistory=$request->input('companyhistory');
           $internship->companylogo=$name;
           return $internship->save();

           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $intern=Internship::findOrFail($id);
        return view('pages.job_details')->with('intern',$intern);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $internship=Internship::findOrFail($id);
        $this->validate($request,[
            'Title'=>'required|string',
            'location'=>'required|string',
            'Description'=>'required|string',
            'Duration'=>'required|string',
            'Requirements'=>'required|string',
            'Vacancy'=>'required|string',
            'requiredcourse'=>'required|string',
            'deadline'=>'required|string',
            'salary'=>'required|string',
            'companyname'=>'required|string',
            'companyemail'=>'required|email|string',
            'companyweb'=>'required|string',
            'companyhistory'=>'required|string',
            'companylogo'=>'required|string',

        ]);
        $internship->Title=$request->input('Title');
        $internship->location=$request->input('location');
        $internship->Description=$request->input('Description');
        $internship->Duration=$request->input('Duration');
        $internship->Requirements=$request->input('Requirements');
        $internship->Vacancy=$request->input('Vacancy');
        $internship->requiredcourse=$request->input('requiredcourse');
        $internship->deadline=$request->input('deadline');
        $internship->salary=$request->input('salary');
        $internship->Company=$request->input('companyname');
        $internship->companyname=$request->input('companyname');
        $internship->companyemail=$request->input('companyemail');
        $internship->companyweb=$request->input('companyweb');
        $internship->companyhistory=$request->input('companyhistory');
        $internship->companylogo=$request->input('companylogo');
        return $internship->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $intern=Internship::findOrFail($id);
        $intern->delete();
    }
}
