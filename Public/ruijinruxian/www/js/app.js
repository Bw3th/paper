// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['ionic', 'starter.controllers', 'starter.services', 'ngResource'])

.run(function($ionicPlatform, $rootScope,$ionicHistory,$http,cfg,$location,$anchorScroll) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });

  $rootScope.setTitle = function(title){
    if(!title){
      document.title = '习业';
    }else{
      document.title = title;
    }
    var $body = $('body');
    // hack在微信等webview中无法修改document.title的情况
    var $iframe = $('<iframe src="" style="display:none"></iframe>').on('load', function() {
      setTimeout(function() {
        $iframe.off('load').remove()
      }, 0)
    }).appendTo($body)
  }

  $rootScope.clearHistory = function(){
    $ionicHistory.clearHistory();
  };

  $rootScope.$on('$stateChangeStart',
  function(event, toState, toParams, fromState, fromParams, cfg){
      if(toState.hideTab){
        $rootScope.hideTab = true;
      }
      else{
        $rootScope.hideTab = false;
      }
      $rootScope.setTitle(toState.title);
  });

  $http({
    method: 'get',
    url: cfg.baseUrl+'api/wechat/getSignPackage'+'?url='+encodeURIComponent($location.absUrl().split('#')[0])
  }).success(function(data){
    wx.error(function(res){
      alert(JSON.stringify(res));
    });
    wx.config({
      debug: false,
      appId: data.appId,
      timestamp: parseInt(data.timestamp),
      nonceStr: data.nonceStr,
      signature: data.signature,
      jsApiList: ['chooseImage',
                  'uploadImage',
                  'downloadImage',
                  'previewImage',
                  'onMenuShareTimeline',
                  'onMenuShareAppMessage',
                  'getLocation',
                  'openLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
  });

  wx.ready(function(){
    wx.onMenuShareTimeline({//朋友圈
      title: '了解肿瘤防治知识，获取健康体检券——“走遍中国前列县(腺)”网络科普公益活动', // 分享标题
      desc: '欢迎参加“走遍中国前列县(腺)”网络科普公益活动，了解肿瘤防治知识，获取健康体检券！', // 分享描述
      link: cfg.baseUrl + 'home/index/home', // 分享链接
      imgUrl: cfg.baseImgUrl + '/Public/awq/www/img/artical01.png', // 分享图标
      success: function () { 
          // 用户确认分享后执行的回调函数
      },
      cancel: function () { 
          // 用户取消分享后执行的回调函数
      }
    });

    wx.onMenuShareAppMessage({
      title: '了解肿瘤防治知识，获取健康体检券——“走遍中国前列县(腺)”网络科普公益活动', // 分享标题
      desc: '欢迎参加“走遍中国前列县(腺)”网络科普公益活动，了解肿瘤防治知识，获取健康体检券！', // 分享描述
      link: cfg.baseUrl + 'home/index/home', // 分享链接
      imgUrl: cfg.baseImgUrl + '/Public/awq/www/img/artical01.png', // 分享图标
      type: '', // 分享类型,music、video或link，不填默认为link
      dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
      success: function () { 
          // 用户确认分享后执行的回调函数
      },
      cancel: function () { 
          // 用户取消分享后执行的回调函数
      }
    });
  })
})

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider

  // setup an abstract state for the tabs directive
    .state('tab', {
    url: '/tab',
    abstract: true,
    templateUrl: 'templates/tabs.html'
  })

  // Each tab has its own nav history stack:

  .state('tab.dash', {
    url: '/dash',
    views: {
      'tab-dash': {
        templateUrl: 'templates/tab-dash.html',
        controller: 'DashCtrl'
      }
    }
  })

  .state('tab.chats', {
      url: '/chats',
      views: {
        'tab-chats': {
          templateUrl: 'templates/tab-chats.html',
          controller: 'ChatsCtrl'
        }
      }
    })
    .state('tab.chat-detail', {
      url: '/chats/:chatId',
      views: {
        'tab-chats': {
          templateUrl: 'templates/chat-detail.html',
          controller: 'ChatDetailCtrl'
        }
      }
    })

  .state('tab.account', {
    url: '/account',
    views: {
      'tab-account': {
        templateUrl: 'templates/tab-account.html',
        controller: 'AccountCtrl'
      }
    }
  });

  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/tab/dash');

})
.config(function($httpProvider){
  $httpProvider.interceptors.push(function($q) {
    return {
      'responseError': function(rejection) {
        if(rejection.status == 401){
          window.location.href = "http://awq.xoncology.org/home/index/home";
        }
        return $q.reject(rejection);
      }
    };
  });
})
.filter('trustHtml', function ($sce) {
  return function (input) {
    return $sce.trustAsHtml(input);
  };
});
