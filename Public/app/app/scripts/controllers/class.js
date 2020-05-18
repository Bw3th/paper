'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('ClassCtrl', function ($scope,$timeout, $location, $rootScope,czFactory) {
        $scope.classList = {};
        $scope.gotoHome = function () {
            $location.url('/');
        };

        $scope.gotoDetail = function (id) {
            $location.url('class-detail/'+id);
        };

        $scope.getClassList = function () {
            czFactory.class.getClassList(function(data){
                $scope.classList = data.info;
            },function(data){
                alert(data.info);
            });
        };

        $scope.getClassList();
    });


