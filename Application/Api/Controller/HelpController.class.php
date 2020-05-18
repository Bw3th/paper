<?php
/**
 * Created by PhpStorm.
 * User: 29588
 * Date: 2020/1/14
 * Time: 14:18
 */

namespace Api\Controller;


class HelpController extends BaseController
{
    /**
     * 获取助力解结列表
     * @author zzl
     * @date 2020/1/14
     */
    public function getHelpList()
    {
        $list = M('help')
            ->field('id,title,img,author')
            ->where(array('is_deleted'=>0))
            ->order('create_time desc')
            ->select();
        $this->response(array('info'=>$list),json,200);
    }

    /**
     * 获取详情
     * @author zzl
     * @date 2020/1/14
     */
    public function getHelpDetail()
    {
        $id = I('get.id');
        $info = M('help')
            ->field('title,create_time,video')
            ->where(array('id'=>$id))
            ->find();
        $this->response(array('info'=>$info),json,200);
    }
}