<div ng-show="state.page == 'users'">
    {{--<pre>@{{ users| json }}</pre>--}}
    <div class="alert alert-success">
        <h1 align="center">Users Records</h1>
    </div>
    <table class="table table-bordered table-dark">
        <tr>
            <th class="thead-dark text-center" colspan="4">Monthly Sale</th>
        </tr>
        <tr>
            <td>Select Month</td>
            <td><select ng-value="month" ng-model="month">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">Novemmber</option>
                    <option value="12">December</option>
                </select>
            </td>
            <td>Select Year</td>
            <td><input type="number" placeholder="Enter Year" ng-model="year">
                <button class="btn-success" ng-click="monthlySale(month,year)">
                    <i class="fas fa-search"></i>
                </button>
            </td>

        </tr>
        <tr>
            <th class="thead-dark">Username</th>
            <th class="thead-dark">Role</th>
            <th class="thead-dark">Shop</th>
            <th class="thead-dark">Change Role</th>
            <th class="thead-dark">Change shop</th>
            <th class="thead-dark">Delete User</th>
        </tr>
        <tbody ng-repeat="user in users">
        <tr>
            <td><a href ng-click="showProducts(user)">@{{ user.username }}</a></td>
            <td>@{{ user.user_type }}</td>
            <td>@{{ user.user_role }}</td>

            <td>
                <a ng-if="user.user_type=='user'" class="btn btn-success" href ng-click="userRole(user)">Admin</a>
                <a ng-if="user.user_type=='admin'" class="btn btn-success" href ng-click="userRole(user)">User</a>
            </td>
            <td>Select Shop
                <select ng-model="shopName" ng-change="usershop(user, shopName)">
                    @{{ user.user_role }}
                    <option value="mustafa"> Mustafa Electronics</option>
                    <option value="khursheed"> Khursheed Electronics</option>
                </select>
            </td>
            <td><a class="btn btn-danger" ng-click="openDeleteModal(user)">Delete User</a></td>
        </tr>

        <!-- Modal -->
        <script type="text/ng-template" id="delete-modal.html">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Delete User</h4>
            </div>
            <div class="modal-body">
                <h1>Are you sure to delete User?</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" ng-click="modal.close()">No</button>
                <a type="submit" href ng-click="delete(user)" class="btn btn-danger">Delete</a>
            </div>
        </script>

        </tbody>
    </table>
</div>
