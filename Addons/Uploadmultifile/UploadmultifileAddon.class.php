<?php

namespace Addons\Uploadmultifile;
use Common\Controller\Addon;

/**
 * 图片批量上传插件
 * @author 原作者:tjr&jj
 * @author 木梁大囧
 */

    class UploadmultifileAddon extends Addon{
        public $info = array(
            'name' => 'Uploadmultifile',
            'title' => '多附件上传',
            'description' => '多附件上传',
            'status' => 1,
            'author' => 'Xiye',
            'version' => '1.2'
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

        //实现的UploadImages钩子方法
        public function Uploadmultifile($param){
            $name = $param['name']?$param['name']:'files';
            $valArr = $param['value'] ? explode(',', $param['value']) : array();
            $files = array();
            if(count($valArr)!=0){
                foreach ($valArr as $key => $value) {
                    # code...
                    $files[$key]['id'] = $value;
                    $re_file = M('file')->find($value);
                    $files[$key]['name'] = $re_file['name'];
                }
            }
            $this->assign('name',$name);
            $this->assign('valStr',$param['value']);
            $this->assign('valArr',$files);
            $this->display('uploadmultifile');
        }
    }