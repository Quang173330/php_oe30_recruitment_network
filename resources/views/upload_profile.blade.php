@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="single">
            <div class="form-container">
                <h2>Update your profile</h2>
                <form class="row" action="{{route('upload')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="cv">Your CV</label>
                                <div class="col-md-9">
                                    <input type="file" name="cv" id="cv" class="input-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="avatar">Your avatar</label>
                                <div class="col-md-9">
                                    <input type="file" name="avatar" path="avatar" id="avatar" class="input-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="tags">@lang('job.tag')</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <tr>
                                            <td class="table-text"><div>@lang('job.skill')</div></td>
                                            <td><table class="table">
                                                <tbody>
                                                    @foreach ($skills as $skill)
                                                        <tr class="unread checked">
                                                            <td class="hidden-xs">
                                                                <input type="checkbox" name="tag[]" value="{{ $skill->id }}"class="checkbox">
                                                            </td>
                                                            <td class="hidden-xs">
                                                                {{ $skill->name }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table></td>
                                        </tr>
                                    </div>
                                    <div class="col-md-2">
                                        <tr>
                                            <td class="table-text"><div>@lang('job.lang')</div></td>
                                            <td>
                                                <table class="table">
                                                    <tbody>
                                                        @foreach ($langs as $lang)
                                                            <tr class="unread checked">
                                                                <td class="hidden-xs">
                                                                    <input type="checkbox" name="tag[]" value="{{ $lang->id }}"class="checkbox">
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
                                            <td class="table-text"><div>@lang('job.working_time')</div></td>
                                            <td><table class="table">
                                                <tbody>
                                                    @foreach ($workingTimes as $workingTime)
                                                        <tr class="unread checked">
                                                            <td class="hidden-xs">
                                                                <input type="checkbox" name="tag[]" value="{{ $workingTime->id }}"class="checkbox">
                                                            </td>
                                                            <td class="hidden-xs">
                                                                {{ $workingTime->name }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table></td>
                                        </tr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="avatar-company">Your avatar company</label>
                                <div class="col-md-9">
                                    <input type="file" path="avatar" name="avatar_company" id="avatar-company" class="input-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-actions floatRight">
                                <input type="submit" value="Update" class="btn btn-primary btn-sm">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection