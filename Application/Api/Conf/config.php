<?php
return array(
  //'配置项'=>'配置值'
  
    'URL_ROUTER_ON'   => true, //开启路由
    'URL_ROUTE_RULES' => array( //定义路由规则

    //获取文章分类
    array('article/category', 'article/getCategory', '', array('method' => 'get')),
    //获取文章列表get(category_id,page)
    array('article/articles', 'article/getArticles', '', array('method' => 'get')),
    //获取文章详细内容get(article_id)
    array('article/articledetail', 'article/getArticleDetail', '', array('method' => 'get')),
    //更新阅读量get(article_id)，返回的数据为更新后的数据
    array('article/addview', 'article/addView', '', array('method' => 'post')),
    
 
  ),


    /* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Download/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）

  
       /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'onethink_home', //session前缀
    'COOKIE_PREFIX'  => 'onethink_home_', // Cookie前缀 避免冲突

    
    /* 图片上传相关配置 */
   
    
);

