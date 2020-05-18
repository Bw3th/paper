'use strict';

/**
 * @ngdoc service
 * @name appApp.zhongliuFactory
 * @description
 * # zhongliuFactory
 * Factory in the appApp.
 */
angular.module('appApp')
  .factory('czFactory', function ($resource, cfg) {
    // Service logic
    // ...

    var meaningOfLife = 42;

    // Public API here
    return {
      map: $resource(cfg.baseUrl + 'api/map/:action', {},{
        'getProvincialList': {method:'GET', params:{action:'getProvincialList'},isArray:false},
        'getCityList': {method:'GET', params:{action:'getCityList'},isArray:false},
        'getHospitalList': {method:'POST', params:{action:'getHospitalList'},isArray:false},
        'getHospitalDetail': {method:'GET', params:{action:'getHospitalDetail'},isArray:false},
        'getDoctorDetail': {method:'GET', params:{action:'getDoctorDetail'},isArray:false},
      }),
      answer: $resource(cfg.baseUrl + 'api/answer/:action', {},{
        'getAnswerList': {method:'GET', params:{action:'getAnswerList'},isArray:false},
        'getAnswerDetail': {method:'GET', params:{action:'getAnswerDetail'},isArray:false},
      }),
      class: $resource(cfg.baseUrl + 'api/class/:action', {},{
        'getClassList': {method:'GET', params:{action:'getClassList'},isArray:false},
        'getClassDetail': {method:'GET', params:{action:'getClassDetail'},isArray:false},
      }),
      help: $resource(cfg.baseUrl + 'api/help/:action', {},{
        'getHelpList': {method:'GET', params:{action:'getHelpList'},isArray:false},
        'getHelpDetail': {method:'GET', params:{action:'getHelpDetail'},isArray:false},
      }),
      knowledge: $resource(cfg.baseUrl + 'api/knowledge/:action', {},{
        'getKnowledgeList': {method:'GET', params:{action:'getKnowledgeList'},isArray:false},
        'getKnowledgeDetail': {method:'GET', params:{action:'getKnowledgeDetail'},isArray:false},
      }),
      live: $resource(cfg.baseUrl + 'api/live/:action', {},{
        'getLiveList': {method:'GET', params:{action:'getLiveList'},isArray:false},
        'getLiveDetail': {method:'GET', params:{action:'getLiveDetail'},isArray:false},
      })
    };
  })
;