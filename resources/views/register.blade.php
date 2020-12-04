@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="choice" id="choice">
            <div class="choice-1">
                <div class="choice-label">
                    <strong>@lang('register.register')</strong>
                </div>
                <div class="choice-content">
                    <div class="choice-employer" id="choice-employer">
                        <input name="choice-register" id="employer" value="employer" type="radio">
                        <label for="employer">@lang('register.employer')</label>
                    </div>
                    <div class="choice-candidate" id="choice-candidate">
                        <input name="choice-register" id="candidate" value="candidate" type="radio">
                        <label for="candidate">@lang('register.candidate')</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="single">
            <div class="form-container">
                <form class="row" method="POST" id="form-candidate">
                    @csrf
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="email">@lang('register.email')</label>
                                <div class="col-md-9">
                                    <input type="text" name="email" id="email" class="form-control input-sm" />
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
                                    <input type="text" name="name" id="name" class="form-control input-sm" />
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
                                <label class="col-md-3 control-lable" for="password">@lang('register.password')</label>
                                <div class="col-md-9">
                                    <input type="password" name="password" id="password" class="form-control input-sm" />
                                    @error('password')
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
                                    for="password-confirmation">@lang('register.confirm_password')</label>
                                <div class="col-md-9">
                                    <input type="password" name="password_confirmation" id="password-confirmation"
                                        class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="subjects">@lang('register.introduce')</label>
                                <div class="col-md-9 sm_1">
                                    <textarea class="ckeditor" cols="77" name="introduce" rows="6" value=""> </textarea>
                                    @error('introduce')
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
                <form class="row form-employer" method="POST" id="form-employer">
                    @csrf
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="email">@lang('register.email')</label>
                                <div class="col-md-9">
                                    <input type="text" name="email" id="email" class="form-control input-sm" />
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
                                    <input type="text" name="name" id="name" class="form-control input-sm" />
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
                                <label class="col-md-3 control-lable" for="password">@lang('register.password')</label>
                                <div class="col-md-9">
                                    <input type="password" name="password" id="password" class="form-control input-sm" />
                                    @error('password')
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
                                    for="password-confirmation">@lang('register.confirm_password')</label>
                                <div class="col-md-9">
                                    <input type="password" name="password_confirmation" id="password-confirmation"
                                        class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="subjects">@lang('register.introduce')</label>
                                <div class="col-md-9 sm_1">
                                    <textarea class="ckeditor" cols="77" name="introduce" rows="6" value=""> </textarea>
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
                                <label class="col-md-3 control-lable"
                                    for="name-company">@lang('register.name_company')</label>
                                <div class="col-md-9">
                                    <input type="text" name="name-company" id="name-company"
                                        class="form-control input-sm" />
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
                                    <input type="text" name="address" id="address" class="form-control input-sm" />
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
                                    <input type="text" name="link-website" id="link-website"
                                        class="form-control input-sm" />
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
                                    <textarea class="ckeditor" cols="77" name="introduce-company" rows="6"
                                        value=""> </textarea>
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
    <script src="{{ asset('js/register.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('bower_components/ckeditor/style.js') }}"></script>
@endsection
