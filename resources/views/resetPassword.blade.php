@extends('layouts.master')

@section('title')
    Inventory Management System
@endsection

@section('content')
    <div class="row">
        <h1 align="center">Password Reset</h1>
        @if(count($errors) > 0)
            <div class="col-sm-6 col-sm-offset-3 alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group" ng-class="{'has-error': errors && errors.con}">
                <label for="">New Password</label>
                <input class="form-control" type="password" ng-model="npassword" placeholder="Enter New Password">
                <span class="help-block" ng-repeat="error in errors.con" ng-if="errors && errors.con">@{{error}}</span>
            </div>
            <div class="form-group" ng-class="{'has-error': errors && errors.new}">
                <label for="">Confirm Password</label>
                <input class="form-control" type="password" ng-model="cpassword" placeholder="Confirm Password">
                <span class="help-block" ng-repeat="error in errors.new"
                      ng-if="errors && errors.new">@{{ error }}</span>
            </div>
            <div>
                <a class="btn btn-primary" ng-click="changePassword(npassword, cpassword)">Reset Password</a>
            </div>
        </div>
    </div>
@endsection