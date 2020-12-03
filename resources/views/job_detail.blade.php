@extends('layouts.app')

@section('content')
<div class="container">
    <div class="single">
        <div class="row">
            <div class="col-md-1 single_right"></div>
            <div class="col-md-7 single_right">
                <div class="tab_grid">
                    <div class="jobs-item with-thumb">
                        <div class="thumb"><a href=""><img src="" class="img-responsive"
                            alt="" /></a></div>
                            <div class="jobs_right">

                                <div class="date">30 <span>Jul</span></div>
                                <div class="date_desc">
                                    <h6 class="title"><a href=""><!-- Front-end Developer --></a></h6>
                                    <span class="meta"><!-- Ha Noi, Viet Nam --></span>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 single_right">
                            <p><b>@lang('job.company')</b></p>
                            <br>
                            <p><b>@lang('job.tag')</b></p>
                        </div>
                        <div class="col-md-6 single_right">
                            <p><b>@lang('job.exp')</b></p>
                            <br>
                            <p><b>@lang('job.salary')</b></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 single_right">
                            <p><b>@lang('job.detail')</b></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 single_right">
                            <p><b>@lang('job.company')</b></p>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="col-md-3">
                    <b>@lang('job.salary')</b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 single_right"></div>
                <div class="col-md-9 single_right">
                    <hr>
                    <h5>@lang('job.similar')</h5>
                    <div class="tab_grid">
                        <div class="jobs-item with-thumb">
                            <div class="thumb"><a href=""><img src="" class="img-responsive"
                                alt="" /></a></div>
                            <div class="jobs_right">
                                <div class="date"><!-- 30 --> <span><!-- Jul --></span></div>
                                <div class="date_desc">
                                    <h6 class="title"><a href=""><!-- Front-end Developer --></a></h6>
                                    <span class="meta"><!-- Ha Noi, Viet Nam --></span>
                                </div>
                                <div class="clearfix"> </div>
                                <br>
                                <div class="col-md-6 single_right">
                                    <p><b>@lang('job.company')</b></p>
                                        <p><b>@lang('job.tag')</b></p>
                                </div>
                                <div class="col-md-6 single_right">
                                    <p><b>@lang('job.exp')</b></p>
                                    <p><b>@lang('job.salary')</b></p>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection
