/**
 * Created by dylan on 23-Jul-16.
 */
app.controller("employeesIndexCtrl",function ($scope,$stateParams,$state) {
    $scope.EmployeeTab   = [
        {
            heading: '<span class="fa fa-eye text-info" aria-hidden="true"></span>View Employee',
            route:   'app.employee.read-all'
        },
        {
            heading: '<span class="fa fa-plus text-info" aria-hidden="true" ></span>create Employee',
            route:   'app.employee.create'
        }
    ];
    


});