'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('HelpCtrl', function ($scope,$timeout, $location, $rootScope,czFactory) {
        $scope.helpList = {};
        $scope.gotoHome = function () {
            $location.url('/');
        };

        $scope.gotoDetail = function (id) {
            $location.url('help-detail/'+id);
        };

        $scope.getHelpList = function () {
            czFactory.help.getHelpList(function(data){
                $scope.helpList = data.info;
            },function(data){
                alert(data.info);
            });
        };

        $scope.getHelpList();
    });

