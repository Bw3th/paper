'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('AnswerCtrl', function ($scope,$timeout, $location, $rootScope,czFactory) {
        $scope.answerList = {};
        $scope.gotoHome = function () {
            $location.url('/');
        };

        $scope.gotoDetail = function (id) {
            $location.url('answer-detail/'+id);
        };

        $scope.getAnswerList = function () {
            czFactory.answer.getAnswerList(function(data){
                $scope.answerList = data.info;
            },function(data){
                alert(data.info);
            });
        };

        $scope.getAnswerList();


    });


