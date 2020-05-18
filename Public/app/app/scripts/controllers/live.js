'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('LiveCtrl', function ($scope,$timeout, $location, $rootScope,$routeParams,czFactory) {
        $scope.liveList = {};
        $scope.gotoHome = function () {
            $location.url('/');
        };

        $scope.gotoDetail = function (id) {
            $location.url('live-detail/'+id);
        };
        $scope.getLiveList = function () {
            czFactory.live.getLiveList(function(data){
                $scope.liveList = data.info;
            },function(data){
                alert(data.info);
            });
        };

        $scope.getLiveList();
    });
