'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('HelpDetailCtrl', function ($scope,$timeout, $location, $rootScope,$routeParams,czFactory) {
        $scope.helpInfo = [];
        $scope.gotoKnowledge = function () {
            $location.url('help');
        };

        $scope.gotoHome = function () {
            $location.url('/');
        };
        $scope.getHelpDetail = function () {
            czFactory.help.getHelpDetail({
                id:$routeParams.id
            },function(data){
                $scope.helpInfo = data.info;
            },function(data){
                alert(data.info);
            });
        };

        $scope.getHelpDetail();
    });
