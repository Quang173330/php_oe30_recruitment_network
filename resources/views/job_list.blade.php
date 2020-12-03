@extends('layouts.app')

@section('content')
<div class="container">
    <div class="single">
        <div class="row">
            <div class="col-md-1 single_right">
            </div>
            <div class="col-md-9 single_right">
                <div class="but_list">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><!-- Job List --></a></li>
                            <li role="presentation"><a href="" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile"><!-- Job List Unapproved< -->/a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                <div class="tab_grid">
                                    <div class="jobs-item with-thumb" href="">
                                        <div class="thumb"><a href=""><img src="images/a2.jpg" class="img-responsive"
                                            alt="" /></a></div>
                                            <div class="jobs_right">
                                                <div class="date"><!-- 30 --><span><!-- Jul --></span></div>
                                                <div class="date_desc">
                                                    <h6 class="title"><a href=""><!-- Front-end Developer --></a></h6>
                                                    <span class="meta"><!-- Ha Noi, Viet Nam --></span>
                                                </div>
                                                <div class="clearfix"> </div>
                                                <br>
                                                <div class="col-md-6 single_right">
                                                    <p><b><!-- Company: --></b></p>
                                                    <p><b><!-- Tags: --></b></p>
                                                </div>
                                                <div class="col-md-6 single_right">
                                                    <p><b><!-- Experience: --></b></p>
                                                    <p><b><!-- Salary: --></b></p>
                                                </div>
                                            </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection
