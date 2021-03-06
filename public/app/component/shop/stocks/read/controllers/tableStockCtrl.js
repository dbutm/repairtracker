/**
 * Created by dylan on 27-Jul-16.
 */
app.controller("tableStockCtrl",function ($scope,serverServices,$uibModal,toaster) {
    getAllStocksData();

    function getAllStocksData() {
        serverServices.get('api/stocks').then(function (response) {
                $scope.displayedCollection = [];  // displayed collection--->used by angular scope
                $scope.rowCollection = [];  // base collection--->used to store data from Async from server , to be used by angular Scope
                $scope.rowCollection = response; //update the original Array ,this is used so as to Synchronised Scope with asynchronous data obtain from dserver
                $scope.displayedCollection = [].concat($scope.rowCollection);  ///insert the data from server with the one used by angular scope
            },
            function (error) {
                toaster.pop('error', "Server Error : "+error.status, "An error ocuured ,try reload the page");
                console.log(error);
            });
    }
    $scope.deleteBtn = function (stockId) {
        serverServices.delete("api/stock/"+stockId).then(function (response) {
            getAllStocksData();
        });
    };
});