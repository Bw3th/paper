<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Addons\Cities\Controller;
use Home\Controller\AddonsController; 

class CitiesController extends AddonsController{
	
	public function getCity(){
  	$ParentId=I('post.ParentId');
  	$current_city=M('vc_citys')->where('ParentId='.$ParentId)->select();
  	$data['data']=$current_city;
  	$this->ajaxReturn($data);
  }
  
  public function getCounty(){
  	$ParentId=I('post.ParentId');
  	$current_county=M('vc_citys')->where('ParentId='.$ParentId)->select();
  	$data['data']=$current_county;
  	$this->ajaxReturn($data);
  }

}
