'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('MapCtrl', function ($scope,$timeout, $location, $rootScope,czFactory) {
        $scope.cont = ''
        $scope.provincialList = [];
        $scope.provincial = {};
        // $scope.provincial.id = 0;

        $scope.cityList = [];
        $scope.city = {};
        $scope.hospitalList = [];
        $scope.gotoHome = function () {
            $location.url('/');
        }

        $scope.gotoDetail = function (id,pid) {
            if(pid == 0){
                $location.url('map-hospital/'+id);
            }else{
                $location.url('map-doctor/'+id);

            }
        }

        $scope.getHospitalList = function () {
            czFactory.map.getHospitalList({
                cont:$scope.cont,
                provincial_id:$scope.provincial.id,
                city_id:$scope.city.id
            },function(data){
                $scope.hospitalList = data.info;
            },function(data){
                alert(data.info);
            });
        };

        $scope.getHospitalList();

        $scope.getProvincialList = function () {
            czFactory.map.getProvincialList(function(data){
                $scope.provincialList = data.info;
            },function(data){
                alert(data.info);
            });
        };
        $scope.getProvincialList();

        $scope.getCityList = function () {
            czFactory.map.getCityList({
                id:$scope.provincial.id
            },function(data){
                $scope.cityList = data.info;
            },function(data){
                alert(data.info);
            });
        };
        $scope.getList = function () {
            $scope.getCityList();
            $scope.getHospitalList();
        };

    });

