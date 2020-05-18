<?php

namespace Addons\Cities;
use Common\Controller\Addon;

/**
 * 省市区三级联动插件
 * @author Vicky
 */

    class CitiesAddon extends Addon{

        public $info = array(
            'name'=>'Cities',
            'title'=>'省市区三级联动',
            'description'=>'省市区三级联动',
            'status'=>1,
            'author'=>'Vicky',
            'version'=>'1.0'
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

        //实现的Cityies钩子方法
        public function Cities($param){
            $provinces = M('vc_citys')->where('ParentId=100000')->select();

            $name = $param['name']?$param['name']:'districe';

            $valArr = $param['value'] ? explode(',', $param['value']) : array();
            $province = $valArr[0]?$valArr[0]:null;
            $city = $valArr[1]?$valArr[1]:null;
            $district = $valArr[2]?$valArr[2]:null;

            if($province){
                $citys = M('vc_citys')->where(array('ParentId'=>$province))->select();
            }else{
                $citys = null;
            }

            if($city){
                $districts = M('vc_citys')->where(array('ParentId'=>$city))->select();
            }else{
                $districts = null;
            }

            $this->assign('name',$name);

            $this->assign('provinces',$provinces);
            $this->assign('citys',$citys);
            $this->assign('districts',$districts);

            $this->assign('province',$province);
            $this->assign('city',$city);
            $this->assign('district',$district);

            $this->display('cities');
        }


    }