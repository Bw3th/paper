'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('LiveDetailCtrl', function ($scope,$timeout, $location, $rootScope,$routeParams,czFactory) {
        $scope.info = [];
        $scope.gotoLive = function () {
            $location.url('live');
        };

        $scope.gotoHome = function () {
            $location.url('/');
        };
        $scope.getLiveDetail = function () {
            czFactory.live.getLiveDetail({
                id:$routeParams.id
            },function(data){
                $scope.info = data.info;
            },function(data){
                alert(data.info);
            });
        };
        $scope.getLiveDetail();
    });

