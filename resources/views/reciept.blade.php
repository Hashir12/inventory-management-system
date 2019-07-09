<div style="padding: 0px 100px;" ng-show="state.page == 'model'" class="row">
    @if(Auth::user()->user_role == 'khursheed')
        <h1>Khursheed Electronics</h1>
    @elseif(Auth::user()->user_role == 'mustafa')
        <h1>Mustafa Electronics</h1>
    @endif
    {{--<pre>@{{ soldData|json }}</pre>--}}
    <div class="row">
        <table class="text-center table-condensed table table-responsive table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th class="thead-dark text-center">Customer Name</th>
                <th class="thead-dark text-center">Customer contact</th>
                <th class="thead-dark text-center">Item Name</th>
                <th class="thead-dark text-center">Company Name</th>
                <th class="thead-dark text-center">Model</th>
                <th class="thead-dark text-center">Number</th>
                <th class="thead-dark text-center">Price</th>
            </tr>
            </thead>
            <tbody ng-repeat="record in soldData.soldRecord">
            <tr>
                <td>@{{soldData.name}}</td>
                <td>@{{soldData.contact}}</td>
                <td>@{{record.itemname}}</td>
                <td>@{{record.companyname}}</td>
                <td>@{{record.model}}</td>
                <td>@{{record.number}}</td>
                <td>@{{record.price * record.number}}</td>
            </tr>
            </tbody>
            <tr>
                <td colspan="5" class="thead-dark">Total Bill : @{{ recieptTotal(soldData.soldRecord) }} |
                    Discount : @{{soldData.discount}}
                </td>
                <td colspan="2" class="thead-dark">Net Cash: @{{ netTotal(soldData) }}
                </td>
            </tr>
        </table>
    </div>
    @if(Auth::user()->user_role == 'khursheed')
        <div><h4>Adress : Shop# 83, near MCB (Muslim Commercial bank) main Tench Road Rawalpindi.</h4>
            <h3>Proprietor : Zubair Mustafa.</h3>
            <h3>Phone Number : 0346-5145214</h3>
            <p>Note : No return or exchange will be granted without bill !</p>
            <p>Created By AppMakers office #512 Rizwan Arcade Adam Gee Road Saddar Rawalpindi.</p>
        </div>
    @elseif(Auth::user()->user_role == 'mustafa')
        <div><h4>Adress : Shop# 302, near MCB (Muslim Commercial bank) main Tench Road Rawalpindi.</h4>
            <h3>Proprietor : Nabeel Mustafa.</h3>
            <h3>Phone Number : 0341-5391067</h3>
            <p>Note : No return or exchange will be granted without bill!</p> <br>
            <p>Created By AppMakers office #512 Rizwan Arcade Adam Gee Road Saddar Rawalpindi.</p>
        </div>
    @endif
</div>