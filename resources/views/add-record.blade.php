<!-- Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {{--Data Input--}}
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <h4 align="center">Add New Records</h4>
                        </div>

                        <div class="form-group">
                            <label for="">Item Name</label>
                            <input type="text" class="form-control" placeholder="Enter Item Name" ng-model="itemname">
                        </div>
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <input type="text" class="form-control" placeholder="Enter Company Name"
                                   ng-model="companyname">
                        </div>
                        <div class="form-group">
                            <label for="">Model</label>
                            <input type="text" class="form-control" placeholder="Enter Model" ng-model="model">
                        </div>
                        <div class="form-group">
                            <label for="">Color</label>
                            <input type="text" class="form-control" placeholder="Enter Color" ng-model="color">
                        </div>
                        <div class="form-group">
                            <label for="">Total Number Recieved</label>
                            <input type="text" class="form-control" placeholder="Enter Total Number" ng-model="number">
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="text" class="form-control" placeholder="Enter Total Number" ng-model="price">
                        </div>
                        <div class="form-group">
                            <button type="submit" ng-click="addRecord()" class="btn btn-primary">Add Record</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>