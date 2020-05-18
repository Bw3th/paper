<?php
/**
 * Created by PhpStorm.
 * User: 29588
 * Date: 2020/1/14
 * Time: 13:29
 */

namespace Api\Controller;


class ClassController extends BaseController
{
    /**
     * 获取视频课堂列表
     * @author zzl
     * @date 2020/1/14
     */
    public function getClassList()
    {
        $list = M('class')
            ->alias('c')
            ->field('c.id,c.img,c.title,h.name,h1.name as hospital_name')
            ->where(array('c.is_deleted'=>0))
            ->join('left join hospital as h on c.hospital_id = h.id')
            ->join('left join hospital as h1 on h.pid = h1.id')
            ->order('c.id desc')
            ->select();
        $this->response(array('info'=>$list),json,200);
    }

    /**
     * 获取视频详情
     * @author zzl
     * @date 2020/1/14
     */
    public function getClassDetail()
    {
        $id = I('get.id');
        $info = M('class')
            ->alias('c')
            ->field('c.title as class_title,c.video,c.info,h.name,h.title,h.class,h1.name as hospital_name')
            ->where(array('c.id'=>$id))
            ->join('left join hospital as h on c.hospital_id = h.id')
            ->join('left join hospital as h1 on h.pid = h1.id')
            ->find();
        $this->response(array('info'=>$info),json,200);
    }
}