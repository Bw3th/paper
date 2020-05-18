'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('HomeCtrl', function ($scope,$timeout, $location, $rootScope) {

    $timeout(function() {
        var swiper = new Swiper ('.swiper-container', {
            direction: 'horizontal',
            loop: true,
            pagination : '.swiper-pagination',
            paginationClickable :true,
        });
    },10);

    $scope.gotoLive = function () {
        $location.url('live');
    }

    $scope.gotoKnowledge = function () {
        $location.url('knowledge');
    }

    $scope.gotoHelp = function () {
        $location.url('help');
    }

    $scope.gotoClass = function () {
        $location.url('class');
    }

    $scope.gotoAnswer = function () {
        $location.url('answer');
    }

    $scope.gotoMap = function () {
        $location.url('map');
    }
});
