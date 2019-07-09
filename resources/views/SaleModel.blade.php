<div ng-show="state.page == 'ItemRecords'">
    {{--<pre>@{{saleItems | json}}</pre>--}}
    <div class="alert alert-success">
        <h1 align="center">Bill Records</h1>
    </div>
    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th class="thead-dark">Item Name</th>
            <th class="thead-dark">Company Name</th>
            <th class="thead-dark">Model</th>
            <th class="thead-dark">price</th>
            <th class="thead-dark">Number of Sold</th>
            <th class="thead-dark">Total Price</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="item in saleItems">
            <td>@{{ item.product.itemname }}</td>
            <td>@{{ item.product.companyname }}</td>
            <td>@{{ item.product.model }}</td>
            <td>@{{ item.product.price }}</td>
            <td>@{{ item.qty }}</td>
            <td>@{{ item.price }}</td>
        </tr>
        <tr>
            <td class="text-center" colspan="6">Total Price: @{{ totalamount(saleItems) }}</td>
        </tr>
        </tbody>
    </table>
</div>
