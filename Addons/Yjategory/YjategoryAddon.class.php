<?php

namespace Addons\Yjategory;
use Common\Controller\Addon;

/**
 * 示列插件
 * @author 无名
 */

    class YjategoryAddon extends Addon{

        public $info = array(
            'name'=>'Yjategory',
            'title'=>'联动',
            'description'=>'联动描述',
            'status'=>1,
            'author'=>'Xiye',
            'version'=>'0.1'
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }
        private function strToArr(){

        }
        //实现的Yjategory钩子方法
        public function Yjategory($param){
            if(!$param){
                return;
            }
           
            $default['value'] =$param['value'];
            $extra =str2arr($param['extra']);
            //格式 document_hospital,1,title逗号隔开
            // array (size=3)
            //       0 => string 'document_hospital' (length=17)表名称
            //       1 => string '1' (length=1) 是否是独立模型 1是 0是文档模型
            //       2 => string 'title' (length=5) 字段
           
            $model =$extra['0'];

            $field =$extra['2'];
            if($extra['1']=='1'){

                $data =M('document')
                        ->join("$model on document.id =$model.id")
                        ->where(array('status'=>'1'))
                        ->field("document.id,$field")
                        ->select();
            }elseif($model=='member'){
                $data =M("$model")                       
                        ->field("uid,$field")
                        ->select();
            }
            else{
                $data =M("$model")                       
                        ->field("id,$field")
                        ->select();
            }
            foreach ($data as $key => $value) {
                $data[$key]['value'] =$default['value'];
            }
            $this->assign('param',$param);
            $this->assign('data',$data);
            $this->assign('field',$field);
            $this->assign('default',$default);
            $this->display('yjategory');
        }

    }