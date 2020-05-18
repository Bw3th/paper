<?php
namespace Api\Controller;
use Think\Log;
use Think\Controller;
use Think\Controller\RestController;
use Com\Wechat\Jssdk\Jssdk;
use Com\Wechat\JsApiPay;
use Com\Wechat\lib\WxPayUnifiedOrder;
use Com\Wechat\lib\WxPayApi;
use Com\Wechat\WechatApi;
use Com\Wechat\Wechat;
use Com\Wechat\lib\WxPayNotify;
use Think\Exception;

class WechatController extends BaseController{
  public function getSignPackage(){
    $url = I('get.url');
    $jssdk = new Jssdk();
    $signPackage = $jssdk->getSignPackage($url);
    $this->response($signPackage, 'JSON');
  }

  public function downloadImage(){
    $media_id = I('get.media_id');
    $jssdk = new Jssdk();
    $file = $jssdk->getMedia($media_id);
    if(!$file){
      $this->response(array('msg'=>$jssdk->errmsg),'JSON', 500);
    }
    $fileDirver = new \Think\Storage\Driver\File();// 实例化上传类 
    $filePath = './Uploads/Images/'.date('Y-m-d/').uniqid('').'.jpg';

    try{
      $fileDirver->put($filePath ,$file);
    }
    catch (\Think\Exception $e){
      $this->response(array('msg'=>$e->getMessage()), 'JSON', 500);
    }

    $filePath = substr($filePath, 1);
    $this->response(array('info'=>$filePath),'json',200);
  }

  //创建菜单
  public function createToMenus(){
    $WechatApi = new WechatApi();
    $url1 ="http://awq.xoncology.com/Home/index/index/";
    $menu =  array(
      "button"=>
      array( 
       array('type'=>'view','name'=>'“走遍中国前列县(腺)”网络科普公益活动','url'=>$url1)
       )
      );

    $data =$WechatApi->createMenu($menu);
    foreach ($data as $key => $value) {
      \Think\Log::write($value,'WARN');
    }
    $re = $WechatApi->getMenu();
    foreach ($re as $key => $value) {
      dump($re['menu']['button']);
      \Think\Log::write($value,'WARN');
    }
  }

  public function valid(){
    $token ='abcdefg';
    $wechat = new Wechat($token);
    $data = $wechat->request();
    //记录 微信 返回信息
    // foreach ($data as $key => $value) {
    //     \Think\Log::write($key,'WARN');

    //     \Think\Log::write($value,'WARN');
    // }
    // ToUserName 微信公众号名称
    // gh_956529496c8d 
    // FromUserName 关注着open_id
    // oqoSut27UAhtTMcnwzXehpMDMM5k
    // CreateTime 关注时间
    // 1463563329
    // MsgType 消息类型
    // event
    // Event 事件
    // subscribe 
    // EventKey 参数
    // qrscene_556
    // Ticket ticket
    // gQFX7zoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL2tVeGtqT2ZsTENsVlpLWnd5MlJ1AAIECDQ8VwMEAAAAAA==
    // //

    // foreach ($data as $key => $value) {
    //   \Think\Log::write($key,'WARN');
    //   \Think\Log::write($value,'WARN');
    // }
    foreach ($data as $key => $value) {
        \Think\Log::write($key,'WARN');
        \Think\Log::write($value,'WARN');
    }
    if($data['Event']=='unsubscribe'){
      //取消关注事件，
      return;
    }
    $WechatApi =new WechatApi();
    $open_id = $data['FromUserName'];
    // if($data['Event'] =='SCAN'||$data['Event'] =='subscribe'){
    //   //二维码事件
     
    //   if($data['Event'] =='SCAN'&&$data['EventKey']){
    //        //已经关注的
    //       $doctor_id =$data['EventKey'];
    //   }
    if($data['Event'] =='subscribe'){
      //未关注的
      $text = '欢迎关注“扁鹊医疗”网络科普公益平台，“扁鹊医疗”是由癌症防治领域专业人员共同发起的网络科普公益平台，普及癌症防治知识，服务广大群众。特别声明：本平台不对社会做任何形式的募资！';
      $type='text';
      $wechat->response($text,$type);
    }
      
    //   if(!$doctor_id){
    //       return;//不是带参数的二维码 
    //   }
    //   $doctor = M('doctor')->where(array('id'=>$doctor_id))->find();
     
    //   $userApi = new UserApi(); 
    //   $user_info =$WechatApi->getUserInfo($open_id);

     
    //   $uid = $userApi->createUserByWx($user_info);

    //   if($uid){
    //       \Think\Log::write('11111','WARN');
    //       $doctor =M('doctor')
    //           ->join('picture on picture.id = doctor.head_img','left')
    //           ->where(array('doctor.id'=>$doctor_id))
    //           ->find();
    //       $image = new \Think\Image();
    //       $newwater  ="./".$doctor['path'];
          
    //       $image->open($newwater);
    //       $savewater ='./Uploads/Picture/2017-01-18/'.uniqid('').'.jpg';
        
    //       $image->crop(300,150,0,40)
    //           // ->thumb(100,100,\Think\Image::IMAGE_THUMB_CENTER)
    //           ->save($savewater);
    //       $doctor_path='http://fuscc-thoracic.xoncology.com/'.$savewater;    
    //       $off_url ="http://fuscc-thoracic.xoncology.com/Public/app/dist/#/officeinfo/2";
    //       $order_url ="http://fuscc-thoracic.xoncology.com/Home/index/order/";
    //       $yuyue =  "http://fuscc-thoracic.xoncology.com/Public/app/dist/images/guahao.png";
    //       $yuyuan =  "http://fuscc-thoracic.xoncology.com/Public/app/dist/images/ruyuan.png";
    //       // $this->pictureMessage($doctor_id,$open_id);
    //       $thumb_media_id ='FxFx8gUXCdvL-4dQCq2u_dTCccvf5apo7x8oJaZN98I';
    //       $new =array($doctor['welcomes'],$doctor['welcomes'],$doctor['needurl'],$doctor_path);
    //       $new2 =array('专家介绍','专家介绍',$doctor['needurl'],$doctor_path);
    //       $new3 =array('预约挂号','预约挂号',$doctor['order_url'],$yuyue);
    //       $new4 =array('线上入院','线上入院',$order_url,$yuyuan);
    //       $wechat->replyNews($new,$new2,$new3,$new4);
    //   }
    // }
  }
}