'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('MapDoctorCtrl', function ($scope,$timeout, $location, $rootScope,$routeParams,czFactory) {
        $scope.selectInfo = 1;
        $scope.info = [];
        $scope.gotoHome = function () {
            $location.url('/');
        };
        $scope.gotoBack = function () {
            history.back();
        };
        $scope.getDoctorDetail = function () {
            czFactory.map.getDoctorDetail({
                id:$routeParams.id
            },function(data){
                $scope.info = data.info;
            },function(data){
                alert(data.info);
            });
        };
        $scope.getDoctorDetail();
    });


