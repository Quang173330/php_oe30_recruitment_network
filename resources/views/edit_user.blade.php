@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="single">
            <div class="form-container">
                <form action="{{ route('users.update',['user'=>$user->id]) }}" class="row" method="POST" id="form-employer">
                    @method('PUT')
                    @csrf
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="email">@lang('register.email')</label>
                                <div class="col-md-9">
                                    <input type="text" name="email" id="email" value="{{ $user->email }}"
                                        class="form-control input-sm" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <span class="span-error">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="name">@lang('register.fullname')</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        class="form-control input-sm" />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <span class="span-error">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="subjects">@lang('register.introduce')</label>
                                <div class="col-md-9 sm_1">
                                    <textarea class="ckeditor" cols="77" name="introduce" rows="6"
                                        value="">{!!  $user->introduce !!}</textarea>
                                    @error('introduce')
                                        <span class="invalid-feedback" role="alert">
                                            <span class="span-error">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="tags">@lang('job.tag')</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <tr>
                                            <td class="table-text">
                                                <div>@lang('job.skill')</div>
                                            </td>
                                            <td>
                                                <table class="table">
                                                    <tbody>
                                                        @foreach ($skills as $skill)
                                                            <tr class="unread checked">
                                                                <td class="hidden-xs">
                                                                    <input type="checkbox" checked="true" name="tag[]"
                                                                        value="{{ $skill->id }}" class="checkbox">
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    {{ $skill->name }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @foreach ($skillsNotBelongTo as $skill)
                                                            <tr class="unread checked">
                                                                <td class="hidden-xs">
                                                                    <input type="checkbox" name="tag[]"
                                                                        value="{{ $skill->id }}" class="checkbox">
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    {{ $skill->name }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </div>
                                    <div class="col-md-2">
                                        <tr>
                                            <td class="table-text">
                                                <div>@lang('job.lang')</div>
                                            </td>
                                            <td>
                                                <table class="table">
                                                    <tbody>
                                                        @foreach ($langs as $lang)
                                                            <tr class="unread checked">
                                                                <td class="hidden-xs">
                                                                    <input type="checkbox" name="tag[]" checked="true"
                                                                        value="{{ $lang->id }}" class="checkbox">
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    {{ $lang->name }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        @foreach ($langsNotBelongTo as $lang)
                                                            <tr class="unread checked">
                                                                <td class="hidden-xs">
                                                                    <input type="checkbox" name="tag[]"
                                                                        value="{{ $lang->id }}" class="checkbox">
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    {{ $lang->name }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </div>
                                    <div class="col-md-2">
                                        <tr>
                                            <td class="table-text">
                                                <div>@lang('job.working_time')</div>
                                            </td>
                                            <td>
                                                <table class="table">
                                                    <tbody>
                                                        @foreach ($workingTimes as $workingTime)
                                                            <tr class="unread checked">
                                                                <td class="hidden-xs">
                                                                    <input type="checkbox" name="tag[]" checked="true"
                                                                        value="{{ $workingTime->id }}" class="checkbox">
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    {{ $workingTime->name }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        @foreach ($workingTimesNotBelongTo as $working)
                                                            <tr class="unread checked">
                                                                <td class="hidden-xs">
                                                                    <input type="checkbox" name="tag[]"
                                                                        value="{{ $working->id }}" class="checkbox">
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    {{ $working->name }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable"
                                    for="name-company">@lang('register.name_company')</label>
                                <div class="col-md-9">
                                    <input type="text" value="{{ $user->company->name }}" name="name_company"
                                        id="name-company" class="form-control input-sm" />
                                    @error('name-company')
                                        <span class="invalid-feedback" role="alert">
                                            <span class="span-error">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="address">@lang('register.address')</label>
                                <div class="col-md-9">
                                    <input type="text" value="{{ $user->company->address }}" name="address" id="address"
                                        class="form-control input-sm" />
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <span class="span-error">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable"
                                    for="link-website">@lang('register.link_website')</label>
                                <div class="col-md-9">
                                    <input type="text" name="link_website" value="{{ $user->company->website }}"
                                        id="link-website" class="form-control input-sm" />
                                    @error('link-website')
                                        <span class="invalid-feedback" role="alert">
                                            <span class="span-error">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable"
                                    for="subjects">@lang('register.introduce_company')</label>
                                <div class="col-md-9 sm_1">
                                    <textarea class="ckeditor" cols="77" name="introduce_company" rows="6"
                                        value="">{!!  $user->company->introduce !!}</textarea>
                                    @error('introduce-company')
                                        <span class="invalid-feedback" role="alert">
                                            <span class="span-error">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-actions floatRight">
                                <input type="submit" value="@lang('register.register')" class="btn btn-primary btn-sm">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/style.js') }}"></script>
@endsection
