'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('AnswerDetailCtrl', function ($scope,$timeout, $location, $rootScope,$routeParams,czFactory) {
        $scope.gotoHome = function () {
            $location.url('/');
        };

        $scope.gotoAnswer = function () {
            $location.url('answer');
        };

        $scope.getAnswerDetail = function () {
            czFactory.answer.getAnswerDetail({
                id:$routeParams.id
            },function(data){
                $scope.info = data.info;
            },function(data){
                alert(data.info);
            });
        };
        $scope.getAnswerDetail();
    });

