'use strict';

/**
 * @ngdoc overview
 * @name appApp
 * @description
 * # appApp
 *
 * Main module of the application.
 */
angular
  .module('appApp', [
    'ngAnimate',
    'ngAria',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ])

  .config(function ($routeProvider,$locationProvider) {
      $locationProvider.hashPrefix('')
    $routeProvider
      .when('/', {
        title:'苹果社区',
        templateUrl: 'views/home.html',
        controller: 'HomeCtrl',
        controllerAs: 'home'
      })
      .when('/live', {
        title:'苹果社区',
        templateUrl: 'views/live.html',
        controller: 'LiveCtrl',
        controllerAs: 'live'
      })
        .when('/live-detail/:id', {
            title:'苹果社区',
            templateUrl: 'views/live-detail.html',
            controller: 'LiveDetailCtrl',
            controllerAs: 'liveDetail'
        })
      .when('/knowledge', {
        title:'苹果社区',
        templateUrl: 'views/knowledge.html',
        controller: 'KnowledgeCtrl',
        controllerAs: 'knowledge'
      })
        .when('/knowledge-detail/:id', {
            title:'苹果社区',
            templateUrl: 'views/knowledge-detail.html',
            controller: 'KnowledgeDetailCtrl',
            controllerAs: 'knowledgeDetail'
        })
        .when('/help', {
            title:'苹果社区',
            templateUrl: 'views/help.html',
            controller: 'HelpCtrl',
            controllerAs: 'help'
        })
        .when('/help-detail/:id', {
            title:'苹果社区',
            templateUrl: 'views/help-detail.html',
            controller: 'HelpDetailCtrl',
            controllerAs: 'helpDetail'
        })
        .when('/class', {
            title:'苹果社区',
            templateUrl: 'views/class.html',
            controller: 'ClassCtrl',
            controllerAs: 'class'
        })
        .when('/class-detail/:id', {
            title:'苹果社区',
            templateUrl: 'views/class-detail.html',
            controller: 'ClassDetailCtrl',
            controllerAs: 'classDetail'
        })
        .when('/answer', {
            title:'苹果社区',
            templateUrl: 'views/answer.html',
            controller: 'AnswerCtrl',
            controllerAs: 'answer'
        })
        .when('/answer-detail/:id', {
            title:'苹果社区',
            templateUrl: 'views/answer-detail.html',
            controller: 'AnswerDetailCtrl',
            controllerAs: 'answerDetail'
        })
        .when('/map', {
            title:'苹果社区',
            templateUrl: 'views/map.html',
            controller: 'MapCtrl',
            controllerAs: 'map'
        })
        .when('/map-hospital/:id', {
            title:'苹果社区',
            templateUrl: 'views/map-hospital.html',
            controller: 'MapHospitalCtrl',
            controllerAs: 'mapHospital'
        })
        .when('/map-doctor/:id', {
            title:'苹果社区',
            templateUrl: 'views/map-doctor.html',
            controller: 'MapDoctorCtrl',
            controllerAs: 'mapDoctor'
        })
      .when('/about', {
        templateUrl: 'views/about.html',
        controller: 'AboutCtrl',
        controllerAs: 'about'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
