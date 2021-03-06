<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class HomeController extends Controller {

	/* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('Index/index');
	}


    protected function _initialize(){
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置

        if(!C('WEB_SITE_CLOSE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
    }

	/* 用户登录检测 */
	protected function login(){
		/* 用户登录检测 */
		is_login() || $this->error('您还没有登录，请先登录！', U('User/login'));
	}

	
	private function get_url() {
	    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
	    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
	    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
 	}
 	public function auth_check(){
 		if (is_login()) {
			return;
		}
		else{
			$this->oauth();
		}
 	}

	public function oauth(){
		if (is_login()) {
			return;
		}
		$oauth = new Oauth();
		$oauth->init($this->get_url());
		
		//通过code获得openid
		if (!isset($_GET['code'])){			
			session('weixin_login_url',$this->get_url());
			$url = $oauth->get_code_by_authorize(1);
			exit();
		} else {
			//获取code码，以获取openid
		  	$code = $_GET['code'];
			$user_info = $oauth->get_userinfo_by_authorize($code);
			//Login user
			if (session('weixin_login_url')){
				$url = session('weixin_login_url');
				session('weixin_login_url',null);
			}
			else {
				$url = U('Home/Index/index');
			}
			if($user_info && $user_info['openid']){
				$userApi = new UserApi();
				$uid = $userApi->createUserByWx($user_info);
				if($uid){
					$this->login_member($uid, $user_info);
				}
				else{
					E('未获取到用户信息');
				}
				header("Location: $url");
			}
			else{
				E('Oauth 失败');
			}
		}
	}
	/**
	*未注册的话会自动注册
	*/
	private function login_member($uid, $user_info){
		$Member = D('Member');
		if($Member->login($uid, $user_info)){ //登录用户
			return true;
		} else {
			$this->error($Member->getError());
		}
	}


}
