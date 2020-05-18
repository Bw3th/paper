<?php
/**
 * Created by PhpStorm.
 * User: 29588
 * Date: 2020/1/14
 * Time: 14:51
 */

namespace Api\Controller;


class KnowledgeController extends BaseController
{
    /**
     * 获取疾病知识列表
     * @author zzl
     * @date 2020/1//14
     */
    public function getKnowledgeList()
    {
        $list = M('knowledge')
            ->field('id,title,info,img,author')
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
    public function getKnowledgeDetail()
    {
        $id = I('get.id');
        $info = M('knowledge')
            ->field('title,info,create_time')
            ->where(array('id'=>$id))
            ->find();
        $this->response(array('info'=>$info),json,200);

    }
}