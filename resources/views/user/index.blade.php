@extends('layouts.master')
@section('title')
    Inventory System
@endsection

@section('content')
    {{--SignIn Form--}}
    <div class="row" ng-show="state.page == 'Login'">
        <h1 align="center">User Login</h1>
        {{--@if(count($errors) > 0)--}}
        {{--<div class="col-sm-6 col-sm-offset-3 alert alert-danger">--}}
        {{--@foreach($errors->all() as $error)--}}
        {{--<p>{{$error}}</p>--}}
        {{--@endforeach--}}
        {{--</div>--}}
        {{--@endif--}}
        <div class="col-sm-6 col-sm-offset-3">
            <form action="/login">
                {{csrf_field()}}
                <div {{--class="form-group"--}}
                     @if(count($errors)> 0)
                     class="has-error"
                        @endif>
                    <label for="">Username</label>
                    <input class="form-control" type="text" name="username" placeholder="Enter User Name">
                    @if(count($errors))
                        <span class="help-block"
                        @foreach($errors->all() as $error)
                                @endforeach>
                        {{$error}}
                        </span>
                    @endif
                </div>
                <div
                        @if(count($errors) > 0)
                        class="has-error"
                        @endif>
                    <label for="">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Enter Password">
                    @if(count($errors))
                        <span class="help-block">
                            @foreach($errors->all() as $error)
                            @endforeach
                            {{$error}}
                        </span>
                    @endif
                </div>
                <div>
                    <button class="btn btn-primary"
                            @if(count($errors) <= 0)
                            style="margin-top: 10px;"
                            @endif>
                        Login
                    </button>
                    <a style="margin-left: 10px;" href ng-click="state.page = 'recover'">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row" ng-show="state.page == 'recover'">
        <h1 align="center">Password Recovery</h1>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <label for="">Enter Your Email</label>
                <input class="form-control" type="email" ng-model="email" placeholder="Enter email">
            </div>
            <div>
                <a class="btn btn-primary" ng-click="recover(email)">continue</a>
            </div>
        </div>
    </div>
@endsection