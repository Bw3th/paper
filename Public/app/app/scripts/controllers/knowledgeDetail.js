'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('KnowledgeDetailCtrl', function ($scope,$timeout, $location, $rootScope,$routeParams,czFactory) {
        $scope.info = [];
        $scope.gotoKnowledge = function () {
            $location.url('knowledge');
        };

        $scope.gotoHome = function () {
            $location.url('/');
        };
        $scope.getKnowledgeDetail = function () {
            czFactory.knowledge.getKnowledgeDetail({
                id:$routeParams.id
            },function(data){
                $scope.info = data.info;
            },function(data){
                alert(data.info);
            });
        };
        $scope.getKnowledgeDetail();
    });

