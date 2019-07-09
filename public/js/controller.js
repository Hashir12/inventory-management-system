var myApp = angular.module('myApp', ['ui.bootstrap', 'toaster']);
// myApp.directive('nvdQrCode', QrCodeDirective);
//
// function QrCodeDirective() {
//     return {
//         restrict: 'E',
//         template: '<div id="nvd-qr-code"></div>',
//         scope: {
//             content: '='
//         },
//         link: function (scope, elem, attrs) {
//             scope.$watch('content', function () {
//                 var content = scope.content;
//                 if (typeof content !== 'string')
//                     content = JSON.stringify(scope.content);
//                 new QRCode(elem.children().eq(0)[0], content);
//             });
//         }
//     };
// }

myApp.controller('myController', function ($scope, $http, toaster, $uibModal) {
        $scope.state = {
            page: 'Login',
            record: {},
        };
        $scope.record = [];

        $scope.bill = [];
        $scope.discount = 0;

        $scope.successPopUp = function ($title, $message) {
            toaster.pop({
                type: 'success',
                title: $title,
                body: $message,
                timeout: 3000
            });
        };

        $scope.errorPopUp = function ($title, $message) {
            toaster.pop({
                type: 'error',
                title: $title,
                body: $message,
                timeout: 3000
            });
        };

        $scope.params = {
            totalItems: 0,
            page: 1,
            perPage: 5,
            id: ''
        };

        $scope.Productparams = {
            totalItems: 0,
            page: 1,
            perPage: 5,
            searchName: '',
            orderBy: '',
            orderDirection: 'asc'
        };

        $scope.fetchData = function () {
            $http({
                url: 'fetchData',
                method: 'get',
                params: $scope.Productparams
            }).then(function (res) {
                $scope.records = res.data.data
                $scope.Productparams.totalItems = res.data.total

            })
        }
        $scope.fetchData();

        $scope.orderBy = function (column) {
            $scope.Productparams.orderBy = column;
            $scope.Productparams.orderDirection = $scope.Productparams.orderDirection === 'asc' ? 'desc' : 'asc';
            $scope.fetchData();
        };

        $scope.addRecord = function () {
            $http({
                url: 'addRecord',
                method: 'post',
                data: {
                    name: $scope.itemname,
                    company: $scope.companyname,
                    model: $scope.model,
                    color: $scope.color,
                    number: $scope.number,
                    price: $scope.price
                },
            }).then(function () {
                $scope.itemname = null;
                $scope.companyname = null;
                $scope.model = null;
                $scope.color = null;
                $scope.number = null;
                $scope.price = null;
                $scope.fetchData();
                $scope.successPopUp('Success', 'Record Added Successfully');
            })
        }

        $scope.userSignup = function (username, password, email) {
            $http({
                url: 'signup',
                method: 'post',
                data: {username: username, password: password, email: email}
            }).then(function (res) {

            }).catch(function (res) {
                $scope.errors = res.data.errors;
            })
        }

        $scope.addItem = function (record) {
            record.number++;
            $http({
                url: 'additem',
                method: 'post',
                data: {id: record.id, qty: record.number}
            }).then(function () {
                $scope.fetchData();
            })
        }

        $scope.changestatus = function (record) {
            if (record.product_status == 'active')
                record.product_status = 'inactive';
            else
                record.product_status = 'active';
            $http({
                url: 'changeStatus',
                method: 'post',
                data: {id: record.id}
            }).then(function (res) {
                record.product_status = res.data.product_status;
            })
        }

        $scope.lessItem = function (record) {
            if (record.number <= 0) {
                return;
            }
            record.number--;
            $http({
                url: 'lessitem',
                method: 'post',
                data: {id: record.id, qty: record.number}
            }).then(function () {
                $scope.fetchData();
            })
        }

        $scope.activeRecord = function (records) {
            $http({
                url: 'active',
                method: 'post',
                data: {product_status: records, active: true}
            }).then(function (res) {
                    $scope.records = res.data;
                }
            )
        }

        $scope.inactiveRecord = function (records) {
            $http({
                url: 'active',
                method: 'post',
                data: {product_status: records}
            }).then(function (res) {
                    $scope.records = res.data;
                }
            )
        }

        $scope.zeroRecord = function (number) {
            $http({
                url: 'zeroRecord',
                method: 'post',
                data: {number: number}
            }).then(function (res) {
                $scope.records = res.data;
            })
        }

        $scope.fetchCustomers = function () {
            $http({
                url: 'customers',
                method: 'get',
                params: $scope.params
            }).then(function (res) {
                $scope.customers = res.data.data;
                $scope.params.totalItems = res.data.total;
            })
        }
        $scope.fetchCustomers();

        $scope.fetchUsers = function () {
            $http({
                url: 'fetchUsers',
                method: 'get',
            }).then(function (res) {
                    $scope.users = res.data.users;
                    $scope.month = new Date().getMonth() + 1;
                    $scope.year = new Date().getFullYear();
                }
            )
        }
        $scope.fetchUsers();

        $scope.showProducts = function (user) {
            $scope.currentUser = user;
            $scope.month = new Date().getMonth() + 1;
            $scope.year = new Date().getFullYear();
            $scope.state.page = 'SoldItems';

        }

        $scope.userRole = function (user) {
            $http({
                url: 'userRole',
                method: 'post',
                data: {id: user.id}
            }).then(function (res) {
                user.user_type = res.data.user_type;

            })
        }

        $scope.usershop = function (user, shop) {
            $http({
                url: 'usershop',
                method: 'post',
                data: {id: user.id, shop: shop}
            }).then(function (res) {
                user.user_role = res.data.user_role;
            })
        };

        $scope.selectMonth = function (year, month, product) {
            $http({
                url: 'recordData',
                method: 'post',
                data: {year: year, month: month, userId: product.id}
            }).then(function (res) {
                $scope.userSale = res.data;
                //getting total price
                $scope.total = 0;
                $scope.dis = 0;
                for (var i = 0; i < $scope.userSale.length; i++) {
                    var bill = $scope.userSale[i];
                    $scope.dis += bill.discount;
                    for (var j = 0; j < bill.sale_records.length; j++) {
                        var saleRecord = bill.sale_records[j];
                        $scope.total += saleRecord.price;
                    }
                }
                $scope.state.page = 'saleItem';
            })
        };

        $scope.monthlySale = function (month, year) {
            $http({
                url: 'monthSale',
                method: 'post',
                data: {month: month, year: year}
            }).then(function (res) {
                $scope.userSale = res.data;
                $scope.total = 0;
                $scope.dis = 0;
                for (var i = 0; i < $scope.userSale.length; i++) {
                    var bill = $scope.userSale[i];
                    $scope.dis += bill.discount;
                    for (var j = 0; j < bill.sale_records.length; j++) {
                        var saleRecord = bill.sale_records[j];
                        $scope.total += saleRecord.price;
                    }
                }
                $scope.state.page = 'saleItem';
            })
        }

        $scope.totalBill = function () {
            var total = 0;
            for (var i = 0; i < $scope.bill.length; i++) {
                var item = $scope.bill[i];
                total += item.price * item.number;
            }
            return total;
        }

        $scope.addToBill = function (record) {
            record.number = record.number - 1;
            // if already exists
            var existing = $scope.bill.findOne(function (item) {
                return item.id == record.id;
            })

            if (existing) {
                existing.number++;
                return;
            }
            // if the record does not exist in the bill

            var duplicateRecord = angular.extend({}, record);
            duplicateRecord.number = 1;
            $scope.bill.push(duplicateRecord);
            $scope.record.push(record);
        };

        $scope.recover = function (email) {
            $http({
                url: 'recoverPassword',
                method: 'post',
                data: {email: email}
            }).then(function (res) {
                $scope.error = res.data;
                if (!$scope.error) {
                    toaster.pop('success', 'Mail sent to your Email');
                    $scope.state.page = 'Login';
                }
                if ($scope.error) {
                    toaster.pop('error', $scope.error)
                }
            }).catch(function (res) {
                console.log(res.data);
                $scope.errors = res.data.errors.email[0];
                toaster.pop('error', $scope.errors);
            })
        }

        $scope.changePassword = function (npass, cpass) {
            $http({
                url: 'resetPass',
                method: 'post',
                data: {new: npass, con: cpass}
            }).then(function (res) {
                $scope.errors = res.data;
                if ($scope.errors) {
                    toaster.pop('error', $scope.errors);
                }
                if (!$scope.errors) {
                    toaster.pop('success', 'Password has changed Successfully');
                }
                $scope.state.page = 'Login';
            }).catch(function (res) {
                console.log(res.data);
                $scope.errors = res.data.errors;

            })
        }

        $scope.Addaction = function (record) {

            var existing = $scope.record.findOne(function (item) {
                return item.id == record.id;
            });
            if (existing.number != 0) {

                record.number = record.number + 1;
            }
            if (existing) {
                if (existing.number > 0) {
                    existing.number--;
                    return;
                }
            }
        }

        $scope.Lessaction = function (record) {
            var existing = $scope.record.findOne(function (item) {
                return item.id == record.id;
            });

            if (record.number != 0) {
                record.number = record.number - 1;
            }
            if (existing) {
                if (record.number != 0) {
                    existing.number++;
                    return;
                }
            }
            if (record.number <= 0) {
                record.number = 1;
            }
            return record;
        }

        $scope.emptyRecord = function (record) {
            var data = $scope.bill.findOne(function (item) {
                return item.id == record.id;
            });

            $scope.bill.remove(data);
        }

        $scope.clearData = function () {
            if ($scope.bill) {
                $scope.bill = [];
            }
            $scope.fetchData();
        }

        $scope.search = function (name) {
            $http({
                url: 'test',
                method: 'post',
                data: {name: name},
            }).then(function (res) {
                $scope.items = res.data;

            });
        }

        $scope.itemName = function (id, name, contact) {
            $scope.customerId = id;
            $scope.name = name;
            $scope.contact = contact;
            $scope.items = null;
        }

        $scope.errors = {};
        $scope.saleRecord = function (customerId, name, contact, discount, bill) {
            $http({
                url: 'saleitem',
                method: 'post',
                data: {
                    customerId: customerId, name: name, contact: contact, discount: discount, bill: bill
                }
            }).then(function (res) {
                $scope.bill = [];
                toaster.pop('success', 'Saved');
                $scope.soldData = res.data;
                $scope.state.page = 'model';
            }).catch(function (res) {
                $scope.errors = res.data.errors;
            });
        }

        $scope.recieptTotal = function (soldRecord) {
            var total = 0;
            if (soldRecord) {
                for (var i = 0; i < soldRecord.length; i++) {
                    var price = soldRecord[i];
                    total += price.price * price.number
                }
            }
            return total;
        }

        $scope.netTotal = function (Record) {
            var total = 0;
            if (Record) {
                for (var i = 0; i < Record.soldRecord.length; i++) {
                    var price = Record.soldRecord[i];
                    total += price.price * price.number;
                    var data = total - Record['discount'];
                }
            }
            return data;
        }

        $scope.totalPrice = function (record) {
            var total = 0;
            if (record) {
                for (var i = 0; i < record.length; i++) {
                    var recordPrice = record[i];
                    total += recordPrice['price'];
                }
            }
            return total;
        }

        $scope.totalamount = function (saleItems) {
            var total = 0;
            if (saleItems) {
                for (var i = 0; i < saleItems.length; i++) {
                    var data = saleItems[i]
                    total += data.price
                }
            }
            return total;
        }

        $scope.billRecords = function (saleRecords) {
            $scope.saleItems = saleRecords;
            $scope.state.page = 'ItemRecords';
        }


        $scope.openDeleteModal = function (user) {
            var modal = $uibModal.open({
                animation: true,
                templateUrl: 'delete-modal.html',
                controller: function ($scope) {
                    $scope.user = user;
                    $scope.modal = modal;
                    $scope.delete = function (user) {
                        $http({
                            url: 'deleteUser',
                            method: 'post',
                            data: {id: user.id}
                        }).then(function (res) {
                            modal.close();
                        })
                    }
                },
                size: 'md',
            });

            modal.result.then(function () {
                $scope.fetchUsers();
            }, function () {
            });
        }

        $scope.openEditModal = function (record) {

            var modal = $uibModal.open({
                animation: true,
                templateUrl: 'edit-modal.html',
                controller: function ($scope) {
                    $scope.record = record;
                    $scope.modal = modal;
                    $scope.UpdateRecord = function (record) {
                        $http({
                            url: 'update',
                            method: 'post',
                            data: {record: record}
                        }).then(function (res) {
                            modal.close()
                        })
                    }
                },
                size: 'md',
            });

            modal.result.then(function () {
                $scope.fetchData();
                $scope.successPopUp('Success', 'Record has been updated successfully')
            }, function () {

            });
        }

        $scope.saleItem = function (record, customerId, name, contact, id, qty) {
            var modal = $uibModal.open({
                animation: true,
                templateUrl: 'sale-modal.html',
                controller: function ($scope) {
                    $scope.record = record;
                    $scope.customerId = customerId;
                    $scope.name = name;
                    $scope.contact = contact;
                    $scope.id = id;
                    $scope.qty = qty;


                },
                size: 'md',
            });

            modal.result.then(function (res) {
                $scope.customer = res;
                $scope.state.page = 'confirm';
            }, function () {


            });
        };
    }
)
;
