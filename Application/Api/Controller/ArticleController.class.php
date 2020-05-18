<?php
namespace Api\Controller;
use Think\Controller;
class ArticleController extends BaseController{
  /**
  *获取文章分类 get
  *@param: 
  *@return:
  */
  public function getCategory(){
    $data = M('category')
    ->field('id,title')
    ->where(array('display'=>1,'status'=>1))
    ->select();
    $this->response(array('info'=>$data),json,200);
  }

  /**
  *获取文章列表 get
  *@param: category_id,page
  *@return:
  */
  public function getArticles(){
    $category_id = I('get.category_id');
    $page = I('get.page')?I('get.page'):1;
    if(!$category_id){
      $this->response(array('info'=>'参数错误'),json,400);
    }
    $data = M('document')
    ->field('document.id,title,category_id,description,display,view,document.create_time,document_article.bookmark, picture.path')
    ->where(array('category_id'=>$category_id,'display'=>1,'document.status'=>1))
    ->join('picture on picture.id = document.cover_id')
    ->join('document_article on document_article.id = document.id')
    ->order('level desc,create_time desc')
    ->page($page,10)
    ->select();
    $this->response(array('info'=>$data),json,200);
  }

  /**
  *获取文章
  *@param: article_id:文章id
  *@return:
  */
  public function getArticleDetail(){
    $article_id = I('get.article_id');
    if(!$article_id){
      $this->response(array('info'=>'参数错误'),json,400);
    }
    $data = M('document')
    ->where(array('document.id'=>$article_id))
    ->field('document.id,title,category_id,description,display,view,document.create_time,document_article.content,document_article.bookmark')
    ->join('document_article on document_article.id = document.id')
    ->find();
    $this->response(array('info'=>$data),json,200);
  }

  /**
  *增加阅读量 post
  *@param: article_id
  *@return:
  */
  public function addView(){
    $post = json_decode(file_get_contents('php://input'), true);
    // $post = I('post.');
    if(!$post['article_id']){
      $this->response(array('info'=>'参数错误'),json,400);
    }
    $data = M('document')
    ->where(array('document.id'=>$post['article_id']))
    ->setInc('view');

    $new_data = M('document')->find($post['article_id']);
    $this->response(array('info'=>$new_data),json,200);
  }

}