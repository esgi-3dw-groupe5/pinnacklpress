<?php

namespace controller\posts;

class Post extends \sophwork\app\controller\AppController {
    
    protected $post = [];
    protected $title;
    protected $content;
    
    public function __construct(){
        parent::__construct();
        $this->post = $this->KDM->create('pp_page');
    }

    public function createPost($POST){
        $this->post->setPostTitle($POST['title']);
        $this->post->setPostContent($POST['content']);
        $this->post->save();
    } 

    public function getPosts($ids = null){

        $aIds = $ids;

        if(is_null($ids)){
            $this->post->findPageType('post');
            $posts = $this->post->getData();

            $aIds = $posts['page_id'];
        }

        $pageMeta = $this->KDM->create('pp_pagemeta');
        $nbPost = 0;
        $aPosts = [];
        foreach ($aIds as $key => $value) {
            $pageMeta->findPageId($aIds[$key]);
            $arrayContents = $pageMeta->getData();

            foreach ($arrayContents['pmeta_value'] as $k => $val) {
                if($arrayContents['pmeta_name'][$k] == 'content' && $arrayContents['page_id'][$k] == $aIds[$key]){
                    if(!is_null($ids)){
                        $this->post->findPageId($aIds[$key]);
                        $posts = $this->post->getData();
                        $aPosts['title'][$nbPost] = $posts['page_name'][0];
                        $aPosts['author'][$nbPost] = $posts['page_author'][0];
                    }else{
                        $aPosts['title'][$nbPost] = $posts['page_name'][$key];
                        $aPosts['author'][$nbPost] = $posts['page_author'][$key];
                    }
                    
                    $aPosts['content'][$nbPost] = $val;
                }
            }
            $nbPost++;
        }

        return $aPosts;
    }

    public function getPostsCateg($cat){
        $pageMeta = $this->KDM->create('pp_pagemeta');
        $pageMeta->find();
        $posts = $pageMeta->getData();
        $aIds   = [];
        foreach ($posts['pmeta_value'] as $key => $value) {
            if($posts['pmeta_value'][$key] == $cat){
                $aIds[] = $posts['page_id'][$key];
            }
        }

        $aPosts = Post::getPosts($aIds);

        return $aPosts;
    }   
}
