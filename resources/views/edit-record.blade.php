<!-- Modal -->
<script type="text/ng-template" id="edit-modal.html">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Record</h4>
    </div>
    <div class="modal-body">
        {{--Edit Record--}}
        <div class="row" {{--ng-show="state.page == 'editRecord'"--}}>
            <div class="col-md-12">
                <div class="alert alert-success">
                    <h1 align="center">Edit Item</h1>
                </div>
                <div class="form-group">
                    <label for="">Item Name</label>
                    <input type="text" class="form-control" placeholder="Enter Item Name"
                           ng-model="record.itemname">
                </div>
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" class="form-control" placeholder="Enter Company Name"
                           ng-model="record.companyname">
                </div>
                <div class="form-group">
                    <label for="">Model</label>
                    <input type="text" class="form-control" placeholder="Enter Model"
                           ng-model="record.model">
                </div>
                <div class="form-group">
                    <label for="">Color</label>
                    <input type="text" class="form-control" placeholder="Enter Model"
                           ng-model="record.color">
                </div>
                <div class="form-group">
                    <label for="">Total Number Recieved</label>
                    <input type="text" class="form-control" disabled placeholder="Enter Total Number"
                           ng-model="record.number">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" class="form-control" placeholder="Enter Price"
                           ng-model="record.price">
                </div>
                <div class="form-group">
                    <button type="submit" ng-click="UpdateRecord(record)"
                            class="btn btn-success">Update
                        Record
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="modal-footer">--}}
    {{--<button type="button" class="btn btn-success" ng-click="modal.close()">No</button>--}}
    {{--<a type="submit" href ng-click="delete(user)" class="btn btn-danger">Delete</a>--}}
    {{--</div>--}}
</script>