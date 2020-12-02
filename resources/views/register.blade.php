@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="single">
            <div class="form-container">
                <h2>@lang('register.register')</h2>
                <form class="row" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="firstName">@lang('register.email')</label>
                                <div class="col-md-9">
                                    <input type="text" name="email" path="firstName" id="firstName"
                                        class="form-control input-sm" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="lastName">@lang('register.fullname')</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" path="lastName" id="lastName"
                                        class="form-control input-sm" />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="lastName">@lang('register.password')</label>
                                <div class="col-md-9">
                                    <input type="text" name="password" path="lastName" id="lastName"
                                        class="form-control input-sm" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable"
                                    for="lastName">@lang('register.confirm-password')</label>
                                <div class="col-md-9">
                                    <input type="text" name="password_confirmation" path="lastName" id="lastName"
                                        class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="subjects">@lang('register.introduce')</label>
                                <div class="col-md-9 sm_1">
                                    <textarea cols="77" name="introduce" rows="6" value=""> </textarea>
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
