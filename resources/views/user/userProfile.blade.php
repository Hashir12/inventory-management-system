@extends('layouts.master')

@section('title')
    Inventory Management System
@endsection

@section('content')
    {{--<pre>state: @{{ state | json }}</pre>--}}
    {{--<pre>records: @{{ records | json }}</pre>--}}
    <div class="container-fluid" {{--style="border:2px solid;"--}}>
        <div class="row" ng-show="state.page == 'Login'">
            <div class="alert alert-success">
                <h1 align="center">Welcome {{ Auth::user()->username }}</h1>
            </div>
            <div class="col-md-6 border-0">
                <table ng-show="state.page == 'Login'"
                       class="text-center table table-bordered table-responsive table-striped table-hover">
                    <thead>
                    <tr>
                        {{--Search Record--}}
                        <th class="thead-dark text-center" colspan="10">
                            Search Item
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" placeholder="Search by Model" class="form-control"
                                   ng-model="Productparams.searchName"
                                   ng-change="fetchData()">
                        </td>
                        <td colspan="1">
                            <input type="text" placeholder="Search by Number" class="form-control" ng-model="number">
                            <button id="btn" class="btn btn-success" ng-click="zeroRecord(number)">Search</button>
                        </td>
                        <td @if(Auth::user()->user_type == 'user')
                            colspan="1"
                            @endif
                            colspan="2">
                            <a ng-click="activeRecord(records)" class="active btn btn-success">Active Items</a>
                        </td>
                        <td colspan="2">
                            <a ng-click="inactiveRecord(records)" class="active btn btn-danger">Inactive
                                Items</a>
                        </td>
                    </tr>
                    <tr>
                        <th class="thead-dark text-center" scope="col">
                            <a style="color: white; cursor: pointer"
                               ng-click="orderBy('itemname')">
                                Item Name
                                <i class="fas fa-arrow-alt-circle-down"
                                   ng-if="Productparams.orderDirection == 'desc' && Productparams.orderBy == 'itemname'"></i>
                                <i class="fas fa-arrow-alt-circle-up"
                                   ng-if="Productparams.orderDirection == 'asc' && Productparams.orderBy == 'itemname'"></i>
                            </a>
                        </th>

                        <th class="thead-dark text-center" scope="col">
                            <a style="color: white; cursor: pointer"
                               ng-click="orderBy('companyname')">Company Name
                                <i class="fas fa-arrow-alt-circle-down"
                                   ng-if="Productparams.orderDirection == 'desc' && Productparams.orderBy == 'companyname'"></i>
                                <i class="fas fa-arrow-alt-circle-up"
                                   ng-if="Productparams.orderDirection == 'asc' && Productparams.orderBy == 'companyname'"></i>
                            </a>
                        </th>

                        {{--<th class="thead-dark" scope="col">--}}
                        {{--<a style="color: white; cursor: pointer" ng-click="orderBy('model')">Model--}}
                        {{--<i class="fas fa-arrow-alt-circle-down"--}}
                        {{--ng-if="Productparams.orderDirection == 'desc' && Productparams.orderBy == 'model'"></i>--}}
                        {{--<i class="fas fa-arrow-alt-circle-up"--}}
                        {{--ng-if="Productparams.orderDirection == 'asc' && Productparams.orderBy == 'model'"></i>--}}
                        {{--</a>--}}
                        {{--</th>--}}

                        <th class="thead-dark text-center" scope="col">
                            <a style="color: white; cursor: pointer" ng-click="orderBy('color')">Color
                                <i class="fas fa-arrow-alt-circle-down"
                                   ng-if="Productparams.orderDirection == 'desc' && Productparams.orderBy == 'color'"></i>
                                <i class="fas fa-arrow-alt-circle-up"
                                   ng-if="Productparams.orderDirection == 'asc' && Productparams.orderBy == 'color'"></i>
                            </a>
                        </th>
                        <th class="thead-dark text-center" scope="col">
                            <a style="color: white; cursor: pointer"
                               ng-click="orderBy('price')">Price
                                <i class="fas fa-arrow-alt-circle-down"
                                   ng-if="Productparams.orderDirection == 'desc' && Productparams.orderBy == 'price'"></i>
                                <i class="fas fa-arrow-alt-circle-up"
                                   ng-if="Productparams.orderDirection == 'asc' && Productparams.orderBy == 'price'"></i>
                            </a></th>
                        <th class="thead-dark text-center" scope="col">Total in Record</th>
                        {{--<th class="thead-dark" scope="col">Status</th>--}}
                        @if(Auth::user()->user_type == 'admin')
                            <th class="thead-dark text-center" scope="col">Actions</th>
                        @endif
                        <th class="thead-dark text-center" scope="col" style="width:63px; height: 33px;">Sale</th>
                    </tr>
                    </thead>
                    <tbody ng-repeat="record in records|filter:searchName">
                    <tr>
                        <td><strong>@{{record.itemname}}</strong></td>
                        <td><strong>@{{ record.companyname }}</strong></td>
                        {{--<td><strong>@{{ record.model }}</strong></td>--}}
                        <td><strong>@{{ record.color }}</strong></td>
                        <td><strong>@{{ record.price }}</strong></td>

                        <td>
                            <strong>
                                @if( Auth::user()->user_type=='admin')
                                    <i ng-if="record.number" class="fas fa-minus btn-danger"
                                       ng-click="lessItem(record)"></i>
                                    <i class="fas fa-plus btn-success" ng-if="!record.number"
                                       ng-click="addItem(record)"></i>
                                @endif
                                <span ng-if="record.number">  @{{ record.number }}</span>
                                @if( Auth::user()->user_type=='admin')
                                    <i class="fas fa-plus btn-success" ng-if="record.number"
                                       ng-click="addItem(record)"></i>
                                @endif
                            </strong>
                        </td>
                        {{--<td>--}}
                        {{--@{{ record.product_status }}--}}
                        {{--</td>--}}
                        @if( Auth::user()->user_type=='admin')
                            <td><a ng-click="openEditModal(record)">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a ng-if="record.product_status == 'active'" href
                                   ng-click="changestatus(record)"><i class="fas fa-shopping-cart"></i></a>
                                <a ng-if="record.product_status == 'inactive'" href
                                   ng-click="changestatus(record)"><i class="fas fa-cart-plus"></i></a>
                            </td>
                        @endif
                        <td>
                            <a ng-if="record.product_status == 'active' && record.number != 0"
                               ng-click="addToBill(record)"><i class="fas fa-cart-plus"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p class="alert alert-danger" ng-if="!records || records.length == 0">No records found</p>
                <ul uib-pagination
                    items-per-page="Productparams.perPage"
                    total-items="Productparams.totalItems"
                    ng-model="Productparams.page"
                    ng-change="fetchData()"
                ></ul>
            </div>

            <div class="text-center col-md-5 border-0" style="margin-left: 1%;">
                {{--<pre>@{{ bill | json }}</pre>--}}
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group" style="margin-top: 45px;">
                    <label style="margin-right: 400px;">Customer Name</label>
                    <input type="text" class="form-control"
                           ng-change="search(name)"
                           ng-model="name" placeholder="Enter Customer Name">
                    <input type="hidden" ng-model="customerId">
                    <div class="test">
                        <div class="items" ng-repeat="item in items">
                            <div class="hover" ng-click="itemName(item.id, item.cname, item.contact)">
                                <h4>@{{ item.cname }}</h4>
                                <h6>@{{ item.contact }} &nbsp;</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger" ng-if="errors.name">@{{ errors.name[0] }}</div>

                <div class="form-group">
                    <label style="margin-right: 385px;">Customer Contact</label>
                    <input type="text" class="form-control is-invalid" ng-model="contact"
                           placeholder="Enter Customer contact">
                </div>
                <div class="alert alert-danger" ng-if="errors.contact">@{{ errors.contact[0] }}</div>

                <table ng-if="bill"
                       class="text-center table-condensed table table-responsive table-bordered table-striped table-hover">
                    <thead class="text-center">
                    <tr>
                        <th class="text-center thead-dark">Item Name</th>
                        <th class="text-center thead-dark">Company Name</th>
                        <th class="text-center thead-dark">Model</th>
                        <th class="text-center thead-dark">Color</th>
                        <th class="text-center thead-dark">price</th>
                        <th class="text-center thead-dark">Number</th>
                        <th class="text-center thead-dark">Total Price</th>
                        <th class="text-center thead-dark">Remove Item</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="record in bill track by $index">
                        <td>@{{ record.itemname }}</td>
                        <td>@{{ record.companyname }}</td>
                        <td>@{{ record.model }}</td>
                        <td>@{{ record.color }}</td>
                        <td>@{{ record.price }}</td>
                        <td><a ng-click="Lessaction(record)" style="border-radius:50%;" href><i
                                        class="fas fa-minus btn-danger"></i>
                            </a>
                            @{{ record.number }}
                            <a ng-click="Addaction(record)" style="border-radius:50%; " href=""><i
                                        class="fas fa-plus btn-success"></i>
                            </a>
                        </td>
                        <td>@{{ record.number*record.price }}</td>
                        <td><a ng-click="emptyRecord(record)" href><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                    <tr ng-show="bill && bill.length">
                        <th colspan="4">
                            <input type="text" placeholder="Discount" ng-model="discount">
                        </th>
                        <th class="text-center" colspan="4">Total Price @{{totalBill() }}</th>
                    </tr>
                    <tr ng-show="bill && bill.length">
                        <th class="text-center" colspan="4">
                            <a class="btn btn-danger" ng-click="clearData()">Clear Items</a>
                        </th>
                        <th class="text-center" colspan="4">
                            <a class="btn btn-success" href
                               ng-click="saleRecord(customerId,name,contact,discount,bill)">Continue</a>
                        </th>
                    </tr>
                    </tbody>
                </table>
                <p class="alert alert-danger" ng-if="bill == 0 || !bill">Your Cart is empty</p>

            </div>
        </div>
    </div>

    @include('userDashboard')
    @include('user.signup')
    @include('add-record')
    @include('edit-record')
    @include('sale-record')
    @include('reciept')
    @include('view-customers')
    @include('sold_items')
    @include('SaleRecords')
    @include('SaleModel')

@endsection