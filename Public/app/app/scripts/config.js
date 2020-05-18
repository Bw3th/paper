'use strict';
angular.module('appApp')
    .value('cfg',{
        // baseUrl:'http://rjss.xoncology.com/',
        // baseImgUrl:'http://rjss.xoncology.com'

        baseUrl:'/applecm/index.php/',
        baseImgUrl:'/applecm',
        baseImgUrl1:'/applecm/Public/static/'
    })
    .config(['$compileProvider', function($compileProvider) {
        $compileProvider.imgSrcSanitizationWhitelist(/^\s*(https?|weixin|wxlocalresource):/);
        //其中 weixin 是微信安卓版的 localId 的形式，wxlocalresource 是 iOS 版本的 localId 形式
    }]);