<?php
/**
 * Created by PhpStorm.
 * User: 29588
 * Date: 2020/1/15
 * Time: 10:03
 */

namespace Api\Controller;


class LiveController extends BaseController
{
    /**
     * 获取往期直播列表
     * @author zzl
     * @date 2020/1/15
     */
    public function getLiveList()
    {
        $list = M('live')
            ->alias('l')
            ->field('l.id,l.title as live_title,l.begin_time,l.end_time,h.name,h.img,h1.name as hospital_name')
            ->where(array('l.is_deleted'=>0))
            ->join('left join hospital as h on l.hospital_id = h.id')
            ->join('left join hospital as h1 on h.pid = h1.id')
            ->order('l.create_time desc')
            ->select();
        $this->response(array('info'=>$list),json,200);
    }

    /**
     * 获取直播详情
     * @author zzl
     * @date 2020/1/15
     */
    public function getLiveDetail()
    {
        $id = I('get.id');
        $info = M('live')
            ->alias('l')
            ->field('l.title as live_title,l.img as live_img,l.info,l.begin_time,l.end_time,h.name,h.img,h.class,h.title,h1.name as hospital_name')
            ->where(array('l.id'=>$id))
            ->join('left join hospital as h on l.hospital_id = h.id')
            ->join('left join hospital as h1 on h.pid = h1.id')
            ->find();
        $this->response(array('info'=>$info),json,200);
    }
}