<div ng-show="state.page == 'seeRecord'">
    <div class="alert alert-success">
        <h4 align="center">Customer Records</h4>
    </div>
    {{--<pre>@{{ customers | json }}</pre>--}}
    <table class="table">
        <thead class="thead-dark">
        <td>
            <label for="">Search Customer</label>
        </td>
        <td colspan="2">
            <input type="text" placeholder="Search" class="form-control" ng-model="params.id"
                   ng-change="fetchCustomers()">
        </td>
        <tr>
            <th>Bill Number</th>
            <th>Customer Name</th>
            <th>Customer Contact</th>
            <th>Item Name</th>
            <th>Company Name</th>
            <th>Model</th>
            <th>Colour</th>
            <th>Price</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody ng-repeat=" customer in customers">
        <tr>
            <td><strong>@{{ customer.id }}</strong></td>
            <td><strong>@{{ customer.bill.customer.cname }}</strong></td>
            <td><strong>@{{ customer.bill.customer.contact }}</strong></td>
            <td><strong>@{{ customer.product.itemname }}</strong></td>
            <td><strong>@{{ customer.product.companyname }}</strong></td>
            <td><strong>@{{ customer.product.model }}</strong></td>
            <td><strong style="color: @{{ customer.product.color  }}">@{{ customer.product.color }}</strong></td>
            <td><strong>@{{ customer.product.price }}</strong></td>
            <td><strong>@{{ customer.bill.date }}</strong></td>
        </tr>
        </tbody>

    </table>
    <p class="alert alert-danger" ng-if="!customers || customers.length==0">No Record found!</p>
    <ul uib-pagination
        items-per-page="params.perPage"
        total-items="params.totalItems"
        ng-model="params.page"
        ng-change="fetchCustomers()"
    ></ul>
</div>