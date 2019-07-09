<div class="row" ng-show="state.page == 'SoldItems'">
    <div class="alert alert-success">
        <h1 align="center">User Records</h1>
    </div>
    {{--<pre>@{{ currentUser | json }}</pre>--}}
    {{--<pre>@{{  month }}</pre>--}}
    {{--<pre>@{{ year }}</pre>--}}
    <table class="table table-bordered table-dark">
        <tr class="text-center">
            <th class="thead-dark text-center" colspan="5">@{{ products1.username}}</th>
        </tr>
        <tbody>
        <tr>
            <td>Select Month</td>
            <td>
                <select ng-value="month" ng-model="month">
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
            <td>
                Select Year
            </td>
            <td>
                <input type="number" placeholder="Enter Year" ng-model="year">
            </td>
            <td>
                <button class="btn btn-success" ng-click="selectMonth(year,month,currentUser)">Search
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>