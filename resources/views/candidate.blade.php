@extends('layouts.app')

@section('content')
<div class="container">
    <div class="single">
        <div class="row">
            <div class="col-sm-4 follow_left">
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
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-sm-8 follow_left">
                    <h4>@lang('job.listapply')</h4>
                    <div class="follow_jobs">
                        <a href="">
                            <div class="featured"></div>
                            <img src="" alt="" class="img-circle">
                            <div class="title">
                                <h5><!-- User Name --></h5>
                                <p><!-- Type Person --></p>
                            </div>
                        </a>
                        <a href="">
                            <div class="featured"></div>
                            <img src="" alt="" class="img-circle">
                            <div class="title">
                                <h5><!-- User Name --></h5>
                                <p><!-- Type Person --></p>
                            </div>
                        </a>
                        <ul class="pagination">
                            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a>
                            </li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection
