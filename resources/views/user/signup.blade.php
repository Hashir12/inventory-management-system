<div class="row" ng-show="state.page == 'signup'">
    <h1 align="center">User Signup</h1>
    <div class="col-md-6 col-sm-offset-3">
        <div class="form-group" ng-class="{'has-error': errors && errors.username}">
            <label for="">User Name</label>
            <input type="text" class="form-control" placeholder="Enter Username" ng-model="username"
                   ng-change="errors.username = null">
            <span class="help-block"
                  ng-repeat="error in errors.username"
                  ng-if="errors && errors.username"
            >@{{ error }}</span>
        </div>
        <div class="form-group" ng-class="{'has-error': errors && errors.password}">
            <label for="">Password</label>
            <input type="password" class="form-control" placeholder="Enter Password" ng-model="password">
            <span class="help-block"
                  ng-repeat="error in errors.password"
                  ng-if="errors && errors.password"
            >@{{ error }}</span>
        </div>
        <div class="form-group" ng-class="{'has-error': errors && errors.email}">
            <label for="">Enter your Email Address</label>
            <input class="form-control" placeholder="Email Address" ng-model="email">
            <span class="help-block"
                  ng-repeat="error in errors.email"
                  ng-if="errors && errors.email"
            >@{{ error }}</span>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" ng-click="userSignup(username,password,email)">Signup</button>
        </div>
    </div>
</div>