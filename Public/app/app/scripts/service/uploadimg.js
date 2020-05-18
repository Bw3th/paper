'use strict';

/**
 * @ngdoc service
 * @name patientApp.uploadImg
 * @description
 * # uploadImg
 * Service in the patientApp.
 */
angular.module('appApp')
  .service('uploadImg', function ($http, cfg, $location, $q, $rootScope, czFactory) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    //单图上传并下载：
    //步骤一：
    //在app.js中调用imgUpload.initWxSdk()初始化WxJssdk
    //步骤二：
    //在上传图片处，调用imgUpload.uploadSingleImage().then(function(data){}),其中function(data)中的data为传回的服务器图片路径（e.g:/Uploads/...）
    
    var chooseWxImg = function(){
      var deferred = $q.defer();
      var data = {};
      var serverIds = [];
      wx.chooseImage({
      count: 1,
      success: function (res) {          
         var localIds = res.localIds;
         if(!localIds || !localIds[0]){
           return;
         }
         wx.uploadImage({
           localId: localIds[0], 
           isShowProgressTips: 1,
           success: function (res) {
             serverIds.push(res.serverId);
             data.serverIds = serverIds;
             data.localIds = localIds;
             deferred.resolve(data);
           },
           error: function(res){
             alert(res);
           }
         });
        },
        error: function(res){
          alert(res);
        }
      });
      return deferred.promise;
    }

    var downloadImg = function(serverIds){
      var deferred = $q.defer();
      $http.get(cfg.baseUrl + 'api/wechat/downloadImage?media_id=' + serverIds).then(function(data){
        deferred.resolve(data);
      },function(data){
        alert(data.data.msg);
      });
      return deferred.promise;
    }
    return {
      initWxSdk : function(){
        $http({
          method: 'get',
          url: cfg.baseUrl+'api/wechat/getSignPackage'+'?url='+encodeURIComponent($location.absUrl().split('#')[0])
        }).then(function(data){
          data = data.data;
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
                        'onMenuShareAppMessage',
                        'onMenuShareTimeline'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
          });
        });
      },
      chooseWxImg : function(){
        var deferred = $q.defer();
        var data = {};
        var serverIds = [];
        wx.chooseImage({
        count: 1,
        success: function (res) {          
           var localIds = res.localIds;
           if(!localIds || !localIds[0]){
             return;
           }
           wx.uploadImage({
             localId: localIds[0], 
             isShowProgressTips: 1,
             success: function (res) {
               serverIds.push(res.serverId);
               data.serverIds = serverIds;
               data.localIds = localIds;
               deferred.resolve(data);
             },
             error: function(res){
               alert(res);
             }
           });
          },
          error: function(res){
            alert(res);
          }
        });
        return deferred.promise;
      },
      downloadImg : function(serverIds){
        var deferred = $q.defer();
        $http.get(cfg.baseUrl + 'api/wechat/downloadImage?media_id=' + serverIds).then(function(data){
          deferred.resolve(data);
        },function(data){
          alert(data.data.info);
        });
        return deferred.promise;
      }, 
      downloadImgs : function(serverIds){
        var deferred = $q.defer();
        czFactory.wechat.downloadimages({
          media_id: serverIds
         },function(data){
            deferred.resolve(data);
         },function(data){
            alert(data.data.info);
         });
        return deferred.promise;
      }, 
      uploadSingleImage : function(){
        var deferred = $q.defer();
        var choseImgPromise = chooseWxImg();
        choseImgPromise.then(function(data){
          var serverIds = JSON.stringify(data.serverIds);
          var downloadImgPromise = downloadImg(serverIds);
          downloadImgPromise.then(function(data){
            deferred.resolve(data);
          });
        });
        return deferred.promise;
      },
      previewImg : function(pic,pics){
        wx.previewImage({
          current: pic, // 当前显示图片的http链接
          urls: pics // 需要预览的图片http链接列表
        });
      },
      shareLink: function(title,desc,link,imgUrl){
        wx.onMenuShareAppMessage({
          title: title, // 分享标题
          desc: desc, // 分享描述
          link: link, // 分享链接
          imgUrl: cfg.baseImgUrl + imgUrl, // 分享图标
          type: '', // 分享类型,music、video或link，不填默认为link
          dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
          success: function () { 
              // 用户确认分享后执行的回调函数
          },
          cancel: function () { 
              // 用户取消分享后执行的回调函数
          }
        })
      },
      shareLink2: function(title,link,imgUrl){
        wx.onMenuShareTimeline({
          title: title, // 分享标题
          link: link, // 分享链接
          imgUrl: cfg.baseImgUrl + imgUrl, // 分享图标
          type: '', // 分享类型,music、video或link，不填默认为link
          dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
          success: function () { 
              // 用户确认分享后执行的回调函数
          },
          cancel: function () { 
              // 用户取消分享后执行的回调函数
          }
        })
      }
    }
  });
