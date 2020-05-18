<?php
/**
 * Created by PhpStorm.
 * User: 29588
 * Date: 2020/1/14
 * Time: 10:38
 */

namespace Api\Controller;


class AnswerController extends BaseController
{
    /**
     * 获取问答集锦
     * @author zzl
     * @date 2020/1/14
     */
    public function getAnswerList()
    {
        $list = M('faq')
            ->field('faq.id,faq.title,faq.img,h.name,h1.name as hospital_name')
            ->where(array('faq.is_deleted'=>0))
            ->join('left join hospital as h on faq.hospital_id = h.id')
            ->join('left join hospital as h1 on h.pid = h1.id')
            ->order('faq.sort desc')
            ->select();
        $this->response(array('info'=>$list),json,200);
    }

    /**
     * 获取问答详情
     * @author zzl
     * @date 2020/1/14
     */
    public function getAnswerDetail()
    {
        $id = I('get.id');
        $doctor_info = M('faq')
            ->field('faq.title as faq_title,h.name,h.title,h.class,h1.name as hospital_name')
            ->join('left join hospital as h on faq.hospital_id = h.id')
            ->join('left join hospital as h1 on h.pid = h1.id')
            ->find();
        $answer_list = M('faq')
            ->alias('f')
            ->field('fd.num,fd.question,fd.desc,fd.answer')
            ->where(array('f.id'=>$id,'fd.is_deleted'=>0))
            ->join('left join faq_detail as fd on f.id = fd.faq_id')
            ->order('fd.num')
            ->select();
        $info = array(
            'doctor_info'=>$doctor_info,
            'answer_info'=>$answer_list
        );
        $this->response(array('info'=>$info),json,200);
    }
}