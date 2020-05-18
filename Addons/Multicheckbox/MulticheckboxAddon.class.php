<?php

namespace Addons\Multicheckbox;
use Common\Controller\Addon;

/**
 * 示列插件
 * @author 无名
 */

    class MulticheckboxAddon extends Addon{

        public $info = array(
            'name'=>'Multicheckbox',
            'title'=>'多选联动',
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
        public function Multicheckbox($param){
            if(!$param){
                return;
            }
            //$param 有三个参数
            //name:表名
            //value:字段值
            //extra:后台设置的自定义条件，为字符串，需要转成array
            $extra = str2arr($param['extra']);
            $model = $extra['0'];//关联表的表名
            $where = $extra['1'];//条件
            $field = $extra['2'];//显示的字段

            //$data 为 checkbox选项
            $data = M("$model")->where("$where")->field("$model.id,$field")->order('sort asc')->select();
            
            $this->assign('data',$data);
            $this->assign('showname',$field);
            $this->assign('name',$param['name']);
            $this->assign('valStr',$param['value']);
            $this->display('multicheckbox');
        }

    }