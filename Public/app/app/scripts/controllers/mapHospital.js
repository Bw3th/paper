'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('MapHospitalCtrl', function ($scope,$timeout, $location, $rootScope,$routeParams,czFactory) {
        $scope.selectInfo = 1;
        $scope.info = {};
        $scope.doctorInfo = {};
        $scope.getHospitalDetail = function () {
            czFactory.map.getHospitalDetail({
                id:$routeParams.id
            },function(data){
                $scope.info = data.info;
                $scope.doctorInfo = data.list;
            },function(data){
                alert(data.info);
            });
        };
        $scope.getHospitalDetail();


        $scope.gotoHome = function () {
            $location.url('/');
        };
        $scope.gotoMap = function () {
            $location.url('map');
        };
        $scope.gotoDetail = function () {
            $location.url('map-doctor');
        }
        $scope.selectCont = function (index) {
            $scope.selectInfo = index;
        };


    });

