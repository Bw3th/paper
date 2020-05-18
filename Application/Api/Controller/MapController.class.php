<?php
/**
 * Created by PhpStorm.
 * User: 29588
 * Date: 2020/1/13
 * Time: 10:56
 */

namespace Api\Controller;


class MapController extends BaseController
{
    /**
     * 获取所有省份
     * @author zzl
     * @date 2020/1/13
     */
    public function getProvincialList()
    {
        $list = M('provincial')
            ->field('id,provincialName')
            ->where(['is_deleted'=>0])
            ->order('id')
            ->select();
        $this->response(array('info'=>$list),json,200);
    }

    /**
     * 获取省份对应的市
     * @author zzl
     * @date 2020/1/13
     */
    public function getCityList()
    {
        $pid = I('get.id');
//        $pid || $this->response('网络不稳定，请稍后再试！',json,400);

        $list = M('city')
            ->field('id,cityName')
            ->where(['provincial_id'=>$pid,'is_deleted'=>0])
            ->order('id')
            ->select();
        $this->response(array('info'=>$list),json,200);
    }

    /**
     * 获取医院列表
     * @author zzl
     * @date 2020/1/13
     */
    public function getHospitalList()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $map = array();
        $map['h.pid'] = 0;
        $map['h.is_deleted'] = 0;
        if($post['cont']){
            $map['h.name'] = array('like',$post['cont'].'%');
            unset($map['h.pid']);
        }
        if($post['provincial_id'] != 0){
            $map['h.provincial_id'] = $post['provincial_id'];
            unset($map['h.pid']);

        }
        if($post['city_id'] != 0){
            $map['h.city_id'] = $post['city_id'];
            unset($map['h.pid']);

        }

        $list = M('hospital')
            ->alias('h')
            ->field('h.id,h.name,h.title,h.level,h.img,h.pid,p.provincialName,h1.name as hospital_name')
            ->where($map)
            ->join('left join provincial as p on h.provincial_id = p.id')
            ->join('left join hospital as h1 on h.pid = h1.id')
            ->order('h.pid,h.id')
            ->select();
        $this->response(array('info'=>$list),json,200);
    }

    /**
     * 获取医院详情
     * @author zzl
     * @date 2020/1/13
     */
    public function getHospitalDetail()
    {
        $id = I('get.id');
        $info = M('hospital')
            ->field('id,name,title,level,img,info')
            ->where(array('id'=>$id))
            ->find();
        $list = M('hospital')
            ->field('id,name,title,img,class')
            ->where(array('pid'=>$id))
            ->order('id')
            ->select();
        $this->response(array('info'=>$info,'list'=>$list),json,200);
    }

    /**
     * 获取医生详情
     * @author zzl
     * @date 2020/1/13
     */
    public function getDoctorDetail()
    {
        $id = I('get.id');
        $info = M('hospital')
            ->alias('h')
            ->field('h.id,h.name,h.title,h.img,h.class,h.info,h1.name as hospital_name')
            ->where(array('h.id'=>$id))
            ->join('left join hospital as h1 on h.pid = h1.id')
            ->find();
        $this->response(array('info'=>$info),json,200);
    }
}





















