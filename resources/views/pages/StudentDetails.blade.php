@extends('layouts.frontend')
@section('content')
    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('assets/img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            
                            <h2>Register Student</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Hero Area End -->
        <div class="container">
             <div class="row">
                 <div class="py-4 container col-md-8">
                      @include('inc.message')
                    <h1>Student Details</h1>
                    {!! Form::open(['action' => 'App\Http\Controllers\StudentsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                        <div class="form-group">
                            {{Form::hidden('userid',Auth::user()->id,['class'=>'form-control','placeholder'=>'userid'])}}
                        </div>
                        <div class="form-group">
                          {{Form::label('StudentName','Student Name')}}
                          {{Form::text('StudentName',Auth::user()->name,['class'=>'form-control','placeholder'=>'Student Name'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('DateofAdmmission','Date of Admission')}}
                            {{Form::date('DateofAdmmission','',['class'=>'form-control','placeholder'=>'Date of Admission'])}}
                          </div>
                        <div class="form-group">
                            {{Form::label('RegNo','Registration Number')}}
                            {{Form::text('RegNo','',['class'=>'form-control','placeholder'=>'Registration Number'])}}
                          </div>
                          <div class="form-group">
                            {{Form::label('YearofIntern','Year of Internship')}}
                            {{Form::select('YearofIntern', ['2014' => '2014', '2015' => '2015','2016' => '2016','2017' => '2017','2018' => '2018'], null, ['placeholder' => 'Select Year...','class'=>'form-control'])}}
                            
                          </div>
                          <div class="form-group">
                            {{Form::label('Course','Course')}}
                            {{Form::text('Course','',['class'=>'form-control','placeholder'=>'Course'])}}
                          </div>             
                        <div class="form-group">
                            {{Form::label('AdmissionLetter','Admission Letter')}}  
                            {{Form::file('AdmissionLetter')}}
                        </div>
                        {{Form::submit('submit', ['class'=>'btn btn-primary'])}}
                     {!! Form::close() !!}
                 </div>
             </div>
        </div>
        

    </main>
@endsection  