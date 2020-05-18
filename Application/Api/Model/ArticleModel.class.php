<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * 患者模型
 */
namespace Api\Model;
use Think\Model;
class ArticleModel extends Model{
  public function bapatientList($uid){
    if(!$uid){
      return false;
    }
    $list =$this->where(array('doctor_id'=>$uid))->select();
    return $list;
  }
}