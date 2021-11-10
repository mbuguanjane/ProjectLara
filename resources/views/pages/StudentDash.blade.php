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
                 <div class="py-4 container col-md-10" >
                      @include('inc.message')
                    <h1>Student Details</h1>
                      <a class="btn btn-primary" href="/job_listing">Apply Internship</a>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Comapny Name</th>
                            <th>Applied On</th>
                            <th>Modify</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if(count($student)>0)
                              @foreach($student as $studen)
                              <tr>
                                <th scope="row">{{$studen->id}}</th>
                                <td>{{$studen->InternShipTitle}}</td>
                                <td>{{$studen->created_at}}</td>
                                <td>
                                    {!! Form::open(['action'=>['App\Http\Controllers\ApplicationController@destroy',$studen->id],'method'=>'POST','class'=>'pull-right']) !!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!! Form::close() !!}
                                </td>
                              </tr>  
                              @endforeach
                            @endif
                                                  
                        </tbody>
                      </table>
                 </div>
             </div>
        </div>
        

    </main>
@endsection  