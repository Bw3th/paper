'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('KnowledgeCtrl', function ($scope,$timeout, $location, $rootScope,czFactory) {
        $scope.knowledgeList = {};
        $scope.gotoHome = function () {
            $location.url('/');
        };

        $scope.gotoDetail = function (id) {
            $location.url('knowledge-detail/'+id);
        };

        $scope.getKnowledgeList = function () {
            czFactory.knowledge.getKnowledgeList(function(data){
                $scope.knowledgeList = data.info;
            },function(data){
                alert(data.info);
            });
        };

        $scope.getKnowledgeList();
    });
