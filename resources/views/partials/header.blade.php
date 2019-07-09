<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="inventory">Inventory</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if(Auth::check())
                    @if(Auth::user()->user_type == 'admin')
                        <li>
                            <a class="nav-link" href data-toggle="modal" data-target="#AddModal"><i
                                        class="fas fa-upload"></i>
                                Add Record</a>
                        </li>
                        <li>
                            <a class="nav-link" href ng-click="state.page = 'seeRecord'"><i class="far fa-eye"></i> See
                                Record</a>
                        </li>
                        <li>
                            <a class="nav-link" href ng-click="state.page = 'users'"><i class="fas fa-users"></i> See
                                Users</a>
                        </li>
                        <li>
                            <a class="nav-link" href ng-click="state.page = 'signup'"><i
                                        class="fas fa-user-plus"></i>
                                Create User </a>
                        </li>
                    @endif
                    <li @if(Auth::user()->user_type=='user')
                        style="margin-left: 405px"
                            @endif>
                        <a id="logout" class="nav-link" href="/userLogout"><i class="fas fa-sign-out-alt"></i>
                            Logout</a>
                    </li>

                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
{{-----------------------------------------------------------------------------------}}
{{--<nav class="navbar navbar-inverse">--}}
{{--<div class="container-fluid">--}}
{{--<div class="navbar-header">--}}
{{--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">--}}
{{--<span class="icon-bar"></span>--}}
{{--<span class="icon-bar"></span>--}}
{{--<span class="icon-bar"></span>--}}
{{--</button>--}}
{{--<a class="navbar-brand" href="#">Inventory Sys</a>--}}
{{--</div>--}}
{{--<div class="collapse navbar-collapse" id="myNavbar">--}}
{{--<ul class="nav navbar-nav">--}}
{{--@if(Auth::check())--}}
{{--<li>--}}
{{--<a class="active" href ng-click="state.page = 'addRecord'">Add Record</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a class="nav-link" href ng-click="state.page = 'seeRecord'">See Record</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a id="logout" class="nav-link" href="/userLogout">Logout</a>--}}
{{--</li>--}}
{{--@else--}}
{{--<li>--}}
{{--<a class="nav-link" href ng-click="state.page = 'signup'">Sign--}}
{{--Up</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a class="nav-link" href ng-click="state.page = 'Login'">Log--}}
{{--In</a>--}}
{{--</li>--}}
{{--@endif--}}

{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--</nav>--}}