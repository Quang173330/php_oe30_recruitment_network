@extends('layouts.app')

@section('content')
    @include('layouts.search')
    <div class="container">
        <div class="single">
            <div class="col-md-9 single_right">
                <div class="but_list">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                @foreach ($jobs as $job)
                                    <div class="jobs-item with-thumb">
                                        <div class="thumb"><a href="{{asset($job->url)}}"><img src="" class="img-responsive" alt="" /></a></div>
                                        <div class="jobs_right">
                                            <div class="date">
                                                {{ $job->created_at->format('d') }}<span>{{ $job->created_at->format('M') }}</span>
                                            </div>
                                            <div class="date_desc">
                                                <h6 class="title">
                                                    <a
                                                        href="{{ route('jobs.show', ['job' => $job->id]) }}">{{ $job->title }}</a>
                                                </h6>
                                                <p>{{ $job->company->address }}</p>
                                                <span class="meta"></span>
                                            </div>
                                            <div class="clearfix"> </div>
                                            <br>
                                            <div class="col-md-6 single_right">
                                                <p>
                                                    <b>@lang('job.company'): </b>
                                                    {{ $job->company->name }}
                                                </p>
                                                <p><b>@lang('job.tag'): </b>
                                                    @foreach ($job->tags as $tag)
                                                        <button class="tag">{{ $tag->name }}</button>
                                                    @endforeach
                                                </p>
                                            </div>
                                            <div class="col-md-6 single_right">
                                                <p>
                                                    <b>@lang('job.exp'): </b>
                                                    {{ $job->experience }}
                                                </p>
                                                <p>
                                                    <b>@lang('job.salary'): </b>
                                                    {{ $job->salary }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
@endsection
