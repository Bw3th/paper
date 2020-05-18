'use strict';
angular.module('starter')
.value('cfg', {
    // baseUrl: 'http://awq.xoncology.com/',
    // baseImgUrl: 'http://awq.xoncology.com'
    baseUrl: '/ruijinruxian/index.php/',
    baseImgUrl: '/ruijinruxian'
})
.config(['$compileProvider', function($compileProvider) {
    $compileProvider.imgSrcSanitizationWhitelist(/^\s*(https?|weixin|wxlocalresource):/);
    //其中 weixin 是微信安卓版的 localId 的形式，wxlocalresource 是 iOS 版本的 localId 形式
}]);