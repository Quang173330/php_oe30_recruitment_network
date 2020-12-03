@extends('layouts.app')

@section('content')
<div class="container">
    <div class="single">
        <div class="row">
            <div class="col-sm-2 follow_left">
            </div>
            <div class="col-sm-8 follow_left">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><!-- Employer List< -->/a></li>
                    <li role="presentation"><a href="" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile"><!-- Candidate List --></a></li>
                </ul>
                <div class="follow_jobs">
                    <a href="">
                        <img src="" alt="" class="img-circle">
                        <div class="title">
                            <h5><!-- Employer Name --></h5>
                            <p><!-- Description --></p>
                        </div>
                    </a>
                    <a href="">
                        <img src="" alt="" class="img-circle">
                        <div class="title">
                            <h5><!-- Employer Name --></h5>
                            <p><!-- Description --></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection
