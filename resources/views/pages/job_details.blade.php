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
                            
                            <h2>{{$intern->Title}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Hero Area End -->
        <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-7 col-lg-8">
                        <!-- job single -->
                        <div class="single-job-items mb-50">
                            <div class="job-items">
                                <div class="company-img company-img-details">
                                    <a href="#"><img width="85" height="85" src="{{ asset('assets/img/icon/' . $intern->companylogo) }}" alt=""></a>
                                </div>
                                <div class="job-tittle">
                                    <a href="#">
                                        <h4>{{$intern->Company}}</h4>
                                    </a>
                                    <ul>
                                        <li>Position: {{$intern->Title}}</li>
                                        <li><i class="fas fa-map-marker-alt"></i>{{$intern->location}}</li>
                                        <li>Salary: {{$intern->salary}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                          <!-- job single End -->
                       
                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Job Description</h4>
                                </div>
                                <p>{{$intern->Description}}.</p>
                            </div>
                            <div class="post-details2  mb-50">
                                 <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Required Course</h4>
                                </div>
                               <ul>
                                   <li>{{$intern->requiredcourse}}</li>
                               </ul>
                            </div>
                            <div class="post-details2  mb-50">
                               
                            </div>
                        </div>

                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Internship Overview</h4>
                           </div>
                          <ul>
                              <li>Posted date : <span>{{$intern->created_at }} </span></li>
                              <li>Location : <span>{{$intern->location}}</span></li>
                              <li>Vacancy : <span>{{$intern->Vacancy}}</span></li>
                              <li>Salary :  <span>{{$intern->salary}}</span></li>
                              <li>Duration :  <span>{{$intern->Duration}}</span></li>
                              <li>Deadline date : <span>{{$intern->deadline}}</span></li>
                          </ul>

                         <div class="apply-btn2">
                            @if($intern->Vacancy>0 )  
                            <a href="\Applynow\{{$intern->id}}" class="btn">Apply Now</a>
                            @endif
                         </div>
                       </div>
                        <div class="post-details4  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Company Information</h4>
                           </div>
                              <span>Safaricom Limited</span>
                              <p>{{$intern->companyhistory}}</p>
                            <ul>
                                <li>Name: <span>{{$intern->Company}} </span></li>
                                <li>Web : <span> {{$intern->companyweb}}</span></li>
                                <li>Email: <span>{{$intern->companyemail}}</span></li>
                            </ul>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->

    </main>
@endsection  