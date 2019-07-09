<div ng-show="state.page == 'saleItem'">
    <div class="alert alert-success">
        <h1 align="center">User Records</h1>
    </div>
    {{--<pre>@{{ userSale | json }}</pre>--}}
    {{--<pre>@{{ records | json }}</pre>--}}
    {{--<pre>@{{ products1 | json }}</pre>--}}
    {{--<pre>@{{ p | json }}</pre>--}}
    <div>
        <a href ng-click="state.page = 'users'"><i class="fas fa-backward"></i>Go Back</a>
    </div>
    <table class="table table-bordered table-dark">
        <tr>
            <th class="thead-dark text-center">Number</th>
            <th class="thead-dark text-center">Customer</th>
            <th class="thead-dark text-center">Product Sold</th>
            <th class="thead-dark text-center">Total Price</th>
            <th class="thead-dark text-center">Discount</th>
            <th class="thead-dark text-center">Sale Date</th>
            <th class="thead-dark text-center">Details</th>
        </tr>
        <tbody>
        <tr ng-repeat="bill in userSale">
            <td>@{{ $index+1 }}</td>
            <td>@{{ bill.customer.cname }}</td>
            <td>@{{ bill.sale_records.length }}</td>
            <td>@{{ totalPrice(bill.sale_records) }}</td>
            <td>@{{ bill.discount }}</td>
            <td>@{{ bill.date }}</td>
            <td ng-click="billRecords(bill.sale_records)">
                <i class="btn-success fas fa-info-circle"></i>
            </td>
        </tr>
        <tr>
            <th class="text-center" colspan="3">Total Sale: @{{ total }}</th>
            <th class="text-center" colspan="3">Discount: @{{ dis }}</th>
            <th class="text-center" colspan="1">Net Sale: @{{ total-dis }}</th>
        </tr>
        </tbody>
    </table>
    <p class="alert alert-danger" ng-if="!records || records == 0">No Sale found</p>

</div>