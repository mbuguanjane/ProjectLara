@extends('layouts.frontend')
@section('content')
    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('assets/img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center" >
                            
                            <h2>Application Finished</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Hero Area End -->
        <div style="margin:200px 200px; color:purple;">
        <h1 >Application submitted Successfully!!</h1>
        <h4>you shall receive an email upon selection</h4>
        </div>
    </main>
@endsection  