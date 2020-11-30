@extends('layouts.app')

@section('content')
    @include('layouts.search')
    <div class="container">
        <div class="single">
            <div class="col-md-9 single_right">
                <div class="but_list">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="" id="home-tab" role="tab" data-toggle="tab"
                                    aria-controls="home" aria-expanded="true">@lang('listjob.suitable')</a></li>
                            <li role="presentation"><a href="" role="tab" id="profile-tab" data-toggle="tab"
                                    aria-controls="profile">@lang('listjob.all')</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                <div class="tab_grid">
                                    <div class="jobs-item with-thumb">
                                        <div class="thumb"><a href=""><img src="" class="img-responsive"
                                            alt="" /></a></div>
                                            <div class="jobs_right">
                                                {{-- date --}}
                                                <div class="date"><span></span></div>
                                                <div class="date_desc">
                                                    {{-- title of job--}}
                                                    <h6 class="title"><a href=""></a>
                                                    </h6>
                                                    {{-- address --}}
                                                    <span class="meta"></span>
                                                </div>
                                                <div class="clearfix"> </div>
                                                <br>
                                                <div class="col-md-6 single_right">
                                                    <p><b>@lang('job.company'):</b></p>
                                                    <p><b>@lang('job.tag'):</b></p>
                                                </div>
                                                <div class="col-md-6 single_right">
                                                    <p><b>@lang('job.exp'):</b></p>
                                                    <p><b>@lang('job.salary'):</b></p>
                                                </div>
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="col_3">
                    <h3>@lang('listjob.skill')</h3>
                    <table class="table">
                        <tbody>
                            <tr class="unread checked">
                                <td class="hidden-xs">
                                    <input type="checkbox" class="checkbox">
                                </td>
                                {{-- list tag --}}
                                <td class="hidden-xs"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
@endsection
