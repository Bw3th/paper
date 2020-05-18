<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;
use Think\Controller;
use Com\Wechat\Oauth;
use User\Api\UserApi;


/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {

	public $version = ''; 
  public function oauth(){
  	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) { 
    
  	}
  	$oauth = new Oauth();
  	$oauth->init($this->get_url());
    //通过code获得openid
    if (!isset($_GET['code'])){     
      $url2 = $oauth->get_code_by_authorize(1);
      exit();
    } else {
      //获取code码，以获取openid
      $code = $_GET['code'];
      $user_info = $oauth->get_userinfo_by_authorize($code);
      if($user_info && $user_info['openid']){
        session('changhai',$user_info,1440);
        return;
      }
      else{
        E('Oauth 失败');
      }
    }
  }

  private function get_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
  }

  //系统首页
  public function index(){
    $this->oauth();
    $user = session('changhai');
    $res_user = M('doctor')->where(array('openid'=>$user['openid']))->find();
    if($res_user){
      session('changhai_id',$res_user['id'],1440);
      redirect(__ROOT__."/Public/changhai/www".$this->version."/#/home/0");
    }else{
      redirect(__ROOT__."/Public/changhai/www".$this->version."/#/select");
    }
  }

}