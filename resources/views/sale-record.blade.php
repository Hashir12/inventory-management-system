<!-- Modal -->
<script type="text/ng-template" id="sale-modal.html">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Sale Item</h4>
    </div>
    <div class="modal-body">
        {{--Sale Record--}}

        <div class="row">
            <div alert="alert alert-success">
                <h1 align="center">Sale Record</h1>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Customer Name</label>
                    <input type="text" class="form-control" ng-change="search(name)"
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
                <div class="form-group">
                    <label for="">Customer Contact</label>
                    <input type="text" class="form-control" ng-model="contact"
                           placeholder="Enter Customer contact">
                </div>
                <div class="form-group">
                    <label for="">Item Name</label>
                    <input type="text" disabled class="form-control" ng-model="bill.itemname"
                           placeholder="Enter Item Name">
                </div>
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" disabled class="form-control" ng-model="record.companyname"
                           placeholder="Enter Company Name">
                </div>
                <div class="form-group">
                    <label for="">Model</label>
                    <input type="text" disabled class="form-control" ng-model="record.model"
                           placeholder="Enter Model">
                </div>
                <div class="form-group">
                    <label for="">Color</label>
                    <input type="text" disabled class="form-control" ng-model="record.color"
                           placeholder="Enter Model">
                </div>
                <div class="form-group">
                    <label for="">Number of Items</label>
                    <input type="number" class="form-control" max="20" min="1"
                           ng-model="record.number"
                           placeholder="Enter Total Number">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" disabled class="form-control" ng-model="record.price"
                           placeholder="Enter Total Number">
                </div>
                <div class="form-group">
                    <button class="btn btn-success"
                            ng-click="bill(customerId,name,contact,record.id,record.number) {{--saleItem(customerId,name,contact,record.id,record.number)--}}; modal.close()">
                        Sale
                    </button>
                </div>
            </div>
        </div>
    </div>

</script>
